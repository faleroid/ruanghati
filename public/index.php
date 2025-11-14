<?php
require_once '../app/templates/header.php'; 

if (isset($_SESSION['user_id'])) {
    header('Location: journal.php');
    exit;
}
?>

<div class="welcome-container">
    <?php if (isset($_GET["status"]) && $_GET["status"]=="logout_success"): ?>
        <p class="notification error">Anda berhasil logout.</p>
    <?php endif; ?>

    <h1>Selamat Datang di RESONa</h1>
    <p>Aplikasi ini membantumu mengelola pikiran dan perasaanmu.</p>
    <div class="welcome">
        <a href="login.php" class="btn">Login</a>
        <a href="register.php" class="btn-secondary">Daftar</a>
    </div>
</div>

<?php 
    require_once '../app/templates/footer.php'; 
?>