<?php
$pageTitle = "Daftar Akun";
$pageStyles = "css/auth.css";
require_once '../app/templates/header.php';

if (isset($_SESSION['user_id'])) {
    header('Location: journal.php');
    exit;
}
?>

<div class="auth-container">
    <div class="form-box">
        <h2>Daftar Akun RuangHati</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <p class="notification error"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'reg_success'): ?>
            <p class="notification error">Registrasi berhasil! Silakan login.</p>
        <?php endif; ?>


        <form action="../app/controllers/auth/register.php" method="POST" class="form-wrapper">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password">Konfirmasi Password</label>
                <input type="password" id="password-confirm" name="password-confirm" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Daftar</button>
            </div>
        </form>
    </div>
    <p>Sudah Punya Akun? <a href="login.php"> Masuk Sekarang</a></p>
</div>

<?php
require_once '../app/templates/footer.php';
?>