<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        header("location: login.php?error=All fields are required.");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: login.php?error=Invalid email format.");
        exit();
    }
    
    try {
        $sql_check = "SELECT id FROM users WHERE username = :username OR email = :email";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->execute(['username' => $username, 'email' => $email]);
        
        if ($stmt_check->rowCount() > 0) {
            header("location: login.php?error=Username or Email already exists.");
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql_insert = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt_insert = $pdo->prepare($sql_insert);
        
        $stmt_insert->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password]);

        header("location: login.php?success=Account created successfully! Please sign in.");
        exit();

    } catch (PDOException $e) {
        header("location: login.php?error=Oops! Something went wrong.");
        exit();
    }
} else {
    header("location: login.php");
    exit();
}
?>