<?php

require __DIR__.'/PDO.php';
$page_name='film_data_preview';

$sid=isset($_GET['sid'])?intval($_GET['sid']):0;

$sql="SELECT * FROM film_primary_table WHERE sid=$sid";

$stamt=$pdo->query($sql);
$row = $stamt->fetch(PDO::FETCH_ASSOC);


// if ($stamt->rowCount()==0) {
//     header('Location: film_main.php');
//     exit;
// }

include __DIR__.'./head.php';
include __DIR__.'./nav.php';
include __DIR__.'./sidenav.php';
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

                <div class="card-header card-title">
                    <h3>個別電影資訊一覽</h3>
                </div>

                <div class="card-body">
                    <form name="form1" method="post" onsubmit="return checkForm();">
                        <input type="hidden" name="checkme" value="check123">
                        <input type="hidden" name="sid" value="<?= $row['sid']?>">

                        <div class="row">
                            <div class="col-lg-4 col-md-4">

                                <div class="form-group">
                                    <label for="name_tw" class="mt-2">
                                        <h4>電影名稱(中文)：</h4>
                                    </label>
                                    <p><?= $row['name_tw']?></p>
                                    <label for="name_en" class="mt-2">
                                        <h4>電影名稱英文</h4>
                                    </label>
                                    <p><?= $row['name_en']?></p>

                                    <label for="movie_pic" class="mt-2">
                                        <h4>電影海報</h4>
                                    </label>
                                    <div class="overflow-hidden" object-fit="cover">
                                        <img width="300px" height="450px" id="output"
                                            src="../pic/film_upload/<?= $row['movie_pic']?>" alt="">
                                    </div>
                                    <label for="intro_tw" class="mt-2">
                                        <h4>電影介紹中文</h4>
                                    </label>
                                    <div class="card-body">
                                        <p><?= $row['intro_tw']?></p>
                                    </div>
                                    <label for="intro_en" class="mt-2">
                                        <h4>電影介紹英文</h4>
                                    </label>
                                    <div class="card-body">
                                        <p><?= $row['intro_en']?></p>
                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">

                                    <label for="trailer" class="mt-2">
                                        <h4>預告片</h4>
                                    </label>
                                    <div class="">
                                        <iframe width="550" height="305" src="<?= $row['trailer']?>" frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    </div>

                                    <label for="movie_genre" class="mt-2">
                                        <h4>電影類別</h4>
                                    </label>
                                    <div
                                        class="col-lg-12 d-flex flex-wrap justify-content-lg-start justify-content-md-center ">

                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type1" name="chk[]"
                                                value="動作片" onclick="check(this,'all','chk[]')">
                                            <label name="sid" class="custom-control-label" for="type1">動作片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type2" name="chk[]"
                                                value="動畫片" onclick="check(this,'all','chk[]')">
                                            <label name="sid" class="custom-control-label" for="type2">動畫片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type3" name="chk[]"
                                                value="喜劇片" onclick="check(this,'all','chk[]')">
                                            <label name="name" class="custom-control-label" for="type3">喜劇片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type4" name="chk[]"
                                                value="偵探片" onclick="check(this,'all','chk[]')">
                                            <label name="nickname" class="custom-control-label" for="type4">偵探片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type5" name="chk[]"
                                                value="紀錄片" onclick="check(this,'all','chk[]')">
                                            <label name="gender" class="custom-control-label" for="type5">紀錄片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type6" name="chk[]"
                                                value="戲劇片" onclick="check(this,'all','chk[]')">
                                            <label name="age" class="custom-control-label" for="type6">戲劇片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type7" name="chk[]"
                                                value="英雄片" onclick="check(this,'all','chk[]')">
                                            <label name="birthday" class="custom-control-label" for="type7">英雄片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type8" name="chk[]"
                                                value="恐怖片" onclick="check(this,'all','chk[]')">
                                            <label name="email" class="custom-control-label" for="type8">恐怖片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type9" name="chk[]"
                                                value="武俠片" onclick="check(this,'all','chk[]')">
                                            <label name="email" class="custom-control-label" for="type9">武俠片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type10" name="chk[]"
                                                value="靈異片" onclick="check(this,'all','chk[]')">
                                            <label name="email" class="custom-control-label" for="type10">靈異片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type11" name="chk[]"
                                                value="文藝片" onclick="check(this,'all','chk[]')">
                                            <label name="email" class="custom-control-label" for="type11">文藝片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type12" name="chk[]"
                                                value="警匪片" onclick="check(this,'all','chk[]')">
                                            <label name="email" class="custom-control-label" for="type12">警匪片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type13" name="chk[]"
                                                value="科幻片" onclick="check(this,'all','chk[]')">
                                            <label name="email" class="custom-control-label" for="type13">科幻片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type14" name="chk[]"
                                                value="懸疑片" onclick="check(this,'all','chk[]')">
                                            <label name="email" class="custom-control-label" for="type14">懸疑片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type15" name="chk[]"
                                                value="驚悚片" onclick="check(this,'all','chk[]')">
                                            <label name="email" class="custom-control-label" for="type15">驚悚片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type16" name="chk[]"
                                                value="戰爭片" onclick="check(this,'all','chk[]')">
                                            <label name="email" class="custom-control-label" for="type16">戰爭片</label>
                                        </div>
                                        <div
                                            class="col-lg-3 col-md-2 custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="type17" name="chk[]"
                                                value="愛情片" onclick="check(this,'all','chk[]')">
                                            <label name="email" class="custom-control-label" for="type17">愛情片</label>
                                        </div>
                                    </div>


                                    <label for="movie_ver" class="mt-2">
                                        <h4>放映類型</h4>
                                    </label>
                                    <select class="custom-select " disabled id="movie_ver" name="movie_ver">
                                        <option value="4DX">4DX</option>
                                        <option value="IMAX">IMAX</option>
                                        <option value="3D">3D</option>
                                        <option value="數位2D">數位2D</option>
                                    </select>


                                    <label for="movie_rating" class="mt-2">
                                        <h4>電影分級</h4>
                                    </label>
                                    <select disabled class="custom-select" id="movie_rating" name="movie_rating">
                                        <option value="普遍級">普遍級</option>
                                        <option value="保護級">保護級</option>
                                        <option value="輔導級">輔導級</option>
                                        <option value="限制級">限制級</option>
                                    </select>


                                    <div class="row">

                                        <div class="col-3">
                                            <label for="pirce" class="mt-2">
                                                <h4>價格</h4>
                                            </label>
                                            <p type="date"><?= $row['pirce']?></p>
                                        </div>
                                        <div class="col-3">
                                            <label for="schedule" class="mt-2">
                                                <h4>檔期</h4>
                                            </label>
                                            <p><?= $row['schedule']?></p>
                                        </div>
                                        <div class="col-3">
                                            <label for="in_theaters" class="mt-2">
                                                <h4>上映日期</h4>
                                            </label>
                                            <p><?= $row['in_theaters']?></p>

                                        </div>
                                        <div class="col-3">
                                            <label for="out_theaters" class="mt-2">
                                                <h4>下檔日期</h4>
                                            </label>
                                            <p><?= $row['out_theaters']?></p>
                                        </div>
                                    </div>


                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">


                                    <label for="subtitle" class="mt-2">
                                        <h4>是否提供字幕</h4>
                                    </label>
                                    <select disabled class="custom-select" id="subtitle" name="subtitle">
                                        <option value="是">是</option>
                                        <option value="否">否</option>
                                    </select>

                                    <div class="row justify-content-around">

                                        <div class="col-4">
                                            <label for="subtitle_lang" class="mt-2">
                                                <h4>字幕語言</h4>
                                            </label>
                                            <p><?= $row['subtitle_lang']?></p>
                                        </div>


                                        <div class="col-4">
                                            <label for="runtime" class="mt-2">
                                                <h4>片長</h4>
                                            </label>
                                            <p><?= $row['runtime']?> mins</p>
                                        </div>

                                        <div class="col-4">
                                            <label for="country" class="mt-2">
                                                <h4>發行國家</h4>
                                            </label>
                                            <p><?= $row['country']?></p>
                                        </div>



                                        <div class="col-4">
                                            <label for="director_tw" class="mt-2">
                                                <h4>導演名稱中文</h4>
                                            </label>
                                            <p><?= $row['director_tw']?></p>
                                        </div>

                                        <div class="col-4">
                                            <label for="director_en" class="mt-2">
                                                <h4>導演名稱英文</h4>
                                            </label>
                                            <p><?= $row['director_en']?></p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

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

    //拿checkbox的參照
    let php_row = "<?= $row['movie_genre']; ?>";
    const movie_genres = ['動作片', '動畫片', '喜劇片', '偵探片', '紀錄片', '戲劇片', '英雄片', '恐怖片', '武俠片', '靈異片', '文藝片', '警匪片', '科幻片', '懸疑片', '驚悚片', '戰爭片', '愛情片'];
    for (let i = 0; i < movie_genres.length; i++) {
        if (php_row.indexOf(movie_genres[i]) != -1) {
            document.getElementsByName('chk[]')[i].checked = 'checked';
        }
    }


    //checkbox全選
    function check_all(cName, obj) {
        var checkboxs = document.getElementsByName(cName);
        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].checked = obj.checked;
        }
    }


    //checkbox勾選狀態判斷
    function check(obj, chkall, cName) {
        if (obj.checked == false) {
            document.getElementById(chkall).checked = false;
        } else {
            let checkItem = document.getElementsByName(cName).length;
            let ci = 0;
            for (let i = 0; i < checkItem; i++) {
                if (document.getElementsByName(cName)[i].checked == true) {
                    ci++;
                }
            }
            if (ci == checkItem) {
                document.getElementById(chkall).checked = true;
            }
        }
    }



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
    const siteid = [
        'movie_ver',
        'movie_rating',
        'subtitle',
    ];

    document.querySelector('#movie_ver').value = '<?= $row['movie_ver'] ?>';
    document.querySelector('#movie_rating').value = '<?= $row['movie_rating'] ?>';
    document.querySelector('#subtitle').value = '<?= $row['subtitle'] ?>';



</script>

<?php include __DIR__.'./foot.php'?>