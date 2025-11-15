<?php
require_once '../app/templates/header.php';
require_once '../db/connect.php';
require_once '../app/models/JournalModel.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$entryId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$userId = $_SESSION['user_id'];

$journalModel = new JournalModel($conn);
$entry = $journalModel->getEntryById($entryId, $userId);

if (!$entry) {
    header('Location: journal.php?error=Jurnal tidak ditemukan atau Anda tidak memiliki akses');
    exit;
}
?>

<div class="form-box">
    <h2>Edit Jurnal</h2>
    <a href="journal.php" class="btn-secondary" style="font-size: 14px;">Kembali</a>
    <br><br>

    <?php if (isset($_GET['error'])): ?>
        <p class="error"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <form action="../app/controllers/journals/UpdateJournal.php" method="POST">
        <input type="hidden" name="entry_id" value="<?= $entry['entry_id'] ?>">

        <div class="form-group">
            <label for="date">Tanggal Kejadian</label>
            <input type="date" id="date" name="date" required value="<?= htmlspecialchars($entry['entry_date']) ?>">
        </div>
        <div class="form-group">
            <label for="situation">Situasi</label>
            <textarea id="situation" name="situation" rows="3" required><?= htmlspecialchars($entry['situation']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="auto_thought">Pikiran Otomatis</label>
            <textarea id="auto_thought" name="auto_thought" rows="3" required><?= htmlspecialchars($entry['auto_thought']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="alt_thought">Pikiran Alternatif</label>
            <textarea id="alt_thought" name="alt_thought" rows="3" required><?= htmlspecialchars($entry['alt_thought']) ?></textarea>
        </div>
        <button type="submit" class="btn">Perbarui Jurnal</button>
    </form>
</div>

<?php
require_once '../app/templates/footer.php';
?>