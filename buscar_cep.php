<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Buscar Endereço pelo CEP</title>
  <style>

    input[type='text']{
        padding: 4px;
        font-size: 1.1rem;
    }
     label{
        display: inline-block;
        width: 150px;
        padding: 4px;
     }
     button{
        height: 40px;
        width: 120px;
        color: white;
        border: 1px outset;
        background-color: red;
        cursor: pointer;
     }
     button:active{
        background-color: darkred;
     }
     button:hover{
        background-color: tomato;
        border: 1px outset gray;
     }

     input[name='cep']{
        background-color: whitesmoke;
     }
  </style>
</head>
<body>

<?php 

include __DIR__ . "/libs/libcep.php"; 

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $cep = $_POST['cep'];
    $endereco = buscarEndereco($cep);

}

?> 

<h1>Buscar Endereço pelo CEP</h1>


<form method="POST">
    <label>CEP:</label>
    <input type="text" name="cep" maxlength="9" value="<?=$cep ??''?>" placeholder="Digite o CEP">
    <br>
    <hr>
    <label>Logradouro:</label>
    <input type="text" name="logradouro"  value="<?=$endereco->logradouro??''?>"maxlength="9" placeholder="">
    <br>
    <label>Bairro:</label>
    <input type="text" name="bairro"  value="<?=$endereco->bairro??''?>"maxlength="9" placeholder="">
    <br>
    <label>Cidade:</label>
    <input type="text" name="cidade"  value="<?=$endereco->localidade??''?>"maxlength="9" placeholder="">
    <br>
    <label>UF/Estado:</label>
    <input type="text" name="uf"  value="<?=$endereco->uf??''?>"maxlength="9" placeholder="">
    <br>
    <hr>
    <button type="reset" onclick="location.href='./buscar_cep.php'">Nova consulta</button>
    <button type="submit">Buscar</button>
</form>



</body>
</html>