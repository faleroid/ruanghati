<?php
    $pageTitle = "Ruang Hening";
    $pageStyles = "css/ruang_hening.css";
    require_once '../app/templates/header.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    require_once '../db/connect.php';
    require_once '../app/models/JournalModel.php';

    $journalModel = new JournalModel($conn);

    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $entries = $journalModel->getEntriesByUserId($userId);
?>

<section class="content">
    <h2>Hai, <?php echo $username?>! Gimana kabarnya hari ini?</h2>

    <div class="content-wrapper">
        <div class="aside">
            <p>
                Ruang Hening merupakan sebuah metode berbasis Cognitive Behavioral Therapy yang bertujuan untuk merefleksikan diri dari berbagai pikiran jahat. 
                Berikut adalah beberapa jenis pikiran yang bisa membuatmu merasa terganggu.
            </p>
            <ul>
                <li>
                    <h3>Catastrophizing</h3>
                    <p>Otak yang selalu berasumsi skenario terburuk akan terjadi.</p>
                </li>
                <li>
                    <h3>Mind Reading</h3>
                    <p>Pikiran yang berasumsi bahwa kita tahu apa yang dipikirkan orang lain.</p>
                </li>
                <li>
                    <h3>Black-and-White Thinking</h3>
                    <p>Pikiran yang selalu ingin kita mejadi perfeksionis.</p>
                </li>
            </ul>
            <span class="motivate"><p>Dengan memahami berbagai jenis pikiran jahat, kamu bisa mengenal diri kamu jauh lebih baik sehingga bisa mengurangi tingkat kecemasan atau gangguan yang kamu alami.</p></span>
            <p>Sekarang waktunya kamu mengenal diri kamu lebih dekat!</p>
        </div>

        <hr>

        <div class="form-box">
            <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <p class="notification success">Jurnal berhasil disimpan.</p>
            <?php endif; ?>
            <?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
                <p class="notification success">Jurnal berhasil dihapus.</p>
            <?php endif; ?>
            <?php if (isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
                <p class="notification success">Jurnal berhasil diperbarui.</p>
            <?php endif; ?>
            <?php if (isset($_GET['error'])): ?>
                <p class="notification error"><?= htmlspecialchars($_GET['error']) ?></p>
            <?php endif; ?>

            <form action="../app/controllers/journals/createJournal.php" method="POST">
                <div class="form-group">
                    <label for="date">Waktu</label>
                    <input type="date" id="date" name="date" required value="<?= date('Y-m-d') ?>">
                </div>
                <div class="form-group">
                    <label for="situation">Bagaimana keadaamu?</label>
                    <textarea id="situation" name="situation" rows="3" placeholder="Apa yang terjadi?"></textarea>
                </div>
                <div class="form-group">
                    <label for="auto_thought">Apa saja yang kamu rasakan?</label>
                    <textarea id="auto_thought" name="auto_thought" rows="3" placeholder="Apa yang kamu rasakan?"></textarea>
                </div>
                <div class="form-group">
                    <label for="alt_thought">Apakah kamu punya sudut pandang lain?</label>
                    <textarea id="alt_thought" name="alt_thought" rows="3" placeholder="Apa cara pandang lain yang lebih logis?"></textarea>
                </div>
                <button type="submit" class="btn">Simpan</button>
            </form>
        </div>
    </div>

    <h2>Rekam Perjalananmu</h2>
    <div class="journal-list">
        <?php if (empty($entries)): ?>
            <p>Yuk, ukir pikiranmu dulu!</p>
        <?php else: ?>
            <?php foreach ($entries as $entry): ?>
                <div class="journal-entry">
                    <div class="journal-group">
                        <p class="date"><?= htmlspecialchars($entry['entry_date']) ?></p>
                    </div>
                    <div class="journal-wrapper">
                        <div class="journal-group">
                            <p>Kondisi:</p>
                            <p> <?= nl2br(htmlspecialchars($entry['situation'])) ?></p>
                        </div>
                        <div class="journal-group">
                            <p>Perasaan:</p>
                            <p><?= nl2br(htmlspecialchars($entry['auto_thought'])) ?></p>
                        </div>
                        <div class="journal-group">
                            <p>Pandangan lain:</p>
                            <?= nl2br(htmlspecialchars($entry['alt_thought'])) ?>
                        </div>
                    </div>
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
</section>  

<?php
    require_once '../app/templates/footer.php';
?>