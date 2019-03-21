<?php
$pagename = "pageMain";

include __DIR__.'/PDO.php';

header("Content-type:application/json");


$result = [
	"success" => false,
	"page" => 0,
	"totalRows" => 0,
	"totalPages" => 0,
	"Msg" => 0,
	"Code" => 0,
	"data" => []
];

	$sid = $_GET['sid'];

	#顯示資料
	$sql = "SELECT * FROM `activity` WHERE `sid` = :datasid";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":datasid",$sid);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$result['data']=$data;


	$result['success']=true;


	echo json_encode($result, JSON_UNESCAPED_UNICODE);
	exit;


?>