<?php
require __DIR__. '/film_crud_session.php';
$page_name='film_data_delete';

require __DIR__.'/PDO.php';

$sid=isset($_GET['sid'])?intval($_GET['sid']):0;

$pdo->query("DELETE FROM `film_primary_table` WHERE `sid`=$sid");

$goto='film_data_list.php';

if(isset($_SERVER['HTTP_REFERer'])){
    $goto=$_SERVER['HTTP_REFERER'];
}

header("Location: $goto");