<?php
// Conectar ao banco
$db = new SQLite3('carrinho.db'); // ajuste o caminho se necessário

// Criar tabela se não existir
$db->exec("CREATE TABLE IF NOT EXISTS carrinho (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    produto_id INTEGER,
    nome TEXT,
    sabor TEXT,
    imagem TEXT,
    quantidade INTEGER DEFAULT 1
)");

// Receber os dados via POST
$id = $_POST['id'] ?? null;
$nome = $_POST['name'] ?? '';
$sabor = $_POST['flavor'] ?? '';
$imagem = $_POST['image'] ?? '';

if ($id) {
    // Verificar se produto já está no carrinho
    $stmt = $db->prepare("SELECT id, quantidade FROM carrinho WHERE produto_id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    if ($result) {
        // Atualiza a quantidade
        $update = $db->prepare("UPDATE carrinho SET quantidade = quantidade + 1 WHERE id = :id");
        $update->bindValue(':id', $result['id'], SQLITE3_INTEGER);
        $update->execute();
    } else {
        // Insere novo
        $insert = $db->prepare("INSERT INTO carrinho (produto_id, nome, sabor, imagem, quantidade)
                                VALUES (:id, :nome, :sabor, :imagem, 1)");
        $insert->bindValue(':id', $id, SQLITE3_INTEGER);
        $insert->bindValue(':nome', $nome);
        $insert->bindValue(':sabor', $sabor);
        $insert->bindValue(':imagem', $imagem);
        $insert->execute();
    }

    // Redireciona para a página do produto (ou carrinho)
    header("Location: carrinho.php");
    exit;
} else {
    echo "Erro ao adicionar ao carrinho.";
}
?>
