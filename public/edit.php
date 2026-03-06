<?php 
require_once 'config.php';

// Pegamos o ID que veio pela URL (ex: edit.php?id=5)
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die("ID inválido.");
}

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome          = $_POST['nome'] ?? '';
    $descricao     = $_POST['descricao'] ?? '';
    $quantidade    = (int)($_POST['quantidade'] ?? 0);
    $preco         = (float)($_POST['preco'] ?? 0.0);
    $data_validade = $_POST['data_validade'] ?? '';

    // Atualizamos o registro no banco
    $sql = "UPDATE medicamentos 
            SET nome = ?, descricao = ?, quantidade = ?, preco = ?, data_validade = ? 
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $quantidade, $preco, $data_validade, $id]);

    header("Location: index.php");
    exit;
}

// Buscamos os dados atuais do medicamento para preencher o formulário
$stmt = $pdo->prepare("SELECT * FROM medicamentos WHERE id = ?");
$stmt->execute([$id]);
$medicamento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$medicamento) {
    die("Medicamento não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-success">Editar Medicamento: <?= htmlspecialchars($medicamento['nome']) ?></h2>
    
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nome do Medicamento</label>
            <input type="text" name="nome" class="form-control" 
                   value="<?= htmlspecialchars($medicamento['nome']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="3"><?= htmlspecialchars($medicamento['descricao']) ?></textarea>
        </div>
        
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Quantidade</label>
                <input type="number" name="quantidade" class="form-control" 
                       value="<?= $medicamento['quantidade'] ?>" min="0" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Preço (R$)</label>
                <input type="number" name="preco" step="0.01" class="form-control" 
                       value="<?= $medicamento['preco'] ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Data de validade</label>
                <input type="date" name="data_validade" class="form-control" 
                       value="<?= $medicamento['data_validade'] ?>" required>
            </div>
        </div>
        
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>