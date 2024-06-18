<?php

require ('conexao.php');

//Verifica se a placa do veiculo foi passada via GET
if (isset($_GET['placaVeiculo'])) {
    //Obtem a placa do veiculo da solicitacao
    $placaVeiculo = $_GET['placaVeiculo'];

    //Prepara a consulta SQL para buscar os dados do usuario
    $sql = "SELECT modelo.nomeModelo, montadora.nomeMontadora, montadora.LogoMontadora,
            veiculo.anoFabricado, veiculo.corVeiculo, modelo.tipoCarroceria, veiculo.idVeiculo
            FROM veiculo
            INNER JOIN modelo ON veiculo.idModelo = modelo.idModelo
            INNER JOIN montadora ON modelo.idMontadora = montadora.idMontadora
            WHERE veiculo.placaVeiculo = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $placaVeiculo);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo json_encode($row);
        } else {
            echo "Nenhum veiculo encontrado com essa placa";
        }
    } else {
        echo "Erro ao buscar os dados do veiculo: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

} else {
    echo "Placa do veiculo não fornecida";
}