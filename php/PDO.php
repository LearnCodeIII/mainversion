<?php

//設定資料庫
$db_host='localhost';
$db_name='movie';
$db_user='shawnlin';
$db_pass='13879428';
$dsn="mysql:host=${db_host};dbname=${db_name}";


try{
    $pdo = new PDO($dsn,$db_user,$db_pass);
    $pdo->query("SET NAMES utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo 'Error'.$e->getMessage();
}


if(! isset($_SESSION)){
    session_start();
}

?>