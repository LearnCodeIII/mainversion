<?php

include __DIR__."./PDO.php";
    $per_page = 500;
    // 設定每頁要幾筆
    // 順序要在RESULT之前，不然PERPAGE抓取會有問題
    
    $result =[
        "success" => false,
        "tRows" => 0,
        "page" => 0,
        "totalPages" =>0,
        "perPage" => $per_page,
        "data" => [],//倒所有論壇文章陣列
        "c_data"=>[],//倒戲院名稱陣列
        "f_data"=>[],//倒電影名稱陣列
        "m_data"=>[],//倒會員名稱陣列
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

    
    //撈取戲院資訊串給INSERT戲院下拉選單
    $member_sql = "SELECT `sid`, `name`,`avatar`,`email` FROM `member` ";
    $member_stmt = $pdo->query($member_sql);
    $member_row = $member_stmt->fetchAll(PDO::FETCH_ASSOC);
    $result["m_data"] =  $member_row;

    //撈取戲院資訊串給INSERT戲院下拉選單
    $cinema_sql = "SELECT `sid`, `name`,`img` FROM `cinema` ";
    $cinema_stmt = $pdo->query($cinema_sql);
    $cinema_row = $cinema_stmt->fetchAll(PDO::FETCH_ASSOC);
    $result["c_data"] =  $cinema_row;
    
    //撈取戲院資訊串給INSERT戲院下拉選單
    $film_sql = "SELECT `sid`, `name_tw`, `movie_pic` FROM `film_primary_table` ";
    $film_stmt = $pdo->query($film_sql);
    $film_row = $film_stmt->fetchAll(PDO::FETCH_ASSOC);
    $result["f_data"] =  $film_row;


    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>