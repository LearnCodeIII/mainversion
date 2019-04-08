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
    $user=$_SESSION['member'];
    $m_sql = "SELECT * FROM `member` where email = '$member' ";
    $m_stmt = $pdo->query($m_sql);
    $m_rows = $lo_stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($m_rows as $m_row){
        $user = $m_row['sid'];
        $user_name = $m_row['name'];
        $user_avatar = $m_row['avatar'];

    
    }
    $level = 2;
}else {
    header("Location: ./login.php");
    exit;
};

?>