<?php 
require_once 'config.php';

// Verificamos se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pegamos os dados enviados pelo formulário
    $nome          = $_POST['nome'] ?? '';               // ?? '' evita erro se campo não existir
    $descricao     = $_POST['descricao'] ?? '';
    $quantidade    = (int)($_POST['quantidade'] ?? 0);   // convertemos para inteiro
    $preco         = (float)($_POST['preco'] ?? 0.0);    // convertemos para decimal
    $data_validade = $_POST['data_validade'] ?? '';      // formato YYYY-MM-DD

    // Preparamos a instrução SQL (usamos ? para evitar SQL Injection)
    $sql = "INSERT INTO medicamentos 
            (nome, descricao, quantidade, preco, data_validade) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    
    // Executamos passando os valores na ordem correta
    $stmt->execute([$nome, $descricao, $quantidade, $preco, $data_validade]);

    // Redirecionamos de volta para a lista (padrão PRG – Post/Redirect/Get)
    header("Location: index.php");
    exit;  // importante: para o script aqui
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-success">Cadastrar Novo Medicamento</h2>
    
    <!-- Formulário de cadastro -->
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nome do Medicamento</label>
            <input type="text" name="nome" class="form-control" required autofocus>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="3"></textarea>
        </div>
        
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Quantidade em estoque</label>
                <input type="number" name="quantidade" class="form-control" min="0" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Preço (R$)</label>
                <input type="number" name="preco" step="0.01" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Data de validade</label>
                <input type="date" name="data_validade" class="form-control" required>
            </div>
        </div>
        
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Salvar Medicamento</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>