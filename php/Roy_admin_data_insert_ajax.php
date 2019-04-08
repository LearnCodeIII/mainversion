<?php
$groupname = "forum";
$pagename = "Roy_admin_data_insert_ajax";
include __DIR__ . '/PDO.php';

if (isset($_SESSION["admin"])) {
    $k = $_SESSION["admin"];
}
if (isset($_SESSION["member"])) {
    $k = $_SESSION["member"];
}
if (isset($_SESSION["theater"])) {
    $k = $_SESSION["theater"];
}

if (!isset($_SESSION["admin"]) && !isset($_SESSION["member"]) && !isset($_SESSION["theater"])) {
    header('Location: login.php');
}
?>
<?php include __DIR__ . './head.php'?>
<?php include __DIR__ . './sidenav.php'?>

<head>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.6/tinymce.min.js"></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../js/sweet.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- FANCYBOX -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script>
    // tinymce.init({
    //     selector: '#review'
    // });
    // ClassicEditor
    //         .create(document.querySelector('#review'))
    //         .catch(error => {
    //             console.error(error);
    //         });

    // 時間選取器

    $(function() {
        var date = $('#w_date').datepicker({
            dateFormat: 'yy-mm-dd'
            // 設定時間格式
        }).val();
        $('#w_date').datepicker();
    });
    </script>
    <style>
    body {
        font-family: 'Noto Sans TC', sans-serif;
    }

    .form-group small {
        color: red !important;
    }

    .marginnone {
        margin: 0
    }

    .stylenone {
        margin: 0 auto;
        padding: 0;
    }

    .starcontainer,
    .heartcontainer,
    .thundercontainer {
        width: 50%;
        height: 30px;
    }

    .starbox,
    .starbox4 {
        color: lightblue;
        font-size: 24px;
        padding: 0 0.3rem;
        z-index: 3;
        left: 0;
        right: 0;
        /* 讓感應區域左右填滿 */
    }

    .starbox2,
    .starbox5 {
        color: transparent;
        font-size: 24px;
        padding: 0 0.3rem;
        z-index: 5;
        left: 0;
        right: 0;
    }

    .starbox3,
    .starbox6 {
        color: transparent;
        font-size: 24px;
        padding: 0 0.3rem;
        z-index: 4;
        left: 0;
        right: 0;
    }


    .heartbox1 i,
    .heartbox3 i,
    .thunderbox1 i {
        font-size: 32px;
        background-color: #565656;
        color: transparent;
        text-shadow: 0px 2px 3px rgba(255, 255, 255, 0.5);
        -webkit-background-clip: text;
        -moz-background-clip: text;
        background-clip: text;
        z-index: 3;
    }

    .heartbox1 i.active,
    .heartbox3 i.active,
    .thunderbox1 i.active {
        font-size: 32px;
        background-color: #565656;
        color: transparent;
        text-shadow: 0px 2px 3px rgba(180, 180, 180, 0.5);
        -webkit-background-clip: text;
        -moz-background-clip: text;
        background-clip: text;

    }

    .heartbox2 i,
    .heartbox4 i,
    .thunderbox2 i {
        font-size: 32px;
        background-color: transparent;
        color: transparent;
        z-index: 4;
    }

    .heartbox2 .heartbox2pink,
    .heartbox4 .heartbox2pink {
        color: rgb(240, 120, 210);
        text-shadow: 1px 1px 1px gray, 1px -1px 1px gray, -1px 1px 1px gray, -1px -1px 1px gray;
    }

    .thunderbox2 .thunderbox2pink {
        color: rgb(252, 211, 78);
        text-shadow: 1px 1px 1px gray, 1px -1px 1px gray, -1px 1px 1px gray, -1px -1px 1px gray;
    }
    </style>
