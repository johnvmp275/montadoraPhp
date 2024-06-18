<?php

require('conexao.php');

if(isset($_GET['idProprietario'])){

    $idProprietario = $_GET['idProprietario'];

    $sql = "SELECT placaVeiculo FROM veiculo WHERE idProprietario = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $idProprietario);

    if($stmt->execute()){
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $options = "<option value=''> Selecione uma placa </option>";

            while($row = $result->fetch_assoc()) {
                $options .= "<option value='" . $row["placaVeiculo"] . "'>" . $row
                ["placaVeiculo"] . "</option>";
            }

            echo $options;
        }else {
            echo "<option value=''> Nenhum veiculo registrado para este proprietário</option>"; 
        }
    }else{
        echo "Erro ao buscar as placas dos veiculos" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}else{
    echo "ID do proprietário não fornecido";
}
?>