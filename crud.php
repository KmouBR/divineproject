<?php
try {
    $pdo = new PDO('sqlite:' . __DIR__ . '/produtos.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

$action = $_GET['action'] ?? 'list';

function listEnergeticos($pdo) {
    return $pdo->query("SELECT * FROM energeticos ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
}

function getEnergetico($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM energeticos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function saveEnergetico($pdo, $data) {
    if (empty($data['id'])) {
        $pdo->prepare("INSERT INTO energeticos (nome, preco, quantidade, descricao) VALUES (?, ?, ?, ?)")
            ->execute([$data['nome'], $data['preco'], $data['quantidade'], $data['descricao']]);
    } else {
        $pdo->prepare("UPDATE energeticos SET nome=?, preco=?, quantidade=?, descricao=? WHERE id=?")
            ->execute([$data['nome'], $data['preco'], $data['quantidade'], $data['descricao'], $data['id']]);
    }
}

function deleteEnergetico($pdo, $id) {
    $pdo->prepare("DELETE FROM energeticos WHERE id = ?")->execute([$id]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) saveEnergetico($pdo, $_POST);
    if (isset($_POST['delete'])) deleteEnergetico($pdo, $_POST['id']);
    header('Location: tables.php'); // redireciona de volta para a listagem
    exit;

}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin DIVINE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="mb-4">Administração de Energéticos</h1>
    <?php if ($action === 'new' || $action === 'edit'): 
        $item = $action === 'edit' ? getEnergetico($pdo, $_GET['id']) : ['id'=>'','nome'=>'','preco'=>'','quantidade'=>'','descricao'=>''];
    ?>
    <div class="card mb-4">
        <div class="card-header"><?= $action==='edit' ? 'Editar' : 'Novo' ?> Energético</div>
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input class="form-control" name="nome" required value="<?= htmlspecialchars($item['nome']) ?>">
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label class="form-label">Preço (R$)</label>
                        <input type="number" class="form-control" name="preco" required value="<?= htmlspecialchars($item['preco']) ?>">
                    </div>
                    <div class="col">
                        <label class="form-label">Quantidade</label>
                        <input type="number" class="form-control" name="quantidade" required value="<?= htmlspecialchars($item['quantidade']) ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" name="descricao" rows="3"><?= htmlspecialchars($item['descricao']) ?></textarea>
                </div>
                <button type="submit" name="save" class="btn btn-primary">Salvar</button>
              <a href="tables.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($action === 'list'): ?>
    <a href="crud.php?action=new" class="btn btn-success mb-3">+ Novo</a>
    <table class="table table-bordered bg-white">
        <thead>
            <tr><th>ID</th><th>Nome</th><th>Preço</th><th>Quantidade</th><th>Descrição</th><th>Ações</th></tr>
        </thead>
        <tbody>
        <?php foreach (listEnergeticos($pdo) as $r): ?>
            <tr>
                <td><?= $r['id'] ?></td>
                <td><?= htmlspecialchars($r['nome']) ?></td>
                <td><?= $r['preco'] ?></td>
                <td><?= $r['quantidade'] ?></td>
                <td><?= htmlspecialchars($r['descricao']) ?></td>
                <td>
                    <a href="crud.php?action=edit&id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <form method="post" style="display:inline;" onsubmit="return confirm('Deseja deletar?');">
                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                        <button type="submit" name="delete" class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>