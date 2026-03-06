<?php
require_once 'config.php';

// Pegamos o ID da URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    // Preparamos e executamos a exclusão
    $stmt = $pdo->prepare("DELETE FROM medicamentos WHERE id = ?");
    $stmt->execute([$id]);
    // Não colocamos mensagem aqui para manter simples
}

// Sempre voltamos para a lista
header("Location: index.php");
exit;
?>