</head>
<section class="dashboard">
    <div class="container">
        <div class="row ">
            <div class="col-lg-8 stylenone">
                <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">發布文章
                        </h5>
                        <form name="form1" method="post" onsubmit="return checkForm();">
                            <input type="hidden" name="checkme" value="check123">
                            <div class="container  px-0 justify-content-between">
                                <div class="info-box d-flex px-0 col-lg-6 justify-content-between">
                                    <div class="form-group ">
                                        <label for="w_date">觀看日期</label>
                                        <input type="text" class="form-control bg-white" id="w_date" name="w_date"
                                            placeholder="" value="" readonly>
                                        <small id="w_dateHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group spoilerscheck">
                                        <label for="re_spoilers">是否爆雷</label>
                                        <input type="hidden" name="re_spoilers" id="re_spoilersX">
                                        <input type="checkbox" id="re_spoilers" class="d-none">
                                        <!-- 設兩個不同ID一個用於NAME送資料，一個用於顯示，避免未選無法SUBMIT，最後再用D_NONE隱藏 -->
                                        <div class="thundercontainer position-relative">
                                            <div class="thunderbox1">
                                                <span><i class="fas fa-bolt position-absolute"></i></span>
                                            </div>
                                            <div class="thunderbox2">
                                                <span><i class="fas fa-bolt position-absolute"></i></span>
                                            </div>
                                        </div>
                                        <small id="re_spoilersHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="issuerarea d-flex col-lg-6 p-0 justify-content-between">
                                    <div class="form-group  p-0 m-0">
                                        <label for="issuer">登入帳號</label>
                                        <input type="text" readonly class="form-control" id="issuer" name="issuer"
                                            placeholder="<?=$k?>" value="<?=$k?>">
                                        <small id="issuerHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="card p-1" style="width: 5rem; height: 5rem">
                                        <img id="currentavatar" class="card-img-top" src="" alt="Card image cap">

                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <label for="headline">影評標題</label>
                                    <input type="text" class="form-control" id="headline" name="headline" placeholder=""
                                        value="">
                                    <small id="headlineHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="filmarea d-flex">
                                    <div class="info-box px-0 col-lg-8 ">

                                        <div class="form-group">
                                            <label for="w_film">觀看電影</label>
                                            <select class="form-control" id="w_film" name="w_film">
                                                <!-- 表單內容由API串接生成 -->
                                            </select>
                                            <small id="w_filmHelp" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group">
                                            <!-- <label for="film_rate">電影評分INPUT</label> -->
                                            <input type="hidden" class="form-control" id="film_rate" name="film_rate"
                                                placeholder="" value="">

                                            <small id="film_rateHelp" class="form-text text-muted"></small>
                                        </div>
                                        <div class="filmratingbox d-flex ">
                                            <div class="form-group col-lg-8 position-relative stylenone">
                                                <label for="film_fav_count ">電影評分</label>
                                                <div class="starcontainer ">
                                                    <!-- 用JQ生成星星 -->
                                                    <div
                                                        class="d-flex starbox  position-absolute justify-content-between marginnone font_star">
                                                    </div>
                                                    <div
                                                        class="d-flex starbox2  position-absolute justify-content-between marginnone font_star">
                                                    </div>
                                                    <div
                                                        class="d-flex starbox3  position-absolute justify-content-between marginnone font_star">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-4 filmcheck text-center">
                                                <label for="film_fav_count">電影最愛</label>
                                                <input type="hidden" name="film_fav_count" id="film_fav_countX">
                                                <input type="checkbox" id="film_fav_count" class="d-none">
                                                <!-- 設兩個不同ID一個用於NAME送資料，一個用於顯示，避免未選無法SUBMIT，最後再用D_NONE隱藏 -->
                                                <div class="heartcontainer position-relative">
                                                    <div class="heartbox3">
                                                        <span><i class="fas fa-heart position-absolute"></i></span>
                                                    </div>
                                                    <div class="heartbox4">
                                                        <span><i class="fas fa-heart position-absolute"></i></span>
                                                    </div>
                                                </div>
                                                <small id="film_fav_countHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="review">電影評論</label>
                                            <!-- <textarea class="form-control" id="review" name="review" cols="30" rows="3"></textarea> -->
                                            <textarea class="form-control textrowgrow" name="review" id="review"
                                                cols="30" rows="5"></textarea>
                                            <small id="reviewHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div
                                        class="pic-pre px-0 py-1 col-lg-4 d-flex justify-content-end stylenone align-items-center">
                                        <div class="card border-0 text-right " style="width: 16rem; max-height:30rem">
                                            <div class=" d-none ">
                                                <h5 class="card-title card_name"></h5>
                                            </div>
                                            <!-- 超連結先設D-NONE避免誤觸，再用JS偵測事件REMOVE CLASS -->
                                            <a id="filmfancybox" class="fancyboxiframe d-none" href="">
                                                <img id="prepic" src="" class="card-img-top stylenone " alt=""
                                                    style="width: 12rem;">
                                            </a>
                                        </div>
                                    </div>
                                </div>


                                <div class="cinemaarea d-flex">
                                    <div class="info-box px-0 col-lg-8">
                                        <div class="form-group ">
                                            <label for="w_cinema">觀看戲院</label>
                                            <select class="form-control" id="w_cinema" name="w_cinema">
                                                <!-- 表單內容由API串接生成 -->
                                            </select>
                                            <small id="w_cinemaHelp" class="form-text text-muted"></small>
                                        </div>

                                        <div class="form-group">
                                            <!-- <label for="film_rate">戲院評分INPUT</label> -->
                                            <input type="hidden" class="form-control" id="cinema_rate"
                                                name="cinema_rate" placeholder="" value="">
                                            <small id="cinema_rateHelp" class="form-text text-muted"></small>
                                        </div>
                                        <div class="cinemaratebox d-flex">
                                            <div class="form-group col-lg-8 position-relative stylenone">
                                                <label for="cinema_rate">戲院評分</label>
                                                <div class="starcontainer ">
                                                    <!-- 用JQ生成星星 -->
                                                    <div
                                                        class="d-flex starbox4  position-absolute justify-content-between marginnone font_star">
                                                    </div>
                                                    <div
                                                        class="d-flex starbox5  position-absolute justify-content-between marginnone font_star">
                                                    </div>
                                                    <div
                                                        class="d-flex starbox6  position-absolute justify-content-between marginnone font_star">
                                                    </div>
                                                </div>
                                                <small id="cinema_rateHelp" class="form-text text-muted"></small>
                                            </div>
                                            <div class="form-group col-lg-4 cinemacheck text-center">
                                                <label for="cinema_push_count">戲院最愛</label>
                                                <input type="hidden" name="cinema_push_count" id="cinema_push_countX">
                                                <input type="checkbox" id="cinema_push_count" class="d-none">
                                                <!-- 設兩個相同ID一個用於送資料，一個用於顯示，避免未選無法SUBMIT，最後再用D_NONE隱藏 -->
                                                <div class="heartcontainer position-relative">
                                                    <div class="heartbox1">
                                                        <span><i class="fas fa-heart position-absolute"></i></span>
                                                    </div>
                                                    <div class="heartbox2">
                                                        <span><i class="fas fa-heart position-absolute"></i></span>
                                                    </div>
                                                </div>
                                                <small id="cinema_push_countHelp" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pic-pre py-1 col-lg-4 d-flex stylenone align-items-center">
                                        <div class="card border-0 text-right" style="width: 18rem; max-height:18rem ">
                                            <div class="  d-none">
                                                <h5 class="card-title card_name_cinema"></h5>
                                            </div>
                                            <!-- 超連結先設D-NONE避免誤觸，再用JS偵測事件REMOVE CLASS -->
                                            <a id="cinemafancybox" class="fancyboxiframe d-none" href="">
                                                <img id="cinema_prepic" src="" class="card-img-top text-right "
                                                    alt="" style="width: 12rem; height:10rem">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cinema_comment">戲院評論</label>
                                <textarea class="form-control textrowgrow" name="cinema_comment" id="cinema_comment"
                                    cols="30" rows="5"></textarea>
                                <small id="reviewHelp" class="form-text text-muted"></small>
                            </div>




                            <div class="form-group">
                                <!-- <label for="intro_pic ">圖片</label> -->
                                <figure>
                                    <img id="myimg" src="" alt="" width="100%">
                                </figure>
                                <div class="custom-file">
                                    <!-- 要包BS LABEL才能正常顯示 -->
                                    <label class="custom-file-label" for="intro_pic">上傳圖片</label>
                                    <!-- 將上傳圖片與上傳圖片檔案分開，如此不用夾帶檔案也能正常送表單，但是上傳圖片API與送表單API要分開 -->
                                    <input type="file" class="custom-file-input" id="intro_picX">
                                    <input type="text" class="form-control" id="intro_pic" name="intro_pic"
                                        placeholder="" value="" hidden>
                                </div>
                                <small id="intro_picHelp" class="form-text text-muted"></small>
                            </div>

                            <button id="submit_btn" type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <!-- <a id="iframe" href="http://localhost/20190404/php/film_data_preview.php?sid=3">This goes to
            iframe</a> -->
    </div>
