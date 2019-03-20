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
            <div class="col-lg-12">
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
                                <label for="headline"><span class="text-danger">*</span>文章標題</label>
                                <input type="text" class="form-control" id="headline" name="headline" placeholder=""
                                    value="">
                                <small id="headlineHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="review"><span class="text-danger">*</span>文章內容</label>
                                <!-- <textarea class="form-control" id="review" name="review" cols="30" rows="3"></textarea> -->
                                <textarea class="form-control" name="review" id="review" ></textarea>
                                <small id="reviewHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="w_date"><span class="text-danger">*</span>觀看日期</label>
                                <input type="text" class="form-control" id="w_date" name="w_date"
                                    placeholder="YYYY-MM-DD" value="">
                                <small id="w_dateHelp" class="form-text text-muted"></small>
                            </div>
                            <!-- 無效 -->
                            <!-- <div class="form-group">
                                <label for="i_date">發布時間</label>
                                <input type="text" class="form-control" id="i_date" name="i_date"
                                    placeholder="YYYY-MM-DD" value="">
                                <small id="w_dateHelp" class="form-text text-muted"></small>
                            </div> -->
                            <div class="form-group">
                                <label for="w_cinema">觀看戲院</label>
                                <input type="text" class="form-control" id="w_cinema" name="w_cinema" placeholder=""
                                    value="">
                                <small id="w_cinemaHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="film_rate">電影評分</label>
                                <input type="text" class="form-control" id="film_rate" name="film_rate"
                                    placeholder="0-10" value="">
                                <small id="film_rateHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="fav">我的最愛</label>
                                <input type="text" class="form-control" id="fav" name="fav" placeholder="0-1" value="">
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
    // 'i_date',無效
    'w_cinema',
    'film_rate',
    'fav',
];

ClassicEditor
    .create(document.querySelector('#review'))
    .catch(error => {
        console.error(error);
    });


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
    if (!fav_pattern.test(fsv.fav)) {
        fs.fav.style.borderColor = 'red';
        document.querySelector('#favHelp').innerHTML = '請輸入正確值!';
        isPassed = false;
    }


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
                    info_bar.innerHTML = '資料新增成功，五秒後自行轉跳';
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
    }
    return false;
};
</script>
<?php include __DIR__ . './foot.php'?>