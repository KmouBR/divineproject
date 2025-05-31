<?php
// Definição do título da página
$pageTitle = "Divine Energy - Poder Divino em Cada Gole";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Divine Energy - Energético com tema angelical">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <?php include 'includes/ver_carrinho.php'; ?>
    
    <!-- Hero Section -->
    <?php include 'includes/hero.php'; ?>
    
    <!-- About Section -->
    <?php include 'includes/about.php'; ?>
    
    <!-- Products Section -->
    <?php include 'includes/products.php'; ?>
    
    <!-- Contact Section -->
    <?php include 'includes/contact.php'; ?>
    
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    
    <!-- Scripts -->
    <script>
        // Script para efeito de scroll suave
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
    <script src="js/carrinho.js"></script>
</body>
</html>
