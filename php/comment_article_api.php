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
    $pname = 'comment_list_api';
    $per_page = 10;
    //每頁筆數
    $result['perPage'] = $per_page;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1 ; //用戶輸入的頁數
    $sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

//總筆數
$t_sql = sprintf("SELECT COUNT(1) FROM `comment`LEFT JOIN `member` ON `comment`.`member_sid` = `member`.`sid` LEFT JOIN `article` ON `comment`.`article_sid`=`article`.`sid` WHERE `article`.`sid`=%s",$sid);
$t_stmt = $pdo -> query($t_sql);
$t_rows = $t_stmt -> fetch(PDO::FETCH_NUM)[0];
$result['totalRows'] = intval($t_rows);

//總頁數
$total_pages = ceil($t_rows/$per_page);
$result['totalPages'] = $total_pages;

if ($page<1) {
    $page=1;
}
if ($page>$total_pages) {
    $page=$total_pages;
};

$result['page'] = $page;

$sql = sprintf("SELECT `comment`.*,`article`.`sid`,`article`.`title`,`member`.`name`,`member`.`nickname`,`member`.`avatar` FROM `comment`LEFT JOIN `member` ON `comment`.`member_sid` = `member`.`sid` LEFT JOIN `article` ON `comment`.`article_sid`=`article`.`sid` WHERE `article`.`sid`=$sid");
$stmt = $pdo -> query($sql);

$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);

$result['data'] = $rows;
$result['success'] = true;

// echo json_encode($result) ;
// 將陣列轉換成 json 字串      ↓跳脫 字碼
echo json_encode($result, JSON_UNESCAPED_SLASHES);   
// echo json_encode($result, JSON_UNESCAPED_SLASHES);   

?>
