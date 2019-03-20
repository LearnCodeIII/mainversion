<?php
// require __DIR__. '/__cred.php';
require __DIR__. './PDO.php';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' => 0,
    'filename' => '',
    'info' => '',
    'errorMsg' => '資料輸入不完整',
    'post' => [], // 做 echo 檢查      
        
];
$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
if (!isset($sid)){
    $result["errorMsg"] = '沒有SID參數';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}


// $s_sql = "SELECT * FROM forum WHERE sid=$sid";
// $s_stmt = $pdo->query($s_sql);
// $row = $s_stmt->fetch(PDO::FETCH_ASSOC);
// $result['success'] = true;
// echo json_encode($result, JSON_UNESCAPED_UNICODE);

if(isset($_POST['headline']) and !empty($sid)){
    $headline = $_POST['headline'];
    $review = $_POST['review'];
    $w_date = $_POST['w_date'];
    $w_cinema = $_POST['w_cinema'];
    $film_rate = $_POST['film_rate'];
    $fav = $_POST['fav'];


    $result['post'] = $_POST;  // 做 echo 檢查

    if(empty($headline) or empty($review) or empty($w_date)){
        $result['errorCode'] = 400;
        $result["errorMsg"] = "欄位不可為空";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // 1. 修改資料之前可以先確認該筆資料是否存在
    // 2. Email 有沒有跟別筆的資料相同

    // $s_sql = "SELECT * FROM `forum` WHERE `sid`=?";
    // $s_stmt = $pdo->prepare($s_sql);
    // $s_stmt->execute([$sid]);

    // switch($s_stmt->rowCount()){
    //     case 0:
    //         $result['errorCode'] = 410;
    //         $result['errorMsg'] = '該筆資料不存在';
    //         echo json_encode($result, JSON_UNESCAPED_UNICODE);
    //         exit;
    //     case 1:
    //         $row = $s_stmt->fetch(PDO::FETCH_ASSOC);
    //         if($row['sid']!=$sid){
    //             $result['errorCode'] = 430;
    //             $result['errorMsg'] = '該筆資料不存在';
    //             echo json_encode($result, JSON_UNESCAPED_UNICODE);
    //             exit;
    //         }
    // }



    $sql = "UPDATE `forum` SET 
                `headline`=?,
                `review`=?,
                `w_date`=?,
                `w_cinema`=?,
                `film_rate`=?,
                `fav`=?
                WHERE `sid`=?";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['headline'],
            $_POST['review'],
            $_POST['w_date'],
            $_POST['w_cinema'],
            $_POST['film_rate'],
            $_POST['fav'],
            $sid
        ]);

        if($stmt->rowCount()==1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料沒有修改';
        }
    } catch(PDOException $ex){
        $result['errorCode'] = 403;
        $result['errorMsg'] = '資料更新發生錯誤';
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);