<?php
require __DIR__. '/PDO.php';
$groupname = 'theater';
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$pdo->query("DELETE FROM `cinema` WHERE `sid`=$sid");


$goto = 'cinema_ifmt_list4.php'; // 預設值

if(isset($_SERVER['HTTP_REFERER'])){
    $goto = $_SERVER['HTTP_REFERER'];
}

header("Location: $goto");
