<?php
    $db_host = 'localhost';
    $db_name = 'uploadding';
    $db_user = 'Ethan';
    $db_psd = 'qqqqqqqq';

    try{
        $pdo = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_psd);
        $pdo->query("SET NAMES utf8");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $ex){
        echo 'error'.$ex->getMessage();
    }

    if(! isset($_SESSION)){
        session_start();
    }

