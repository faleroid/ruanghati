<?php
class JournalModel {
    private $conn;

    public function __construct($db_connection) {
        $this->conn = $db_connection;
    }

    public function createJournal($userId, $data) {
        $sql = "INSERT INTO journal_entries (user_id, entry_date, situation, auto_thought, alt_thought) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        
        if (!$stmt) {
             die("Error preparing statement: " . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param(
            $stmt, 
            "issss", 
            $userId, 
            $data['date'], 
            $data['situation'], 
            $data['auto_thought'], 
            $data['alt_thought']
        );
        
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function getEntriesByUserId($userId) {
        $entries = [];
        $sql = "SELECT * FROM journal_entries WHERE user_id = ? ORDER BY entry_date DESC, created_at DESC";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) {
             die("Error preparing statement: " . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $entries[] = $row;
        }
        
        mysqli_stmt_close($stmt);
        return $entries;
    }

    public function getEntryById($entryId, $userId) {
        $sql = "SELECT * FROM journal_entries WHERE entry_id = ? AND user_id = ?";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) {
             die("Error preparing statement: " . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param($stmt, "ii", $entryId, $userId);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $entry = mysqli_fetch_assoc($result);
        
        mysqli_stmt_close($stmt);
        return $entry;
    }

    public function update($entryId, $userId, $data) {
        $sql = "UPDATE journal_entries SET 
                entry_date = ?, 
                situation = ?, 
                auto_thought = ?, 
                alt_thought = ? 
                WHERE entry_id = ? AND user_id = ?";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) {
             die("Error preparing statement: " . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param(
            $stmt, 
            "ssssii",
            $data['date'],
            $data['situation'],
            $data['auto_thought'],
            $data['alt_thought'],
            $entryId,
            $userId
        );

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function delete($entryId, $userId) {
        $sql = "DELETE FROM journal_entries WHERE entry_id = ? AND user_id = ?";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) {
             die("Error preparing statement: " . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param($stmt, "ii", $entryId, $userId);
        $result = mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);
        return $result;
    }
}