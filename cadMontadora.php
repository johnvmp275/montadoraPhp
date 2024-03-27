<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Montadora</title>
</head>

<body>

    <h2>Cadastro de Montadora</h2>

    <?php
        include ("backMontadora.php");
    ?>

    <form 
        id="formMontadora" 
        action="
        <?php
        echo htmlspecialchars($_SERVER["PHP_SELF"]);
        ?>"
        method="post"
        enctype="multipart/form-data"
    >

    <label for="nomeMontadora">
        Nome de Montadora:
    </label>

    <input 
        type="text" 
        name="nomeMontadora" 
        id="nomeMontadora" 
        placeholder="Insira o nome da montadora"
        required
    >

    <input 
        type="file" 
        name="logoMontadora" 
        id="logoMontadora" 
        accept="image/PNG" 
        required
    >

    <img 
        id="previewLogo" 
        src="#" 
        alt="Preview do Logo" 
        style="
        display: none; 
        max-width: 200px;"
    >

    <input type="submit" value="Salvar">
    </form>

    <script>

    document.getElementById('logoMontadora').addEventListener('change',
    function(event){
        let input = event.target;
        let reader = new FileReader();

        reader.onload = function(){
            let dataUrl = reader.result;
            let preview = document.getElementById('previewLogo');

            preview.src =dataUrl;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    });

    </script>

</body>

</html>