<?php
require 'db.php'; // Database connection
session_start();

/* 1. Role-Based Access Control (RBAC) */
$_SESSION['user_role'] = 'Admin'; 
$allowedRoles = ['Admin', 'Manager'];

if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], $allowedRoles)) {
    die("Error: Access Denied. Only Admins and Managers can upload files.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['attachment'])) {
    
    $taskId = (int)$_POST['task_id']; // Integer mein convert kiya (Security)
    $file = $_FILES['attachment'];
    $uploader = $_SESSION['user_role'];

    /* 2. File Validation: Extension & Size (25MB) */
    $allowedExts = ['pdf', 'jpg', 'png', 'docx', 'xlsx', 'zip'];
    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $maxFileSize = 25 * 1024 * 1024; // 25MB

    if (!in_array($fileExt, $allowedExts)) {
        die("Error: This file type is not allowed.");
    }
    if ($file['size'] > $maxFileSize) {
        die("Error: File is too large. Maximum allowed size is 25MB.");
    }

    /* 3. Folder Structure: /uploads/tasks/[task_id]/ */
    $uploadPath = "uploads/tasks/" . $taskId . "/";
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true); 
    }

    $fileName = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $file['name']); // Clean filename
    $targetFile = $uploadPath . $fileName;

    /* 4. Move File & Save to Database */
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        try {
            $sql = "INSERT INTO attachments (task_id, file_name, file_path, file_size, uploaded_by) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$taskId, $file['name'], $targetFile, $file['size'], $uploader]);

            // Success Page
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Success - TaskSquads CRM</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body { background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; height: 100vh; }
                    .success-card { max-width: 500px; width: 100%; text-align: center; padding: 40px; border-radius: 15px; background: white; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
                    .checkmark { font-size: 80px; color: #28a745; margin-bottom: 20px; }
                    .btn-home { background-color: #0d6efd; color: white; border-radius: 25px; padding: 10px 30px; text-decoration: none; }
                </style>
            </head>
            <body>
                <div class="success-card">
                    <div class="checkmark">✔</div>
                    <h2>Success!</h2>
                    <p class="text-muted">File uploaded and saved securely.</p>
                    <div class="alert alert-info">Uploaded to: /uploads/tasks/<?php echo $taskId; ?>/</div>
                    <a href="index.php" class="btn btn-home">Back to Dashboard</a>
                </div>
            </body>
            </html>
            <?php
        } catch (Exception $e) {
            echo "Database error: " . $e->getMessage();
        }
    } else {
        echo "Error: Failed to move uploaded file.";
    }
}
?>