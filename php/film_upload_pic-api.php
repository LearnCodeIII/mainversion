<?php

$upload_dir = __DIR__. '../film_upload/';
//可以設定其他路徑 類似改存到  $upload_dir=C:/Users/student/Desktop/photoshop/file/
//但是\要改成/


header('Content-Type: application/json');


$result = [
    'success' => false,
    'filename' => '',
    'info' => '',
];


//如果沒有檔案 回傳json並離開
if(empty($_FILES['movie_pic'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

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
        echo json_encode($result,JSON_UNESCAPED_UNICODE);          
        exit;
}

$result['filename']=$filename;
$upload_file=$upload_dir.$filename;

if(move_uploaded_file($_FILES['movie_pic']['tmp_name'], $upload_file)){
    $result['success']=true;
}else {
    $result['info']='暫存檔無法搬移';

}
echo json_encode($result, JSON_UNESCAPED_UNICODE);



