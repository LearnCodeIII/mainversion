<?php
$pagename = "pageMain";

include __DIR__ . '/PDO.php';
?>
<?php include __DIR__ . './head.php'?>
<?php include __DIR__ . './nav.php'?>
<?php include __DIR__ . './Roysidenav.php'?>

<section class="dashboard">
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
            <table class="table table-bordered table-dark text-center">
                <thead>
                    <tr>
                        <th scope="col">文章編號</th>
                        <th scope="col">文章標題</th>
                        <th scope="col">影評</th>
                        <th scope="col">發布時間</th>
                        <th scope="col">觀看日期</th>
                        <th scope="col">觀看戲院</th>
                        <th scope="col">電影評分</th>
                        <th scope="col">我的最愛</th>
                        <th scope="col"><i class="far fa-edit"></i></th>
                        <th scope="col"><i class="far fa-trash-alt"></i></th>
                        <a href=""></a>
                    </tr>
                </thead>
                <tbody id="forum_databody">

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
                    <td><%=headline%></td>
                    <td><%=review%></td>
                    <td><%=i_date%></td>
                    <td><%=w_date%></td>
                    <td><%=w_cinema%></td>
                    <td><%=film_rate%></td>
                    <td><%=fav%></td>
                    <td><a href="./Roy_data_edit.php?sid=<%=sid%>"><i class="far fa-edit"></i></a></td>
                    <td>
                        <a href="javascript:delete_it(<%=sid%>)">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>

                </tr>`

//刪除提醒
function delete_it(sid) {
    if (confirm("確定要刪除編號" + sid + "的資料嗎")) {
        location.href = "Roy_data_delete.php?sid=" + sid;
    }
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


    fetch("Roy_datalist_api.php?page=" + page)
        .then(response => response.json())
        .then(json => {
            ori_data = json;
            console.log(ori_data);

            // 文章內容匯入
            let str = '';

            for (let v of ori_data.data) {
                str += tr_func(v);
            }
            forum_databody.innerHTML = str;

            // 分頁按鈕

            str = '';
            for (let i = 1; i <= ori_data.totalPages; i++) {
                let active = ori_data.page === i ? 'active' : '';
          
                let hide = ""
                str += pagi_func({
                    active: active,
                    h:hide,
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
                console.log(str)

            }
            ul_pagi.innerHTML = str;
            pagenav.innerHTML = "第" + page + "頁/共" + ori_data.totalPages + "頁";
        })

}


window.addEventListener('hashchange', myHashChange);
myHashChange();
</script>
<?php include __DIR__ . './foot.php'?>