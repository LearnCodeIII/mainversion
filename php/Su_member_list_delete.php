<?php
// require __DIR__.'/__cred.php';
require __DIR__.'/PDO.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$pdo -> query("DELETE FROM `member` WHERE `sid`=$sid");

$suc_msg="已成功刪除資料!";

echo "<script type='text/javascript'>alert('$suc_msg');</script>";

$goto = "Su_member_list.php";//預設值
if(isset($_SERVER['HTTP_REFERER'])){
    $goto = $_SERVER['HTTP_REFERER'];
}

header("Location: $goto");