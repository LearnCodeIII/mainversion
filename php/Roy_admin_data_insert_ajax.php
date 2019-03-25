<?php
$pagename = "pageMain";
// include __DIR__ . '/__cred.php';
include __DIR__ . '/PDO.php';

// if($_SESSION["admin"]!=="roy"){
//     header('Location: login.php');
// }

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
<?php include __DIR__ . './nav.php'?>
<?php include __DIR__ . './Roysidenav.php'?>

<head>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.6/tinymce.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    .form-group small {
        color: red !important;
    }

    .stylenone {
        margin: 0 auto;
        padding: 0;
    }
    </style>
</head>
<section class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">發布文章
                        </h5>
                        <form name="form1" method="post" onsubmit="return checkForm();">
                            <input type="hidden" name="checkme" value="check123">
                            <div class="container  px-0 d-flex justify-content-between">
                                <div class="info-box px-0 col-lg-4">
                                    <div class="form-group ">
                                        <label for="headline">登入帳號</label>
                                        <input type="text" readonly class="form-control" id="issuer" name="issuer"
                                            placeholder="<?=$k?>" value="<?=$k?>">
                                        <small id="headlineHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="w_film">觀看電影</label>
                                        <select class="form-control" id="w_film" name="w_film">
                                            <!-- 表單內容由API串接生成 -->
                                        </select>
                                        <small id="w_filmHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="film_rate">電影評分</label>
                                        <select class="form-control " id="film_rate" name="film_rate">
                                            <option></option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                        </select>
                                        <small id="film_rateHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="film_fav_count">電影最愛</label>
                                        <select class="form-control" id="film_fav_count" name="film_fav_count">
                                            <option></option>
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                        <small id="film_fav_countHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group ">
                                        <label for="w_date">觀看日期</label>
                                        <input type="text" class="form-control" id="w_date" name="w_date" placeholder=""
                                            value="">
                                        <small id="w_dateHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="info-box px-0 col-lg-4">
                                    <div class="form-group">
                                        <label for="re_spoilers">是否爆雷</label>
                                        <select class="form-control" id="re_spoilers" name="re_spoilers">
                                            <!-- 表單要下NAME，是抓NAME為參數值 -->
                                            <option></option>
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                        <small id="re_spoilersHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group ">
                                        <label for="w_cinema">觀看戲院</label>
                                        <select class="form-control" id="w_cinema" name="w_cinema">
                                            <!-- 表單內容由API串接生成 -->
                                        </select>
                                        <small id="w_cinemaHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="cinema_rate">戲院評分</label>
                                        <select class="form-control" id="cinema_rate" name="cinema_rate">
                                            <option></option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                        </select>
                                        <small id="cinema_rateHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="cinema_push_count">戲院最愛</label>
                                        <select class="form-control" id="cinema_push_count" name="cinema_push_count">
                                            <option></option>
                                            <option>是</option>
                                            <option>否</option>
                                        </select>
                                        <small id="cinema_push_countHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="pic-pre px-0 col-lg-3 d-flex justify-content-center">
                                    <div class="card border-0" style="width: 18rem; ">
                                        <div class=" text-center ">
                                            <h5 class="card-title card_name">Card title</h5>
                                        </div>
                                        <img src="./dr-strange.jpg" class="card-img-top stylenone" alt=""
                                            style="width: 12rem;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="headline">影評標題</label>
                                <input type="text" class="form-control" id="headline" name="headline" placeholder=""
                                    value="">
                                <small id="headlineHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group ">
                                <label for="review">電影評論</label>
                                <!-- <textarea class="form-control" id="review" name="review" cols="30" rows="3"></textarea> -->
                                <textarea class="form-control" name="review" id="review" cols="30" rows="3"></textarea>
                                <small id="reviewHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group ">
                                <label for="cinema_comment">戲院評論</label>
                                <textarea class="form-control" name="cinema_comment" id="cinema_comment" cols="30"
                                    rows="3"></textarea>
                                <small id="reviewHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="intro_pic ">圖片</label>
                                <figure>
                                    <img id="myimg" src="" alt="" width="200px">
                                </figure>
                                <!-- 如果不換圖片無法提交的BUG -->
                                <input type="file" class="form-control" id="intro_pic" name="intro_pic" placeholder=""
                                    value="">
                                <small id="intro_picHelp" class="form-text text-muted"></small>
                            </div>

                            <button id="submit_btn" type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>




    </div>
