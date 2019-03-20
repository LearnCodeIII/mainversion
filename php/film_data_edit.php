<?php

// 這份 底下HTML的 修改時要顯示的內容值還沒有改完 value="<?= $row['name_en']
require __DIR__.'/PDO.php';
$page_name='film_data_edit';

$sid=isset($_GET['sid'])?intval($_GET['sid']):0;

$sql="SELECT * FROM film_primary_table WHERE sid=$sid";

$stamt=$pdo->query($sql);
if ($stamt->rowCount()==0) {
    header('Location: film_data_list.php');
    exit;
}
$row = $stamt->fetch(PDO::FETCH_ASSOC);

include __DIR__.'./head.php';
include __DIR__.'./nav.php';
include __DIR__.'./film_sidenav.php';
?>
<style>
    .form-group small {
        color: red !important;
    }
</style>


<section class="dashboard">

    <div class="row">
        <div class="col-lg-12 col-md-6">

            <div id="info_bar" class="alert alert-success" role="alert" style="display:none">
            </div>

            <div class="card">

                <h5 class="card-title">修改資料
                </h5>
                <div class="card-body">
                    <form name="form1" method="post" onsubmit="return checkForm();">
                        <input type="hidden" name="checkme" value="check123">
                        <input type="hidden" name="sid" value="<?= $row['sid']?>">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">

                                <div class="form-group">
                                    <label for="name_tw">電影中文</label>
                                    <input type="text" class="form-control" id="name_tw" name="name_tw" placeholder=""
                                        value="<?= $row['name_tw']?>">
                                    <small id="name_twHelp" class="form-text text-muted"></small>
                                </div>

                                <div class="form-group">
                                    <label for="name_en">電影英文</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder=""
                                        value="<?= $row['name_en']?>">
                                    <small id="name_enHelp" class="form-text text-muted"></small>
                                </div>

                                <div class="form-group">
                                    <label for="intro_tw">電影介紹中文</label>
                                    <textarea class="form-control" id="intro_tw" name="intro_tw" cols="30"
                                        rows="3"><?= $row['intro_tw']?></textarea>
                                    <small id="intro_twHelp" class="form-text text-muted"></small>
                                </div>

                                <div class="form-group">
                                    <label for="intro_en">電影介紹英文</label>
                                    <textarea class="form-control" id="intro_en" name="intro_en" cols="30"
                                        rows="3"><?= $row['intro_en']?></textarea>
                                    <small id="intro_enHelp" class="form-text text-muted"></small>
                                </div>

                                <label for="movie_pic">電影圖</label>
                                <div class="custom-file form-group">
                                    <input type="file" class="custom-file-input" id="movie_pic" name="movie_pic"
                                        accept="image/*" onchange="loadFile(event)">
                                    <label class="custom-file-label" for="customFile" data-browse="上傳檔案">選擇檔案</label>
                                    <small id="movie_picHelp" class="form-text text-muted"></small>
                                    <div class="overflow-hidden" width="200px" height="200px">
                                        <img id="output" src="../pic/film_upload/<?= $row['movie_pic']?>" alt="">
                                    </div>
                                </div>


                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label for="movie_genre">電影類別</label>
                                    <input type="text" class="form-control" id="movie_genre" name="movie_genre"
                                        placeholder="" value="<?= $row['movie_genre']?>">
                                    <small id="movie_genreHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="movie_ver">放映類型</label>
                                    <select class="custom-select" id="movie_ver" name="movie_ver">
                                        <option value="4DX">4DX</option>
                                        <option value="IMAX">IMAX</option>
                                        <option value="3D">3D</option>
                                        <option value="數位2D">數位2D</option>
                                    </select>
                                    <small id="movie_verHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="movie_rating">電影分級</label>
                                    <select class="custom-select" id="movie_rating" name="movie_rating">
                                        <option value="普遍級">普遍級</option>
                                        <option value="保護級">保護級</option>
                                        <option value="輔導級">輔導級</option>
                                        <option value="限制級">限制級</option>
                                    </select>
                                    <small id="movie_ratingHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="trailer">預告片</label>
                                    <input type="text" class="form-control" id="trailer" name="trailer" placeholder=""
                                        value="<?= $row['trailer']?>">
                                    <small id="trailerHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="pirce">價格</label>
                                    <input type="text" class="form-control" id="pirce" name="pirce" placeholder=""
                                        value="<?= $row['pirce']?>">
                                    <small id="pirceHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="schedule">檔期</label>
                                    <input type="text" class="form-control" id="schedule" name="schedule" placeholder=""
                                        value="<?= $row['schedule']?>">
                                    <small id="scheduleHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="in_theaters">上映日期</label>
                                    <input type="text" class="form-control" id="in_theaters" name="in_theaters"
                                        placeholder="YYYY-MM-DD" value="<?= $row['in_theaters']?>">
                                    <small id="in_theatersHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="out_theaters">下檔日期</label>
                                    <input type="text" class="form-control" id="out_theaters" name="out_theaters"
                                        placeholder="YYYY-MM-DD" value="<?= $row['out_theaters']?>">
                                    <small id="out_theatersHelp" class="form-text text-muted"></small>
                                </div>


                            </div>

                            <div class="col-lg-4 col-md-4">

                                <div class="form-group">
                                    <label for="runtime">片長</label>
                                    <input type="text" class="form-control" id="runtime" name="runtime"
                                        placeholder="多少分鐘" value="<?= $row['runtime']?>">
                                    <small id="runtimeHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="director_tw">導演中文</label>
                                    <input type="text" class="form-control" id="director_tw" name="director_tw"
                                        placeholder="" value="<?= $row['director_tw']?>">
                                    <small id="director_twHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="director_en">導演英文</label>
                                    <input type="text" class="form-control" id="director_en" name="director_en"
                                        placeholder="" value="<?= $row['director_en']?>">
                                    <small id="director_enHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="country">發行國家</label>
                                    <input type="text" class="form-control" id="country" name="country" placeholder=""
                                        value="<?= $row['country']?>">
                                    <small id="countryHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="subtitle">提供字幕</label>
                                    <select class="custom-select" id="subtitle" name="subtitle">
                                        <option value="是">是</option>
                                        <option value="否">否</option>
                                    </select>
                                    <!-- <input type="text" class="form-control" id="subtitle" name="subtitle"
                                        placeholder="是/否" value=""> -->
                                    <small id="subtitleHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="subtitle_lang">字幕語言</label>
                                    <input type="text" class="form-control" id="subtitle_lang" name="subtitle_lang"
                                        placeholder="" value="<?= $row['subtitle_lang']?>">
                                    <small id="subtitle_langHelp" class="form-text text-muted"></small>
                                </div>

                            </div>

                        </div>

                        <button id="submit_btn" type="submit" class="btn btn-primary btn-block">送出</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>



