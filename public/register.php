<?php
require_once '../app/templates/header.php';

if (isset($_SESSION['user_id'])) {
    header('Location: journal.php');
    exit;
}
?>

<div class="auth-container-centered">
    <div class="form-box">
        <h2>Daftar Akun Baru</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <p class="notification error"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'reg_success'): ?>
            <p class="notification error">Registrasi berhasil! Silakan login.</p>
        <?php endif; ?>


        <form action="../app/controllers/auth/register.php" method="POST">
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
            <button type="submit" class="btn">Daftar</button>
        </form>
    </div>
    <a href="login.php">login</a>
</div>

<?php
require_once '../app/templates/footer.php';
?>