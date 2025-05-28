<?php
// Array de produtos
$products = [
    [
        'id' => 1,
        'name' => 'Divine Branco',
        'color' => 'white',
        'description' => 'Pureza e Iluminação',
        'flavor' => 'Coco e Baunilha',
        'image' => 'assets/white-divine.png'

    ],
    [
        'id' => 2,
        'name' => 'Divine Azul',
        'color' => 'blue',
        'description' => 'Serenidade e Paz',
        'flavor' => 'Mirtilo e Lavanda',
        'image' => 'assets/blue-divine.png'
    ],
    [
        'id' => 3,
        'name' => 'Divine Verde',
        'color' => 'green',
        'description' => 'Esperança e Renovação',
        'flavor' => 'Maçã Verde e Hortelã',
        'image' => 'assets/green-divine.png'
    ],
    [
        'id' => 4,
        'name' => 'Divine Vermelho',
        'color' => 'red',
        'description' => 'Força e Paixão',
        'flavor' => 'Morango e Romã',
        'image' => 'assets/red-divine.png'
    ]
];
?>

<section id="products" class="products">
    <div class="container">
        <h2>Nossos Sabores Divinos</h2>
        <p class="section-description">Descubra a energia celestial em cada sabor</p>
        
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card <?php echo $product['color']; ?>">
                    <div class="product-icon">
                        <div class="halo">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-img">
                        </div>
                        <div class="wings"></div>
                    </div>
                    <h3><?php echo $product['name']; ?></h3>
                    <p class="product-description"><?php echo $product['description']; ?></p>
                    <p class="product-flavor">Sabor: <?php echo $product['flavor']; ?></p>
                    <a href="includes/produtos.php?id=<?php echo $product['id']; ?>" class="btn-product">Saiba Mais</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
