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
        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => $url,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_SSL_VERIFYPEER => false,
        //     CURLOPT_TIMEOUT => 30
        // ));
        // $response = curl_exec($curl);
        // curl_close($curl);

        $response = file_get_contents($url);
    }

    // Converte o JSON de resposta para um objeto
    $endereco = json_decode($response);

    // Exibe o endereço completo
    //echo "Endereço: " . $endereco->logradouro . ", " . $endereco->bairro . ", " . $endereco->localidade . " - " . $endereco->uf;

    echo "<br>Pronto para nova pesquisa";
    return $endereco;
}

/**
 * 
 * Função para exibir coordenadas de um endereço
 * @param $endereco String Endereço para pesquisar as coordenadas.
 * @return $coords array contendo as coordenadas 
 */
function exibirCoordenadas($endereco)
{

    $coords = ["sucesso" => false, "erro" => "", "latitude" => 0, "longitude" => 0];

    // Define a localidade que se deseja obter as coordenadas
    //$endereco = 'Av. Paulista, 1000 - São Paulo, SP';

    // Faz a requisição à API do Google Maps
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($endereco);
    $response = file_get_contents($url);

    // Converte o JSON de resposta para um objeto
    $data = json_decode($response);

    // Verifica se a resposta da API foi bem-sucedida
    if ($data->status == 'OK') {
        // Obtém as coordenadas geográficas da localidade
        $latitude = $data->results[0]->geometry->location->lat;
        $longitude = $data->results[0]->geometry->location->lng;

        $coords = ["sucesso" => true, "erro" => $data->status, "latitude" => $latitude, "longitude" => $longitude];

        // Exibe as coordenadas geográficas na tela
        //echo 'Latitude: ' . $latitude . '<br>';
        //echo 'Longitude: ' . $longitude;
    } else {
        // Caso contrário, exibe a mensagem de erro da API
        //echo 'Erro ao obter as coordenadas: ' . $data->status;
        $coords = ["sucesso" => false, "erro" => $data->status, "latitude" => "", "longitude" => ""];
    }

    return $coords;
}
