<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once 'conexao.php';
$con->set_charset("utf8");

$jsonParam = json_decode(file_get_contents('php://input'), true);

if (!$jsonParam) {
    echo json_encode(['success' => false, 'message' => 'Dados JSON inválidos ou ausentes.']);
    exit;
}

// dados
$nome          = trim($jsonParam['nome'] ?? '');
$preco         = floatval($jsonParam['preco'] ?? 0);
$quantidade    = intval($jsonParam['quantidade'] ?? 0);
$id_fornecedor = intval($jsonParam['id_fornecedor'] ?? 0);

// SQL (SEM preco_fornecedor agora)
$stmt = $con->prepare("
    INSERT INTO pecas (nome, preco, quantidade, id_fornecedor)
    VALUES (?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Erro ao preparar: ' . $con->error]);
    exit;
}

$stmt->bind_param("sdii", $nome, $preco, $quantidade, $id_fornecedor);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Peça inserida com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao inserir: ' . $stmt->error]);
}

$stmt->close();
$con->close();

?>
