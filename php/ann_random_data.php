<?php
// exit;
require __DIR__. '/PDO.php';

$begin = microtime(true);
echo $begin. '<br />';

    $sql = "INSERT INTO `ad`(
            `client_name`, `client_number`, `client_address`, `client_poc`, `client_mobile`, `client_email`, `contract_budget`, `contract_start_date`, `contract_end_date`, `ad_name`, `ad_pic`, `ad_link`, `ad_link_count`, `ad_start_time`, `ad_end_time`
            ) VALUES (
              ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )";

    $stmt = $pdo->prepare($sql);

    $pdo->beginTransaction();

    for($i=1; $i<50; $i++) {
        $stmt->execute([
            "TATA Ltd. $i",
            "0$i",
            "Earth$i",
            "Ms. $i",
            "0986$i",
            "Test{$i}@tcs.com",
            "TWD$i",
            "2020-01-01",
            "2050-01-01",
            "Fun$i",
            "Pic$i",
            "Link$i",
            "Count$i",
            "2020-01-01",
            "2050-01-01",
        ]);
    }

    $pdo->commit();

$end = microtime(true);
echo $end. '<br>';
echo $end-$begin. '<br>';