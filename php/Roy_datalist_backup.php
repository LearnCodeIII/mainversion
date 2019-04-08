<?php
$pagename = "Roy_datalist";
include __DIR__ . '/PDO.php';

if (!isset($_SESSION["admin"]) && !isset($_SESSION["member"]) && !isset($_SESSION["theater"])) {
    header('Location: login.php');
}
?>
<?php include __DIR__ . './head.php'?>
<?php include __DIR__ . './sidenav.php'?>

<head>
    <script src="../js/sweet.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js">
    </script>

</head>

<style>
/* .review-content {
    width: 4%;
    表頭欄寬
} */
</style>
<section class="dashboard <?=isset($_SESSION["admin"]) ? "" : "d-none"?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="pagenav">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <nav class="d-flex">
                    <ul class="firstpage pagination pagination-sm">
                    </ul>
                    <ul class="prepage pagination pagination-sm">
                    </ul>
                    <ul class="allpages pagination pagination-sm">
                    </ul>
                    <ul class="nextpage pagination pagination-sm">
                    </ul>
                    <ul class="lastpage pagination pagination-sm">
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row">
            <table class="table  text-center " id="mytable">
                <thead class="  thead-dark table-bordered   ">
                    <tr>
                        <th class="review-content" scope="col">評論編號</th>
                        <th class="review-content" scope="col">全文預覽</th>
                        <th class="review-content" scope="col">編輯</th>
                        <th class="review-content" scope="col">隱藏</th>
                        <th class="review-content" scope="col">刪除</th>
                        <th class="review-content" scope="col">文章點擊</th>
                        <th class="review-content" scope="col">電影</th>
                        <th class="review-content" scope="col">爆雷</th>
                        <th class="review-content" scope="col">電影評分</th>
                        <th class="review-content" scope="col">電影最愛</th>
                        <th class="review-content" scope="col">評論者</th>
                        <th class="review-content" scope="col">標題</th>
                        <th class="review-content" scope="col">影評</th>
                        <th class="review-content" scope="col">檢舉內容</th>
                        <th class="review-content" scope="col">檢舉</th>
                        <th class="review-content" scope="col">文章票數</th>
                        <th class="review-content" scope="col">文章推數</th>
                        <th class="review-content" scope="col">留言數</th>
                        <th class="review-content" scope="col">發布時間</th>
                        <th class="review-content" scope="col">觀看日期</th>
                        <th class="review-content" scope="col">最後修改</th>
                        <th class="review-content" scope="col">觀看戲院</th>
                        <th class="review-content" scope="col">戲院評論</th>
                        <th class="review-content" scope="col">戲院評分</th>
                        <th class="review-content" scope="col">戲院最愛</th>
                    </tr>
                </thead>
                <tbody id="forum_databody" class="thead-light table-bordered">
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
let page = 1;

let ori_data;
const ul_pagi = document.querySelector('.allpages');
const pagenav = document.querySelector('.pagenav');
const ul_first = document.querySelector('.firstpage');
const ul_pre = document.querySelector('.prepage');
const ul_next = document.querySelector('.nextpage');
const ul_last = document.querySelector('.lastpage');
const forum_databody = document.querySelector("#forum_databody");


// 資料TABLE生成
// ?sid=<%=sid%>要加才能選定刪除的sid
// <a href="./Roy_data_delete.php?sid=<%=sid%>"> 不須刪除提醒的寫法
const tr_str = ` <tr>
                    <td><%=sid%></td>
                    <td>
                        <a href="./Roy_datapreview.php?sid=<%=sid%>">
                            <i class="fas fa-eye"></i>
                        </a>

                    </td>
                    <td><a href="./Roy_data_edit.php?sid=<%=sid%>"><i class="far fa-edit"></i></a></td>
                    <td><%=sid%></td>
                    <td>
                        <a href="javascript:delete_it(<%=sid%>)">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                    <td><%=review_click%></td>
                    <td><%=w_film%></td>
                    <td><%=re_spoilers%></td>
                    <td><%=film_rate%></td>
                    <td><%=film_fav_count%></td>
                    <td><%=issuer%></td>
                    <td>
                        <a href="#set_headline<%=sid%>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="set_headline<%=sid%>">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#set_review<%=sid%>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="set_review<%=sid%>">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#set_report<%=sid%>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="set_report<%=sid%>">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td><%=re_report%></td>
                    <td><%=re_vote_count%></td>
                    <td><%=re_push_count%></td>
                    <td><%=re_reply_count%></td>
                    <td class="text-nowrap"><%=i_date%></td>
                    <td><%=w_date%></td>
                    <td class="text-nowrap"><%=re_last_edit%></td>
                    <td><%=w_cinema%></td>
                    <td>
                        <a href="#set_cinema_comment<%=sid%>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="set_cinema_comment<%=sid%>">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td><%=cinema_rate%></td>
                    <td><%=cinema_push_count%></td>
                </tr>
                `
