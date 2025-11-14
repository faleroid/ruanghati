<?php
    require_once '../app/templates/header.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    require_once '../db/connect.php';
    require_once '../app/models/JournalModel.php';

    $journalModel = new JournalModel($conn);

    $userId = $_SESSION['user_id'];
    $entries = $journalModel->getEntriesByUserId($userId);
?>

<div class="form-box">
    <h2>Buat Entri Jurnal Baru</h2>
    
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <p class="success">Jurnal berhasil disimpan.</p>
    <?php endif; ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
        <p class="success">Jurnal berhasil dihapus.</p>
    <?php endif; ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
        <p class="success">Jurnal berhasil diperbarui.</p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="error"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <form action="../app/controllers/journals/createJournal.php" method="POST">
        <div class="form-group">
            <label for="date">Tanggal Kejadian</label>
            <input type="date" id="date" name="date" required value="<?= date('Y-m-d') ?>">
        </div>
        <div class="form-group">
            <label for="situation">Situasi</label>
            <textarea id="situation" name="situation" rows="3" placeholder="Apa yang terjadi?"></textarea>
        </div>
        <div class="form-group">
            <label for="auto_thought">Pikiran Otomatis</label>
            <textarea id="auto_thought" name="auto_thought" rows="3" placeholder="Apa yang Anda rasakan/pikirkan?"></textarea>
        </div>
        <div class="form-group">
            <label for="alt_thought">Pikiran Alternatif</label>
            <textarea id="alt_thought" name="alt_thought" rows="3" placeholder="Apa cara pandang lain yang lebih logis?"></textarea>
        </div>
        <button type="submit" class="btn">Simpan Jurnal</button>
    </form>
</div>


<div class="journal-list">
    <h2>Jurnal Saya</h2>
    
    <?php if (empty($entries)): ?>
        <p>Anda belum memiliki entri jurnal. Mulailah menulis!</p>
    <?php else: ?>
        <?php foreach ($entries as $entry): ?>
            <div class="journal-entry">
                <h3>Pada Tanggal: <?= htmlspecialchars($entry['entry_date']) ?></h3>
                <p><strong>Situasi:</strong><br> <?= nl2br(htmlspecialchars($entry['situation'])) ?></p>
                <p><strong>Pikiran Otomatis:</strong><br> <?= nl2br(htmlspecialchars($entry['auto_thought'])) ?></p>
                <p><strong>Pikiran Alternatif:</strong><br> <?= nl2br(htmlspecialchars($entry['alt_thought'])) ?></p>
                <div class="entry-actions">
                    <a href="edit_journal.php?id=<?= $entry['entry_id'] ?>" class="btn-edit">Edit</a>
                    <a href="../app/controllers/journals/deleteJournal.php?id=<?= $entry['entry_id'] ?>" 
                       class="btn-delete" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus jurnal ini?');">
                       Hapus
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php
    require_once '../app/templates/footer.php';
?>