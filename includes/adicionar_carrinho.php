<?php
session_start();

// Configurações do banco de dados
$dbPath = __DIR__ . '/../carrinho.db';

try {
    $db = new SQLite3($dbPath);
    
    // Cria a tabela com todas as colunas necessárias SE NÃO EXISTIR
    $db->exec("CREATE TABLE IF NOT EXISTS carrinho (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        product_id INTEGER NOT NULL,
        name TEXT NOT NULL,
        flavor TEXT NOT NULL,
        price REAL NOT NULL,
        image TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validação dos dados
        $required = ['id', 'name', 'flavor', 'price', 'image'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Campo '$field' é obrigatório");
            }
        }

        // Preparar a declaração SQL
        $sql = "INSERT INTO carrinho (product_id, name, flavor, price, image) 
                VALUES (:product_id, :name, :flavor, :price, :image)";
        
        $stmt = $db->prepare($sql);
        if (!$stmt) {
            throw new Exception("Erro ao preparar a consulta SQL: " . $db->lastErrorMsg());
        }
        
        // Bind dos parâmetros
        $stmt->bindValue(':product_id', (int)$_POST['id'], SQLITE3_INTEGER);
        $stmt->bindValue(':name', $_POST['name'], SQLITE3_TEXT);
        $stmt->bindValue(':flavor', $_POST['flavor'], SQLITE3_TEXT);
        $stmt->bindValue(':price', (float)$_POST['price'], SQLITE3_FLOAT);
        $stmt->bindValue(':image', $_POST['image'], SQLITE3_TEXT);
        
        // Executar a inserção
        $result = $stmt->execute();
        if (!$result) {
            throw new Exception("Erro ao executar a consulta: " . $db->lastErrorMsg());
        }

        // Mensagem de sucesso
        $_SESSION['message'] = "Produto adicionado ao carrinho com sucesso!";
        $_SESSION['message_type'] = 'success';
        
        // Redireciona de volta para a página do produto
        header("Location: ../includes/produtos.php?id=" . $_POST['id']);
        exit;
    }
} catch (Exception $e) {
    // Mensagem de erro
    $_SESSION['message'] = "Erro: " . $e->getMessage();
    $_SESSION['message_type'] = 'error';
    
    // Redireciona de volta com erro
    $redirect = isset($_POST['id']) ? "../includes/produtos.php?id=" . $_POST['id'] : "../index.php";
    header("Location: " . $redirect);
    exit;
}   