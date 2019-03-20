<?php
exit;  
//要用時把上面exit註解掉後再跑

require __DIR__.'/PDO.php';

$begin=microtime(true);
echo $begin.'<br>';

$sql = "INSERT INTO `film_primary_table` (
    `name_tw`,
    `name_en`,
    `intro_tw`,
    `intro_en`,
    `movie_pic`,
    `movie_genre`,
    `movie_ver`,
    `movie_rating`,
    `trailer`,
    `pirce`,
    `schedule`,
    `in_theaters`,
    `out_theaters`,
    `runtime`,
    `director_tw`,
    `director_en`,
    `country`,
    `subtitle`,
    `subtitle_lang`) VALUES (
        ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?, ? , ?, ? 
            )";


$stamt = $pdo->prepare($sql);


    // 開始 Transaction
$pdo->beginTransaction();

for ($i=1;$i<100;$i++) {
    $stamt->execute(
        [
            "好看電影$i",
            "Good Moive $i",
            "反正就是超好看的拉$i",
            "is good to see ? $i",
            "aaaa{$i}.jpg",
            "科幻片 $i",
            "4DX",
            "限制級 $i",
            "預告片 $i",
            "$i",
            "元宵節 $i",
            "2019-03-19",
            "2019-06-06",
            "$i",
            "王 $i",
            "Wang $i",
            "台灣 $i",
            "有 $i",
            "中文 $i",

        ]
    );
}

    // 提交 Transaction
$pdo->commit();

$end=microtime(true);
echo $end.'<br>';
echo $end-$begin.'<br>';