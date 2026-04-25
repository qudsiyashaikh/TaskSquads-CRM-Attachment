<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskSquads CRM - File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Upload Task Attachment</h4>
                </div>
                <div class="card-body">
                    <form action="upload.php" method="POST" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                            <label for="task_id" class="form-label">Task ID</label>
                            <input type="number" name="task_id" id="task_id" class="form-control" placeholder="Enter Task ID (e.g., 1)" required>
                            <small class="text-muted">Note: Ensure this Task ID exists in the 'tasks' table.</small>
                        </div>

                        <div class="mb-3">
                            <label for="attachment" class="form-label">Select File</label>
                            <input type="file" name="attachment" id="attachment" class="form-control" required>
                            <small class="text-muted">Allowed: PDF, JPG, PNG, DOCX, XLSX, ZIP</small>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-success">Upload and Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>