<?php
// ================================================
// ARQUIVO DE CONFIGURAÇÃO DA CONEXÃO COM O BANCO
// ================================================

// Estas variáveis guardam as informações para conectar no MySQL
$host = 'localhost';      // computador onde o banco está (normalmente é o mesmo da aplicação)
$db   = 'farmacia_estoque'; // nome do banco de dados que criamos
$user = 'root';           // usuário padrão do MySQL/XAMPP (mude se tiver senha diferente)
$pass = '';               // senha (deixe vazio se não tiver senha)

// Tentamos criar a conexão usando PDO (é mais seguro e moderno que mysqli)
try {
    // A linha abaixo cria a conexão e define que usaremos UTF-8 (para acentos funcionarem)
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    
    // Configura o PDO para mostrar erros caso algo dê errado (muito útil para aprender)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Se chegou aqui, a conexão funcionou!
} catch (PDOException $e) {
    // Se der erro (banco não existe, senha errada, servidor parado...), mostramos a mensagem
    echo("Erro ao conectar no banco de dados: " . $e->getMessage());
}

// Pronto! A variável $pdo pode ser usada em qualquer página que inclua este arquivo
?>