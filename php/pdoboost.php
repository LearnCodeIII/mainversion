<?php
#頁面名稱
$pagename = "pageMain";
include __DIR__.'/PDO.php';


// #每頁筆數
// $per_page = 4;

// #設定當前頁數
// $page = isset($_GET['page'])? intval($_GET['page']):1;

// #算總筆數
// $t_sql = "SELECT COUNT(1) FROM activity";
// $t_stmt = $pdo->query($t_sql);
// $total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

// #總頁數
// $total_pages = ceil($total_rows/$per_page);
// if($page<1)$page=1;
// if($page>$total_pages)$page=$total_pages;

// #顯示資料
// $sql = sprintf("SELECT * FROM `activity` LIMIT %s, %s",($page-1)*$per_page,$per_page);
// $stmt = $pdo->query($sql);
// $rows = $stmt->fetchALL(PDO::FETCH_ASSOC);

?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./nav.php'?>
<?php include __DIR__.'./film_sidenav.php'?>


<!-- <section class="dashboard">

</section> -->
<?php include __DIR__.'./foot.php'?>