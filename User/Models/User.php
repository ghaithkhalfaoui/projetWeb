<?php
class User
{
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function getAll() {
        return mysqli_query($this->db, "SELECT id_user, username, email FROM users ORDER BY id_user DESC");
    }

    public function find($id) {
        $stmt = mysqli_prepare($this->db, "SELECT * FROM users WHERE id_user = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }

    public function create($username, $email) {
        $stmt = mysqli_prepare($this->db, "INSERT INTO users (username, email) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        return mysqli_stmt_execute($stmt);
    }

    public function update($id, $username, $email) {
        $stmt = mysqli_prepare($this->db, "UPDATE users SET username = ?, email = ? WHERE id_user = ?");
        mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function delete($id) {
        $stmt = mysqli_prepare($this->db, "DELETE FROM users WHERE id_user = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt) > 0;
    }

    public function emailExists($email, $exclude = null) {
        $sql = "SELECT id_user FROM users WHERE email = ? AND id_user != ?";
        $stmt = mysqli_prepare($this->db, $sql);
        $exclude = $exclude ?? 0;
        mysqli_stmt_bind_param($stmt, "si", $email, $exclude);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        return mysqli_stmt_num_rows($stmt) > 0;
    }
}