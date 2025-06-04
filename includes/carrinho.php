<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login-page/index.php');
    exit;
}

$usuario_id = $_SESSION['user_id'];

$dbPath = realpath(__DIR__ . '/../db/database.db');
$db = new SQLite3($dbPath);

$sql = "SELECT c.quantidade, p.nome, p.sabor, p.preco, p.imagem 
        FROM carrinho c
        JOIN produtos p ON c.produto_id = p.id
        WHERE c.usuario_id = :usuario_id";

$stmt = $db->prepare($sql);
$stmt->bindValue(':usuario_id', $usuario_id, SQLITE3_INTEGER);
$result = $stmt->execute();

$itens = [];
$total = 0;

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $row['subtotal'] = $row['preco'] * $row['quantidade'];
    $total += $row['subtotal'];
    $itens[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Seu Carrinho</title>
  <link rel="stylesheet" href="../css/styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #121212;
      color: white;
      padding: 2rem;
    }
    .carrinho {
      max-width: 800px;
      margin: auto;
      background: #1e1e1e;
      padding: 1.5rem;
      border-radius: 10px;
    }
    .item {
      display: flex;
      align-items: center;
      margin-bottom: 1.5rem;
      border-bottom: 1px solid #444;
      padding-bottom: 1rem;
    }
    .item img {
      width: 80px;
      height: auto;
      margin-right: 1rem;
      border-radius: 8px;
    }
    .item-info {
      flex-grow: 1;
    }
    .total {
      text-align: right;
      font-size: 1.3rem;
      margin-top: 1rem;
    }
    .btn-finalizar {
      display: block;
      margin-top: 2rem;
      padding: 0.8rem 1.5rem;
      background: #8e80f9;
      color: white;
      border: none;
      border-radius: 5px;
      text-align: center;
      font-size: 1rem;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s ease;
    }
    .btn-finalizar:hover {
      background: #6b5df6;
    }
  </style>
</head>
<body>
  <div class="carrinho">
    <h1>🛒 Seu Carrinho</h1>

    <?php if (count($itens) === 0): ?>
      <p>Seu carrinho está vazio.</p>
    <?php else: ?>
      <?php foreach ($itens as $item): ?>
        <div class="item">
          <img src="<?php echo $item['imagem']; ?>" alt="Imagem do produto">
          <div class="item-info">
            <strong><?php echo $item['nome']; ?></strong><br>
            Sabor: <?php echo $item['sabor']; ?><br>
            Quantidade: <?php echo $item['quantidade']; ?><br>
            Preço unitário: R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?><br>
            Subtotal: R$ <?php echo number_format($item['subtotal'], 2, ',', '.'); ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="total">
        Total: <strong>R$ <?php echo number_format($total, 2, ',', '.'); ?></strong>
      </div>
      <a href="#" class="btn-finalizar">Finalizar Compra</a>
    <?php endif; ?>
  </div>
</body>
</html>
