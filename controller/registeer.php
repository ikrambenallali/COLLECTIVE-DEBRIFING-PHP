<?php
include __DIR__ . '/../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    var_dump($username);
    die();
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
    $Role = $_POST['Role'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO User (username, fullname, Role) VALUES (?, ?, ?)");
    $stmt->execute([$username, $fullname, $hashedPassword, $Role]);

    try {
        $query = "SELECT count(*) FROM User";
        $result = $this->db->query($query)->fetchColumn();
        $Role = $result == 0 ? "admin" : "user";

        $stmt = $this->db->prepare("INSERT INTO User (username,fullname, password,Role) VALUES (?,?,?,?)");
        $stmt->execute([$this->username, $this->fullname, $hashed, $Role]);
        echo "inscription reussite";
        header("location: login.php");
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