// <tr class="col-lg-12 panel-collapse collapse in" id="set_headline<%=sid%>">
//         <td colspan="100%"  class=" text-left">
//         <p>編號<%=sid%>標題內容：</p>
//         <%=headline%>
//         </td>
// </tr>
// <tr class="col-lg-12 panel-collapse collapse in" id="set_review<%=sid%>">
//         <td colspan="100%" class=" text-left">
//         <p>編號<%=sid%>電影評價內容：</p>
//         <%=review%>
//         </td>
// </tr>
// <tr class="col-lg-12 panel-collapse collapse in" id="set_cinema_comment<%=sid%>">
//         <td colspan="100%" class=" text-left">
//         <p>編號<%=sid%>戲院評價內容：</p>
//         <%=review%>
//         </td>
// </tr>
// <tr class="col-lg-12 panel-collapse collapse in" id="set_report<%=sid%>">
//         <td colspan="100%" class=" text-left">
//         <p>編號<%=sid%>檢舉內容：</p>
//         <%=re_report_content%>
//         </td>
// </tr>

//刪除提醒
function delete_it(sid) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false,
    })
    swalWithBootstrapButtons.fire({
        title: "確定要刪除編號" + sid + "的資料嗎",
        text: "刪除後將無法回復",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: '確認刪除',
        cancelButtonText: '取消刪除',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            swalWithBootstrapButtons.fire({
                title: '刪除成功',
                text: "您的檔案已被刪除",
                confirmButtonText: '確認',
                type: 'success'
            }).then((result) => {
                location.href = "Roy_data_delete.php?sid=" + sid;
            })
        } else if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: '取消成功',
                text: "檔案未被刪除",
                confirmButtonText: '確認',
                type: 'error'
            })
        }
    })
}


const tr_func = _.template(tr_str);
//分頁按鈕生成
const pagi_str = `<li class="page-item  <%= active%>" style="visibility:<%= h %>">
                    <a class="page-link" href="#<%= page %>"><%= page %></a>
                  </li>`;



const pagi_func = _.template(pagi_str);

// 文章匯入
const myHashChange = () => {
    let h = location.hash.slice(1);
    page = parseInt(h);

    if (isNaN(page)) {
        page = 1;
    }
    const pagi_first = `<li class="page-item ${page<=1? "disabled":""} ">
                    <a class="page-link" href="#1">&lt;&lt;</a>
                  </li>`;
    const pagi_pre = `<li class="page-item ${page<=1? "disabled":""} ">
                    <a class="page-link" href="#${page-1}">&lt;</a>
                  </li>`;

    ul_first.innerHTML = pagi_first;
    ul_pre.innerHTML = pagi_pre;

    let d_data = ""

    fetch("Roy_datalist_api.php?page=" + page)
        .then(response => response.json())
        .then(json => {
            ori_data = json;
            // console.log(ori_data);

            // 文章內容匯入
            let str = '';

            for (let v of ori_data.d_data) {

                console.log(ori_data.d_data[0]["re_spoilers"])
                str += tr_func(v);
            }

            forum_databody.innerHTML = str;

            $(document).ready(function() {
                $('#mytable').DataTable();
            })
            // 分頁按鈕

            str = '';
            for (let i = 1; i <= ori_data.totalPages; i++) {
                let active = ori_data.page === i ? 'active' : '';

                let hide = ""
                str += pagi_func({
                    active: active,
                    h: hide,
                    page: i
                });
                const pagi_next = `<li class="page-item ${page>=ori_data.totalPages? "disabled":""}">
                    <a class="page-link" href="#${page+1}">&gt</a>
                  </li>`;

                const pagi_last = `<li class="page-item ${page>=ori_data.totalPages? "disabled":""}">
                    <a class="page-link" href="#${ori_data.totalPages}">&gt&gt</a>
                  </li>`;
                ul_next.innerHTML = pagi_next;
                ul_last.innerHTML = pagi_last;
                // console.log(str)

            }
            ul_pagi.innerHTML = str;
            pagenav.innerHTML = "第" + page + "頁/共" + ori_data.totalPages + "頁";
        })

}


window.addEventListener('hashchange', myHashChange);
myHashChange();
</script>
<?php include __DIR__ . './foot.php'?>