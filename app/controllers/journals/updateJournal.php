<?php
session_start();
require_once '../../../db/connect.php';
require_once '../../validator/UserPayloadValidator.php';
require_once '../../models/JournalModel.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../../public/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../../public/journal.php');
    exit;
}

$entryId = $_POST['entry_id'];
$userId = $_SESSION['user_id'];
$data = [
    'date' => $_POST['date'],
    'situation' => $_POST['situation'],
    'auto_thought' => $_POST['auto_thought'],
    'alt_thought' => $_POST['alt_thought']
];

if (UserPayloadValidator::areEmpty([$data['date'], $data['situation'], $data['auto_thought']])) {
    header("Location: ../../../public/edit_journal.php?id=$entryId&error=Data tidak boleh kosong");
    exit;
}

$journalModel = new JournalModel($conn);
$success = $journalModel->update($entryId, $userId, $data);

if ($success) {
    header('Location: ../../../public/journal.php?status=updated');
} else {
    header("Location: ../../../public/edit_journal.php?id=$entryId&error=Gagal memperbarui jurnal");
}

mysqli_close($conn);
exit;