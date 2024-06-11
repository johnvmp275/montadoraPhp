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
    include ('menu.php');

    //Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitServico'])) {

        // inclui o arquivo de conexão com o banco de dados
        require ('conexao.php');

        //obtém os dados do formulário
        $nomeServico = $_POST['nomeServico'];
        $precoServico = $_POST['precoServico'];

        //prepara a consulta SQL para inserir o servico no banco de dados
        $sql = "INSERT INTO servico (nomeServico, precoServico) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);

        //prepara a declaração SQL
        $stmt->bind_param("sd", $nomeServico, $precoServico);

        // executa a declaração
        if ($stmt->execute()) {
            echo "Serviço cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o serviço " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }

    ?>

    <h2>Registro de Serviços Prestados</h2>

    <form id="formServico" action="
        <?php
        echo htmlspecialchars(
            $_SERVER["PHP_SELF"]
        );
        ?>
        " method="post">
        <!-- htmlspecialchars é uma função do PHP que transforma caracteres especiais em codigo como < em &lt, ' em &#039; ou > &gt -->
        <label for="nomeServico">Nome do Serviço:</label>
        <input type="text" id="nomeServico" name="nomeServico" required>

        <br>
        <br>

        <label for="precoServico">Nome do Serviço:</label>
        <input type="number" id="precoServico" name="precoServico" min="0" max="9999" step="0.01" required>

        <br>
        <br>

        <input type="submit" name="submitServico" value="Registrar Serviço">
    </form>

    <?php
    include ('lstServico.php')
        ?>
</body>

</html>