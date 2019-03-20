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





if (isset($_POST['checkme'])) {
    $name = $_POST['name'];
    $email =  $_POST['email'];
    $mobile =  $_POST['mobile'];
    $pwd =  $_POST['pwd'];
    $fav = isset($_POST['chk'])? implode(',', $_POST['chk']):NULL;


    if(empty($_FILES['avatar']['name'])){
        $filename = 'null.jpg';
        $result['filename'] = $filename;
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

     
    



    // if(!empty($_FILES['avatar'])){
    //         $filename = sha1($_FILES['avatar']['name'].uniqid());
    //         switch($_FILES['avatar']['type']){
    //             case 'image/jpeg':
    //                 $filename .= '.jpg';
    //                 break;
    //             case 'image/png':
    //                 $filename .= '.png';
    //                 break;
    //             default:
    //                 $result['file_info']='檔案格式不符!';
    //                 echo json_encode($result, JSON_UNESCAPED_UNICODE);
    //                 exit;
    //         }
    //     $result['filename'] = $filename;
        
    //     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_dir.$filename)){
    //         $result['file_success'] = true;
    //         $result['file_info']='檔案上傳成功!';
    //     }else{
    //         $result['file_info'] = '暫存檔搬移失敗!';
    //         exit;
    //     }
    //     }

    
    








    $result['post'] = $_POST;//做回應檢查


    //若其中一格為空值，錯誤碼=400，回傳結果陣列，並停止程式
    if (empty($name) or empty($email) or empty($mobile) or empty($pwd)) {
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
    //TODO:檢查name長度

    //檢查email格式
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {//php的email驗證
        $result['errorCode'] = 405;
        $result['errorMsg'] = 'Email格式錯誤!';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
    //檢查格式也可用preg_match(正規表示法檢查)
    // // The "i" after the pattern delimiter indicates a case-insensitive search
    // if (preg_match("/php/i", "PHP is the web scripting language of choice.")) {
    //     echo "A match was found.";
    // } else {
    //     echo "A match was not found.";
    // }






    //TODO:檢查mobile格式


    $sql = "INSERT INTO `member`(`name`, `nickname`, `gender`, `age`, `birthday`, `email`, `mobile`, `fav_type`,`avatar`,`pwd`,`permission`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
  
    try {
        // $pdo->beginTransaction();
        $stmt = $pdo->prepare($sql);//先準備一個statement物件(function)
        $stmt->execute([//執行塞值的動作
        $_POST['name'],
        $_POST['nickname'],
        $_POST['gender'],
        $_POST['age'],
        $_POST['birthday'],
        $_POST['email'],
        $_POST['mobile'],
        $fav,
        $filename,
        SHA1($_POST['pwd']),
        $_POST['permission'],
    ]);


        if ($stmt->rowCount()==1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料輸入錯誤!';
        };
        // $pdo->commit();
    } catch (PDOException $ex) {//需先設定PDO錯誤模式，才會顯示此內容(該設定在__connect_db.php)
        $result['errorCode'] = 403;
        $result['errorMsg'] = 'Email重複輸入!';
        // $pdo->rollback();
    };

};


echo json_encode($result, JSON_UNESCAPED_UNICODE);



