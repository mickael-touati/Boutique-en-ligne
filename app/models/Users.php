<?php
namespace App\Models;

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($name, $mail, $password, $address = '') {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user (name, mail, password, address, role) VALUES (?, ?, ?, ?, 'client')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $mail, $hashed_password, $address]);
    }

    public function findByMail($mail) {
        $sql = "SELECT * FROM user WHERE mail = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$mail]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}