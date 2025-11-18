<?php
session_start();
require_once '../../../db/connect.php';
require_once '../../validator/UserPayloadValidator.php';
require_once '../../models/ForumModel.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../../public/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../../public/forum.php');
    exit;
}

$title = $_POST['title'];
$content = $_POST['content'];
$userId = $_SESSION['user_id'];

if (UserPayloadValidator::areEmpty([$title, $content])) {
    header('Location: ../../../public/forum.php?error=Judul dan isi pesan tidak boleh kosong');
    exit;
}

$forumModel = new ForumModel($conn);

$newThreadId = $forumModel->createThread($userId, $title);

if ($newThreadId) {
    $successPost = $forumModel->createReplyToThread($newThreadId, $userId, $content);
    
    if ($successPost) {
        header("Location: ../../../public/thread.php?id=$newThreadId");
    } else {
        header('Location: ../../../public/forum.php?error=Gagal membuat postingan');
    }
} else {
    header('Location: ../../../public/forum.php?error=Gagal membuat topik baru');
}

mysqli_close($conn);
exit;