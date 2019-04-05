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



if (isset($_POST["checkme"])) {
    $headline = htmlspecialchars($_POST["headline"]);
    $review = htmlspecialchars($_POST['review']);
    $w_date = htmlspecialchars($_POST['w_date']);
    // $w_cinema = htmlspecialchars($_POST['w_cinema']);
    // $film_rate = htmlspecialchars($_POST['film_rate']);

    // // $spoilers = htmlspecialchars($_POST['re_spoilers']);
    // // $fav = htmlspecialchars($_POST['fav']);
    // // $intro_pic = htmlspecialchars($_POST['intro_pic']);
    // // 這串要拿掉，值的屬性不同會判讀有誤

    $result["post"] = $_POST; // 做 echo 檢查

    if (empty($headline) or empty($review) or empty($w_date)) {
        $result["success"] = false;
        $result["errorCode"] = 401;
        $result["errorMsg"] = "請輸入必填欄位";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        // 如果以上有錯就會進入這裡回傳，不會進資料庫
        exit;
    } else {
        $result["success"] = true;
    }

    // 將表單選值轉換1,0

    $spoilers = $_POST["re_spoilers"];
    $film_fav_count = $_POST["film_fav_count"];
    $cinema_push_count = $_POST["cinema_push_count"];
    // var_dump($cinema_push_count);

    if ($spoilers === "true") {
        $spoilers = 1;
    }

    // 判讀關係，POST出來為字串，所以判讀要加上""
    if ($cinema_push_count === "true") {
        $cinema_push_count = true;
    } else {
        $cinema_push_count = false;
    }

    if ($film_fav_count === "true") {
        $film_fav_count = true;
    } else {
        $film_fav_count = false;
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
            $_POST["intro_pic"]
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
