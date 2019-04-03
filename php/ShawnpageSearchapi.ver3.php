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

$where = ' WHERE 1 ';

if(isset($_POST['search_keyword'])){
	$sk = $pdo->quote( '%'. $_POST['search_keyword']. '%' );
	$where .= sprintf(" AND ( `name` LIKE %s OR `content` LIKE %s OR `company` LIKE %s  OR `region` LIKE %s) ", $sk, $sk, $sk, $sk);
}

$startDate = isset($_POST['search_dateStart']) ? $_POST['search_dateStart'] : '';
$endDate = isset($_POST['search_dateEnd']) ? $_POST['search_dateEnd'] : '';

if(empty($startDate) and empty($endDate)){
} elseif(!empty($startDate) and empty($endDate)){

}elseif(empty($startDate) and !empty($endDate)){

}else{
	" AND ( OR　) "
}



if(isset($_POST['search_dateStart'])){
	$
	$where .= " AND `dateStart` LIKE %s OR `content` LIKE %s OR `company` LIKE %s  OR `region` LIKE %s) ";


}


if(isset($_POST['search_keyword'])){

	$_POST['search_keyword']=isset($_POST['search_keyword'])?$_POST['search_keyword']:"";
	$_POST['search_dateStart']=isset($_POST['search_dateStart'])?$_POST['search_dateStart']:"1970-01-01";
	$_POST['search_dateEnd']=isset($_POST['search_dateEnd'])?$_POST['search_dateEnd']:"3000-01-01";


	$search_keyword = '%'.$_POST['search_keyword'].'%';
	$search_dateStart = '%'.$_POST['search_dateStart'].'%';
	$search_dateEnd = '%'.$_POST['search_dateEnd'].'%';



	#算總筆數
	$t_sql = "SELECT COUNT(1) FROM `activity` WHERE `name` LIKE :search_keyword OR `content` LIKE :search_keyword OR `company` LIKE :search_keyword OR `region` LIKE :search_keyword ORDER BY `activity`.`sid` DESC";
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

	$sql = sprintf("SELECT * FROM `activity` WHERE `name` LIKE :search_keyword OR `content` LIKE :search_keyword OR `company` LIKE :search_keyword OR `region` LIKE :search_keyword  ORDER BY `activity`.`sid` DESC LIMIT %s, %s",($page-1)*$per_page,$per_page);
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