<?php
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

require 'dados_produtos.php'; // arquivo com $products

$product = $products[$id - 1] ?? null;

if (!$product) {
    echo "Produto inválido.";
    exit;
}

$pdo = new PDO("sqlite:carrinho.db");

// Cria a tabela se não existir
$pdo->exec("CREATE TABLE IF NOT EXISTS carrinho (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT,
    sabor TEXT,
    quantidade INTEGER
)");

// Verifica se já existe
$stmt = $pdo->prepare("SELECT * FROM carrinho WHERE nome = ?");
$stmt->execute([$product['name']]);
$existing = $stmt->fetch();

if ($existing) {
    $update = $pdo->prepare("UPDATE carrinho SET quantidade = quantidade + 1 WHERE nome = ?");
    $update->execute([$product['name']]);
} else {
    $insert = $pdo->prepare("INSERT INTO carrinho (nome, sabor, quantidade) VALUES (?, ?, ?)");
    $insert->execute([$product['name'], $product['flavor'], 1]);
}

header("Location: detalhes.php?id={$id}");
exit;
?>
