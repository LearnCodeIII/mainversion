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




if(isset($_POST['search_keyword']) || isset($_POST['search_keyword']) || isset($_POST['search_keyword'])){


	$search_keyword = '%'.$_POST['search_keyword'].'%';
	$search_dateStart = $_POST['search_dateStart'];
	$search_dateEnd = $_POST['search_dateEnd'];




	#算總筆數
	$t_sql ="SELECT * FROM `activity` WHERE (`name` LIKE :search_keyword OR `content` LIKE :search_keyword OR `company` LIKE :search_keyword OR `region` LIKE :search_keyword )AND  `dateStart` >= :search_dateStart AND `dateEnd` <= :search_dateEnd ORDER BY `activity`.`dateStart` ASC";
	$t_stmt = $pdo->prepare($t_sql);
	$t_stmt->bindValue(":search_keyword",$search_keyword);
	$t_stmt->bindValue(":search_dateStart",$search_dateStart);
	$t_stmt->bindValue(":search_dateEnd",$search_dateEnd);
	$t_stmt->execute();
	$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
	$result['totalRows']=$total_rows;
	if($total_rows<1){
		$result['msg']="沒有結果";
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		exit;
	}


	#顯示資料
	$sql ="SELECT * FROM `activity` WHERE (`name` LIKE :search_keyword OR `content` LIKE :search_keyword OR `company` LIKE :search_keyword OR `region` LIKE :search_keyword )AND  `dateStart` >= :search_dateStart AND `dateEnd` <= :search_dateEnd ORDER BY `activity`.`dateStart` ASC";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":search_keyword",$search_keyword);
	$stmt->bindValue(":search_dateStart",$search_dateStart);
	$stmt->bindValue(":search_dateEnd",$search_dateEnd);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$result['data']=$data;
	$result['totalRows']=count($data);


	$result['success']=true;


	echo json_encode($result, JSON_UNESCAPED_UNICODE);
	exit;
};






?>