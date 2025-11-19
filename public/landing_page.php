<?php
$pageTitle = "Login";
$pageStyles = "css/landing_page.css";
require_once '../app/templates/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../db/connect.php';
require_once '../app/models/JournalModel.php';

$journalModel = new JournalModel($conn);
$username = $_SESSION['username'];
?>

<div class="content">
    <div class="overview">
        <div class="text-side">
            <h2 class="main-title">Hola, <?php echo $username ?>!</h2>
            <p class="gray-text">Jangan sepelekan kesehatan mentalmu, ya.</p>
            <p>Jika, kamu merasa harimu melelahkan, tidak apa apa untuk beristirahat sejenak. Selain menjaga fisikmu tetap bugar, jaga terus mental kamu agar tetap selalu berpikir postif.</p>
            <p>Apabila suatu saat kamu butuh bantuan, kami menyediakan ahli yang bisa membantumu pulih.</p>
            <button class="btn-help"><a href="ruang_nafas.php">Cari Bantuan</a></button>
        </div>
        <img class="model" src="assets/images/dr.svg">
    </div>

    <br><br>

    <div class="features">
        <h2>Kamu Butuh yang Mana?</h2>
        <p class="gray-text">RuangHati selalu ada buat kamu</p>
        <br>
        <div class="features-wrapper">
            <div class="feature ft1">
                <h3>Ruang untuk Refleksi</h3>
                <p>Ketika kamu butuh untuk menilai padanganmu terhadap dirimu</p>
                <button><a href="journal.php">Pilih</a></button>
            </div>
            <div class="feature ft2">
                <h3>Ruang untuk Bertumbuh</h3>
                <p>Ketika kamu butuh sudut pandang dari orang lain</p>
                <button><a href="forum.php">Pilih</a></button>
            </div>
            <div class="feature ft3">
                <h3>Ruang untuk Inspirasi</h3>
                <p>Ketika kamu butuh mendapatkan sebuah insight tentang dirimu</p>
                <button><a href="ruang_nafas.php">Pilih</a></button>
            </div>
        </div>
    </div>

    <br><br>

    <div class="event-container">
        <h2>Acara dari RuangHati</h2>
        <p>Diskusi seputar kesehatan mental yang dibawakan oleh ahlinya.</p>
        <br>
        <div class="event-wrapper">
            <div class="card">
                <h3>Refreshing: Ulik Cara Latih Mental Bagi Generasi Muda</h3>
                <div class="card-text">
                    <p>Minggu, 29 November 2025</p>
                    <p>Online</p>
                </div>
                <a class="btn-e-regist" href=""><p>Daftar</p></a>
            </div>
            <div class="card">
                <h3>Question: Wajar Ngga Sih Sering Overthinking?</h3>
                <div class="card-text">
                    <p>Selasa, 3 Desember 2025</p>
                    <p>Online</p>
                </div>
                <a class="btn-e-regist" href=""><p>Daftar</p></a>
            </div>
            <div class="card">
                <h3>Tips: Bangun Positif Habit dengan Cara Menyenangkan</h3>
                <div class="card-text">
                    <p>Jumat, 6 Desember 2025</p>
                    <p>Online</p>
                </div>
                <a class="btn-e-regist" href=""><p>Daftar</p></a>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once '../app/templates/footer.php';
?>