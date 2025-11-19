<?php
$pageStylesIndex = "public/css/welcomingPage.css";
require_once 'app/templates/header.php'; 

if (isset($_SESSION['user_id'])) {
    header('Location: public/landing_page.php');
    exit;
}
?>

<section class="welcome">
        <?php if (isset($_GET["status"]) && $_GET["status"]=="logout_success"): ?>
                <p class="notification error">Anda berhasil logout.</p>
        <?php endif; ?>
        <div class="welcome-wrapper">
            <div class="content">
                <div class="text">
                    <h1>Buka Kacamatamu dengan Sudut Pandang yang Belum Pernah Kamu Bayangkan</h1>
                    <p>Bertumbuh bersama dan kuasai manajemen emosional yang lebih baik.</p>
                </div>
                <div class="welcome-btn">
                    <a href="public/login.php" class="btn">Mulai Sekarang</a>
                </div>
            </div>
            <div class="image">
                    <img src="public/assets/images/main.svg">
            </div>
        </div>
</section>

    <div class="feature-lists">
            <h2>Temukan Ruangmu</h2>
            <div class="feature">
                <h3>Ruang Hening</h3>
                <p>Saat pikiran sedang kalut atau overthinking, RuangHening adalah tempat amanmu. Ini adalah jurnal 100% privat yang dirancang untuk membantumu "membedah" pikiran.
                </p>
            </div>
            <div class="feature right-text">
                <h3>Lingkar Cerita</h3>
                <p>ruang komunitas yang aman untuk saling memberi dukungan, menemukan validasi, dan menyadari bahwa kita semua berjuang bersama. Baik memberi atau menerima, temukan kekuatan dalam kebersamaan.
                </p>
            </div>
            <div class="feature">
                <h3>Ruang Nafas</h3>
                <p>Temukan artikel edukasi yang ringkas, video latihan pernapasan terpandu, dan daftar hotline darurat kesehatan jiwa yang bisa langsung Anda hubungi.
                </p>
            </div>
    </div>

<?php 
    require_once 'app/templates/footer.php'; 
?>