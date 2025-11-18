<?php
$pageTitle = "Lingkar Cerita";
$pageStyles = "css/lingkar_cerita.css";

require_once '../app/templates/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../db/connect.php';
require_once '../app/models/ForumModel.php';

$forumModel = new ForumModel($conn);

$threads = $forumModel->getAllThreads();
?>

<div class="content">
        <div class="title">
            <h2>Lingkar Cerita</h2>
            <p class="desc">Ruang untuk berbagi pengalaman yang nyaman dan aman.</p>
        </div>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'thread_created'): ?>
            <p class="notification success">Topik baru berhasil dibuat.</p>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <p class="notification error"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>
    <div class="form-box">
        <form action="../app/controllers/forum/createThread.php" method="POST">
            <div class="form-group">
                <label for="title">Judul Topik</label>
                <input type="text" id="title" name="title" required placeholder="Apa judul topik diskusimu?">
            </div>
            <div class="form-group">
                <label for="content">Isi</label>
                <textarea id="content" name="content" rows="4" required placeholder="Tuliskan cerita atau pertanyaan kamu di sini..."></textarea>
            </div>
            <button type="submit" class="btn">Buat Topik</button>
        </form>
    </div>

    <div class="search-box">
        <form action="forum.php" method="GET">
            <div class="search-form">
                <input type="text" id="search" name="search" placeholder="Cari berdasarkan judul..." 
                       value="<?= htmlspecialchars($searchQuery ?? '') ?>">
            </div>
            <button type="submit" class="btn">Cari</button>
        </form>
    </div>

    <div class="thread-container">
        <h2 class="thread-header">Semua Topik Diskusi</h2>
        <br>
        <?php if (empty($threads)): ?>
            <p>Belum ada topik diskusi. Jadilah yang pertama!</p>
        <?php else: ?>
            <div class="thread-wrapper">
            <?php foreach ($threads as $thread): ?>
                <div class="thread-card">
                    <a class="thread-list" href="thread.php?id=<?= $thread['thread_id'] ?>">
                        <div class="thread-top">
                            <div class="thread-group">
                                <h3 class="thread-owner"><?= htmlspecialchars($thread['username']) ?></h3>
                            </div>
                            <div class="thread-group">
                                <h3 class="thread-date"><?= date('d M Y', strtotime($thread['created_at'])) ?></h3>
                            </div>
                        </div>
                        <div class="thread-group">
                            <h3 class="thread-title"><?= htmlspecialchars($thread['title']) ?></h3>
                        </div>
                    </a>
                    
                    <div class="thread-action-wrapper">
                        <div class="thread-action">
                            <span class="material-symbols-outlined">favorite</span><p>0</p>
                        </div>
                        <div class="thread-action">
                            <span class="material-symbols-outlined">mode_comment</span><p>0</p>
                        </div>
                        <div class="thread-action">
                            <span class="material-symbols-outlined">share</span><p>0</p>
                        </div>
                    </div>
                </div> 
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
    require_once '../app/templates/footer.php';
?>