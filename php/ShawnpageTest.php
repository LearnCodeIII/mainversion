<?php
include __DIR__.'/PDO.php';
$groupname = "activity";
$pagename = "ShawnpageMain";

if(isset($_SESSION['admin'])){
    $t_user = $_SESSION['admin'];
    $level = "admin";
}else if(isset($_SESSION['theater'])){
    $theater=$_SESSION['theater'];
    $sql = "SELECT * FROM `cinema` where account = '$theater' ";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row){
        $t_sid = $row['sid'];
        $t_user = preg_replace('/\s(?=)/', '', $row['name']);
        $t_userac = $row['account'];
        $level =  "theater";
    }
}else if(isset($_SESSION['member'])){
    $member=$_SESSION['member'];
    $sql = "SELECT * FROM `cinema` where account = '$member' ";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row){
        $t_sid = $row['sid'];
        $t_user = preg_replace('/\s(?=)/', '', $row['name']);
        $t_img = $row['img'];
        $t_taxID = $row['taxID'];
        $t_phone = $row['phone'];
        $t_address = $row['address'];
        $t_intro = $row['intro'];
        $level =  "member";
    }
}else {
    header("Location: ./login.php");
    exit;
};
?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./sidenav.php'?>
<section class="dashboard">


	
</section>



<?php include __DIR__.'./foot.php'?>