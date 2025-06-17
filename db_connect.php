<?php
// db_connect.php
$db_host = 'localhost';
$db_name = 'users';         // <= APNE DATABASE KA NAAM DAALEIN
$db_user = 'root';             // <= XAMPP/WAMP ke liye 'root'
$db_pass = '';                 // <= XAMPP/WAMP ke liye password khaali hota hai

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Agar abhi bhi error aaye, to woh yahan dikhega
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>