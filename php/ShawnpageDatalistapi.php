<?php
$pagename = "pageMain";

include __DIR__.'/PDO.php';

#每頁筆數
$per_page = 4;

$result = [
	"success" => false,
	"page" => 0,
	"totalRows" => 0,
	"per_page" => $per_page,
	"totalPages" => 0,
	"data" => [],
	"ErrMsg" => 0,
	"ErrCode" => 0
];


#設定當前頁數
$page = isset($_GET['page'])? intval($_GET['page']):1;

#算總筆數
$t_sql = "SELECT COUNT(1) FROM activity";
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
$result['totalRows']=$total_rows;

#總頁數
$total_pages = ceil($total_rows/$per_page);
$result['totalPages']=$total_pages;

if($page<1)$page=1;
if($page>$total_pages)$page=$total_pages;
$result['page']=$page;

#顯示資料
$sql = sprintf("SELECT * FROM `activity` ORDER BY `activity`.`sid` DESC LIMIT %s, %s",($page-1)*$per_page,$per_page);
$stmt = $pdo->query($sql);
$result['data'] = $stmt->fetchALL(PDO::FETCH_ASSOC);


$result['success']=true;
echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>