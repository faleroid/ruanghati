<?php
class ForumModel {
    private $conn;
    public function __construct($db_connection) {
        $this->conn = $db_connection;
    }

    public function createThread($userId, $title) {
        $sql = "INSERT INTO forum_threads (user_id, title) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        
        if (!$stmt) {
             die("Error preparing statement: " . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param($stmt, "is", $userId, $title);
        mysqli_stmt_execute($stmt);
        
        $newThreadId = mysqli_insert_id($this->conn); // Ambil ID terakhir
        
        mysqli_stmt_close($stmt);
        return $newThreadId;
    }

    public function createReplyToThread($threadId, $userId, $content) {
        $sql = "INSERT INTO forum_posts (thread_id, user_id, content) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        
        if (!$stmt) {
             die("Error preparing statement: " . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param($stmt, "iis", $threadId, $userId, $content);
        $result = mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function getAllThreads() {
        $threads = [];
        // Kita JOIN dengan tabel 'users' untuk mendapatkan username
        $sql = "SELECT t.*, u.username 
                FROM forum_threads t
                JOIN users u ON t.user_id = u.user_id
                ORDER BY t.created_at DESC";
        
        $result = mysqli_query($this->conn, $sql);
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $threads[] = $row;
            }
        } else {
            die("Error query: " . mysqli_error($this->conn));
        }
        
        return $threads;
    }

    public function getThreadById($threadId) {
        $sql = "SELECT t.*, u.username 
                FROM forum_threads t
                JOIN users u ON t.user_id = u.user_id
                WHERE t.thread_id = ?";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $threadId);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $thread = mysqli_fetch_assoc($result);
        
        mysqli_stmt_close($stmt);
        return $thread;
    }

    public function getRepliesByThreadId($threadId) {
        $posts = [];
        $sql = "SELECT p.*, u.username 
                FROM forum_posts p
                JOIN users u ON p.user_id = u.user_id
                WHERE p.thread_id = ?
                ORDER BY p.created_at ASC";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $threadId);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }
        
        mysqli_stmt_close($stmt);
        return $posts;
    }
}