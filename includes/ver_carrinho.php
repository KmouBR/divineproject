<div id="cart-overlay" class="cart-overlay" onclick="toggleCart()"></div>

<div id="cart-box" class="cart-box">
    <h2>🛒 Seu Carrinho</h2>
    <div id="cart-items">
        <?php
        // Conecta ao banco
        $pdo = new PDO('sqlite:carrinho.db');

        $stmt = $pdo->query("SELECT * FROM carrinho");
        $items = $stmt->fetchAll();

        if (count($items) === 0) {
            echo "<p>Seu carrinho está vazio.</p>";
        } else {
            foreach ($items as $item) {
                echo "<div class='cart-item'>";
                echo "<strong>{$item['nome']}</strong><br>";
                echo "<small>Sabor: {$item['sabor']}</small><br>";
                echo "<small>Qtd: {$item['quantidade']}</small>";
                echo "</div>";
            }
        }
        ?>
    </div>
</div>
