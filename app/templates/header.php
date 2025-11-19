<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'RuangHati' ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <?php if (isset($pageStyles)): ?>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="<?= $pageStyles ?>">
    <?php endif; ?>

    <?php if (isset($pageStylesIndex)): ?>
        <link rel="stylesheet" href="<?= $pageStylesIndex ?>">
        <link rel="stylesheet" href="public/css/style.css">
    <?php endif; ?>
</head>
<body>
    <header>
        <nav>
            <?php if(isset($pageStylesIndex)): ?>
                <img src="public/assets/icons/logo.svg" alt="logo" width="85px">
            <?php else: ?>
                <a href="../index.php" class="logo">
                    <img src="assets/icons/logo.svg" alt="logo" width="85px">
                </a>  
            <?php endif; ?>
            <ul class="nav-menu">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="landing_page.php" class="landingpage">Beranda</a></li>
                    <li><a href="journal.php" class="ruanghening">Ruang Hening</a></li>
                    <li><a href="forum.php" class="lingkarcerita">Lingkar Cerita</a></li>
                    <li>
                        <a href="ruang_nafas.php" class="ruangnafas">Ruang Nafas</a>
                    </li>

                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li><a href="admin.php">Admin Panel</a></li>
                    <?php endif; ?>

                    <li><a href="../app/controllers/auth/logout.php" class="btn-logout">Logout</a></li>
                
                <?php else: ?>
                    <li><a href="public/ruang_nafas.php">Ruang Nafas</a></li>
                    <li>
                        <div class="btn-auth">
                            <?php if(isset($pageStylesIndex)): ?>
                                <a href="public/login.php" class="btn-login">Login</a>
                                <a href="public/register.php" class="btn-register">Daftar</a>
                            <?php else: ?>
                                <a href="login.php" class="btn-login">Login</a>
                                <a href="register.php" class="btn-register">Daftar</a>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main class="container">