<?php

$end_point_api = "https://silabsst.com.br/appSilabSST/v1.1/servico/apiBackSilab2.0";

function getApiSilab($table, $dados)
{
    global $end_point_api;

    $curl = curl_init();

    if (!empty($dados)) {
        foreach ($dados as $key => $dado) {
            $dados[$key] = $key . "=" . base64_encode(json_encode($dado));
        }
    }

    $option = implode("&", $dados);

    $table = base64_encode($table);

    $api_url = "$end_point_api/?table=$table&$option";

    curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response, true);
}

function patchApiSilab($table, $dados)
{
    global $end_point_api;

    $curl = curl_init();

    $dados = json_encode($dados);

    $table = base64_encode($table);

    $api_url = "$end_point_api/?table=$table";

    curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PATCH',
        CURLOPT_POSTFIELDS => $dados,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response, true);
}

function postApiSilab($table, $dados)
{
    global $end_point_api;

    $curl = curl_init();

    $dados = json_encode($dados);

    $table = base64_encode($table);

    $api_url = "$end_point_api/?table=$table";

    curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $dados,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response, true);
}

function deleteApiSilab($table,  $dados)
{
    global $end_point_api;

    $curl = curl_init();

    if (!empty($dados)) {
        foreach ($dados as $key => $dado) {
            $dados[$key] = $key . "=" . base64_encode(json_encode($dado));
        }
    }

    $option = implode("&", $dados);

    $table = base64_encode($table);

    $api_url = "$end_point_api/?table=$table";

    curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response, true);
}
