<?php
/**
 * Biblioteca de funções...
 *
 */

ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL&~E_NOTICE);

$path = __DIR__ . "/../dados/bd.txt";

//---------------------------------------
//CRUD - create, retrieve(read), update, delete
//---------------------------------------
function incluir($nome, $email)
{
    global $path;
    //tratamento de excessões
    $incluiu = false;

    try {

        $fp = fopen($path, "a");
        fwrite($fp, "$nome;$email\n");
        fclose($fp);

        $incluiu = true;

    } catch (Exception $ex) {

        die("<br>Erro ao inserir os dados. <br>O erro foi: " . $ex->getMessage());
    }
    return $incluiu;
}

function excluir($email)
{
    global $path;

    $registros = ler();
    $novos_dados = [];
    $excluiu = false;

    try {

        foreach ($registros as $registro) {
          
           if ($registro) {
          
           $dado = explode(";", $registro);
          
            if (trim($dado[1]) !== $email) {
                
                  $novos_dados[] = $dado[0] . ";" . $dado[1];
                
            }

          }
        }

        unlink($path);

        foreach ($novos_dados as $dado) {
            file_put_contents($path, $dado, FILE_APPEND);
        }

        $excluiu = true;

    } catch (Exception $ex) {
        die($ex->getMessage());
    }

    return $excluiu;

}

function atualizar($nome, $email)
{
    global $path;

    $alterou = false;

    try {

        if (empty($email)) {
            throw new Exception("O email deve ser informado.");
        }

        $registros = ler();
        $novos_dados = [];

        foreach ($registros as $registro) {

            $dado = explode(";", $registro);
            if ($dado[0] && $dado[1]) {
                if (trim($dado[1]) === $email) {
                    $dado[0] = $nome;
                }
                //se houver dado aqui...
                $novos_dados[] = $dado[0] . ";" . $dado[1];
            }

        }

        unlink($path);

        $fp = fopen($path, "a");

        foreach ($novos_dados as $registro) {

            fwrite($fp, $registro);
        }

        fclose($fp);

        $alterou = true;

    } catch (Exception $ex) {
        die($ex->getMessage());
    }

    return $alterou;

}

/**
 * Lê o arquivo de dados..
 */
function ler()
{
    global $path;

    $registro = [];

    try {

        if (!file_exists($path)) {
            throw new Exception("Arquivo não existe ou nenhum dado cadastrado");
        }
        $fp = fopen($path, "r");
        //$registro = file_get_contents($path);
        while (!feof($fp)) {
            $registro[] = fgets($fp, 1024);
        }
        fclose($fp);

    } catch (Exception $ex) {
        die($ex->getMessage());
    }

    return $registro;

}
