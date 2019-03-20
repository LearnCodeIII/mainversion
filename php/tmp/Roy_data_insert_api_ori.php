<?php
include __DIR__ . "./PDO.php";

header('Content-Type: application/json');

$result = [
    "success" => false,
    "errorCode" => 0,
    "errorMsg" => "資料輸入不完整",
    "post" => [],
];

if (isset($_POST["checkme"])) {
    $headline = htmlspecialchars($_POST["headline"]);
    $review = htmlspecialchars($_POST['review']);
    $w_date = htmlspecialchars($_POST['w_date']);
    $w_cinema = htmlspecialchars($_POST['w_cinema']);
    $film_rate = htmlspecialchars($_POST['film_rate']);
    $fav = htmlspecialchars($_POST['fav']);

    $result["post"] = $_POST; // 做 echo 檢查

    if (empty($headline) or empty($review) or empty($w_date)) {
        $result["errorCode"] = 401;
        $result["errorMsg"] = "請輸入必填欄位";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        // 如果以上有錯就會進入這裡回傳，不會進資料庫
        exit;
    }

    $sql = "INSERT INTO `forum`(`headline`, `review`, `w_date`, `w_cinema`, `film_rate`, `fav`)
             VALUES (?, ?, ?, ?, ?, ?)";
    // 不用SPRINTF寫法


// TRY CATCH偵錯，假設輸入錯誤EMAIL會顯示提醒EMAIL錯誤
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            // 執行下列矩陣
            $_POST["headline"],
            $_POST["review"],
            $_POST["w_date"],
            $_POST["w_cinema"],
            $_POST["film_rate"],
            $_POST["fav"],
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
