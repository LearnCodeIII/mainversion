<?php
require __DIR__.'/PDO.php';

//建立一個陣列，準備用來儲存結果
$result = [
        'success' => false,
        'data' => [],
        'errorCode' => 0,
        'errorMsg' => '',
];
    
    //取得資料
        $sql="SELECT * FROM `permission` ORDER BY `sid`";
        $stmt = $pdo->query($sql);
        $result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);//將計算結果加入result陣列
        $result['success'] = true;//將計算結果加入result陣列


//回傳至頁面(以json字串形式)
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>