<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// conexão
require_once 'conexao.php';
$con->set_charset("utf8");

json_decode(file_get_contents('php://input'), true);

$sql = "SELECT 
    p.id_peca,
    p.nome AS peca,
    p.preco,
    p.quantidade,
    f.nome AS fornecedor,
    f.cidade
FROM pecas p
JOIN fornecedores f
ON p.id_fornecedor = f.id_fornecedor;
$result = $con->query($sql);

$response = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    $response[] = [
        "id_peca" => 0,
        "peca" => "",
        "preco" => 0,
        "quantidade" => 0,
        "fornecedor" => ""
    ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);

$con->close();

?>
