<?php
$pagename = "pageMain";

include __DIR__ . '/PDO.php';

?>
<?php include __DIR__ . './head.php'?>
<?php include __DIR__ . './nav.php'?>
<?php include __DIR__ . './Roysidenav.php'?>
<style>
.form-group small {
    color: red !important;
}
</style>
<section class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">發布文章
                        </h5>
                        <p>
                             <span class="text-danger">*</span>為必填欄位
                        </p>
                        <form name="form1" method="post" onsubmit="return checkForm();">
                            <input type="hidden" name="checkme" value="check123">
                            <div class="form-group">
                            <!-- TODO 星號沒有變紅色 -->
                            <label for="headline"><span class="text-danger">*</span>文章標題</label>
                                <input type="text" class="form-control" id="headline" name="headline" placeholder="" value="">
                                <small id="headlineHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="review"><span class="text-danger">*</span>文章內容</label>
                                <textarea class="form-control" id="review" name="review" cols="30" rows="3"></textarea>
                                <small id="reviewHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="w_date"><span class="text-danger">*</span>觀看日期</label>
                                <input type="text" class="form-control" id="w_date" name="w_date" placeholder="YYYY-MM-DD"
                                    value="">
                                <small id="w_dateHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="w_cinema">觀看戲院</label>
                                <input type="text" class="form-control" id="w_cinema" name="w_cinema"
                                    placeholder="" value="">
                                <small id="w_cinemaHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="film_rate">電影評分</label>
                                <input type="text" class="form-control" id="film_rate" name="film_rate"
                                    placeholder="" value="">
                                <small id="film_rateHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="fav">我的最愛</label>
                                <input type="text" class="form-control" id="fav" name="fav"
                                    placeholder="" value="">
                                <small id="favHelp" class="form-text text-muted"></small>
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
const info_bar = document.querySelector('#info_bar');
const submit_btn = document.querySelector('#submit_btn');
const fields = [
    'headline',
    'review',
    'w_date',
    'w_cinema',
    'film_rate',
    'fav',
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


    let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    let mobile_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;

    for (let v of fields) {
        fs[v].style.borderColor = '#cccccc';
        document.querySelector('#' + v + 'Help').innerHTML = '';
    }

    if (fsv.headline.length > 20) {
        fs.headline.style.borderColor = 'red';
        document.querySelector('#headlineHelp').innerHTML = '請勿輸入超過20個字!';

        isPassed = false;
    }
    // if (!email_pattern.test(fsv.review)) {
    //     fs.review.style.borderColor = 'red';
    //     document.querySelector('#reviewHelp').innerHTML = '請填寫正確的 review!';
    //     isPassed = false;
    // }
    // if (!mobile_pattern.test(fsv.w_date)) {
    //     fs.w_date.style.borderColor = 'red';
    //     document.querySelector('#w_dateHelp').innerHTML = '請填寫正確的手機號碼!';
    //     isPassed = false;
    // }


    if (isPassed) {
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
                } else {
                    info_bar.className = 'alert alert-danger';
                    info_bar.innerHTML = obj.errorMsg;
                }
                submit_btn.style.display = 'block';
            });
    }
    return false;
};
</script>
<?php include __DIR__ . './foot.php'?>