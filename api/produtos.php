<?php
// =============================================
// API DE PRODUTOS - CRUD básico (GET e POST)
// =============================================
require 'config.php';
header('Content-Type: application/json');   // Responde sempre em JSON

$method = $_SERVER['REQUEST_METHOD'];

// GET → retorna todos os produtos (usado na listagem)
if ($method === 'GET') {
    $stmt = $pdo->query("SELECT * FROM produtos");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

// POST → cadastra um novo produto
if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, estoque, descricao) VALUES (?, ?, ?, ?)");
    $stmt->execute([$data['nome'], $data['preco'], $data['estoque'], $data['descricao'] ?? '']);
    echo json_encode(['status' => 'ok', 'mensagem' => 'Produto cadastrado com sucesso!']);
}
?>