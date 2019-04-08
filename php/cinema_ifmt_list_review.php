<?php include __DIR__. './PDO.php'?>
<?php
$groupname = 'theater';
$pagename = 'theater';

//抓上一頁的資料
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
    $logo = $row['logo'] ? $row['logo'] : '../pic/cinema/'.$row['img'];
}


//----------------------ac撈活動資料套入活動頁
$ac_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$ac_per_page = 4;
// 算總筆數
try{
    $ac_t_sql = "SELECT COUNT(1) FROM `activity`  WHERE `activity`.`company`='$name'";
    $ac_t_stmt = $pdo->query($ac_t_sql);
    $ac_total_rows = $ac_t_stmt->fetch(PDO::FETCH_NUM)[0];

    if($ac_total_rows > $ac_per_page){
        $ac_per_page = 4;
    } else {
        $ac_per_page = $ac_total_rows;
    }
// 總頁數
    if($ac_page < 1) $ac_page = 1;
    $ac_sql = sprintf("SELECT *  FROM `activity`  WHERE `activity`.`company`='$name'  LIMIT %s , %s", 0,$ac_per_page);
    $ac_stmt = $pdo->query($ac_sql);
// 所有資料一次拿出來
    $ac_row = $ac_stmt->fetchAll(PDO::FETCH_ASSOC);
    $ac_rows = isset($ac_row) ? $ac_row : '';

//先抓個name去下面判斷是否有資料
    foreach($ac_rows as $row){
        $ac_name = $row['name'];
        $ac_sid = $row['sid'];
    }

}catch(PDOException $ex){
    $ac_miss_msg = '無相關資料';
}


//----------------------ad撈廣告資料套入廣告頁
try{
    $ad_sql = "SELECT * FROM  `ad` WHERE `ad`.`client_name`='$name' ";
    $ad_stmt = $pdo->query($ad_sql);
    $ad_row = $ad_stmt->fetchAll(PDO::FETCH_ASSOC);
    $ad_rows = isset($ad_row) ? $ad_row : '';
    //先抓個name去下面判斷是否有資料

    foreach($ad_rows as $row ) {
        $ad_name = $row['ad_name'];
        $start_date = $row['contract_start_date'];
        $end_date = $row['contract_end_date'];
    }

}catch(PDOException $ex){
    $ad_miss_msg = '無相關資料';
}


