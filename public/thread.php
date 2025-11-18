<?php
$pageTitle = "Lingkar Cerita";
$pageStyles = "css/lingkar_cerita_reply.css";
require_once '../app/templates/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../db/connect.php';
require_once '../app/models/ForumModel.php';

$threadId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($threadId <= 0) {
    header('Location: forum.php?error=Topik tidak valid');
    exit;
}

$forumModel = new ForumModel($conn);

$thread = $forumModel->getThreadById($threadId);
$allPosts = $forumModel->getRepliesByThreadId($threadId);

if (!$thread) {
    header('Location: forum.php?error=Topik tidak ditemukan');
    exit;
}

$mainPost = array_shift($allPosts); 
$replies = $allPosts;
?>

<section class="content">
    <span class="btn-secondary"><a href="forum.php" >Kembali</a></span>
    <br>
    <div class="main-content">
        <div class="thread-header">
            <h2><?= htmlspecialchars($thread['title']) ?></h2>
            <span class="content-date"><p><?= date('d M Y, H:i', strtotime($thread['created_at']))  ?></p></span>
        </div>

        <div class="post-content">
            <p><?= nl2br(htmlspecialchars($mainPost['content'])) ?></p>
            <span class="content-owner"><p>ditulis oleh <?= nl2br(htmlspecialchars($mainPost['username'])) ?></p></span>
        </div>
    </div>

    <hr>

    <div class="form-box" id="reply-form">
        <?php if (isset($_GET['error_reply'])): ?>
            <p class="error"><?= htmlspecialchars($_GET['error_reply']) ?></p>
        <?php endif; ?>

        <form action="../app/controllers/forum/createReply.php" method="POST">
            <input type="hidden" name="thread_id" value="<?= $threadId ?>">
            
            <div class="form-group">
                <textarea id="content" name="content" rows="4" required placeholder="Tulis balasan..."></textarea>
            </div>
            <div class="btn-wrapper">
                <button type="submit" class="btn">Kirim Balasan</button>
            </div>
        </form>
    </div>

    <div class="post-list">
        <?php if (empty($replies)): ?>
            <p>Belum ada balasan di topik ini.</p>
        <?php else: ?>
            <h3 class="comment-tag">Komentar</h3>
            <?php foreach ($replies as $reply): ?>
                <div class="post-entry">
                    <div class="post-author">
                        <p class="post-owner"><?= htmlspecialchars($reply['username']) ?></p>
                        <span class="post-date"><p><?= date('d M Y | H:i', strtotime($reply['created_at'])) ?></p></span>
                    </div>
                    <div class="post-content">
                        <p><?= nl2br(htmlspecialchars($reply['content'])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php
require_once '../app/templates/footer.php';
?>