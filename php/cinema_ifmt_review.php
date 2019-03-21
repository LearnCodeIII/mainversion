<?php include __DIR__. './PDO.php'?>
<?php
$groupname = 'theater';
$sid = $_GET['sid'];
$sql = "SELECT * FROM cinema where sid='{$sid}'";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row){
    $name = $row['name'];
    $img = '../pic/cinema/'.$row['img'];
    $taxID = $row['taxID'];
    $phone = $row['phone'];
    $address = $row['address'];
    $intro = $row['intro'];
}



//----------------------撈活動資料
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//ad
$per_page = 5;
// 算總筆數
try{
    $t_sql = sprintf("SELECT COUNT(1) FROM `activity` JOIN `ad` ON `activity`.`company`='$name'  OR `ad`.`client_name`='$name'");
    $t_stmt = $pdo->query($t_sql);
    $total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

    if($total_rows > $per_page){
        $per_page = 5;
    } else {
        $per_page = $total_rows;
    }
// 總頁數
    if($page < 1) $page = 1;
    $sql = sprintf("SELECT `activity`.`sid`, `activity`.`name` , `ad`.`contract_start_date` , `ad`.`contract_end_date`,`ad`.`ad_name` FROM `activity` JOIN `ad` ON `activity`.`company`='$name'  OR `ad`.`client_name`='$name'  LIMIT 0,%s", $per_page);
    $stmt = $pdo->query($sql);

// 所有資料一次拿出來
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $ad_row = $rows;
    $ac_row = $rows;
    $ad_rows = isset($ad_row) ? $ad_row : '';
    $ac_rows = isset($ac_row) ? $ac_row : '';


    foreach($ad_rows as $row ) {
        $contract_start_date = $row['contract_start_date'];
        $contract_end_date = $row['contract_end_date'];
        $ad_name = $row['ad_name'];
    }

    foreach($ac_rows as $row){
        $ac_name = $row['name'];
        $ac_sid = $row['sid'];
    }
}catch(PDOException $ex){
    $miss_msg = '無相關資料';
}





?>
<?php include __DIR__. './head.php' ?>
    <style>
        p{
            width: 75%;
        }
        label{
            width: 20%;
            height: 30px;
            font-size: 19px;
            font-weight: bolder;
        }
        #review_img{
            background: url("<?= $img ?>");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
        .ad ,.ac{
            font-size: 30px;
            color: #fff;
        }


    </style>
    <section class="dashboard">
        <section class="d-flex">

            <!--    左側資料-->

            <div class="overflow-hidden shadow-sm" style="width: 45%;background-color: white;border-radius: 30px;">

                <!--    圖像-->
                <div class="overflow-hidden" style="width:110%;height: 400px;object-fit:cover" >
                    <div id="review_img" class="w-100 h-100"></div>
                </div>

                <!--    內容-->
                <div class="px-5 pt-3 pb-3">
                    <h2 id="name" class="font-weight-bolder text-black pb-3" style="font-size: 50px"><?= $name ?></h2>

                    <div class="d-flex align-items-center">
                        <label for="#sid">會員編號</label>
                        <p contenteditable = "true" id="taxid" class="text-secondary"><?= $sid ?></p>
                    </div>

                    <div class=" d-flex align-items-center">
                        <label for="#taxid">統一編號:</label>
                        <p contenteditable = "true" id="taxid" class="text-secondary"><?= $taxID ?></p>
                    </div>

                    <div class="d-flex align-items-center">
                        <label for="#phone">連絡電話:</label>
                        <p contenteditable = "true" id="phone" class="text-secondary"><?= $phone ?></p>
                    </div>

                    <div class="d-flex align-items-center">
                        <label for="#address">地址:</label>
                        <p contenteditable = "true" id="address" class="text-secondary"><?= $address ?></p>
                    </div>

                    <div class="d-flex align-items-center">
                        <label for="#intro">簡介:</label>
                        <p contenteditable = "true" id="intro" class="text-secondary"><?= $intro ?></p>
                   </div>
                </div>
            </div>

            <!--        右邊連結-->
            <div class="ml-5" style="width: 45%;border-radius: 30px;">

                <!--                上方廣告-->
                <div class="mb-5  w-100 h-50 overflow-hidden shadow-sm" style="border-radius: 30px">
                    <div class="bg-dark d-flex justify-content-center align-items-center" style="height: 80px"><i class="fas fa-ad ad"> 廣告</i></div>
                    <div class="pt-3 pb-3 bg-white w-100 h-100 d-flex flex-column align-items-center overflow-hidden" id="ad_body">

                        <?php if(!isset($contract_start_date)){ ?>
                            <div class="m-5">無相關資料</div>
                        <?php } ?>

                        <?php if(isset($contract_start_date)){ ?>
                            <?php foreach($rows as $row): ?>
                                <div class="bg-white w-100 d-flex align-items-center justify-content-center overflow-hidden" >
                                    <a href="ann_client_list.php" style="display:flex;text-decoration:none;" >
                                        <div class="mb-2 mt-2 px-5 py-2" style="border-radius: 10px 0 0 10px;border:1px solid #ffe21f;background: #ffe21f">
                                            <div class="font-weight-bold">廣告名稱</div>
                                            <div > <?= $row['ad_name'] ?></div>
                                        </div>
                                        <div class="mb-2 mt-2 px-5 py-2" style="border:1px solid #fff768">
                                            <div class="font-weight-bold">廣告開始時間</div>
                                            <div style="color:#aaa"> <?= $row['contract_start_date'] ?></div>
                                        </div>
                                        <div class="mb-2 mt-2 px-5 py-2" style="border-radius:0 10px 10px 0;border:1px solid #fff768" >
                                            <div class="font-weight-bold">預計結束時間</div>
                                            <div style="color:#aaa"> <?= $row['contract_end_date'] ?></div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php }?>
                    </div>
                </div>

                <!--                下方活動-->
                <div class=" w-100 h-50 overflow-hidden shadow-sm mb-5" style="border-radius: 30px">
                    <div class="bg-dark d-flex justify-content-center align-items-center" style="height: 80px"><<i class="fas fa-snowboarding ac">活動</i></div>
                    <div class="pt-3 pb-3 bg-white w-100 h-100 d-flex flex-column align-items-center" id="ad_body">

                        <?php if(!isset($ac_name)){ ?>
                            <div class="m-5">無相關資料</div>
                        <?php } ?>

                        <?php if(isset($ac_name)){ ?>
                            <?php foreach($rows as $row): ?>
                                <a href="http://192.168.27.179/mainversion/mainversion/php/ShawnpageDisplay.php?sid=<?= $row['sid'] ?>" class="mx-auto my-2" style="width: 94%;height: 14%">
                                    <button type="button" class="btn btn-info mx-auto  w-100 h-100">
                                        <div class="font-weight-bold">活動名稱</div>
                                        <?= $row['name'] ?>
                                    </button>
                                </a>
                            <?php endforeach; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <script>

        function delete_it(sid){
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = 'cinema_ifmt_list_delete.php?sid=' + sid;
            }
        }
    </script>

<?php include __DIR__. './foot.php' ?>