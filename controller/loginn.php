<?php
include __DIR__ . '/../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM User WHERE username=?");
    $stmt->execute([$username]);
    $User = $stmt->fetch(PDO::FETCH_ASSOC);

    try {
        $stmt->execute();
        $User = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($User && password_verify($password, $User['password'])) {
            $_SESSION['id'] = $User['id'];
            $_SESSION['username'] = $username;
            $_SESSION['Role'] = $User['Role'];
        }
        if($user['role'] == 1) {
            header('Location: dashboard.php');
        }
        else{
            header('Location: login.php');

        }
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    }
}
?>
