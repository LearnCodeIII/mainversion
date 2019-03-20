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




if(isset($_POST['search_keyword'])){

	$search_keyword =$_POST['search_keyword'];
	$search_keyword = '%'.$_POST['search_keyword'].'%';

	#算總筆數
	$t_sql = "SELECT COUNT(1) FROM `activity` WHERE `name` LIKE :search_keyword OR `content` LIKE :search_keyword OR `company` LIKE :search_keyword OR `region` LIKE :search_keyword ";
	$t_stmt = $pdo->prepare($t_sql);
	$t_stmt->bindParam(":search_keyword",$search_keyword);
	$t_stmt->execute();
	$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
	$result['totalRows']=$total_rows;
	if($total_rows<1){
		$result['msg']="沒有結果";
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		exit;
	}
	#總頁數
	$page=isset($page)?$page:1;
	$total_pages = ceil($total_rows/$per_page);
	$result['totalPages']=$total_pages;
	if($page<1)$page=1;
	if($page>$total_pages)$page=$total_pages;
	$result['page']=$page;

	#顯示資料

	$sql = sprintf("SELECT * FROM `activity` WHERE `name` LIKE :search_keyword OR `content` LIKE :search_keyword OR `company` LIKE :search_keyword OR `region` LIKE :search_keyword  LIMIT %s, %s",($page-1)*$per_page,$per_page);
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":search_keyword",$search_keyword);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$result['data']=$data;


	$result['success']=true;


	echo json_encode($result, JSON_UNESCAPED_UNICODE);
	exit;
};






?>