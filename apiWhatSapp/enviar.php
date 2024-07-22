<?php
$curl = curl_init();

$data = array(
    "phone" => '5512991074421',
    "message" => $texto_whats,
    "image" => "https://silabsst.com.br/appSilabSST/v1.1/assets/img/logo.png",
    "linkUrl" => $url,
    "title" => "LABORE MEDICINA OCUPACIONAL",
);

$data = json_encode($data);

$headers = array(
    "Content-Type: application/json",
    "client-token: {{security-token}}",
    "Content-Length: " . strlen($data)
);

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.z-api.io/instances/SUA_INSTANCIA/token/SEU_TOKEN/send-image",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => $headers,
));

echo $response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo  $response['id'];
}
