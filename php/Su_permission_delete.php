<?php
// require __DIR__.'/__cred.php';
require __DIR__.'/PDO.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$pdo -> query("DELETE FROM `permission` WHERE `sid`=$sid");

$suc_msg="已成功刪除資料!";

echo "<script type='text/javascript'>history.go(-1)</script>";

// $goto = "Su_member_search.php";//預設值
// if(isset($_SERVER['HTTP_REFERER'])){
//     $goto = $_SERVER['HTTP_REFERER'];
// }

// header("Location: $goto");