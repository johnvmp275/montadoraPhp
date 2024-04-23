<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Modelos</title>
    <style>
        .logoMontadora{
            width: 16px;
        }
    </style>
</head>
<body>

    <h2>Lista de Modelos Cadastrados</h2>

    <?php

        //Inclui o arquivo de conexão com o banco de dados
        require('conexao.php');

        //Consulta SQL para selecionar todos os dados
        $sql = "SELECT m.idModelo, m.nomeModelo, m.anoModelo, m.tipoCarroceria, n.nomeMontadora, n.logoMontadora
                FROM modelo m
                INNER JOIN montadora  n ON m.idMontadora = n.idMontadora
                ORDER BY m.nomeModelo, m.anoModelo";
                $result = $conn->query($sql);

        //Verifica se há modelos cadastrados
        if ($result->num_rows > 0) {
            //Exibe os modelos em uma tabela
            echo"
                <table border = '1'>
                    <tr>
                        <th>
                            Nome do Modelo
                        </th>
                        <th>
                            Ano do Modelo
                        </th>
                        <th>
                            Tipo de Carroceria
                        </th>
                        <th>
                            Montadora
                        </th>
                    </tr>
            ";

            //Loop através dos resultados e exibe cada Modelo
            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                        <td>
                            ". $row["nomeModelo"] ."
                        </td>
                        <td>
                            ". $row["anoModelo"] ."
                        </td>
                        <td>
                            ". $row["tipoCarroceria"] ."
                        </td>
                        <td>
                            <img src=". $row["logoMontadora"] . " class='logoMontadora'>" . $row["nomeMontadora"] ."
                        </td>
                    </tr>
                ";
            }
            echo "</table>";
        }else{
            echo "Nenhum modelo cadastrado";
        }

        //Fecha a conexão com o banco de dados
        $conn->close()
    ?>


</body>
</html>