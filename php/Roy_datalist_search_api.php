<?php

include __DIR__."./PDO.php";
    $per_page = 10;
    // 設定每頁要幾筆
    // 順序要在RESULT之前，不然PERPAGE抓取會有問題
    
    $result =[
        "success" => false,
        "tRows" => 0,
        "page" => 0,
        "totalPages" =>0,
        "perPage" => $per_page,
        "data" => [],
        // 設定一空陣列到時候可以倒進去
        "errorCode" =>0,
        // 除錯用
        "errorMsg" =>""
    ];

    $t_stmt = "SELECT COUNT(1) FROM forum";
    // 先抓到值總共筆數
    $t_count = $pdo->query($t_stmt);
    $t_rows = $t_count->fetch(PDO::FETCH_NUM)[0];
    $result["tRows"] =  $t_rows;


    $page = isset($_GET["page"]) ? intval($_GET["page"]): 1;
    // 如果有選業就選定當頁，否則選第一頁

  

    // 總頁數
    $totalPages = ceil($t_rows/$per_page);
    // 總頁數為總比數/單頁筆數
    $result["totalPages"] = $totalPages;


    if ($page<1) {
        $page = 1;
    }
    // 如果頁數小於1則顯示第一頁
    if ($page>$totalPages) {
        $page = $totalPages;
    }
    // 如果頁數大於總頁數則顯示最後一頁
    $result["page"] = $page;

    $sql = sprintf("SELECT * FROM `forum` ORDER BY sid DESC LIMIT %s,%s", ($page-1)*$per_page, $per_page);
    // 因為有%S所以用SPRINF，第一個帶入圍總
    $stmt = $pdo->query($sql);


    // $stmt = $pdo->query("SELECT * FROM `address_book` ORDER BY sid DESC");
    // 將QUREY的東西用STMT的容器裝


    $rows = $stmt->fetchall(PDO::FETCH_ASSOC);
    // 將所有抓出的資料倒進ROWS
    $result["data"] = $rows;
    $result['success'] = true;

    $pagename = "datalist";
    // 隨意設定一名稱，讓NAV可以用三元運算來設定規則

    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>



