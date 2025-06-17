<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        header("location: login.php?error=Username and Password are required.");
        exit();
    }

    try {
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                session_regenerate_id();
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $user['id'];
                $_SESSION["username"] = $user['username'];
                header("location: dashboard.php");
                exit();
            } else {
                header("location: login.php?error=Invalid username or password.");
                exit();
            }
        } else {
            header("location: login.php?error=Invalid username or password.");
            exit();
        }
    } catch (PDOException $e) {
        header("location: login.php?error=Oops! Something went wrong.");
        exit();
    }
} else {
    header("location: login.php");
    exit();
}
?>