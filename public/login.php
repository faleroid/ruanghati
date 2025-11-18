<?php
$pageTitle = "Login";
$pageStyles = "css/auth.css";
require_once '../app/templates/header.php';

if (isset($_SESSION['user_id'])) {
    header('Location: journal.php');
    exit;
}
?>

<div class="auth-container">
    <div class="form-box">
        <h2>Masuk ke Akun RuangHati</h2>
        
        <?php if (isset($_GET['error_login'])): ?>
            <p class="notification error"><?= htmlspecialchars($_GET['error_login']) ?></p>
        <?php endif; ?>
        
        <form class="form-wrapper" action="../app/controllers/auth/login.php" method="POST">
            <div class="form-group">
                <label for="login_email">Email</label>
                <input type="email" id="login_email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login_password">Password</label>
                <input type="password" id="login_password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Login</button>
            </div>
        </form>
    </div>
    <p>Belum Punya Akun? <a href="register.php"> Daftar Akun Sekarang</a></p>
</div>

<?php
require_once '../app/templates/footer.php';
?>