<?php
require __DIR__.'/PDO.php';
$dper_page = 10;//每頁資料筆數


//建立一個陣列，準備用來儲存結果
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
    

// $check = array(
//     'sid',
//     'name',
//     'nickname',
//     'gender',
//     'age',
//     'birthday',
//     'email',
//     'mobile',
//     'fav_type',
//     'avatar',
//     'join_date',
//     'pwd',
//     'pwd_change_d',
//     'pwd_err_c',
//     'last_login_d',
//     'login_c',
//     'rank',
//     'permission'
// );


if (! isset($_POST['chk'])) {
    $result['errorCode'] = 401;
    $result['errorMsg'] = '未勾選任何欄位!';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}


if($_POST['sel-1-k']!=''){
    if($_POST['sel-1']=='none'){
        $result['errorCode'] = 405;
        $result['errorMsg'] = '請為您輸入的關鍵字選擇搜尋欄位!';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

    $tempchk = $_POST['chk'];
    $select= implode(",", $tempchk);

    $sel1 = $_POST['sel-1'];
    // $sel2 = $_POST['sel-2'];
    // $sel3 = $_POST['sel-3'];
    $kw1 = $_POST['sel-1-k'];
    $kw2 = $_POST['sel-2-k'];
    $kw3 = $_POST['sel-3-k'];
    $cond1=$sel1." LIKE'%".$kw1."%'";
    $cond2="gender IN('".$kw2."')";
    $cond3="permission IN(".$kw3.")";



    $page = isset($_GET['page'])? intval($_GET['page']) : 1;




    //計算資料筆數
    if($kw1=='' && $kw2=="男','女" && $kw3=="0,1,2,3"){
        $t_sql = "SELECT $select FROM `member`";
    }else{
        if($kw1==''){
            $t_sql = "SELECT $select FROM `member` WHERE $cond2 AND $cond3";
        }else{
            $t_sql = "SELECT $select FROM `member` WHERE $cond1 AND $cond2 AND $cond3";
        }
    }
    $t_stmt = $pdo->query($t_sql);
    $total_rows = $t_stmt->rowCount();
    $result['totalRows']=intval($total_rows);//將計算結果加入result陣列

    if($total_rows==0){
        $result['errorCode'] = 402;
        $result['errorMsg'] = '查無符合條件的資料!';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }





    //總頁數(小數點進位)
    $total_page = ceil($total_rows/$dper_page);
    $result['totalPage']=$total_page;//將計算結果加入result陣列

    if ($page < 1) {
        $page = 1;
    }
    if ($page > $total_page) {
        $page = $total_page;
    }
    $result['page']=$page;//將計算結果加入result陣列

    //取得資料
    if ($kw1=='' && $kw2=="男','女" && $kw3=="0,1,2,3") {
        $sql = sprintf("SELECT $select FROM `member` ORDER BY `sid` ASC LIMIT %s,%s", ($page-1)*$dper_page, $dper_page);
    }else{
        if($kw1==''){
            $sql = sprintf("SELECT $select FROM `member` WHERE %s AND %s ORDER BY `sid` ASC LIMIT %s,%s", $cond2, $cond3, ($page-1)*$dper_page, $dper_page);
        }else{
            $sql = sprintf("SELECT $select FROM `member` WHERE %s AND %s AND %s ORDER BY `sid` ASC LIMIT %s,%s", $cond1, $cond2, $cond3, ($page-1)*$dper_page, $dper_page);
        }
        // $sql = "SELECT $select FROM `member` WHERE $cond1 AND $cond2 AND $cond3";
        // $sql = sprintf("SELECT $select FROM `member` WHERE %s AND %s AND %s LIMIT %s,%s", $cond1, $cond2, $cond3, ($page-1)*$dper_page, $dper_page);

    }
        $stmt = $pdo->query($sql);
        $result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);//將計算結果加入result陣列
        $result['success'] = true;//將計算結果加入result陣列



//回傳至頁面(以json字串形式)
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
// }