<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Montadora</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    include_once('menu.php')
    ?>
    <h2>Montadoras Cadastradas</h2>

    <div class="container">
        <div class="container-box">
        <?php
        //inclui o arquivo de conexão com o banco de dados
            require('conexao.php');
            
            //Consukta o sql para retornar todos os modelos
            $sql = "SELECT * FROM montadora ORDER BY nomeMontadora";
            $result = $conn->query($sql);

            //verifica se há modelos cadastrados
            if($result->num_rows > 0){
                //loop atraves dos resultados e exibe cada modelo
                while($linha = $result->fetch_assoc()) {
                    echo "
                    <div class='card'>
                        <img src=". $linha['logoMontadora'] .">
                        <p>".$linha['nomeMontadora']."</p>
                    </div>
                    ";
                }
            }else{
                echo "Nenhuma montadora cadastrada";
            }

            //fecha a conexão com o banco de dados
            $conn->close();
        ?>
          </div>
    </div>
</body>
</html>