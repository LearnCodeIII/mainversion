<?php
include __DIR__ . "./PDO.php";

$start = microtime(true);
echo $start;
echo "<br>";

$sql = "INSERT INTO `forum`(
            `headline`, `review`, `i_date`, `w_date`, `w_cinema`, `film_rate`, `fav`
            ) VALUES (
              ?, ?, ?, ?, ?, ?, ?
            )";

$stmt = $pdo->prepare($sql);

$pdo->beginTransaction();
// 開始TRANSACTION，用這種方式處理資料會較快，括號內不用輸入值
for ($i = 1; $i < 30; $i++) {
    $r_m = rand(1,12);
    $r_d = rand(1,31);
    $r_r = rand(1,5);
    $r_f = rand(0,1);
    $stmt->execute([
        "{$i}驚奇隊長》Captain Marvel - 還有人在乎宇宙魔方嗎？",
        // "「漫威電影宇宙」（Marvel Cinematic Universe, MCU）第{$i}部作品，第1部女性英雄為主角的作品，承接《復仇者聯盟：無限之戰》煙滅事件後的新英雄角色、《復仇者聯盟：終局之戰》的關鍵人物，《驚奇隊長》在MCU中存在著多重意義，相信進場觀賞的觀眾期待也有所不同。就整體來說，《驚奇隊長》在MCU第三階段收尾前夕，突來一筆述說了一個英雄起源故事，讓這個已經琳琅滿目的複雜宇宙觀中，又更複雜了。",
        "「漫威電影宇宙」",
        "2019-$r_m-$r_d",
        "2019-$r_m-$r_d",
        "電影院$i",
        "$r_r",
        "$r_f"
    ]);
}
$pdo->commit();
// 結束TRANSACTION

// 以下為想偵測資料處理總共耗時
$end = microtime(true);
// 括號內用BOOLEAN值
echo $end;
echo "<br>";
$duration = $end - $start;
echo $duration;