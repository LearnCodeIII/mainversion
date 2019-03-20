<?php
include __DIR__.'/PDO.php';
$sid= isset($_GET['sid'])?intval($_GET['sid']):0;
$pdo->query("DELETE FROM `activity` WHERE `sid`=${sid}");
$goto = "ShawnpageDatalist.php";
if(isset($_SERVER['HTTP_REFERER'])){
	$goto = $_SERVER['HTTP_REFERER'];
};

header("Location:$goto");

?>