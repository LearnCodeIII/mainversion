<?php 
require __DIR__.'/PDO.php';

$result = [
    'success' => false,
    'page' => 0,
    'perPage' => 0,
    'totalPages' => 0,
    'totalRows' => 0,
    'data' => [],
    ];

$pname = 'article_list';
$per_page = 10;
 //每頁筆數
$result['perPage'] = $per_page;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1 ; //用戶輸入的頁數

$searchkey = isset($_GET['searchkey']) ? $_GET['searchkey'] : '';
$srky = $pdo->quote("%".$searchkey."%");

if (!isset($searchkey)){
    $result["errorMsg"] = '搜尋到0筆資料';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

//總筆數
$t_sql = sprintf("SELECT COUNT(1) FROM `article`  WHERE `title` LIKE %s OR `content` LIKE %s",$srky,$srky);
$result['total_sql'] = $t_sql;
$t_stmt = $pdo -> query($t_sql);
$t_rows = $t_stmt -> fetch(PDO::FETCH_NUM)[0];
$result['totalRows'] = intval($t_rows);

//總頁數
$total_pages = ceil($t_rows/$per_page);
$result['totalPages'] = $total_pages;

if($page < 1)  $page = 1 ;
if($page > $total_pages) $page = $total_pages;
$result['page'] = $page;

$sql = sprintf("SELECT * FROM `article` WHERE `title` LIKE %s OR `content` LIKE %s ORDER BY sid DESC LIMIT %s, %s", $srky,$srky,($page-1)*$per_page, $per_page);
$result['items_sql'] = $sql;
$stmt = $pdo -> query($sql);

$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);

$result['data'] = $rows;
$result['success'] = true;

// echo json_encode($result) ;
// 將陣列轉換成 json 字串      ↓跳脫 字碼
echo json_encode($result, JSON_UNESCAPED_UNICODE);   

?>
