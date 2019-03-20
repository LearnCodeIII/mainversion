<?php
//TODO 設定管理權限使用
// require __DIR__. '/__cred.php';
include __DIR__ . '/PDO.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$pdo->query("DELETE FROM `forum` WHERE `sid`=$sid");

$goto = "Roy_datalist.php"; // 預設值



if(isset($_SERVER['HTTP_REFERER'])){
    $goto = $_SERVER['HTTP_REFERER'];
    // 回到當頁,用AJAX方式寫會無效，因為沒有頁面轉換
}

header("Location: $goto");





?>

<script>
// const current_page = location.hash.slice(1);
// console.log(current_page)
// console.log(location.href)
// location.href = `Roy_datalist.php#${current_page}`;





</script>
