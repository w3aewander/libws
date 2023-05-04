<?php
/**
 * Função somar para testar o uso da biblioteca...
 */

$action = $_REQUEST['action'];
$num1 = $_REQUEST['num1'];
$num2 = $_REQUEST['num2'];

if ($action == "somar"){
    return intval($_REQUEST['num1']) + intval($_REQUEST['num2']);
}
