<?php
include __DIR__."./PDO.php";

header('Content-Type: application/json');

$result = [
    "success" => false,
    "errorCode" => 0,
    "errorMsg" => "資料輸入不完整",
    "post" => []
];

if (isset($_POST["checkme"])) {

    $name = $_POST["name"];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];

    $result["post"] = $_POST; // 做 echo 檢查

    if (empty($name) or empty($email) or empty($mobile)){
   
            $result["errorCode"] = 403;
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            // 如果以上有錯就會進入這裡回傳，不會進資料庫
        exit;
    }

    //TODO:檢查EMAIL長度
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result["errorCode"] = 403;
        $result["errormgs"] = "EMAIL輸入錯";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        // 如果以上有錯就會進入這裡回傳，不會進資料庫
    exit;
    }

    $sql = "INSERT INTO `address_book`(`name`, `email`, `mobile`, `birthday`, `address`) VALUES (
            ?, ?, ?, ?, ?)";
    // 不用SPRINTF寫法

// TRY CATCH偵錯，假設輸入錯誤EMAIL會顯示提醒EMAIL錯誤
try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
            // 執行下列矩陣
        $_POST["name"],
        $_POST["email"],
        $_POST["mobile"],
        $_POST["birthday"],
        $_POST["address"],

        ]);

    if ($stmt->rowCount()==1) {
        $result["success"] = true;
        $result["errorCode"] = 200;
        $result["errormsg"] = "";
          
   
    } else {

            $result["errorCode"] = 402;
            $result["errormsg"] = "輸入錯誤";
   
    } ;
}catch(PDOException $ex ){

        $result["errorCode"] = 403;
        $result["errormsg"] = "email輸入錯誤";

}

}

echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>
