<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <?php
    include ('menu.php');
    ?>

    <h2>Resgistro de Serviços em Veiculos</h2>

    <form id="formRegistroServico" action="
       <?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]);
       ?>
    "
    method="post"
    >
        <label for="idProprietario">Proprietário: </label>
        <select name="idProprietario" id="idProprietario">
            <option value="">Selecione um proprietário</option>
            <?php
                require('conexao.php');

                $sql_proprietarios = "SELECT idProprietario, nomeProprietario FROM 
                proprietario ORDER BY nomeProprietario";
                
                $result_proprietarios = $conn->query($sql_proprietarios);

                while($row = $result_proprietarios->fetch_assoc()){
                    echo "<option value='>". $row["idProprietario"]. "'>". $row["nomeProprietario"]. "</option>";
                }
            ?>
        </select>

        <label for="placaVeiculo">Veiculo:</label>
        <select name="placaVeiculo" id="placaVeiculo" disabled required>
            <option value="">Selecione um proprietário primeiro</option>
        </select>
        <br>
        <br>

        <label for="dadosVeiculo">Dados do Veiculo:</label>
        <span id="dadosVeiculo"></span>
        <br>
        <br>

        <label for="idServico">Servico:</label>
        <select name="idServico" id="idServico" required>
            <option value="">Selecione um serviço</option>
            <?php
                $sql_servicos = "SELECT idServico, nomeServico, precoServico FROM servico ORDER BY nomeServico";
                $result_servicos = $conn->query($sql_servicos);

                while($row = $result_servicos->fetch_assoc()){
                    echo "
                        <option value='>". $row["idServico"]. "' data-preco='". $row["precoServico"] . "'>".
                        $row["nomeServico"]. "(R$". number_format($row["precoServico"], 2,',', '.'). ")</option>";
                }
            ?>
        </select>
        <br>
        <br>

        <label for="precoPago">Preco Pago:</label>
        <input type="number" id="precoPago" name="precoPago" min="0" max="9999" step="0.01" required readonly>
        <br>
        <br>

        <label for="dataServico">Data do Serviço:</label>
        <input type="datetime-local" id="dataServico" name="dataServico" value="<?php echo date('Y-m-d\TH:i', strtotime('-3 hours')); ?>" required>
        <br>
        <br>

        <input type="submit" name="submitRegistroServico" value="Registrar Servico">
    </form>

    <script>
        $(document).ready(function(){
            $('#idProprietario').change(function() {
        
                let idProprietario = $(this).val();

                $('#placaVeiculo').prop('disabled', true);

                $.ajax({
                    url: 'buscar_placas_veiculos.php',
                    type: 'GET',
                    data: (idProprietario, idProprietario),
                    success: function(response){
                        $('#placaVeiculo').html(response);

                        $('#placaVeiculo').prop('disabled', false);
                    },
                    error:function(xhr, status, error){
                        console.error(xhr.responseText);
                    }
                })
            })
            $('#placaVeiculo').change(function() {

                let placaVeiculo = $(this).val();

                $.ajax({
                    url: 'buscar_dados_veiculo.php'
                    type: 'GET',
                    data: (placaVeiculo, placaVeiculo),
                    success: function(response){
                        let dadosVeiculo = JSON.parse(response);

                        let dadosFormatados = "Nome do Modelo" + dadosVeiculo.nomeModelo + "<br>" +
                        "Ano de Fabricação" + dadosVeiculo.anoFabricado + "<br>" + "<input type=hidden name=idVeiculo value="+
                        dadosVeiculo.idVeiculo + ">" + "Cor do Veiculo " + dadosVeiculo.corVeiculo + "<br>" +
                        "<img src='" + dadosVeiculo.logoMontadora + "' alt='logo da Montadora' width='48' heigth='48'>"

                        $('#dadosVeiculo').html(dadosFormatados);
                    },
                    error: function(xhr, status, error){
                        console.error(xhr.responseText);
                    }
                })
            })

            $('#formRegistroServico').change(function(event) {
                event.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: 'salvar_servico.php',
                    type: 'POST',
                    data: formData,
                    success: function(response){
                        alert(response)

                        $('#formRegistroServico')[0].reset();

                        $('#dadosVeiculo').html('')
                    },
                    error:function(xhr, status, response){
                        console.error(xhr.responseText);
                        alert("Erro ao registro o serviço. Verifique o console do navegador para mais detalhe")
                    }
                })
            })

            $('#idServico').change(function(){
                let precoServico = $(this).find(':selected').data('preco')

                $('#precoPago').val(precoServico)
            })
        })
    </script>
</body>

</html>