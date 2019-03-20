<?php
// require __DIR__. '/__crud.php';
// 待設定權限

require __DIR__.'/PDO.php';

$result=[
'success'=>false,
'errorCode'=>0,
'errorMsg'=>'資料輸入不完整',
'post'=>[], //做檢查

];


$sid=isset($_POST['sid']) ? intval($_POST['sid']):0;

if (isset($_POST['name_tw'])and !empty($sid)) {
    //1. 修改資料之前可以先確認該筆資料是否存在
    $name_tw=$_POST['name_tw'];
    $name_en=$_POST['name_en'];
    $intro_tw=$_POST['intro_tw'];
    $intro_en=$_POST['intro_en'];
    $movie_pic=$_POST['movie_genre'];
    $movie_ver=$_POST['movie_ver'];
    $movie_rating=$_POST['movie_rating'];
    $trailer=$_POST['trailer'];
    $pirce=$_POST['pirce'];
    $schedule=$_POST['schedule'];
    $in_theaters=$_POST['in_theaters'];
    $out_theaters=$_POST['out_theaters'];
    $runtime=$_POST['runtime'];
    $director_tw=$_POST['director_tw'];
    $director_en=$_POST['director_en'];
    $country=$_POST['country'];
    $subtitle=$_POST['subtitle'];
    $subtitle_lang=$_POST['subtitle_lang'];
    $result['post']=$_POST;  //做檢查



    // 上傳圖片相關
    $upload_dir = __DIR__. '/../pic/film_upload/';
    // 如果沒有檔案 給一個nopic檔
    if (empty($_FILES['movie_pic']['name'])) {
        $filename="nopic.jpg";
    } else {
        $filename = sha1($_FILES['movie_pic']['name']. uniqid());

        switch ($_FILES['movie_pic']['type']) {
    case 'image/jpeg':
        $filename .= '.jpg';
        break;
    case 'image/png':
        $filename .= '.png';
        break;
    default:
        $result['info']='格式不符';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
        }
    }
    $result['movie_pic']=$filename;
    $upload_file=$upload_dir.$filename;

    if (move_uploaded_file($_FILES['movie_pic']['tmp_name'], $upload_file)) {
        $result['success']=true;
    } else {
        $result['info']='暫存檔無法搬移';
    }





    // 1. 修改資料之前可以先確認該筆資料是否存在
    // 2. 電影名稱 有沒有跟別筆的資料相同

    $s_sql="SELECT * FROM `film_primary_table` WHERE `sid`=?";
    $s_stmt=$pdo->prepare($s_sql);
    $s_stmt->execute([$sid]);

    switch ($s_stmt->rowCount()) {
            case 0:
            $result['errorCode']=410;
            $result['errorMsg']='該筆資料不存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
            //    break;
            
            case 1:
            $row=$s_stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['sid']!=$sid) {
                $result['errorCode']=430;
                $result['errorMsg']='該筆資料不存在';
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                exit;
            }
        }


    $sql = "UPDATE `film_primary_table` SET 
        `name_tw`=?,
        `name_en`=?,
        `intro_tw`=?,
        `intro_en`=?,
        `movie_pic`=?,

        `movie_genre`=?,
        `movie_ver`=?,
        `movie_rating`=?,
        `trailer`=?,
        `pirce`=?,

        `schedule`=?,
        `in_theaters`=?,
        `out_theaters`=?,
        `runtime`=?,
        `director_tw`=?,

        `director_en`=?,
        `country`=?,
        `subtitle`=?,
        `subtitle_lang`=?
        WHERE `sid`=?
        ";



    try {
        $stamt = $pdo->prepare($sql);

        $stamt->execute([
                $_POST['name_tw'],
                $_POST['name_en'],
                $_POST['intro_tw'],
                $_POST['intro_en'],
                $filename,

                $_POST['movie_genre'],
                $_POST['movie_ver'],
                $_POST['movie_rating'],
                $_POST['trailer'],
                $_POST['pirce'],

                $_POST['schedule'],
                $_POST['in_theaters'],
                $_POST['out_theaters'],
                $_POST['runtime'],
                $_POST['director_tw'],

                $_POST['director_en'],
                $_POST['country'],
                $_POST['subtitle'],
                $_POST['subtitle_lang'],
                $sid
        ]);

        if ($stamt->rowCount()==1) {
            $result['success'] =true;
            $result['errorCode'] =200;
            $result['errorMsg'] ='';
        } else {
            $result['errorCode'] =402;
            $result['errorMsg'] ='資料沒有修改';
        }
    } catch (PDOException $ex) {
        $result['errorCode'] =403;
        $result['error'] = $ex->getMessage();
        $result['errorMsg'] ='資料更新發生錯誤';
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
