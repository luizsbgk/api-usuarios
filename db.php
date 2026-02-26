<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sistema_api";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["erro" => "Falha na conexão com o banco de dados: " . $conn->connect_error], JSON_UNESCAPED_UNICODE);
    exit();
}
?>
<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "sistema_api";


$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$conn->set_charset("utf8mb4");
?>