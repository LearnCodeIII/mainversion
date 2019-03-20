<?php

require __DIR__.'/PDO.php';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'data' => [],
    ];


$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$sql = "SELECT * FROM article WHERE `sid`=$sid";
// $sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
// $sid = 5;

// $sql = "SELECT * FROM `article` WHERE `sid`=?";
$s_stmt = $pdo->query($sql);

if ($s_stmt->rowCount() == 1) {
    $row = $s_stmt -> fetchAll(PDO::FETCH_ASSOC);
    $result['data'] = $row;
    $result['success'] = true;
};

echo json_encode($result) ;