</section>

<script>
// 上傳檔案
const myimg = document.querySelector("#myimg");
const intro_pic = document.querySelector("#intro_pic");








intro_pic.addEventListener("change", event => {
    // 當偵測到有變更後，觸發箭頭韓式EVENT
    //console.log(event.target);
    const fd = new FormData();

    fd.append('intro_pic', intro_pic.files[0]);
    fetch('Roy_data_insert_api.php', {
            // 將轉碼也寫在同隻API
            method: 'POST',
            body: fd
        })
        .then(response => response.json())
        .then(obj => {
            console.log(obj);
            myimg.setAttribute('src', '../pic/forum/' + obj.filename);
            // 要指定好變更後的路徑
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
    're_spoilers'
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
    let rate_pattern = /^[1-9]$|^[1][0]$/;
    // 喜好限制
    let fav_pattern = /^[0-1]$/;

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
    if (!rate_pattern.test(fsv.film_rate)) {
        fs.film_rate.style.borderColor = 'red';
        document.querySelector('#film_rateHelp').innerHTML = '請輸入正確區間!';
        isPassed = false;
    }

    // TODO 如果不想必檢查的方式
    // if (!fav_pattern.test(fsv.fav)) {
    //     fs.fav.style.borderColor = 'red';
    //     document.querySelector('#favHelp').innerHTML = '請輸入正確值!';
    //     isPassed = false;
    // }




    if (isPassed) {

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
                    // func = () => {
                    //     location.href = "Roy_datalist.php";
                    // }
                    // setTimeout(() => {
                    //     func();
                    // }, 5000);
                } else {
                    info_bar.className = 'alert alert-danger';
                    info_bar.innerHTML = obj.errorMsg;
                }
                submit_btn.style.display = 'block';
            });
    }
    return false;
};

// 戲院下拉選單
let cinema_data;
const cinema_rate = document.querySelector('#w_cinema');
const cinema_str = `<option><%=name%></option>`
const cinema_func = _.template(cinema_str);

fetch("Roy_datalist_api.php")
    .then(response => response.json())
    .then(json => {
        cinema_data = json;
        console.log(cinema_data);

        // 文章內容匯入
        let cinema_str = '';
        for (let v of cinema_data.c_data) {
            // 取API中C_DATA資料
            cinema_str += cinema_func(v);
        }
        cinema_rate.innerHTML = cinema_str;
    })

// 電影下拉選單
let film_data;
const w_film = document.querySelector('#w_film');
const w_film_str = `<option><%=name_tw%></option>`
const w_film_func = _.template(w_film_str);

fetch("Roy_datalist_api.php")
    .then(response => response.json())
    .then(json => {
        film_data = json;
        console.log(film_data.f_data);

        // 文章內容匯入
        let w_film_str = '';
        for (let v of film_data.f_data) {
            w_film_str += w_film_func(v);
        }
        w_film.innerHTML = w_film_str;
    })


const card_name = document.querySelector('.card_name');
w_film.addEventListener("change", event => {
    card_name.innerHTML = w_film.value;
})



// 抓到所選電影CHANGE對應到的索引值
w_film.addEventListener('change',catchPicture)
        function catchPicture(){
            console.log('maybe')
            for (let i = 0; i < w_film.childNodes.length; i++) {
                var aa = "";
                if (w_film.childNodes[i].selected == true) {

                    console.log('enter');
                    return console.log(i)
                }
                console.log('no enter');
            
            }
        }

</script>
<?php include __DIR__ . './foot.php'?>