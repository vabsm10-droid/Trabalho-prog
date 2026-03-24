<?php

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "loja_eletronica";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Erro: " . $con->connect_error);
}

?>
