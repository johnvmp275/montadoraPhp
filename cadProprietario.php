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
        include("menu.php");
    ?>
    <?php
       include('conexao.php');

       if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitProprietario'])){

        //INCLUI O ARQUIVO DE CONEXÃO COM O BANCO DE DADOS
        require('conexao.php');

        //OBTÉM OS DADOS DO FORMULÁRIO
        $nomeProprietario = $_POST['nomeProprietario'];
        $telProprietario = $_POST['telProprietario'];
        $enderecoProprietario = $_POST['enderecoProprietario'];
        $dataNasc = $_POST['dataNasc'];
        $cpfProprietario = $_POST['cpfProprietario'];

        $sql = "INSERT TO proprietario(nomeProprietario, telProprietario, enderecoProprietario, dataNasc, cpfProprietario) VALUES 
        (?, ?, ?, ?, ?)";

        // PREPARA A DECLARAÇÃO SQL
        $stmt = $conn->prepare($sql);

        //VINCULA OS PARÂMETROS
        $stmt->bind_param("sssss", $nomeProprietario, $telProprietario, $enderecoProprietario, $dataNasc, $cpfProprietario);

        //EXECUTA A DECLARAÇÃO
        if($stmt->execute()){
            echo "Proprietário já cadastrado com sucesso";
        }else{
            echo "Erro ao cadastrar o proprietário" . $conn->error;
        }

        //FECHA A DECLARAÇÃO E A CONEXÃO COM O BANCO DE DADOS
        $stmt->close();
        $conn->close();

       }
    ?>

    <h1>cadastrado de proprietario</h1>

    <form 
        id="formProprietario" 
        action="
        <?php
        
        echo htmlspecialchars($_SERVER['PHP_SELF']);
        ?>"
        method="post"
    >
        <label for="nomeProprietario">Nome do proprietario</label>
        <input type="text" id="nomeProprietario" name="nomeProprietario" required>

        <label for="telProprietario">Telefone do proprietario</label>
        <input type="tel" id="telProprietario" name="telProprietario" required>

        <label for="enderecoProprietario"> Endereço do proprietario</label>
        <input type="text" id="enderecoProprietario" name="enderecoProprietario" required>

        <label for="dataNasc">Data de Nascimento do proprietario</label>
        <input type="date" id="dataNasc" name="dataNasc" required>

        <label for="cpfProprietario">Data de Nascimento do proprietario</label>
        <input type="text" id="cpfProprietario" name="cpfProprietario" required>

        <input type="submit" name="submitProprietario" value="Cadastrar Proprietário">
    </form>
</body>
</html> 