</section>

<script>
// 上傳檔案
const myimg = document.querySelector("#myimg");
const intro_pic = document.querySelector("#intro_pic");

// 上傳圖片，ID與送DATABASE要不同
const intro_picupload = document.querySelector("#intro_picX");
intro_picupload.addEventListener("change", event => {
    // 當偵測到有變更後，觸發箭頭韓式EVENT
    //console.log(event.target);
    const fd = new FormData();

    fd.append('intro_picupload', intro_picupload.files[0]);
    fetch('Roy_data_img_upload_api.php', {
            // 將轉碼也寫在同隻API
            method: 'POST',
            body: fd
        })
        .then(response => response.json())
        .then(obj => {
            console.log(obj);
            myimg.setAttribute('src', '../pic/forum/' + obj.filename);
            // 要指定好變更後的路徑
            intro_pic.value = obj.filename
        });
})



const info_bar = document.querySelector('#info_bar');
const submit_btn = document.querySelector('#submit_btn');
const fields = [
    'headline',
    'review',
    'w_date',
    // 'i_date',無效
    'w_cinema',
    'film_rate',
    // 'fav',
    'intro_pic',
    // 're_spoilers' 會造成SUBMIT問題

];

// 拿到每個欄位的參照
const fs = {};
for (let v of fields) {
    fs[v] = document.form1[v];
}
console.log(fs);
console.log('fs.headline:', fs.headline);


