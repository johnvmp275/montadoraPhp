<?php

// verifica se o formulario foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //testa o metodo se for o post entre no if

    //faz a abertura do arquivo conectar aos que possuem os dados de conexao
    require ('conexao.php');

    //direciona as variaveis post para variaveis locais
    $nomeMontadora = $_POST['nomeMontadora'];

    //resgata a imagem enviada para o cache e o nome
    $logoMontadora = $_FILES['logoMontadora']['name'];

    //atribui o endereco termporario a imagem
    $tempLogo = $_FILES['logoMontadora']['tmp_name'];

    //gera um nome unico sem repeticao
    $nomeUnico = str_replace('.', '', uniqid('', true));

    //gera um caminho onde sera salvado o arquivo com base no local do arquivo atual
    $caminhoLogo = "./imagens/" . $nomeUnico . ".png";
    //dentro da pasta atual, na pasta /imagens/nomegerado.png

    //move a imagem para a pasta desejada (certificando de ter permissoes de escrita)
    move_uploaded_file($tempLogo, $caminhoLogo);

    $sql = "INSERT INTO montadora (nomeMontadora, logoMontadora) VALUES ('$nomeMontadora', '$caminhoLogo')";

    //insere os dados no banco de dados
    if ($conn->query($sql) === TRUE) {
        //verifica se a insercao ocorreu sem erros

        //mensagem enviada com sucesso
        echo "Montadora cadastrada com sucesso!";
    } else {
        echo "error ao cadastrar a montadora: " . $conn->error;
        //o erro procura no objeto $conn para retornar a mensagem
    }

    //fecha a conecao com o banco de dados
    $conn->close();
}

?>