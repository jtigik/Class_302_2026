<?php
// =============================================
// ARQUIVO DE CONFIGURAÇÃO DO BANCO DE DADOS
// Responsável por conectar o PHP ao MySQL
// =============================================

$host = 'localhost';      // Servidor do banco
$db   = 'loja_ecotech';   // Nome do banco criado
$user = 'root';           // Usuário padrão do XAMPP
$pass = '';               // Senha (vazia no XAMPP padrão)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Conexão bem-sucedida (não exibe nada em produção)
} catch(PDOException $e) {
    die("Erro de conexão com o banco: " . $e->getMessage());
}
?>