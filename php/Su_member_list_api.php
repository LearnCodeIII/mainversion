<?php
require __DIR__.'/PDO.php';
$dper_page = 10;//每頁資料筆數



$result = [
    'success' => false,
    'page' => 0,
    'dperPage' => $dper_page,
    'totalPage' => 0,
    'totalRows' => 0,
    'data' => [],
    'errorCode' => 0,
    'errorMsg' => '',
];


$page = isset($_GET['page'])? intval($_GET['page']) : 1; 


//計算資料筆數
$t_sql = "SELECT COUNT(1) FROM `member`";
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
$result['totalRows']=intval($total_rows);

//總頁數(小數點進位)
$total_page = ceil($total_rows/$dper_page);
$result['totalPage']=$total_page;

if($page < 1) $page = 1;
if($page > $total_page) $page = $total_page;
$result['page']=$page;

//取得資料
$sql = sprintf("SELECT * FROM member LIMIT %s,%s",($page-1)*$dper_page,$dper_page);
$stmt = $pdo->query("$sql");
$result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result['success'] = true;

//回傳至頁面(以json字串形式)
echo json_encode($result, JSON_UNESCAPED_UNICODE);
