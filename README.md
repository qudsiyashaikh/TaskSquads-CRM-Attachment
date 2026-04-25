# Task Management & Attachment System

A professional PHP-based Task Attachment System developed for the TaskSquads CRM assignment. This project allows Admins and Managers to securely upload documents related to specific tasks with strict validation rules.

## 🚀 Features
- **Role-Based Access Control (RBAC):** Only users with 'Admin' or 'Manager' roles can upload files.
- **Strict Validations:** - Restricts file types to: .pdf, .jpg, .png, .docx, .xlsx, .zip.
  - Enforces a maximum file size limit of **25MB**.
- **Dynamic Storage:** Automatically creates a structured directory (`/uploads/tasks/[task_id]/`) for each task.
- **Database Integration:** Securely logs file metadata (name, path, size, uploader) using PDO Prepared Statements to prevent SQL Injection.
- **Responsive UI:** Modern and clean success/error feedback pages using Bootstrap 5.

## 🛠️ Tech Stack
- **Backend:** PHP (Core)
- **Database:** MySQL (MariaDB)
- **Frontend:** HTML5, CSS3 (Custom), Bootstrap 5
- **Server:** XAMPP (Local Development)

## 📸 Screenshots
<img width="649" height="350" alt="Screenshot 2026-04-25 162714" src="https://github.com/user-attachments/assets/765466fd-3da1-4896-98a2-d7e0011408a1" />

*Success page after a secure file upload.*

## 📂 Folder Structure
```text
/tasksquads
│── db.php               # Database connection settings
│── index.php            # Main upload form interface
│── upload.php           # Backend logic & security validations
│── tasksquads_db.sql    # Database schema export
│── /uploads             # Directory where attachments are stored
└── README.md            # Project documentation
