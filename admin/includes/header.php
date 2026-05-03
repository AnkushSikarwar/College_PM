<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - College Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; }
        .sidebar { min-height: 100vh; background-color: #1e293b; transition: all 0.3s; }
        .sidebar-link { color: #cbd5e1; text-decoration: none; padding: 12px 20px; display: block; border-left: 4px solid transparent; transition: all 0.2s; }
        .sidebar-link:hover, .sidebar-link.active { color: #fff; background-color: #334155; border-left-color: #3b82f6; }
        .sidebar-link i { width: 25px; text-align: center; margin-right: 10px; }
        .main-content { flex: 1; transition: all 0.3s; }
        .topbar { background-color: #fff; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); padding: 15px 25px; }
        .card { border: none; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 24px; }
    </style>
</head>
<body>
<div class="d-flex">
