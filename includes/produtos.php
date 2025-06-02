<?php
session_start(); // Adicionado para mensagens flash

// Mostrar mensagem de sucesso/erro se existir
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $messageType = $_SESSION['message_type'];
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}

$products = [
    [
        'id' => 1,
        'name' => 'Divine Branco',
        'color' => 'white',
        'description' => 'Pureza e Iluminação',
        'flavor' => 'Coco e Baunilha',
        'price' => '12.90',
        'image' => '../assets/white-divine.png'
    ],
    [
        'id' => 2,
        'name' => 'Divine Azul',
        'color' => 'blue',
        'description' => 'Serenidade e Paz',
        'flavor' => 'Mirtilo e Lavanda',
        'price' => '12.90',
        'image' => '../assets/blue-divine.png'
    ],
    [
        'id' => 3,
        'name' => 'Divine Verde',
        'color' => 'green',
        'description' => 'Esperança e Renovação',
        'flavor' => 'Maçã Verde e Hortelã',
        'price' => '12.90',
        'image' => '../assets/green-divine.png'
    ],
    [
        'id' => 4,
        'name' => 'Divine Vermelho',
        'color' => 'red',
        'description' => 'Força e Paixão',
        'flavor' => 'Morango e Romã',
        'price' => '12.90',
        'image' => '../assets/red-divine.png'
    ]
];


$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

// 3) Valida se existe um produto com esse ID
if (!$id || !isset($products[$id - 1])) {
    echo "<p>Produto não encontrado. <a href='index.php'>Voltar</a></p>";
    exit;
}

$product = $products[$id - 1];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title><?php echo $product['name']; ?> — Detalhes</title>
  <link rel="stylesheet" href="../css/styles.css"><!-- apontar para seu CSS -->
  <style>
    /* Estilos rápidos só para esta página */

    body {
      background: linear-gradient(#0b0c2a, rgba(0, 0, 20, 0.7)), url('../assets/hero-stars.jpg');
      color: #ffffff; /* textos brancos */
      font-family: 'Poppins', sans-serif;
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }
    h1, h2, h3, p {
      color: #ffffff;
      text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }
    .product-card {
      background-color: rgba(0, 0, 0, 0.6); /* fundo semi-transparente escuro */
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
      color: #fff;
    }
    .product-detail {
      max-width: 600px;
      margin: 4rem auto;
      background: rgba(255, 255, 255, 0.05); /* bem sutil */
      backdrop-filter: blur(10px); /* vidro fosco */
      padding: 2rem; 
      border-radius: 10px;
      color: #fff;
      text-align: center;
    }
    .product-detail img {
      width: 200px;
      height: auto;
      border-radius: 10px;
      margin-bottom: 1.5rem;
      border: 2px solid #fff;
      box-shadow:
      0 0 10px rgba(255, 255, 255, 0.6),
      0 0 20px rgba(255, 255, 255, 0.5),
      0 0 40px rgba(255, 255, 255, 0.4);
    }
    .btn-back {
      display: inline-block;
      margin-top: 2rem;
      padding: 0.6rem 1.2rem;
      background: linear-gradient(135deg, #8e80f9, #6b5df6);
      color: #fff;
      text-decoration: none;
      border-radius: 50px;
      font-weight: bold;
      text-transform: uppercase;
      box-shadow: 0 4px 15px rgba(142, 128, 249, 0.5);
      transition: all 0.3s ease;
    }
    .btn-back:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(142, 128, 249, 0.7);
    }
    .btn-primary {
      background: linear-gradient(135deg, #8e80f9, #6b5df6);
      color: #fff;
      padding: 10px 20px;
      border-radius: 50px;
      box-shadow: 0 4px 15px rgba(142, 128, 249, 0.5);
      font-weight: bold;
      text-transform: uppercase;
      border: none;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(142, 128, 249, 0.7);
    }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .product-detail {
    animation: fadeInUp 0.8s ease-out;
  }

  .alert {
    padding: 15px;
    margin: 20px auto;
    max-width: 600px;
    border-radius: 5px;
    text-align: center;
    animation: fadeInUp 0.5s ease-out;
  }
  .alert-success {
    background-color: #4CAF50;
    color: white;
  }
  .alert-error {
    background-color: #f44336;
    color: white;
  }
  </style>
</head>
<body>
  <?php if (!empty($message)): ?>
    <div class="alert alert-<?php echo $messageType; ?>">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>

  <div id="product-<?php echo $product['id']; ?>" class="product-detail <?php echo $product['color']; ?>">
  <div 
    id="product-<?php echo $product['id']; ?>" 
    class="product-detail <?php echo $product['color']; ?>">
    <h1><?php echo $product['name']; ?></h1>
    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <p><em><?php echo $product['description']; ?></em></p>
    <p><strong>Sabor:</strong> <?php echo $product['flavor']; ?></p>
    <a href="../index.php" class="btn-back" style="margin-right: 1rem;">← Voltar</a>
  <form method="POST" action="../includes/adicionar_carrinho.php" style="display: inline;">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
    <input type="hidden" name="flavor" value="<?php echo $product['flavor']; ?>">
    <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
    <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
    <button type="submit" class="btn-primary">🛒 Adicionar ao Carrinho</button>
  </form>
  </div>
</body>
</html>