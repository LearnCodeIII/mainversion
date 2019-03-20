<?php
$upload_dir = __DIR__. '/images/cinema/';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'filename' => '',
    'info' => '',
];

if(empty($_FILES['img'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$filename = $_FILES['img']['name'];

//switch($_FILES['img']['type']){
//    case 'image/jpeg':
//        $filename .= '.jpg';
//        break;
//    case 'image/png':
//        $filename .= '.png';
//        break;
//    default:
//        $result['info'] = '圖片格式不符';
//        echo json_encode($result, JSON_UNESCAPED_UNICODE);
//        exit;
//}
$result['filename'] = $filename;
$upload_file = $upload_dir. $filename;

if(move_uploaded_file($_FILES['img']['tmp_name'], $upload_file)){
    $result['success'] = true;
} else {
    $result['info'] = '暫存檔無法搬移';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);





