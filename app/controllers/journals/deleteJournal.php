<?php
session_start();
require_once '../../../db/connect.php';
require_once '../../models/JournalModel.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../../public/login.php');
    exit;
}

$entryId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$userId = $_SESSION['user_id'];

if ($entryId <= 0) {
    header('Location: ../../../public/journal.php?error=ID jurnal tidak valid');
    exit;
}

$journalModel = new JournalModel($conn);
$success = $journalModel->delete($entryId, $userId);

if ($success) {
    header('Location: ../../../public/journal.php?status=deleted');
} else {
    header('Location: ../../../public/journal.php?error=Gagal menghapus jurnal atau jurnal tidak ditemukan');
}

mysqli_close($conn);
exit;