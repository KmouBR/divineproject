<?php
if (isset($_GET['success']) && $_GET['success'] == 1): ?>
  <div class="alert success">
    ✅ Produto adicionado com êxito!
  </div>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
  <div class="alert error">
    ❌ Ocorreu um erro ao adicionar o produto.
  </div>
<?php endif; ?>
