<?php
    $pageTitle = "Ruang Hening";
    $pageStyles = "css/ruang_nafas.css";
    require_once '../app/templates/header.php';
?>

<div class="content">
    <h2>Yuk, Cek Kebutuhanmu</h2>
    <p class="gray-text">Kamu bisa menghubungi ahli hingga melihat rekomendasi artikel atau konten</p>
    
    <br><br>

    <h3>Hubungi Ahli</h3>
    <p class="gray-text">Konsultasi serta diskusi dengan para ahli pilihan.</p>

    <br>

    <div class="card-wrapper">
        <div class="card">
            <h4>Raihan Dwi Ananda</h4>
            <p>Psikiater</p>
            <p>Pengalaman 1 - 2 tahun</p>
            <button>Atur Jadwal</button>
        </div>
        <div class="card">
            <h4>Naufal Satrio Putra</h4>
            <p>Ahli Neurologis</p>
            <p>Pengalaman 9 - 10 tahun</p>
            <button>Atur Jadwal</button>
        </div>
        <div class="card">
            <h4>Rahmat Darmawan</h4>
            <p>Psikiater</p>
            <p>Pengalaman < 1 tahun</p>
            <button>Atur Jadwal</button>
        </div>
        <div class="card">
            <h4>Aji Santoso</h4>
            <p>Psikolog</p>
            <p>Pengalaman 2 - 3 tahun</p>
            <button>Atur Jadwal</button>
        </div>
        <div class="card">
            <h4>Ella Cyntia</h4>
            <p>Psikiater</p>
            <p>Pengalaman 5 - 6 tahun</p>
            <button>Atur Jadwal</button>
        </div>
    </div>

    <br><br>

    <h3>Artikel yang Bisa Kamu Baca</h3>

    <br>

    <div class="article-wrapper">
        <div class="article">
            <h4>Hasil Survei I-NAMHS: Satu dari Tiga Remaja Indonesia Memiliki Masalah Kesehatan Mental</h4>
            <p><a href="https://ugm.ac.id/id/berita/23086-hasil-survei-i-namhs-satu-dari-tiga-remaja-indonesia-memiliki-masalah-kesehatan-mental/">
                Kunjungi
            </a></p>
        </div>
    </div>

    <br><br>

    <h3>Tes yang Bisa Kamu Coba</h3>

    <br>

    <div class="test-wrapper">
        <div class="test">
            <h4>Tes Depresi</h4>
            <p class="gray-text">Ukur gejala depresimu dengan metode PGQ-9</p>
            <button>Ambil Tes</button>
        </div>
        <div class="test">
            <h4>Tes Gangguan Mental</h4>
            <p class="gray-text">Ukur gejala gangguan mentalmu dengan metode GAD-7</p>
            <Button>Ambil Tes</Button>
        </div>
        <div class="test">
            <h4>Tes Stres</h4>
            <p class="gray-text">Pemeriksaan singkat untuk tingkat stresmu</p>
            <Button>Ambil Tes</Button>
        </div>
    </div>
</div>

<?php 
    require_once '../app/templates/footer.php';
?>