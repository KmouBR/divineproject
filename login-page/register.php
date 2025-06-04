<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new SQLite3(__DIR__ . '/../db/database.db');

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $role = 'user';

    
    if ($password !== $confirm_password) {
        echo "<script>alert('As senhas não coincidem.'); window.history.back();</script>";
        exit;
    }

   
    $check = $db->prepare('SELECT id FROM usuarios WHERE email = :email');
    $check->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $check->execute();
    if ($result->fetchArray()) {
        echo "<script>alert('Este e-mail já está em uso.'); window.history.back();</script>";
        exit;
    }

   
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $db->prepare('INSERT INTO usuarios (username, email, password, role) VALUES (:username, :email, :password, :role)');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $hashed_password, SQLITE3_TEXT);
    $stmt->bindValue(':role', $role, SQLITE3_TEXT);

    try {
        $stmt->execute();
        echo "<script>alert('Cadastro realizado com sucesso! Faça login.'); window.location.href = 'index.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Erro ao cadastrar.'); window.history.back();</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Divine</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="pb.ico" type="image/x-icon">
</head>
<body>
  <div class="wrapper">
    <form action="#" method="POST">
      <h2>Register</h2>
      <div class="input-field">
        <input type="text" name="username" required>
        <label>Enter your username</label>
      </div>
      <div class="input-field">
        <input type="email" name="email" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Create a password</label>
      </div>
      <div class="input-field">
        <input type="password" name="confirm_password" required>
        <label>Confirm your password</label>
      </div>
      <button type="submit">Register</button>
      <div class="register">
        <p>Already have an account? <a href="index.php">Login</a></p>
      </div>
    </form>
  </div>
</body>
</html>
