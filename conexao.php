<?php

//Variaveis para conectar ao banco de dados
$servername = "localhost:3308";
$username = "root";
$password = "etec2023";
$dbname = "lavajato";

$conn = new mysqli($servername, $username, $password, $dbname);

//verifica se a conexao foi estabelecida corretamente
if ($conn->connect_error) {
    die("Falha na conexão:" . $conn->connect_error);
}

?>