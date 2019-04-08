<?php

if(isset($_SESSION['admin'])){
    $user = $_SESSION['admin'];
    $ad_sql = "SELECT * FROM `admins` where `admin_id` = '$user' ";
    $ad_stmt = $pdo->query($ad_sql);
    $ad_rows = $ad_stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($ad_rows as $ad_row){
        $user = $ad_row['sid'];
        $user_name = $ad_row['admin_id'];
        $user_avatar ='null.jpg';}
    
}else if(isset($_SESSION['member'])){
    $member=$_SESSION['member'];
    $lo_sql = "SELECT * FROM `member` where email = '$member' ";
    $lo_stmt = $pdo->query($lo_sql);
    $lo_rows = $lo_stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($lo_rows as $lo_row){
        $user = $lo_row['sid'];
        $user_name = $lo_row['name'];
        $user_avatar = $lo_row['avatar'];

    
    }
    $level = 2;
}else {
    header("Location: ./login.php");
    exit;
};

?>