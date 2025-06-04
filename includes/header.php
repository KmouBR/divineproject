<?php
session_start();
$usuario = $_SESSION['usuario'] ?? '';

$total = 0;
if (!empty($usuario)) {
    $pdo = new PDO('sqlite:db/database.db');
    $stmt = $pdo->prepare("SELECT SUM(quantidade) as total FROM carrinho WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $row['total'] ?? 0;
}
?>

<header class="header fadeInUp delay-1">
    <div class="container">
        <div class="logo">
            <img src="assets/hero-logo-image.png" alt="Divine Energy Logo" class="logo-small">
        </div>

        <nav class="nav">
            <ul>
                <li><a href="#home">Início</a></li>
                <li><a href="#about">Sobre</a></li>
                <li><a href="#products">Produtos</a></li>
                <li><a href="#contact">Contato</a></li>
            </ul>
        </nav>

        <div class="actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                
                <div class="cart-icon">
                    <a href="/divineproject/includes/carrinho.php">
                        🛒
                    </a>
                </div>
                
                <a href="/divineproject/logout.php" class="nav-logout-btn" style="margin-left: 15px;">Sair</a>
            <?php else: ?>
             
                <a href="/divineproject/login-page/index.php" class="nav-login-btn">Login / Register</a>
            <?php endif; ?>
        </div>
    </div>
</header>
