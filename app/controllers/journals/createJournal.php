<?php
session_start();
require_once '../../../db/connect.php';
require_once '../../validator/UserPayloadValidator.php';
require_once '../../models/JournalModel.php';

if (!isset($_SESSION['user_id']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../../public/login.php');
    exit;
}

$data = [
    'date' => $_POST['date'],
    'situation' => $_POST['situation'],
    'auto_thought' => $_POST['auto_thought'],
    'alt_thought' => $_POST['alt_thought']
];
$userId = $_SESSION['user_id'];

if (UserPayloadValidator::areEmpty([$data['date'], $data['situation'], $data['auto_thought']])) {
    header('Location: ../../../public/journal.php?error=Tanggal, Situasi, dan Pikiran Otomatis tidak boleh kosong');
    exit;
}

$journalModel = new JournalModel($conn);
$success = $journalModel->create($userId, $data);

if ($success) {
    header('Location: ../../../public/journal.php?status=success');
} else {
    header('Location: ../../../public/journal.php?error=Gagal menyimpan jurnal');
}

mysqli_close($conn);
exit;