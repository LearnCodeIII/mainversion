<?php
require __DIR__. '/cinema_Login_SQL.php';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [], // 做 echo 檢查      
        
];
$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;

if(isset($_POST['name']) and !empty($sid)){
    $name = $_POST['name'];
    $img = $_POST['img'];
    $taxID = $_POST['taxID'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $account = $_POST['account'];
    $password = $_POST['password'];
    $intro = $_POST['intro'];

    $result['post'] = $_POST;  // 做 echo 檢查

    if(empty($name) or empty($taxID) or empty($phone) or empty($address) or empty($account) or empty($password)){
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // 1. 修改資料之前可以先確認該筆資料是否存在
    // 2. account 有沒有跟別筆的資料相同

    $s_sql = "SELECT * FROM `cinema` WHERE `sid`=? OR `account`=?";
    $s_stmt = $pdo->prepare($s_sql);
    $s_stmt->execute([$sid ,$_POST['account']]);

    switch($s_stmt->rowCount()){
        case 0:
            $result['errorCode'] = 410;
            $result['errorMsg'] = '該筆資料不存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        //break;
        case 2:
            $result['errorCode'] = 420;
            $result['errorMsg'] = '帳號 已存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        case 1:
            $row = $s_stmt->fetch(PDO::FETCH_ASSOC);
            if($row['sid']!=$sid){
                $result['errorCode'] = 430;
                $result['errorMsg'] = '該筆資料不存在';
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                exit;
            }
    }

    $sql = "UPDATE `cinema` SET 
                `name`=?,
                `name`=?,
                `taxID`=?,
                `phone`=?,
                `address`=?,
                `account`=?,
                `password`=?,
                `intro`=?                
                WHERE `sid`=?";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['name'],
            $_POST['img'],
            $_POST['taxID'],
            $_POST['phone'],
            $_POST['address'],
            $_POST['account'],
            $_POST['password'],
            $_POST['intro'],
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
