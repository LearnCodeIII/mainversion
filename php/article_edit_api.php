<?php 
require __DIR__.'/PDO.php';
$upload_dir = __DIR__.'/../pic/';

// ↓ 輸出的內容格式 = json
header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' =>0,
    'errorMsg' =>'資料不完整',
    'post' =>[],
];

$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;

if (isset($_POST['title'])and !empty($sid)){
    
    $title = $_POST['title'];
    $author = $_POST['author'];
    $avatar = $_POST['avatar'];
    $date = $_POST['date'];
    $content = $_POST['content'];
    // $image = $_POST['image'];
    $link = $_POST['link'];
    $result['post'] = $_POST;
    
    if(empty($_FILES['image']['name'])){
    $filename = $_POST['ori_img'];
    }else{  
    $filename = $_FILES['image']['name'];}
    
    
    // switch($_FILES['image']['type']){
    //     case 'image/jpeg':
    //         $filename .= '.jpg';
    //         break;
    //     case 'image/png':
    //         $filename .= '.png';
    //         break;
    //     default:
    //         $result['info'] = '格式不符';
    //         echo json_encode($result, JSON_UNESCAPED_UNICODE);
    //         exit;
    // }

    $result['image'] = $filename;
    $upload_file = $upload_dir.$filename;
    
    if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)){
        $result['success'] = true;
    } else {
        $result['info'] = '暫存檔無法搬移';
    }
    
    //如果 這些 變數的欄位 是空的  就回傳 result錯誤代碼400的json格式 並停止
    if(empty($title) or empty($author) or empty($content)){
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    };

    $s_sql = "SELECT * FROM `article` WHERE `sid`=?";
    $s_stmt = $pdo->prepare($s_sql);
    $s_stmt -> execute([$sid]);

    switch($s_stmt->rowCount()){
        //　情況是 s_stmt抓到的資料是0筆
        case 0: 
        $result['errorCode'] = 410;
        $result['errorMsg'] = '該筆資料不存在';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
        // 情況是 s_stmt抓到2筆資料
        case 2:
        $result['errorCode'] = 420;
        $result['errorMsg'] = 'email資料重複';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
        
        case 1:
        $row = $s_stmt->fetch(PDO::FETCH_ASSOC);
        if($row['sid']!=$sid){
            $result['errorCode'] = 430;
            $result['errorMsg'] = '該筆資料不存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;}
    };
    
            $sql = "UPDATE `article` SET
            `title`=?,
            `author`=?,
            `avatar`=?,
            `date`=?,
            `content`=?, 
            `image`=?,
            `link`=? 
            WHERE `sid`=?";
         //↓先準備好一個sql的架構
    try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
            $_POST['title'],
            $_POST['author'],
            $_POST['avatar'],
            $_POST['date'],
            $_POST['content'],
            $filename,
            $_POST['link'],
            $sid
            ]); 

        if($stmt->rowCount() == 1 ){
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        }else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料新增錯誤';
        };
        //要看connect db 設定的錯誤屬性  484=exception J個部分$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $ex){
            $result['errorCode'] = 403;
            $result['errorMsg'] = '資料新增失敗';
        };
};


echo json_encode($result, JSON_UNESCAPED_UNICODE);