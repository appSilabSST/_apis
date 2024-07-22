<?php
$host = '162.241.60.224';    // host onde está o banco de dados
$db_name = 'labore26_silab'; // nome do banco de dados
$user = 'labore26_silab';    // usuário de conexão ao banco de dados
$password = 'SiLaB@2019';    // senha de conexão para o banco de dados
;
try {
    $conecta = new PDO("mysql:host={$host};dbname={$db_name}", $user, $password);
    // echo "Connection Successfuly";
} catch (PDOException $ex) {
    die("Connection error: " . $ex->getMessage());
}
