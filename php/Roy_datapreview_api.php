<?php

include __DIR__."./PDO.php";

    
    $result =[
        "success" => false,
        "data" => 0,
        "errorCode" =>0,
        // 除錯用
        "errorMsg" =>""
    ];

    $sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

    $sql = "SELECT * FROM `forum` WHERE `sid` = $sid";

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchall(PDO::FETCH_ASSOC);

    $result["data"] = $rows;
    $result['success'] = true;
    echo json_encode($result, JSON_UNESCAPED_UNICODE);


?>