const checkForm = () => {
    let isPassed = true;
    info_bar.style.display = 'none';

    // 拿到每個欄位的值
    const fsv = {};
    for (let v of fields) {
        fsv[v] = fs[v].value;
    }
    console.log(fsv);


    // 評分限制
    // let rate_pattern = /^[1-9]$|^[1][0]$/;
    // 喜好限制
    // let fav_pattern = /^[0-1]$/;

    // dd/mm/yyyy
    // let date_pattern = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;

    // yyyy/mm/dd
    let date_pattern =
        /^([0-9]{4}[-/]?((0[13-9]|1[012])[-/]?(0[1-9]|[12][0-9]|30)|(0[13578]|1[02])[-/]?31|02[-/]?(0[1-9]|1[0-9]|2[0-8]))|([0-9]{2}(([2468][048]|[02468][48])|[13579][26])|([13579][26]|[02468][048]|0[0-9]|1[0-6])00)[-/]?02[-/]?29)$/;


    for (let v of fields) {
        fs[v].style.borderColor = '#cccccc';
        document.querySelector('#' + v + 'Help').innerHTML = '';
    }

    if (fsv.headline.length > 50) {
        fs.headline.style.borderColor = 'red';
        document.querySelector('#headlineHelp').innerHTML = '請勿輸入超過50個字!';

        isPassed = false;
    }
    if (fsv.headline.length == 0) {
        fs.headline.style.borderColor = 'red';
        document.querySelector('#headlineHelp').innerHTML = '請輸入內容!';
        isPassed = false;
    }
    if (fsv.review.length == 0) {
        fs.review.style.borderColor = 'red';
        document.querySelector('#reviewHelp').innerHTML = '請輸入內容!';
        console.log("123");
        isPassed = false;
    }
    if (fsv.review.length > 1000) {
        fs.review.style.borderColor = 'red';
        document.querySelector('#reviewHelp').innerHTML = '請勿超過1000字!';
        console.log("123");
        isPassed = false;
    }
    // if (!email_pattern.test(fsv.review)) {
    //     fs.review.style.borderColor = 'red';
    //     document.querySelector('#reviewHelp').innerHTML = '請填寫正確的 review!';
    //     isPassed = false;
    // }
    if (!date_pattern.test(fsv.w_date)) {
        fs.w_date.style.borderColor = 'red';
        document.querySelector('#w_dateHelp').innerHTML = '請輸入正確日期!';
        isPassed = false;
    }
    // if (!rate_pattern.test(fsv.film_rate)) {
    //     fs.film_rate.style.borderColor = 'red';
    //     document.querySelector('#film_rateHelp').innerHTML = '請輸入正確區間!';
    //     isPassed = false;
    // }

    // TODO 如果不想必檢查的方式
    // if (!fav_pattern.test(fsv.fav)) {
    //     fs.fav.style.borderColor = 'red';
    //     document.querySelector('#favHelp').innerHTML = '請輸入正確值!';
    //     isPassed = false;
    // }




    if (isPassed) {
        // 上傳前確認
        Swal.fire({
            title: '是否確認上傳?',
            text: "請點選確認繼續或取消離開",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '確認',
            cancelButtonText: '取消',

        }).then((result) => {
            // 確認有按下上傳確認鍵後開始FETCH
            if (result.value) {
                // 文字編輯器要放在NEWFORMDATA前面，要先用下方方式抓取送出的文章內容，才不會要送兩次
                // const edt = document.querySelector('#review')
                // console.log(edt);
                // edt.innerHTML += tinyMCE.activeEditor.getContent();


                let form = new FormData(document.form1);
                submit_btn.style.display = 'none';
                fetch('Roy_data_insert_api.php', {
                        method: 'POST',
                        body: form
                    })
                    .then(response => response.json())
                    .then(obj => {
                        console.log(obj);
                        info_bar.style.display = 'block';
                        if (obj.success) {
                            info_bar.className = 'alert alert-success';
                            info_bar.innerHTML = '資料新增成功';
                            func = () => {
                                location.href = "Roy_datalist.php";
                            }
                            setTimeout(() => {
                                func();
                            }, 5000);
                        } else {
                            info_bar.className = 'alert alert-danger';
                            info_bar.innerHTML = obj.errorMsg;
                        }
                        submit_btn.style.display = 'block';
                    });

                // 跳出結果確認視窗,並倒數
                let timerInterval
                Swal.fire({
                    // 大括號設定內容
                    type: "success",
                    confirmButtonText: '確認',
                    title: '成功',
                    text: "檔案已上傳完成，將在五秒後跳轉",
                    // 顯示圖片類型
                    // type: 'success',
                    // 倒數計時
                    html: '檔案已上傳完成，將在<strong class="submitcheck"></strong>秒後跳轉<br><br>',
                    timer: 5100,
                    onBeforeOpen: () => {
                        const content = Swal.getContent()
                        const $ = content.querySelector.bind(content)
                        timerInterval = setInterval(() => {
                            Swal.getContent().querySelector('strong.submitcheck')
                                .textContent = (Swal.getTimerLeft() / 1000)
                                .toFixed(0)
                        }, 100)
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    // 如果點選確認提前跳轉
                    location.href = "Roy_datalist.php"
                })
            }
        })
    } else {
        Swal.fire({
            type: 'error',
            title: '錯誤',
            text: '請確認是否輸入正確資訊',
        })
    }
    return false;
};

// 偵測登入者回傳使用者頭像
var memberindex = [];
let member_data;
fetch("Roy_datalist_api.php")
    .then(response => response.json())
    .then(json => {
        member_data = json;
        memberindex = member_data.m_data
        console.log(memberindex);
        // console.log(issuer.value);

        // 抓到目前登入者跟資料庫對應到的物件並回傳物件
        function isLoginMember(memberobj) {
            return memberobj.name === issuer.value;
        }
        // 搜尋符合條件的物件
        var currentissuer = memberindex.find(isLoginMember)
        if (currentissuer) {
            console.log(currentissuer.avatar);
            // 抓出物件中大頭貼照片並傳至HTML中
            currentavatar.setAttribute("src", '../pic/avatar/' + currentissuer.avatar)
        } else {
            // 如沒符合條件則設為預設圖片
            currentavatar.setAttribute("src", '../pic/avatar/null.jpg')
        }
    })


// 戲院下拉選單
let cinema_data;
// 抓戲院回傳資料
const w_cinema = document.querySelector('#w_cinema');
const cinema_str = `<option><%=name%></option>`
const cinema_func = _.template(cinema_str);

const card_name_cinema = document.querySelector('.card_name_cinema');
var j = 0;
// 用來抓下拉捲單變更回傳之物件索引值(戲院)
// console.log(j)

fetch("Roy_datalist_api.php")
    .then(response => response.json())
    .then(json => {
        cinema_data = json;
        // console.log(cinema_data);

        // 文章內容匯入
        let cinema_str = '';
        for (let v of cinema_data.c_data) {
            // 取API中C_DATA資料
            cinema_str += cinema_func(v);
        }
        w_cinema.innerHTML = cinema_str;
    })
// 抓到所選戲院CHANGE對應到的索引值------------變動圖片必要內容
w_cinema.addEventListener('change', event => {
    for (let i = 0; i < w_cinema.childNodes.length; i++) {
        // 抓到ID的整個陣列物件後加LENGTH得知數量
        if (w_cinema.childNodes[i].selected == true) {
            // 觀看第幾個物件是否有在CHANGE事件後觸發SELECT有救回傳
            j = i;
            // 把I值抓出去
            // console.log(i)
            return i
        }
    }
})


// 額外加入偵測下拉選單變換後抓到索引值選取對應JPG名稱後串聯設回IMG欄------------變動圖片必要內容
// 可根據下拉選單變動對應變更照片
w_cinema.addEventListener('change', event => {
    console.log(j)
    let cinemaprepicindex = cinema_data.c_data[j]["img"]
    // 將索引中物件裡的圖片名稱抓出來
    cinema_prepic.setAttribute("src", '../pic/cinema/' + cinemaprepicindex)

    // 抓到當筆資料SID，SQL記得要加撈SID
    let cinema_prepicsid = cinema_data.c_data[j]["sid"]
    // 根據得到的SID值將圖片上的連結導向戲院串接API
    cinemafancybox.setAttribute("href", "cinema_ifmt_list_review.php?sid=" + cinema_prepicsid)
    console.log(cinema_prepicsid);

})
// // 下拉選單換後選到對應值後寫入HTML
// w_cinema.addEventListener("change", event => {
//     card_name_cinema.innerHTML = w_cinema.value;
// })

// CHANGE只能針對INPUT事件有效，圖片SRC改變不會有反應，因此不能直接選圖片ID偵測
$("#w_cinema").on("change", function() {
    $("#cinemafancybox").removeClass("d-none");
})



let film_data;
// 抓電影回傳資料
const w_film = document.querySelector('#w_film');
const w_film_str = `<option><%=name_tw%></option>`
const w_film_func = _.template(w_film_str);

// 用於變動圖片需要之參數
const card_name = document.querySelector('.card_name');
const card_name1 = document.querySelector('.card_name1');
var k = 0;
// 用來抓下拉捲單變更回傳之物件索引值
// console.log(k)

var currentfilmsid = "";
// 抓當下圖片SID

// 抓到所選電影CHANGE對應到的索引值------------變動圖片必要內容
w_film.addEventListener('change', event => {
    for (let i = 0; i < w_film.childNodes.length; i++) {
        // 抓到ID的整個陣列物件後加LENGTH得知數量
        if (w_film.childNodes[i].selected == true) {
            // 觀看第幾個物件是否有在CHANGE事件後觸發SELECT有救回傳
            k = i;
            // 把I值抓出去
            // console.log(i)
            return i
        }
    }
})
// 額外加入偵測下拉選單變換後抓到索引值選取對應JPG名稱後串聯設回IMG欄------------變動圖片必要內容
// 可根據下拉選單變動對應變更照片
w_film.addEventListener('change', event => {
    console.log(k)
    let prepicindex = film_data.f_data[k]["movie_pic"]
    // 將索引中物件裡的圖片名稱抓出來
    console.log(prepicindex);
    prepic.setAttribute("src", '../pic/film_upload/' + prepicindex)


    // 抓到當筆資料SID,SQL記得要加撈SID
    let prepicsid = film_data.f_data[k]["sid"]
    // 根據得到的SID值將圖片上的連結導向電影介紹串接API
    filmfancybox.setAttribute("href", "film_data_preview.php?sid=" + prepicsid)
    currentfilmsid = prepicsid
})
console.log(currentfilmsid)


// 電影下拉選單
fetch("Roy_datalist_api.php")
    .then(response => response.json())
    .then(json => {
        film_data = json;
        // 文章內容匯入
        let w_film_str = '';
        for (let v of film_data.f_data) {
            w_film_str += w_film_func(v);
        }
        w_film.innerHTML = w_film_str;
    })

// 下拉選單換後選到對應值後寫入HTML
w_film.addEventListener("change", event => {
    card_name.innerHTML = w_film.value;
})

// CHANGE只能針對INPUT事件有效，圖片SRC改變不會有反應，因此不能直接選圖片ID偵測
$("#w_film").on("change", function() {
    $("#filmfancybox").removeClass("d-none");
})


// 控制FANCYBOX，用來塞電影圖片點開預覽戲院電影相關資訊
$(".fancyboxiframe").fancybox({
    "fitToView": false,
    "autoSize": false,
    'transitionIn': 'none',
    'transitionOut': 'none',
    'type': 'iframe',

    // 要控制FANCYBOX CSS要用下面的方式，在上面寫用括號或沒括號"WIDTH:XXX"無效
    iframe: {
        css: {
            height: '1000px',
        }
    }
})


// // 抓到所選電影CHANGE對應到的索引值
// w_film.addEventListener('change', catchPicture)

// function catchPicture() {
//     console.log('maybe')
//     for (let i = 0; i < w_film.childNodes.length; i++) {
//         var aa = "";
//         if (w_film.childNodes[i].selected == true) {

//             console.log('enter');
//             return console.log(i)
//         }
//         console.log('no enter');

//     }
// }


const film_rate = document.querySelector("#film_rate")
const cinema_rate = document.querySelector("#cinema_rate")
const font_star = document.querySelectorAll(".font_star")
const cinema_push_count = document.querySelector("#cinema_push_count")


// 產生10顆星星HTML
for (let font_star_num = 0; font_star_num < 10; font_star_num++) {
    // 要家FLEXFILL增加感應區
    $(".font_star").append("<span class='fas fa-star flex-fill'></span>")
}


var f_rate;
var c_rate;
var f_rate_count = 0
var c_rate_count = 0


// 先在外面下全域接值
// 評分系統

//上層 進入的當下與前面所有的變色，綜合寫法
// 電影&戲院
$(".starbox2 span, .starbox5 span").mouseenter(function() {
    // $(this).css("color","lightblue")
    $(this).css("color", "#ffee58").prevAll().css("color", "#ffee58")
})

// 中間層
// 電影
$(".starbox2 span").mouseenter(function() {
    // $(this).css("color","lightblue")
    $(".starbox3 span").css("color", "lightblue")
})
// 戲院
$(".starbox5 span").mouseenter(function() {
    // $(this).css("color","lightblue")
    $(".starbox6 span").css("color", "lightblue")
})

// 上層
// 電影&戲院
$(".starbox2 span, .starbox5 span").mouseleave(function() {
    $(this).css("color", "transparent")
})

// 中間層
// 電影
$(".starbox2 span").mouseleave(function() {
    $(".starbox3 span").css("color", "transparent")
})
// 戲院
$(".starbox5 span").mouseleave(function() {
    $(".starbox6 span").css("color", "transparent")
})

// 上層離開整個大外框變色
// 電影
$(".starbox2").mouseleave(function() {
    $(".starbox2 span").css("color", "transparent")

})
// 上層離開整個大外框變色
// 戲院
$(".starbox5").mouseleave(function() {
    $(".starbox5 span").css("color", "transparent")

})


// 下層
// 電影
$(".starbox2 span").click(function() {
    f_rate = $(this).index();
    // 點選後回傳是第幾顆星
    f_rate_count = f_rate + 1
    console.log(f_rate_count)
    film_rate.value = f_rate_count;
    // 把值抓到外面倒到外面ID下面的VALUE可作INPUT

    // console.log(f_rate_count)
    $(".starbox span").eq(f_rate).css("color", "green").prevAll().css("color", "green")
    // 點擊的當下與其先前的變色，綜合寫法
    $(".starbox span").eq(f_rate).nextAll().css("color", "lightblue")
    // 同時點擊的之後全變回綠合併寫法
})

// 下層
// 戲院
$(".starbox5 span").click(function() {
    c_rate = $(this).index();
    // 點選後回傳是第幾顆星
    c_rate_count = c_rate + 1
    console.log(c_rate_count)
    cinema_rate.value = c_rate_count;
    // 把值抓到外面倒到外面ID下面的VALUE可作INPUT

    // console.log(c_rate_count)
    $(".starbox4 span").eq(c_rate).css("color", "green").prevAll().css("color", "green")
    // 點擊的當下與其先前的變色，綜合寫法
    $(".starbox4 span").eq(c_rate).nextAll().css("color", "lightblue")
    // 同時點擊的之後全變回綠合併寫法
})

// 戲院移入愛心變色
$(".heartbox2 i").hover(function() {
    $(".heartbox1 i").toggleClass("active")
})
// 戲院移入愛心變色，回傳TRUE FALSE
$(".heartbox2 i").click(function() {
    $(this).toggleClass("heartbox2pink")

    // 抓TRUE FALSE送回表單INPUT
    var cinemafav = $("#cinema_push_count").prop("checked")
    // 讓TRUE的反義在每次CLICK丟回去取代來切換TRUE FALSE
    cinemafav = !cinemafav
    // 每次點將值帶入
    $(".cinemacheck :checkbox").prop("checked", cinemafav)
    // 確認目前為TRUE OR FALSE

    // console.log(cinemafav)
    cinema_push_countX.value = cinemafav;
    // console.log(cinema_push_countX)
})


// 電影入愛心變色
$(".heartbox4 i").hover(function() {
    $(".heartbox3 i").toggleClass("active")
})
// 電影入愛心變色，回傳TRUE FALSE
$(".heartbox4 i").click(function() {
    $(this).toggleClass("heartbox2pink")

    // 抓TRUE FALSE送回表單INPUT
    var filmfav = $("#film_fav_count").prop("checked")
    // 讓TRUE的反義在每次CLICK丟回去取代來切換TRUE FALSE
    filmfav = !filmfav
    // 每次點將值帶入
    $(".filmcheck :checkbox").prop("checked", filmfav)
    // 確認目前為TRUE OR FALSE

    console.log(filmfav)
    film_fav_countX.value = filmfav;
    // console.log(film_fav_countX);
})



// 暴雷閃電變色
$(".thunderbox2 i").hover(function() {
    $(".thunderbox1 i").toggleClass("active")
})
// 暴雷閃電變色，回傳TRUE FALSE
$(".thunderbox2 i").click(function() {
    $(this).toggleClass("thunderbox2pink")

    // 抓TRUE FALSE送回表單INPUT
    var spoilersconfirm = $("#re_spoilers").prop("checked")
    // 讓TRUE的反義在每次CLICK丟回去取代來切換TRUE FALSE
    spoilersconfirm = !spoilersconfirm
    // 每次點將值帶入
    $(".spoilerscheck :checkbox").prop("checked", spoilersconfirm)
    // 確認目前為TRUE OR FALSE

    console.log(spoilersconfirm)
    re_spoilersX.value = spoilersconfirm;
    console.log(re_spoilersX);
})

// 點TEXT AREA增加列高
$("textarea.textrowgrow").on({
    focus: function() {
        $(this).attr("rows", "10");
    },
    blur: function() {
        $(this).attr("rows", "4");
    }
})
</script>
<?php include __DIR__ . './foot.php'?>