<?php
require __DIR__.'/PDO.php';
$avatar_dir = __DIR__.'../avatar/';
$per_page = 10;//每頁資料筆數


//建立一個陣列，準備用來儲存結果
$result = [
        'success' => false,
        'page' => 0,
        'per_page' => $per_page,
        'tol_page' => 0,
        'row_count' => 0,
        'data' => [],
        'errorCode' => 0,
        'errorMsg' => '',
];
    

if (! isset($_POST['chk'])) {
    $result['errorCode'] = 401;
    $result['errorMsg'] = '未勾選任何條件!';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

    $tempchk = $_POST['chk'];
    $select= implode(",", $tempchk);

    $page = isset($_GET['page'])? intval($_GET['page']) : 1;




    //計算資料筆數
    
    $t_sql = "SELECT $select FROM `film_primary_table`";
    $t_stmt = $pdo->query($t_sql);
    $total_rows = $t_stmt->rowCount();
    $result['row_count']=intval($total_rows);//將計算結果加入result陣列

    if($total_rows==0){
        $result['errorCode'] = 402;
        $result['errorMsg'] = '查無符合條件的資料!';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }





    //總頁數(小數點進位)
    $total_page = ceil($total_rows/$per_page);
    $result['tol_page']=$total_page;//將計算結果加入result陣列

    if ($page < 1) {
        $page = 1;
    }
    if ($page > $total_page) {
        $page = $total_page;
    }
    $result['page']=$page;//將計算結果加入result陣列

    //取得資料
        $sql = sprintf("SELECT sid,$select FROM film_primary_table ORDER BY `sid` ASC LIMIT %s,%s", ($page-1)*$per_page, $per_page);
        $stmt = $pdo->query("$sql");
        $result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);//將計算結果加入result陣列
        $result['success'] = true;//將計算結果加入result陣列


//回傳至頁面(以json字串形式)
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
// }