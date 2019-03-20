<?php
// require __DIR__. '/__cred.php';
require __DIR__. './PDO.php';

header('Content-Type: application/json');



$result = [
    'success' => false,
    'errorCode' => 0,
    "filename" => "",
    "info" => "",
    'errorMsg' => '資料輸入不完整',
    'post' => [], // 做 echo 檢查      
        
];

$_POST['headline']="test";
$_POST['sid']="500";





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
    $intro_pic = $_POST['intro_pic'];
    

  
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


    // 上傳圖案
    $upload_dir =__DIR__. "/../pic/roy/";
    // 先設定好上傳後的路徑，若要放在當下資料夾子資料夾可用DIR
    // 若要放其他資料夾放入完整路徑
    
    if (empty($_FILES['intro_pic'])) {
        $filename ="";
      
        // echo json_encode($result, JSON_UNESCAPED_UNICODE);
        // 可拿掉

        // exit;
        // 避免空了就離開拿掉EXIT
    }
    
    $filename = sha1($_FILES["intro_pic"]["name"] . uniqid());
    // 使轉出來的SHA1為唯一
   
    // 下列為判斷是否有上傳錯誤格式的檔案方式
    switch ($_FILES["intro_pic"]["type"]) {
        case "image/jpeg":
            // 別打成IMG
            $filename .= ".jpg";
            //   接上字串
            break;
            // 要記得下BREAK，否則傳出來的檔案不會是正確JPG格式
        case "image/png":
            $filename .= ".png";
            //   接上字串
            break;
            
        default:
            $result["info"] = "格式不符";
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            // 回傳字樣
            exit;
    
    }
    
    $result["filename"] = $filename;
  
    // 將結果的FILENAME回傳
    $upload_file = $upload_dir . $filename;
    // 回傳後接上連結路徑
    
    
    
    if (move_uploaded_file($_FILES["intro_pic"]["tmp_name"], $upload_file)) {
        // 如果檔案成功移動到UPLOADFILE則回傳TRUE
        $result["success"] = true;
    } else {
        $result["info"] = "資料格式錯誤";
    }



    $sql = "UPDATE `forum` SET 
                `headline`=?,
                `review`=?,
                `w_date`=?,
                `w_cinema`=?,
                `film_rate`=?,
                `fav`=?
                `intro_pic`=?
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
            $filename,
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

