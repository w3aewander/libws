<?php
/**
 *
 */

include "libs/libws.php";

//qual o método de envio recebido por este script
$metodo = $_SERVER['REQUEST_METHOD'];

//pega os dados enviados pelo formuário e armazena nas variáveis correspondentes
$nome = $_POST['nome'];
$email = $_POST['email'];

//verifica qual ação foi solicitada
if (isset($_POST['acao_incluir'])) {

    echo "Incluindo o registro no arquivo de dados...";

    if (incluir($nome, $email)) {
        echo "Registro inserido com sucesso";
    } else {
        echo "Não foi possível inserir o registro.";
    }

} else if (isset($_POST['acao_excluir'])) {

    echo "<br>Recebi a ação excluir<br>";

    if (excluir($email)) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Não foi possível excluir o registro.";
    }

} else if (isset($_POST['acao_alterar'])) {

    echo "<br>Atualizando o registro...<br>";

    if (atualizar($nome, $email)) {
        echo "Registro alterado com sucesso";
    } else {
        echo "Não foi possível alterar  o registro.";
    }

} else if (isset($_POST['acao_ler'])) {

    echo "Lendo o arquivo...<br>";

    $dados = ler();

    foreach ($dados as $linha) {
        echo $linha . "<br>";
    }

} else {
    echo "Não recebi nenhuma ação";
}

echo "<h1>Aguarde... retornará para a tela principal em 3 segundos...</h1>";

header("refresh: 3; url = index.php");