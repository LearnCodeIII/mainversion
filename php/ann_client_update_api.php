<?php
// require __DIR__. '/__cred.php';
require __DIR__ . '/PDO.php';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [], // 做 echo 檢查      
        
];
$sn = isset($_POST['sn']) ? intval($_POST['sn']) : 0;

if(isset($_POST['client_name']) and !empty($sn)){

    $client_name = $_POST['client_name'];
    $client_number = $_POST['client_number'];
    $client_address = $_POST['client_address'];
    $client_poc = $_POST['client_poc'];
    $client_mobile = $_POST['client_mobile'];
    $client_email = $_POST['client_email'];
    $contract_budget = $_POST['contract_budget'];
    $contract_start_date = $_POST['contract_start_date'];
    $contract_end_date = $_POST['contract_end_date'];

    $result['post'] = $_POST;  // 做 echo 檢查

    if(empty($client_name) or empty($client_email) or empty($client_mobile)){
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    if(! filter_var($client_email, FILTER_VALIDATE_EMAIL)){
        $result['errorCode'] = 405;
        $result['errorMsg'] = '信箱格式不正確';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $s_sql = "SELECT * FROM `ad` WHERE `sn`=? OR `client_email`=?";
    $s_stmt = $pdo->prepare($s_sql);
    $s_stmt->execute([$sn, $_POST['client_email']]);

    switch($s_stmt->rowCount()){
        case 0:
            $result['errorCode'] = 410;
            $result['errorMsg'] = '該筆資料不存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
            // break;
        case 2:
            $result['errorCode'] = 420;
            $result['errorMsg'] = '信箱已存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        case 1:
            $row = $s_stmt->fetch(PDO::FETCH_ASSOC);
            if($row['sn']!=$sn){
                $result['errorCode'] = 430;
                $result['errorMsg'] = '該筆資料不存在';
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                exit;
            }
    }

    $sql = "UPDATE `ad` SET 
                `client_name`=?,
                `client_number`=?,
                `client_address`=?,
                `client_poc`=?,
                `client_mobile`=?,
                `client_email`=?,
                `contract_budget`=?,
                `contract_start_date`=?,
                `contract_end_date`=?
                WHERE `sn`=?";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([

            $_POST['client_name'],
            $_POST['client_number'],
            $_POST['client_address'],
            $_POST['client_poc'],
            $_POST['client_mobile'],
            $_POST['client_email'],
            $_POST['contract_budget'],
            $_POST['contract_start_date'],
            $_POST['contract_end_date'],

        ]);

        if($stmt->rowCount() == 1) {
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