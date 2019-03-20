<?php
$pagename = "pageMain";

include __DIR__ . '/PDO.php';

?>
<?php include __DIR__ . './head.php'?>
<?php include __DIR__ . './nav.php'?>
<?php include __DIR__ . './Roysidenav.php'?>

<section class="dashboard">
    <div class="container-fluid ">
        <div class="row justify-content-center">
            <div class="col-lg-6 ">
                <div id="info_bar" class="alert alert-success" role="alert">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="col-lg-6 py-4 px-4 bg-light">
                <div class="media">
                    <div id="review_body" class="media-body">

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
let sid = parseInt(location.href.slice(57));
// 需要根據不同路徑更改SLICE數量
let ori_data;
const review_body = document.querySelector('#review_body');

// 掛載UNDERSCORE自動生成帶入內容
const tr_str = ` <h5 class="mt-3 mb-3 border-bottom"><%=headline%></h5>                   
                <%=review%>
                <p class="mt-3 mb-3">發布日期:<%=i_date%></p>
                <p class="mt-3 mb-3">觀看日期:<%=w_date%></p>
                <p class="mt-3 mb-3">觀看戲院:<%=w_cinema%></p>
                <p class="mt-3 mb-3">電影評價:<%=film_rate%></p>
               `


const tr_func = _.template(tr_str);


// review_body.innerHTML = tr_func

// 文章匯入

// 如為空值就會顯示錯誤
if (!isNaN(sid)) {
    fetch('Roy_datapreview_api.php?sid=' + sid)
        .then(response => response.json())
        .then(obj => {
            // 將API的JOSN回傳成OBJ

            console.log(obj.data);
            let str = '';
            // 將OBJ內DATA的值撈出來代入tr_func
            for (let v of obj.data) {
                str = tr_func(v);
            }
            review_body.innerHTML = str;
            
            if (obj.success) {
                info_bar.className = 'alert alert-success';
                info_bar.innerHTML = '資料讀取成功';
            } else {
                info_bar.className = 'alert alert-danger';
                info_bar.innerHTML = obj.errorMsg;
            }
        });
} else {
    info_bar.className = 'alert alert-danger';
    info_bar.innerHTML = '無此筆資料';
}

// fetch('Roy_datapreview_api.php?sid=' + sid )
//     .then(response => response.json())
//     .then(json => {
//         ori_data = json;
//         console.log(ori_data);

//         // 資料內容的表格
//         // let str = '';
//         // str = tr_func(ori_data.data);
//         // data_body.innerHTML = str;
//     });


// })
</script>

<?php include __DIR__ . './foot.php'?>