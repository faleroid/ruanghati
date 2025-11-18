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

$forumModel = new ForumModel($conn);

$content = $_POST['content'];
$threadId = isset($_POST['thread_id']) ? (int)$_POST['thread_id'] : 0;
$userId = $_SESSION['user_id'];

if (UserPayloadValidator::areEmpty([$content]) || $threadId <= 0) {
    header("Location: ../../../public/thread.php?id=$threadId&error_reply=Balasan tidak boleh kosong");
    exit;
}

$success = $forumModel->createReplyToThread($threadId, $userId, $content);

if ($success) {
    header("Location: ../../../public/thread.php?id=$threadId#reply-form");
} else {
    header("Location: ../../../public/thread.php?id=$threadId&error_reply=Gagal mengirim balasan");
}

mysqli_close($conn);
exit;