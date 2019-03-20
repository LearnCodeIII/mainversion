<?php
$pagename = "pageMain";

include __DIR__.'/PDO.php';

header("Content-type:application/json");

	# 用戶要看第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 4;

$result = [
	"success" => false,
	"page" => 0,
	"totalRows" => 0,
	"per_page" => $per_page,
	"totalPages" => 0,
	"Msg" => 0,
	"Code" => 0,
	"data" => []
];







	
	$search_dateStart = "2017-10-12";
	$search_dateEnd = "2019-04-08";

	#顯示資料
	$sql ="SELECT * FROM `activity` WHERE `dateStart` > :search_dateStart AND `dateEnd` < :search_dateEnd ORDER BY `activity`.`dateStart` ASC";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":search_dateStart",$search_dateStart);
	$stmt->bindValue(":search_dateEnd",$search_dateEnd);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$result['data']=$data;
	$result['totalRows']=count($data);


	$result['success']=true;


	echo json_encode($result, JSON_UNESCAPED_UNICODE);
	exit;







?>