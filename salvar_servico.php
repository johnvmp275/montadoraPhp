<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    require('conexao.php');

    //Obtem os dados do formulario
    $idServico = $_POST["idServico"];
    $idVeiculo = $_POST["idVeiculo"];
    $precoPago = $_POST["precoPago"];
    $dataServico = $_POST["dataServico"];

    //Prepara a consulta SQL para inserir os dados na tabela servico_veiculo
    $sql = "INSERT INTO servico_veiculo (idServico, idVeiculo, precoPago, dataServico) VALUES (?, ?, ?, ?)";

    //Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    if($stmt){
        $stmt->bind_param("isis", $idServico, $idVeiculo, $precoPago, $dataServico);

        if($stmt->execute()){
            echo "Servico registrado com sucesso";
        }else{
            echo "Erro ao registrar o servico: " . $stmt->error;
        }

        $stmt->close();
    } else{
        echo "Erro ao preparar a declaração SQL: " . $conn->error;
    }

    $conn->close();

}else{
    echo "Erro: metodo de requisicao invalido";
}