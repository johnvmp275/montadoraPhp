<?php

header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

//Verifica se o formulario foi submetido
 if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    //testa o metodo se for post entre no if

    //Faz a abertura do arquivo conectar que tem os dados de conexao
    require('conexao.php');

    //Direciona as variaveis post para variaveis locais
    $montadora = $_POST ['montadora'];
    $nomeModelo = $_POST ['nomeModelo'];
    $anoModelo = $_POST ['anoModelo'];
    $tipoCarroceria = $_POST ['tipoCarroceria'];

    //Prepara a consulta SQL para inserir o modelo no banco de dados
    $sql = "INSERT INTO modelo (idMontadora, nomeModelo, anoModelo, tipoCarroceria) VALUES (?, ?, ?, ?)";

    //Prepara a declaracao do statement (objeto de declaracao) SQL
    $stmt = $conn->prepare($sql); //$conn veio do conxao.php

    //Vincula os parametros
    $stmt->bind_param("isis", $montadora, $nomeModelo, $anoModelo, $tipoCarroceria);
    //o bind_param atrela cada um dos interrogacoes a uma variavel, sempre seguido o primeiro parametro com os dois tipos de dados

    //executa a declaracao
    if ($stmt->execute()){
        //depois de preparado e bind(ado)
        echo "Modelo cadastrado com sucesso!";
        //em caso de sucesso
    }else{
        echo "Erro ao cadastrar o modelo". $conn->error;
        //o erro procura $conn para retornar a mensagem
    }

    //Fecha o statement e a conexao com o banco de dados
    $stmt->close();
    $conn->close();
 }//caso contrario, nada acontece
?>