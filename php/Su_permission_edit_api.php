<?php
require __DIR__.'/PDO.php';
header('Content-type:application/json');//設定資料回傳格式為json

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [],//做回應檢查
];



$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0 ;

if (isset($_POST['checkme'])) {
    $permName=$_POST['edit_perm_name'];
    $permNo=$_POST['edit_perm_no'];
    $canDo = implode(',', $_POST['edit_can']);
    $result['post'] = $_POST;//做回應檢查


    //若其中一格為空值，錯誤碼=400，回傳結果陣列，並停止程式
    if (empty($permName) or empty($canDo)) {
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
    $sql = "UPDATE `permission` SET 
            `name`=?,
            `can_do`=?
            WHERE `no`=?";

    try {
        $stmt = $pdo->prepare($sql);//先準備一個statement物件(function)
        $stmt->execute([//執行塞值的動作
        $permName,
        $canDo,
        $permNo
    ]);
        if ($stmt->rowCount()==1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料沒有異動!';
        };
    } catch (PDOException $ex) {//需先設定PDO錯誤模式，才會顯示此內容(該設定在__connect_db.php)
        $result['errorCode'] = 403;
        $result['errorMsg'] = '發生錯誤!';
    };
};

echo json_encode($result, JSON_UNESCAPED_UNICODE);