//----------------------vd撈影片資料套入影片瀑布流
try{
    $vd_sql = "SELECT * FROM `film_primary_table` fp WHERE `fp`.`movie_cinema`='$name'";
    $vd_stmt = $pdo->query($vd_sql);
// 所有資料一次拿出來
    $vd_row = $vd_stmt->fetchAll(PDO::FETCH_ASSOC);
    $vd_rows = isset($vd_row) ? $vd_row : '';

    //先抓個name去下面判斷是否有資料
    foreach($vd_rows as $row){
        $vd_name = $row['name_tw'];
        $vd_sid = $row['sid'];
    }

}catch(PDOException $ex){
    $vd_miss_msg = '無相關資料';
}
?>
<?php include __DIR__. './head.php' ?>
<?php include __DIR__.'./sidenav.php'?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+TC|Oswald" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">


    <style>
        .googleFont {
            font-family: 'Oswald', sans-serif,'Noto Serif TC', serif;
        }
        body{
            overflow-x: hidden
        }
        .fullPage{
            height: 105vh;
            width: 110%;
        }
        #openViewName{
            transition: 1s;
        }


        /*RightBar*/
        .rightBtn,.right_bar{
            transform: translateX(290px);
            transition: 1.8s;
        }
        .right_bar{
            position: fixed;
            right: 0;
            top: 200px;
            bottom: 200px;
            z-index: 50;
            background: rgba(52, 58, 64, 0.21);
            width: 30px;
            border-radius: 3px;
        }
        .rightBtn{
            height: 100%;
            position: fixed;
            right: 4px;
            top:60vh;
            box-sizing: border-box;
            z-index: 100;
            text-align: center;
            color: #000;
        }
        .rightBtnTop{
            width: 50px;
            height: 50px;
            background: #343a40;
            border-radius: 50%;
            margin-bottom: 6px;
            box-shadow: 0 0 2px #333;
            padding-top: 12px;
            border: 1px solid transparent;
        }
        .rightBtnTop:hover{
            background: rgba(175, 64, 85, 0.75);
            border: 1px solid #fff;
            transform: scale(1.15);
            color: #222;
            transition: .3s;
        }
        .rightBtnBack{
            width: 50px;
            height: 50px;
            background: #343a40;
            border-radius: 50%;
            box-shadow: 0 0 2px #333;
            padding-top: 12px;
            border: 1px solid transparent;
        }
        .rightBtnBack:hover{
            background: rgba(175, 64, 85, 0.75);
            border: 1px solid #fff;
            transform: scale(1.15);
            color: #222;
            transition: .3s;
        }
        .rightBtn a{
            text-decoration: none;
            color: #ccc;
            font-weight: bold;
        }
        .rightText{
            position: absolute;
            top: 90px;
            right: 7px;
            color: transparent;
            font-size: 72px;
            font-weight: 900;
            transition: 1s;
        }
        .rightText.active{
            color: rgba(175, 64, 85, 0.75);
        }
        .rightTextCircle{
            margin-top: 10px;
            width: 100px;
            height: 100px;
            display: inline-block;
            border:.5px solid rgba(238, 238, 238, 0.4);
            border-radius: 50%;
        }


        /*openView*/
        .openView {
            position: relative;
        }
        .openViewLogoImgBox{
            position: absolute;
            top: 30vh;
            left: 20vh;
            width: 400px;
            height: 400px;
            overflow: hidden;
            border-radius: 50%;
            padding: 0;
            box-shadow: 0 0 7px #1b1e21;
            transform-style: preserve-3d;
            transform: translateZ(20px);
        }
        .openViewLogoImgBox img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .openViewLine{
            position: absolute;
            left: 38.8vw;
            top: 500px;
            bottom: 500px;
            width: 4px;
            background: #333;
            transition: 1.2s;
            transition-timing-function: cubic-bezier(.6,-0.69,.41,1.66);
        }
        .openViewTextBox{
            position: absolute;
            right: 150px;
            top: 12vh;
            width: 100%;
            height: 76vh;
            justify-content: center;
            padding-right: 5%;
            transform: translateX(1300px);
            transition: 1.1s;
        }
        .openViewSid{
            font-weight: bold;
            position: absolute;
            bottom: 26.5vh;
            left: 36vw;
            transform:translateY(1300px) rotate(-90deg) ;
            transition: 1.1s;
            z-index: -1;
        }
        #openViewName{
            transition: .8s;
        }


        /*Intro*/
        .intro{
            background: url("../pic/cinema/introbg.jpg");
            background-position: top;
            background-size: cover;
        }
        .introBgWhite{
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,.65);
        }
        .introImgBox{
            width: 700px;
            height: 700px;
            overflow: hidden;
            border-radius: 50%;
            transform: translateX(-1000px) rotateZ(-760deg) ;
            transition: 1.3s;
        }
        .introImgBox img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .introTextBox{
            background: rgba(0, 0, 0, 0.85);
            padding: 15px;
            border-radius: 30px;
        }
        .introTextBox img{
            width: 50px;
            background: white;
            border-radius: 50%;
            padding: 7px;
            object-fit: cover;
        }
        .introTextBox p{
            font-size: 18px;
            margin: 0;
            color: #999;
        }
        .introTextBox .title{
            font-size: 20px;
            margin: 0;
            color: #fff;
        }


        /*ac*/
        .acContainer{
            width: 90%;
            margin: 0 auto;
            padding: 20px 0;
            overflow: hidden;
            color: palevioletred;
            font-size: 22px;
        }
        .acBg{
            right:80px;
            top:25%;
            z-index:-1;
            background:url('../pic/cinema/activity_bg.jpg');
            background-repeat: no-repeat;
            background-position:right;
            background-size: cover;
            border-radius: 50px;
            opacity: 0;
            transition: 3.5s;
        }
        .acBox{
            height: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            transform: scale(.2);
            transition: .5s;
            transition-timing-function: cubic-bezier(.6,-0.69,.41,1.66);
        }
        .acImg{
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 50%;
            transform:rotate(-20deg);
            transition: .5s;
            box-shadow: 0 0 4px #777;
        }
        .acImg:hover{
            transform:rotate(0);
            box-shadow: 0 0 10px #af4055;
        }
        .acImg img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .acTitle{
            transition: .5s;
        }
        .acTitle a{
            text-decoration: none;
            color: palevioletred;
            transition: .5s;
        }
        .acTitle a:hover{
            color: #ffbcc3;
        }
        .acTextBox{
            width: 150px;
            height: 150px;
            border-radius: 50%;
            text-align: center;
            border: 3px solid transparent;
            color:transparent;
            transition: 2s;
        }
        .acTextBox.active{
            color: #333;
            border: 3px solid #333;
            position: absolute;
            top: 45vh;
            left: 13vh;
        }


        /*ad*/
        .adTableBox{
            width: 70%;
            padding-top: 20vh;
            padding-left:20px;
            height: 100%;
            transition: 1s;
        }
        .adTextBox{
            width: 150px;
            height: 150px;
            border-radius: 50%;
            text-align: center;
            border: 3px solid transparent;
            color:transparent;
            transition: 3s;
        }
        .adTextBox.active{
            color: #333;
            border: 3px solid #333;
            position: absolute;
            top: 300px;
        }
        .adBg{
            overflow: hidden;
            position: absolute;
            z-index: -2;
            transition: 2s;
            width: 300px;
            height: 300px;
            right: 12vw;
            top: 24vh;
            border-radius: 50%;
            opacity: .4;
        }
        .adBg img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .adTr{
            cursor: pointer;
            transition: .5s;
        }


        /*Video*/
        .fullPage5{
            background: url('../pic/cinema/video_bg.jpg');
            background-size: contain;
            background-attachment: fixed;
            height: 100%;
            -webkit-filter:contrast(1);
        }
        .videoContainer{
            width: 90%;
            margin: 0 auto;
            padding: 20px 0 0 0 ;
        }
        .grid{
            width: 100%;
            padding: 30px;
        }
        .grid-item{
            width: 400px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 7px #1b1e21;
            margin-bottom: 10px;
        }
        .videoBtnBox{
            background:rgba(10,10,10,.8);
        }
        .videoBtnBox a{
            padding: 0;
            text-decoration: none;
            color: #ccc;
        }
        .videoBtnBox a:hover{
            background: #ff5b7e;
            color: #222;
            transition: .3s;
        }
        .videoTextBox span{
            display: inline-block;
        }
        .vdTextBox{
            width: 150px;
            height: 150px;
            border-radius: 50%;
            text-align: center;
            border: 3px solid transparent;
            color:transparent;
            transition: 2s;
        }
        .vdTextBox.active{
            color: #fff;
            border: 3px solid #fff;
        }
    </style>


    <section class="dashboard" style="padding-bottom: 0">
        <!--            右側的li-->
        <div class="right_bar googleFont" id="rightBar">
            <div class="rightTextBox position-relative">
                <span class="rightText active">劇場</span>
                <span class="rightText">
                    <span class="rightTextCircle">資</span>
                    <span class="rightTextCircle">料</span>
                </span>
                <span class="rightText">活動</span>
                <span class="rightText">
                    <span class="rightTextCircle">廣</span>
                    <span class="rightTextCircle">告</span>
                </span>
                <span class="rightText">影片</span>
            </div>
        </div>
        <div class="rightBtn googleFont">
            <a href="#"><div class="rightBtnTop" id="rightBtnTop">Top</div></a>
            <a href="cinema_ifmt_list.php"><div class="rightBtnBack">Back</div></a>
        </div>


        <!--                openView入門頁-->
        <div class="fullPage d-flex openView" id="fullPage1" style="margin-top: -48px;margin-left: -16px;">
            <div class="openViewLogoImgBox col-5" data-tilt>
                <img class="" src="../pic/cinema/<?= $logo ?>">
            </div>
            <div class="openViewLine"></div>
            <div class="openViewTextBox col-6  d-flex flex-column">
                <h1 class="googleFont ml-3" id="openViewName" style="color: #333;font-weight: bolder;font-size: 46px"><b><?= $name ?></b></h1>
                <p class="googleFont mt-4 ml-3" style="color: #666;font-size: 19px"><?= $intro ?></p>
            </div>
            <div class="openViewSid">
                <p class="googleFont">會員編號:#<?= $sid ?></p>
            </div>
            <div class="openViewArrowBox">
                <object id="openViewArrow" type="image/svg+xml" data="../pic/cinema/download-arrow.svg"></object>
            </div>
        </div>


        <!--                intro簡介頁-->
        <div class="fullPage d-flex intro " id="fullPage2" style="margin-left: -16px;">
            <div class="introBgWhite d-flex align-items-center overflow-hidden justify-content-between">
                <div class="introImgBox ml-5">
                    <img class="" src="<?= $img ?>">
                </div>
                <div class="introTextBox col-5 d-flex flex-column googleFont">
                    <div class="introTaxID  d-flex align-items-center col-6 ml-3">
                        <img src="../pic/cinema/tag.svg" alt="">
                        <div class="introTaxIDText  ml-4">
                            <p class="title"><b>統一編號</b> TaxID</p>
                            <p><?= $taxID ?></p>
                        </div>
                    </div>
                    <div class="introPhone d-flex align-items-center my-4 col-6 ml-3">
                        <img src="../pic/cinema/phone-call.svg" alt="">
                        <div class="introTaxIDText  ml-4">
                            <p class="title"><b>電話</b> Phone</p>
                            <p ><?= $phone ?></p>
                        </div>
                    </div>
                    <div class="introAddress  d-flex align-items-center col-6 ml-3">
                        <img src="../pic/cinema/house.svg" alt="">
                        <div class="introTaxIDText ml-4">
                            <p class="title"><b>地址</b> Address</p>
                            <p><?= $address ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--                活動頁-->
        <div class="fullPage position-relative googleFont" id="fullPage3" style="margin-left: -16px;">
            <div class="acBg h-50 w-75 position-absolute" style="right: 80px;top: 25%;z-index-1;background: url('../pic/cinema/activity_bg.jpg')no-repeat right;background-size: cover;border-radius: 50px"></div>
            <div class="acContainer h-100 d-flex flex-wrap align-items-center" >
                <?php if(isset($ac_name)){ ?>
                    <?php foreach ($ac_rows as $row): ?>
                        <div class="acBox col-3 ml-4 p-0 d-flex" style="height: 42%">
                            <div class="acImg" >
                                <?php if($row['picture']=='space'){?>
                                    <a href="http://192.168.27.179/mainversion/mainversion/php/ShawnpageDisplay.php?sid=<?= $ac_sid ?>"><img src="../pic/cinema/<?= $logo ?>"></a>
                                <?php }else{?>
                                    <a href="http://192.168.27.179/mainversion/mainversion/php/ShawnpageDisplay.php?sid=<?= $ac_sid ?>"><img src="../pic/activity/<?= $row['picture'] ?>"></a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="acTitle col-2" style="font-weight: 600">
                            <a href="http://192.168.27.179/mainversion/mainversion/php/ShawnpageDisplay.php?sid=<?= $ac_sid ?>"><?= $row['name'] ?></a>
                        </div>
                    <?php endforeach ?>
                <?php } else { ?>
                    <div class="acTextBox col-2" style="font-size: 18px;font-weight: 600"><span style="font-size: 70px">無</span><br>相關活動</div>
                <?php }; ?>
            </div>
        </div>


        <!--                廣告頁    -->
        <div class="fullPage googleFont overflow-hidden" id="fullPage4" style="margin-left: -16px;height: 90vh">
            <div class="adContainer position-relative">
                <div class="adBg">
                    <img src="../pic/cinema/ad-bg.jpg" alt="">
                </div>
                <?php if(!isset($ad_name)){ ?>
                    <div class="adTextBox" style="font-size: 18px;font-weight: 600;left:30px">
                        <span style="font-size: 70px">無</span><br>相關廣告
                    </div>
                    <div class="adTextBox" style="font-size: 18px;font-weight: 600;left:180px">
                        <span style="font-size: 70px">無</span><br>相關廣告
                    </div>
                    <div class="adTextBox" style="font-size: 18px;font-weight: 600;left:330px">
                        <span style="font-size: 70px">無</span><br>相關廣告
                    </div>
                    <div class="adTextBox" style="font-size: 18px;font-weight: 600;left:480px">
                        <span style="font-size: 70px">無</span><br>相關廣告
                    </div>
                    <div class="adTextBox" style="font-size: 18px;font-weight: 600;left:630px">
                        <span style="font-size: 70px">無</span><br>相關廣告
                    </div>
                    <div class="adTextBox" style="font-size: 18px;font-weight: 600;left:780px">
                        <span style="font-size: 70px">無</span><br>相關廣告
                    </div>
                    <div class="adTextBox" style="font-size: 18px;font-weight: 600;left:930px">
                        <span style="font-size: 70px">無</span><br>相關廣告
                    </div>
                    <div class="adTextBox" style="font-size: 18px;font-weight: 600;left:1080px">
                        <span style="font-size: 70px">無</span><br>相關廣告
                    </div>
                <?php }else{ ?>
                <div class="adTableBox">
                    <table class="table table-hover adTable" id="ad">
                        <thead class="thead-dark">
                        <tr>
                            <th>廣告名稱</th>
                            <th>開始時間</th>
                            <th>結束時間</th>
                            <th>預算</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($ad_rows as $row): ?>
                            <tr class="adTr" onclick="document.location ='   #    '">
                                <td><?= $row['ad_name'] ?></td>
                                <td><?= $row['contract_start_date'] ?></td>
                                <td><?= $row['contract_end_date'] ?></td>
                                <td><?= $row['contract_budget'] ?></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <?php }; ?>
                </div>
            </div>
        </div>

        <!--                影片頁-->
        <div class="fullPage fullPage5" id="fullPage5" style="margin-left: -16px">
            <div class="fullPage5Black pb-4" style="background: rgba(0,0,0,.4)">
                <div class="videoContainer">
                    <div class="grid googleFont">
                        <?php if(!isset($vd_name)){ ?>
                            <div class="m-5 vdTextBox" style="font-size: 18px;font-weight: 600">
                                <span style="font-size:70px">無</span><br>相關影片
                            </div>
                        <?php }else{ ?>
                        <?php foreach ($vd_rows as $row):?>
                            <div class="videoBox grid-item">

                                <!--                            TODO:設定圖片連結-->
                                <a href="   #   ">
                                    <div class="videoImgBox w-100 overflow-hidden">
                                        <img class="w-100" src="../pic/film_upload/<?= $row['movie_pic'] ?>" alt="">
                                    </div>
                                </a>
                                <div class="videoTextBox bg-light p-3">
                                    <span class="videoTitleCn" style="font-size: 30px"><b><?= $row['name_tw'] ?></b></span>
                                    <span class="videoTitleEn" style="font-size: 16px"><?= $row['name_en'] ?></span><br>
                                    <span class="videoCountry" style="font-size: 12px">"from" <b><?= $row['country'] ?></b></span><br>
                                    <span class="videoDiretorCn" style="font-size: 18px"><?= $row['director_tw'] ?></span>
                                    <span class="videoDiretorEn" style="font-size: 12px"><small><?= $row['director_en'] ?></small></span><br>
                                    <span class="videoIntro mt-2" style="font-size: 14px"><?= $row['intro_tw'] ?></span>
                                </div>
                                <div class="videoBtnBox d-flex w-100 text-center">

                                    <!--                            TODO:設定連結-->
                                    <a class="col-4" href="  #  "><div class="videoBtn py-3 "><i class="fas fa-link"></i> 連結 Link</div></a>
                                    <a class="col-4" href="<?= $row['trailer'] ?>" target="_blank" style="margin: 0 0.5px;"><div class="videoBtn py-3 "><i class="fas fa-video"></i> 預告片 Trailer</div></a>
                                    <a class="col-4" href="  #   "><div class="videoBtn py-3 "><i class="far fa-calendar-alt"></i> 檔期 Schedule</div></a>
                                </div>
                            </div>
                        <?php endforeach ?>
                        <?php }; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vivus/0.4.4/vivus.js"></script>
    <script src="https://unpkg.com/tilt.js@1.2.1/dest/tilt.jquery.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
        // 進頁面時的openView動畫
        start();
        function start (){
            $('.openViewTextBox').css('transform', "translateX(0)");
            $('.openViewSid').css('transform', "translateY(0) rotate(-90deg)");
            $('.rightBtn,.right_bar').css('transform', "translateX(0)");
            $('.openViewLine').css({
                top: 130,
                bottom: 270
            });
        }


        // 影片頁瀑布流
        $('.grid').masonry();

        $('.grid').masonry({
            // options
            itemSelector: '.grid-item',
            columnWidth: 200,
            gutter: 6
        });


        // 滾輪捲動互動效果
        $(window).scroll(function(){
            var s = $(this).scrollTop();
            console.log(s);
            $('#rightBtnTop').click(function () {
            });


            // rightBar文字
            if(s <= 500){
                $('.rightText').siblings().removeClass('active').eq(0).addClass('active');
            }else if (s <= 1600){
                $('.rightText').siblings().removeClass('active').eq(1).addClass('active');
            }else if(s <= 2400){
                $('.rightText').siblings().removeClass('active').eq(2).addClass('active');
            }else if(s <= 3300){
                $('.rightText').siblings().removeClass('active').eq(3).addClass('active');
                $('.rightText').eq(4).css('color','transparent');
            }else {
                $('.rightText').siblings().removeClass('active').eq(4).addClass('active');
                $('.rightText').eq(4).css('color','white');
            };


            // 介紹頁動畫
            if(s >= 500){
                if(s >= 1600){
                    $('.introImgBox').css('transform','translateX(-1200px) rotateZ(360deg)');
                }else{
                    $('.introImgBox').css('transform','translateX(0) rotateZ(0)');
                    $('#openViewName').css({
                        'transform':'translate(-250px , 950px) rotateZ(-450deg)',
                        color:"rgba(0,0,0,.3)",
                        'font-size':'60px'
                    });
                };
            }else{
                $('.introImgBox').css('transform','translateX(-1200px) rotateZ(360deg)');
                $('#openViewName').css({
                    'transform':'translate(0px , 0px) rotateZ(0)',
                    'color':'#333',
                    'font-weight':'900',
                    'font-size':'46px'
                });
            };


            // 活動頁動畫
            if(s >= 1400){
                if(s >= 3000){
                    $('.acBox').css('transform','scale(.3)');
                    $('.acbg').css('opacity','0.1');
                    $('.acTextBox').removeClass('active');
                }else{
                    $('.acBg').css({
                        'opacity':'.95',
                    });
                    $('.acBox').css('transform','scale(1)');
                    $('.acTextBox').addClass('active');
                }
            }else{
                $('.acBox').css('transform','scale(.3)');
                $('.acbg').css('opacity','0.1');
                $('.acTextBox').removeClass('active');
            }


            // ad頁動畫
            if(s >= 2400){
                if(s >= 3400){
                    $('.adTableBox').css('transform','translateX(-2300px) scaleZ(0)');
                    $('.adTextBox').removeClass('active');
                }else{
                    $('.adTableBox').css({
                        'transform': 'translateX(0) scaleZ(1)'
                    });
                    $('.adTextBox').addClass('active');
                    $('.adBg').attr('adImg','');
                }
            }else{
                $('.adTableBox').css('transform','translateX(-2300px) scaleZ(0)');
            }


            // video沒資料的文字動畫
            if(s >= 2800){
                $('.vdTextBox').addClass('active');
            }else{
                $('.vdTextBox').removeClass('active');
            };
        });


        // 廣告業Table
        $(document).ready( function () {
            $('#ad').DataTable();
        } );
    </script>

<?php include __DIR__.'./foot.php' ?>