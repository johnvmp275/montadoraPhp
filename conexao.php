<?php

//Variaveis para conectar ao banco de dados
$servername = "localhost:3308";
$username = "root";
$password = "etec2023";
$dbname = "lavajato";

try {
    //verifica se a conexao foi estabelecida corretamente
    $conn = new mysqli($servername, $username, $password, $dbname);

} catch (Exception $e) {

    die("Erro:" . $e->getMessage());
}

?>