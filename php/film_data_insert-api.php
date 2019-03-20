<?php
// require __DIR__. '/__cred.php';
//待確認權限

require __DIR__.'/PDO.php';

header('Content-Type:application/json');

$result=[
'success'=>false,
'errorCode'=>0,
'errorMsg'=>'資料輸入失敗',
'post'=>[], //做檢查

];


if (isset($_POST['checkme'])) {
    $name_tw=$_POST['name_tw'];
    $name_en=$_POST['name_en'];
    $intro_tw=$_POST['intro_tw'];
    $intro_en=$_POST['intro_en'];
    $movie_pic=$_POST['movie_pic'];
    $movie_genre=$_POST['movie_genre'];
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


    // if (empty($name_tw)or empty($movie_pic)) {
    //     $result['errorCode']=400;
    //     $result['errorMsg'] ='一定要有名字和圖片喔';
    //     // echo json_encode($result, JSON_UNESCAPED_UNICODE);
    //     exit;
    // }



    $upload_dir = __DIR__. '/../pic/film_upload/';
//     //如果沒有檔案 回傳json並離開
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
    $result['filename']=$filename;
    $upload_file=$upload_dir.$filename;

    if (move_uploaded_file($_FILES['movie_pic']['tmp_name'], $upload_file)) {
        $result['success']=true;
    } else {
        $result['info']='暫存檔無法搬移';
    }

    
       
    

    $sql = "INSERT INTO `film_primary_table` (
        `name_tw`,
        `name_en`,
        `intro_tw`,
        `intro_en`,
        `movie_pic`,
        `movie_genre`,
        `movie_ver`,
        `movie_rating`,
        `trailer`,
        `pirce`,
        `schedule`,
        `in_theaters`,
        `out_theaters`,
        `runtime`,
        `director_tw`,
        `director_en`,
        `country`,
        `subtitle`,
        `subtitle_lang`) VALUES (
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
            ,?
            )";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
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
                $_POST['subtitle_lang']
            ]);



        if ($stmt->rowCount()==1) {
            $result['success'] =true;
            $result['errorCode'] =200;
            $result['errorMsg'] ='';
        } else {
            $result['errorCode'] =402;
            $result['errorMsg'] ='資料新增錯誤';
        }
    } catch (PDOException $ex) {
        $result['errorCode'] =403;
        $result['error'] = $ex->getMessage();
        $result['errorMsg'] ='data重複輸入';
    }
}


echo json_encode($result, JSON_UNESCAPED_UNICODE);
