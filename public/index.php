<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estoque Farmácia - Controle Simples</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="text-center mb-4 text-success">
        <i class="bi bi-capsule"></i> Controle de Estoque - Farmácia
    </h1>

    <a href="create.php" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Novo Medicamento
    </a>

    <table class="table table-hover table-bordered align-middle">
        <thead class="table-success">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Qtd</th>
                <th>Preço</th>
                <th>Validade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $stmt = $pdo->query("SELECT * FROM medicamentos ORDER BY nome");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $validade = date('d/m/Y', strtotime($row['data_validade']));
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['descricao']}</td>
                <td class='text-center'><strong>{$row['quantidade']}</strong></td>
                <td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>
                <td>{$validade}</td>
                <td>
                    <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>
                        <i class='bi bi-pencil'></i>
                    </a>
                    <a href='delete.php?id={$row['id']}' 
                        class='btn btn-danger btn-sm'
                        onclick=\"return confirm('Excluir {$row['nome']}?')\">
                        <i class='bi bi-trash'></i>
                    </a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>