<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial libs</title>
</head>
<body>
    <h1>Formulário de Cadastro</h1>
    <form  name="form-cadastro" action="crud.php" method="POST" accept-charset="utf-8">

       <label for="nome">Nome:</label><br>
       <input type="text" name="nome" value="<?=$_REQUEST['nome']??''?>"><br>

       <label for="email">Email:</label><br>
       <input type="email" name="email"  value="<?=$_REQUEST['email']??''?>"><br>

       <br>
       <button type="reset"  name="acao_novo">Novo</button>
       <button type="submit"  name="acao_incluir">Incluir</button>
       <button type="submit"  name="acao_alterar">Alterar</button>
       <button type="submit"  name="acao_excluir">Excluir</button>
       <button type="submit"  name="acao_ler">Ler</button>
       <button type="submit"  name="acao_pesquisar">Pequisar</button>

    </form>

    <?php
    
    include "libs/libws.php";

    $registros = ler();
    foreach ($registros as $registro) {
        $dado = explode(";", $registro);
        if ($dado[0] && $dado[1]){
            echo "<br>" . $dado[0] . " " . $dado[1] . "<br>";
        }
    }
?>

</body>
</html>