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

//總筆數
$t_sql = "SELECT COUNT(1) FROM `article`";
$t_stmt = $pdo -> query($t_sql);
$t_rows = $t_stmt -> fetch(PDO::FETCH_NUM)[0];
$result['totalRows'] = intval($t_rows);

//總頁數
$total_pages = ceil($t_rows/$per_page);
$result['totalPages'] = $total_pages;

if($page < 1)  $page = 1 ;
if($page > $total_pages) $page = $total_pages;
$result['page'] = $page;

$sql = sprintf("SELECT * FROM article ORDER BY sid DESC LIMIT %s, %s", ($page-1)*$per_page, $per_page);
$stmt = $pdo -> query($sql);

$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);

$result['data'] = $rows;
$result['success'] = true;

// echo json_encode($result) ;
// 將陣列轉換成 json 字串      ↓跳脫 字碼
echo json_encode($result, JSON_UNESCAPED_SLASHES);   
// echo json_encode($result, JSON_UNESCAPED_SLASHES);   

?>
