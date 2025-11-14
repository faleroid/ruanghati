<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESONA</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="logo">RESONA</a>
            <ul class="nav-menu">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="journal.php">Jejak Pikir</a></li>
                    <li><a href="forum.php">Lingkar Cerita</a></li>
                    <li><a href="resources.php">Ruang Nafas</a></li>

                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li><a href="admin.php">Admin Panel</a></li>
                    <?php endif; ?>

                    <li><a href="../app/controllers/auth/logout.php" class="nav-button">Logout</a></li>
                
                <?php else: ?>
                    <li><a href="resources.php">Ruang Nafas</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php" class="nav-button">Daftar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main class="container">