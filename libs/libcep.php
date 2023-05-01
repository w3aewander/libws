<?php


function buscarEndereco($cep)
{
    $response = "";

    // Remove caracteres que não são números do CEP
    $cep = preg_replace("/[^0-9]/", "", $cep);

    // Verifica se o CEP possui 8 dígitos
    if (strlen($cep) != 8) {
        echo "<br>CEP inválido!";
        //exit();
        header('refresh: 3; url="__DIR__ . /../buscar_cep.php" ');
    } else {

        // Faz a requisição à API do ViaCEP
        $url = "https://viacep.com.br/ws/" . $cep . "/json/";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30
        ));
        $response = curl_exec($curl);
        curl_close($curl);
    }

    // Converte o JSON de resposta para um objeto
    $endereco = json_decode($response);


    // Exibe o endereço completo
    //echo "Endereço: " . $endereco->logradouro . ", " . $endereco->bairro . ", " . $endereco->localidade . " - " . $endereco->uf;

    echo "<br>Pronto para nova pesquisa";
    return $endereco;
}
