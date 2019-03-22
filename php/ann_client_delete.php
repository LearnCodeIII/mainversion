<?php
// require __DIR__. '/__cred.php';
require __DIR__ . '/PDO.php';

$sn = isset($_GET['sn']) ? intval($_GET['sn']) : 0;

$pdo->query("DELETE FROM `ad` WHERE `sn`= $sn");


$goto = 'ann_client_list.php'; // 預設值

if(isset($_SERVER['HTTP_REFERER'])){
    $goto = $_SERVER['HTTP_REFERER'];
}

header("Location: $goto");