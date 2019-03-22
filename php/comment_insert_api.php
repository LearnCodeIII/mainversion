<?php 
require __DIR__.'/PDO.php';
$upload_dir = __DIR__.'/../pic/article/';

// ↓ 輸出的內容格式 = json
header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' =>0,
    'errorMsg' =>'資料不完整',
    'post' =>[],
];

if (isset($_POST['comment'])){
    $result['post'] = $_POST;
    $comment = $_POST['comment'];

    //如果 這些 變數的欄位 是空的  就回傳 result錯誤代碼400的json格式 並停止
    if(empty($comment)){
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    };

    
    $sql = "INSERT INTO `comment`(`member_sid`,`cm_date`,`article_sid`, `comment`) 
            VALUES (?, ?, ?, ?)";
         //↓先準備好一個sql的架構
    try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
            $_POST['member_sid'],
            $_POST['cm_date'],
            $_POST['article_sid'],
            $_POST['comment'],
            ]); 

        if($stmt->rowCount() == 1 ){
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        }else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料新增錯誤';
        };
        }catch(PDOException $ex){
            $result['errorCode'] = 403;
            $result['errorMsg'] = '資料新增失敗';
        };
};


echo json_encode($result, JSON_UNESCAPED_UNICODE);