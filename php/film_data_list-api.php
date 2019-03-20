<?php
require __DIR__.'/PDO.php';


//指定每頁顯示數量
$per_page=10;
$page = isset($_GET['page'])? intval($_GET['page']):1;


    //設定要傳給前端的變數和資料
$result = [
    'success'=>false,
    'page'=>0,
    'row_count'=>0,
    'per_page'=>$per_page,
    'tol_page'=>0,
    'data'=>[],
    'errorCode'=>0,
    'errorMsg'=>'',
];


//算總筆數
$tol_sql="SELECT COUNT(*) FROM film_primary_table";
$tol_stmt=$pdo->query($tol_sql);
$row_count=$tol_stmt->fetch(PDO::FETCH_NUM)[0];
    //將結果設定進去要傳給前端的變數
$result['row_count']=intval($row_count);

//總頁數
$tol_page=ceil($row_count/$per_page);

$sql=sprintf("SELECT * FROM `film_primary_table` ORDER BY sid ASC LIMIT %s,%s", ($page-1)*$per_page, $per_page);
$stamt=$pdo->query($sql);
    //將結果設定進去要傳給前端的變數
$result['tol_page']=$tol_page;

//設定輸入頁數範圍
if ($page<1) {
    $page=1;
}
if ($page>$tol_page) {
    $page=$tol_page;
}
    //將結果設定進去要傳給前端的變數
$result['page']=$page;

//所有資料一次拿出來
$rows = $stamt->fetchAll(PDO::FETCH_ASSOC);

    //將拿出來的資料存進陣列
$result['data'] =$rows;

    //將傳輸結果改為成功
$result['success'] = true;

    //將結果陣列轉成JSON字串
    //如果要便於除錯 可加入JSON_UNESCAPED_UNICODE 防跳脫字元
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>