<script>

    const info_bar = document.querySelector('#info_bar');
    const submit_btn = document.querySelector('#submit_btn');

    const fields = [
        'name_tw',
        'name_en',
        'intro_tw',
        'intro_en',
        'movie_genre',
        'movie_ver',
        'movie_rating',
        'trailer',
        'pirce',
        'schedule',
        'in_theaters',
        'out_theaters',
        'runtime',
        'director_tw',
        'director_en',
        'country',
        'subtitle',
        'subtitle_lang'

    ];


    //拿每個欄位的參照
    const fs = {};
    for (let v of fields) {
        fs[v] = document.form1[v];
    }
    console.log(fs);
    console.log('fs.name_tw:', fs.name_tw);

    const checkForm = () => {

        let isPassed = true;

        //拿每個欄位的值
        const fsv = {};
        for (let v of fields) {
            fsv[v] = fs[v].value;
        }
        console.log(fsv);

        // let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        // let mobile_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;

        for (let v of fields) {
            fs[v].style.borderColor = '#cccccc';
            document.querySelector('#' + v + 'Help').innerHTML = '';

        }

        // if (fsv.name.length < 2) {
        //     fs.name.style.borderColor = 'red';
        //     document.querySelector('#nameHelp').innerHTML = '請填寫正確的 name!';
        //     isPassed = false;
        // }

        // if (!mobile_pattern.test(fsv.selfphone)) {
        //     fs.selfphone.style.borderColor = 'red';
        //     document.querySelector('#selfphoneHelp').innerHTML = '請填寫正確的 selfphone!';
        //     isPassed = false;
        // }

        // if (!email_pattern.test(fsv.email)) {
        //     fs.email.style.borderColor = 'red';
        //     document.querySelector('#emailHelp').innerHTML = '請填寫正確的 Email!';
        //     isPassed = false;

        // }

        if (isPassed) {
            let form = new FormData(document.form1);

            // submit_btn.style.display = 'none';

            fetch('film_data_edit-api.php', {
                method: 'POST',
                body: form
            })
                .then(response => response.json())
                .then(obj => {
                    console.log(obj);

                    info_bar.style.display = 'block';

                    if (obj.success) {
                        info_bar.className = 'alert alert-success';
                        info_bar.innerHTML = '資料修改成功惹';
                    } else {
                        info_bar.className = 'alert alert-danger';
                        info_bar.innerHTML = obj.errorMsg;
                    }
                    submit_btn.style.display = 'block';
                });
        }

        return false;
    };

    //上傳圖片顯示檔案名
    $(document).ready(function () {
        bsCustomFileInput.init();
    })

    //上傳圖片前預覽
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };



    //匯入資訊 對比資料庫資料值入selected
    // array.forEach(element => {

    // });
    // if (movie_ver.options[0].selected ==) {
    //     movie_ver.options[0].selected = true;
    // }

    // const gotop = () => {
    //     location.href = './film_data_edit.php';
    // }

    // movie_ver.options[0].selected = true
    // true


    // const siteid = [
    //     'movie_ver',
    //     'movie_rating',
    //     'subtitle',
    // ];

    // function setOption(selectElement, value) {
    //     var options = selectElement.options;
    //     for (var i = 0, optionsLength = options.length; i < optionsLength; i++) {
    //         if (options[i].value == value) {
    //             selectElement.selectedIndex = i;
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    // siteid.forEach(function (element) {
    //     setOption(
    //         // document.querySelector('select[name=element]'),
    //         "<?php echo $sid; ?>"
    //     );
    // });


</script>

<?php include __DIR__.'./foot.php'?>