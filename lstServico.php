<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include_once ('menu.php')
    ?>

    <h2>Lista de Serviços</h2>

    <?php

    //Inclui o arquivo de conexão com o banco de dados
    require ('conexao.php');

    //consulta para buscar todos os serviços ordenados por ordem alfabética
    $sql = "SELECT * FROM servico ORDER BY nomeServico";
    $result = $conn->query($sql);

    //verifica se há serviços cadastrados
    if ($result->num_rows > 0){
        //exibe os serviços em uma tabela
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nome do Serviço</th></tr>";
        while($linha = $result->fetch_assoc()) {
            echo "
               <tr>
                    <td>
                    ". $linha['idServico']."
                    </td>
                    <td>
                    ". $linha['nomeServico']."
                    </td>
                    <td> R$
                    ". number_format($linha['precoServico'], 2, ',', '.')."
                    </td>
               </tr>
            ";
        }
        echo "</table>";
    }else{
        echo "Nenhum serviço cadastrado";
    }

    $conn->close();

    ?>

</body>

</html>