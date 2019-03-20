<?php

$upload_dir =__DIR__. "/../pic/roy/";
// 先設定好上傳後的路徑，若要放在當下資料夾子資料夾可用DIR
// 若要放其他資料夾放入完整路徑

header('Content-Type: application/json');

$result = [
    "success" => false,
    "filename" => "",
    "info" => "",

];

if (empty($_FILES['intro_pic'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
    // 如果上傳的檔案是空的就離開
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

echo json_encode($result, JSON_UNESCAPED_UNICODE);
// 將回傳的資料轉乘JSON傳出