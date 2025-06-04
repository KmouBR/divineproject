<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /divineproject/login-page/index.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../db/database.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto_id = (int)($_POST['id'] ?? 0);
    $usuario_id = $_SESSION['user_id'];

    if ($produto_id <= 0) {
        $_SESSION['message'] = "Produto inválido.";
        header("Location: ../index.php");
        exit;
    }

    $check = $db->prepare('SELECT quantidade FROM carrinho WHERE usuario_id = :uid AND produto_id = :pid');
    $check->bindValue(':uid', $usuario_id, SQLITE3_INTEGER);
    $check->bindValue(':pid', $produto_id, SQLITE3_INTEGER);
    $result = $check->execute()->fetchArray(SQLITE3_ASSOC);

    if ($result) {
        
        $nova_qtd = $result['quantidade'] + 1;
        $update = $db->prepare('UPDATE carrinho SET quantidade = :qtd WHERE usuario_id = :uid AND produto_id = :pid');
        $update->bindValue(':qtd', $nova_qtd, SQLITE3_INTEGER);
        $update->bindValue(':uid', $usuario_id, SQLITE3_INTEGER);
        $update->bindValue(':pid', $produto_id, SQLITE3_INTEGER);
        $update->execute();
    } else {
        
        $insert = $db->prepare('INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES (:uid, :pid, 1)');
        $insert->bindValue(':uid', $usuario_id, SQLITE3_INTEGER);
        $insert->bindValue(':pid', $produto_id, SQLITE3_INTEGER);
        $insert->execute();
    }

    $_SESSION['message'] = "Produto adicionado ao carrinho!";
    header("Location: ../index.php");
    exit;
}
?>
