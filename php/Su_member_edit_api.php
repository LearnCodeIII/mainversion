<?php
require __DIR__.'/PDO.php';
header('Content-type:application/json');//設定資料回傳格式為json
$upload_dir = __DIR__.'/../pic/avatar/';

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [],//做回應檢查
    'filename' => '',
    'file_info' => '',
    'file_success' => false
];



$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0 ;

if (isset($_POST['checkme']) and !empty($sid)) {
    // $name = $_POST['name'];
    $email =  $_POST['email'];
    $mobile =  $_POST['mobile'];
    // $pwd =  $_POST['pwd'];
    $fav = isset($_POST['chk'])? implode(',', $_POST['chk']):NULL;


    if(empty($_FILES['avatar']['name'])){
        $filename = $_POST['ori_pic'];
    }else{
        $filename = sha1($_FILES['avatar']['name'].uniqid());
        switch($_FILES['avatar']['type']){
            case 'image/jpeg':
                $filename .= '.jpg';
                break;
            case 'image/png':
                $filename .= '.png';
                break;
            default:
                $result['file_info']='檔案格式不符!';
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                exit;
        }
        $result['filename'] = $filename;
    
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_dir.$filename)){
            $result['file_success'] = true;
            $result['file_info']='檔案上傳成功!';
        }else{
            $result['file_info'] = '暫存檔搬移失敗!';
        exit;
        }   
    }


    $result['post'] = $_POST;//做回應檢查


    //若其中一格為空值，錯誤碼=400，回傳結果陣列，並停止程式
    if (empty($email) or empty($mobile)) {
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }


    //檢查email格式
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {//php的email驗證
        $result['errorCode'] = 405;
        $result['errorMsg'] = 'Email格式錯誤!';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    //TODO:檢查name長度
    //TODO:檢查mobile格式


    //1. 修改資料之前先確認該筆資料是否存在
    //2. Email是否與其他筆資料的重複
    $s_sql = "SELECT * FROM `member` WHERE `sid`=? OR `email`=?";
    $s_stmt = $pdo->prepare($s_sql);
    $s_stmt->execute([$sid,$_POST['email']]);

    switch ($s_stmt->rowCount()) {
        case 0:
            $result['errorCode'] = 410;
            $result['errorMsg'] = '該筆資料不存在!';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        case 2:
            $result['errorCode'] = 420;
            $result['errorMsg'] = 'Email已存在!';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        case 1:
        $row = $s_stmt->fetch(PDO::FETCH_ASSOC);
        if($row['sid']!=$sid){
            $result['errorCode'] = 430;
            $result['errorMsg'] = '該筆資料不存在!';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }




    $sql = "UPDATE `member` SET 
            `nickname`=?,
            `gender`=?,
            `age`=?,
            `birthday`=?,
            `email`=?,
            `mobile`=?,
            `fav_type`=?,
            `avatar`=?,
            -- `pwd`=?,
            `permission`=?
            WHERE `sid`=?";

    try {
        $stmt = $pdo->prepare($sql);//先準備一個statement物件(function)
    $stmt->execute([//執行塞值的動作
        $_POST['nickname'],
        $_POST['gender'],
        $_POST['age'],
        $_POST['birthday'],
        $_POST['email'],
        $_POST['mobile'],
        $fav,
        $filename,
        // SHA1($_POST['pwd']),
        $_POST['permission'],
        $sid
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
        $result['errorMsg'] = 'Email重複輸入!';
    };
};

echo json_encode($result, JSON_UNESCAPED_UNICODE);
