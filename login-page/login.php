<?php
session_start();
$db = new SQLite3(__DIR__ . '/../db/database.db');


$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';


$stmt = $db->prepare('SELECT * FROM usuarios WHERE email = :email');
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$result = $stmt->execute();
$user = $result->fetchArray(SQLITE3_ASSOC);


if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

 
    if ($user['role'] === 'admin') {
        header("Location: /divineproject/admin");
    } else {
        header("Location: /divineproject/index.php");
    }
    exit;
} else {
    echo "Email ou senha inválidos.";
}
?>