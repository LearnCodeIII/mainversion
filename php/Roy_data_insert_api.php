<?php
include __DIR__ . "./PDO.php";

header('Content-Type: application/json');

$result = [
    "success" => false,
    "errorCode" => 0,
    "filename" => "",
    "info" => "",
    "errorMsg" => "資料輸入不完整",
    "post" => [],
];

// 將轉碼寫在IF外面

$upload_dir = __DIR__ . '/../pic/forum/';
// 先設定好上傳後的路徑，若要放在當下資料夾子資料夾可用DIR
// 若要放其他資料夾放入完整路徑

if (empty($_FILES['intro_pic'])) {
    $filename = "";

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

if (isset($_POST["checkme"])) {
    $headline = htmlspecialchars($_POST["headline"]);
    $review = htmlspecialchars($_POST['review']);
    $w_date = htmlspecialchars($_POST['w_date']);
    $w_cinema = htmlspecialchars($_POST['w_cinema']);
    $film_rate = htmlspecialchars($_POST['film_rate']);
    // $spoilers = htmlspecialchars($_POST['re_spoilers']);
    // $fav = htmlspecialchars($_POST['fav']);
    // $intro_pic = htmlspecialchars($_POST['intro_pic']);
    // 這串要拿掉，值的屬性不同會判讀有誤

    $result["post"] = $_POST; // 做 echo 檢查

    if (empty($headline) or empty($review) or empty($w_date)) {
        $result["success"] = false;
        $result["errorCode"] = 401;
        $result["errorMsg"] = "請輸入必填欄位";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        // 如果以上有錯就會進入這裡回傳，不會進資料庫
        exit;
    }else{
        $result["success"] = true;
    }

    // 將表單選值轉換1,0

    $spoilers = $_POST["re_spoilers"];
    $film_fav_count = $_POST["film_fav_count"];
    $cinema_push_count = $_POST["cinema_push_count"];

    if ($spoilers === "是") {
        $spoilers = 1;
    }
    if ($film_fav_count === "是") {
        $film_fav_count = 1;
    }
    if ($cinema_push_count === "是") {
        $cinema_push_count = 1;
    }

    $sql = "INSERT INTO `forum`(`w_film`, `re_spoilers`, `film_rate`, `film_fav_count`, `issuer`, `headline`, `review`, `w_date`, `w_cinema`, `cinema_rate`, `cinema_comment`, `cinema_push_count`, `intro_pic`)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    // 不用SPRINTF寫法

// TRY CATCH偵錯，假設輸入錯誤EMAIL會顯示提醒EMAIL錯誤
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            // 執行下列矩陣
            $_POST["w_film"],
            $spoilers,
            $_POST["film_rate"],
            $film_fav_count,
            $_POST["issuer"],
            htmlentities($_POST["headline"]),
            htmlentities($_POST["review"]),
            $_POST["w_date"],
            $_POST["w_cinema"],
            $_POST["cinema_rate"],
            htmlentities($_POST["cinema_comment"]),
            $cinema_push_count,
            $filename,
            // 將操作的使用者同時記錄上傳
        ]);

        if ($stmt->rowCount() == 1) {
            $result["success"] = true;
            $result["errorCode"] = 200;
            $result["errorMsg"] = "";

        } else {
            $result["errorCode"] = 402;
            $result["errorMsg"] = "新增資料錯誤";
        }
    } catch (PDOException $ex) {
        $result["errorCode"] = 403;
        $result["errorMsg"] = "email重複輸入";
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
