<!DOCTYPE html>
<html lang="pt_br">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Montadora</title>
</head>

<body>

     <?php
     include ("backModelo.php");
     ?>

     <form 
          id="formModelo" 
          action="
          <?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]);
          ?>"
          method="post"
      >

        <label for="montadora">
                montadora:
        </label>

        <select
                name="montadora" 
                id="montadora" 
                onchange="showLogo()"
        >
        <option value="">Selecione uma montadora</option>

        <?php 
                require("conexao.php");

                $sql = "SELECT idMontadora, nomeMontadora, logoMontadora FROM montadora";
                $result = $conn->query($sql);
                
                //verifica se há montadoras cadastradas na lista
                if($result->num_rows > 0){
                        //loop para exibir as montadoras como opções no select
                while($linha = $result->fetch_assoc()){
                        echo "<option value ='" . $linha["idMontadora"]. "'>" .$linha
                        ["nomeMontadora"] . "</option>";
                }
                }else{
                        echo "<option value=''> nenhuma montadora cadastrada </option>";
                }

                //fechamento da conexao como o banco de dados
                $conn->close()
        ?>
        </select>

        <img 
                id="logoMontadora" 
                src="./imagens/placeholder.png" 
                alt="Logo da Montadora"
        >
        <br>
        <br>

        <label for="nomeModelo">
                Nome do Modelo:
        </label>

        <input 
                type="text"
                id="nomeModelo"
                name="nomeModelo"
                required
        >

        <br>
        <br>

        <label 
                for="anoModelo"
        >
                Ano do Modelo:
        </label>
        
        <input 
                type="number"
                id="anoModelo"
                name="anoModelo"
                min="1950"
                required
        >

        <br>
        <br>

        <select 
                name="tipoCarroceria" 
                id="tipoCarroceria"
        >

                <option value="Hatch">Hatch</option>
                <option value="Sedã">Sedã</option>
                <option value="Perua (SW)">Perua (SW)</option>
                <option value="Coupé">Coupé</option>
                <option value="Conversível">Conversível</option>
                <option value="Minivan">Minivan</option>
                <option value="Limousine">Limousine</option>
                <option value="SUV">SUV</option>
                <option value="Jipe">Jipe</option>
                <option value="Picape">Picape</option>
                <option value="Furgão">Furgão</option>

        </select>

        <br>
        <br>

        <input type="submit" value="salvar">

      </form>

      <script>
        function showLogo() {

                let selectMontadora = document.getElementById('montadora');
                let logoMontadora = document.getElementById('logoMontadora');
                let selectedMontadoraId = selectMontadora.options[selectMontadora.selectedIndex].value;

                if(selectedMontadoraId) {
                        let xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {
                                if(this.readyState == 4 && this.status == 200){
                                        console.log(selectedMontadoraId);
                                        logoMontadora.src = this.responseText;
                                }
                        };

                        xhr.open("GET", "buscar_logo.php?idMontadora=" + selectedMontadoraId, true);
                        xhr.send();
                }else{
                        logoMontadora.src = "./imagens/placeholder.png"
                }

        }
      </script>

      <?php
          include('lstModelo.php');
      ?>

</body>

</html>