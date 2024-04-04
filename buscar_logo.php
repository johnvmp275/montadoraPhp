<?php

require ("conexao.php");

if (isset($_GET['idMontadora'])) {
    $idMontadora = $_GET['idMontadora'];

    $sql = "SELECT logoMontadora FROM montadora WHERE idMontadora = $idMontadora";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        echo $linha['logoMontadora'];
    } else {
        echo "imagens/placeholder.png";
    }
}
?>