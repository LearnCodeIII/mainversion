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

$t_sql = sprintf("SELECT COUNT(1) FROM `ad`, `activity` WHERE `activity`.`author`='$name'  AND `ad`.`client_name`='$name'  ");
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

// 總頁數
$total_pages = ceil($total_rows/$per_page);

if($page < 1) $page = 1;
if($page > $total_pages) $page = $total_pages;

//$sql = sprintf("SELECT * FROM `activity` where `activity`.`author`='$name'  LIMIT %s, %s", ($page-1)*$ac_per_page, $ac_per_page);
$sql = sprintf("SELECT  `activity`.`name` , `ad`.`contract_start_date`,`ad`.`contract_end_date`,`ad`.`ad_name` FROM `ad`, `activity` WHERE `activity`.`author`='$name'  AND `ad`.`client_name`='$name'  LIMIT %s, %s", ($page-1)*$per_page, $per_page);

$stmt = $pdo->query($sql);

// 所有資料一次拿出來
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $ex){
    $miss_msg = '無相關資料';
}





?>
<?php include __DIR__. './head.php' ?>
<?php include __DIR__. './nav.php' ?>
<?php include __DIR__. './cinema_sidenav.php' ?>
    <style>
        p{
            width: 75%;
        }
        label{
            width: 20%;
            height: 30px;
            font-size: 18px;
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
                    <div id="review_img" class="w-100 h-100")"></div>
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
                <div class="mb-5  w-100 h-50 overflow-hidden shadow-sm" style="border-radius: 30px">
                    <div class="bg-dark d-flex justify-content-center align-items-center" style="height: 80px"><i class="fas fa-ad ad"> 廣告</i></div>
                    <div class="bg-white w-100 h-100 d-flex flex-column align-items-center overflow-hidden" id="ad_body">
                        <?php if(isset($miss_msg)){ ?>
                            <div class="mt-5"><?= $miss_msg ?></div>
                        <?php } else { ?>
                            <?php foreach($rows as $row): ?>
                            <div class="bg-white w-100 h-90 d-flex align-items-center justify-content-center">
                                <button type="button" class="btn btn-danger mx-auto my-2" style="width: 30%;height: 75%">
                                    <div class="font-weight-bold">廣告名稱</div>
                                    <div> <?= $row['ad_name'] ?></div>
                                </button>
                                <button type="button" class="btn btn-warning mx-auto my-2" style="width: 30%;height: 75%">
                                    <div class="font-weight-bold">廣告開始時間</div>
                                    <div> <?= $row['contract_start_date'] ?></div>
                                </button>
                                <button type="button" class="btn btn-warning mx-auto my-2" style="width: 30%;height: 75%">
                                    <div class="font-weight-bold">預計結束時間</div>
                                    <div> <?= $row['contract_end_date'] ?></div>
                                </button>
                            </div>
                            <?php endforeach; ?>
                        <?php }?>
                    </div>
                </div>
                <div class=" w-100 h-50 overflow-hidden shadow-sm"style="border-radius: 30px">
                    <div class="bg-dark d-flex justify-content-center align-items-center" style="height: 80px"><i class="fas fa-star ac"> 活動</i></i></div>

                    <div class="bg-white w-100 h-100 d-flex flex-column align-items-center" id="ad_body">
                        <?php if(isset($miss_msg)){ ?>
                            <div class="mt-5"><?= $miss_msg ?></div>
                        <?php }else{ ?>
                            <?php foreach($rows as $row): ?>
                                <button type="button" class="btn btn-info mx-auto mt-3" style="width: 90%;height: 20%">
                                    <div class="font-weight-bold">活動名稱</div>
                                    <?= $row['name'] ?>
                                </button>
                            <?php endforeach; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <script>
            function delete_it(sid){
                if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                    location.href = 'cinema_ifmt_list_delete.php?sid=' + sid;
                }
            }
        </script>

    </section>
<?php include __DIR__. './foot.php' ?>