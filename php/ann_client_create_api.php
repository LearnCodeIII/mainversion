<?php
require __DIR__ . '/PDO.php';

header('Content-Type: application/json'); // 在Postman檢查時不須再特別選擇就會直接以JSON格式顯示

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => "資料輸入不完整",
    'post' => [], // 做 echo 檢查      
];

if(isset($_POST['checkme'])) {
  
    $client_name = $_POST['client_name'];
    $client_number = $_POST['client_number'];
    $client_address = $_POST['client_address'];
    $client_poc = $_POST['client_poc'];
    $client_mobile = $_POST['client_mobile'];
    $client_email = $_POST['client_email'];
    $contract_budget = $_POST['contract_budget'];
    $contract_start_date = $_POST['contract_start_date'];
    $contract_end_date = $_POST['contract_end_date'];
    
    $result['post'] = $_POST; // 做echo檢查

    if(empty($client_name) or empty($client_email) or empty($client_email)) {
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

if(! filter_var($client_email, FILTER_VALIDATE_EMAIL)) {
    $result['errorCode'] = 405;
    $result['errorMsg'] = 'Email格式不正確';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `ad`(
        `client_name`, `client_number`, `client_address`, `client_poc`, `client_mobile`, `client_email`, `contract_budget`, `contract_start_date`, `contract_end_date`
        ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?
        )";

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

        if ($stmt->rowCount() == 1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';

        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料新增錯誤';
        }

    } catch(PDOException $e) {
        $result['errorCode'] = 403;
        $result['errorMsg'] = '信箱已存在';
    }

}

echo json_encode($result, JSON_UNESCAPED_UNICODE);