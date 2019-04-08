<?php
$pagename = "article_search";
$groupname = "article";

include __DIR__.'/PDO.php';
?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./sidenav.php'?>


<style>
.content {
    /* display: block; */
    overflow:hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width:400px;
};

.title {
    /* display: block; */
    overflow:hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width:30px;
};

.none{
    display:none;
}

</style>
<script src="../js/sweet.js"></script>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<section class="dashboard">

    <div class="container-fluid">
        <form class="form-inline" name="searchform" onsubmit="return gosearch();">
            <div class="form-group my-3">
                <input type="text" class="form-control" id="search" name="searchkey" placeholder="Search">
                <button type="submit" class="btn btn-primary mx-1">go</button>
            </div>
        </form>
        <nav aria-label="Page navigation example">
            <ul class="pagination">

            </ul>
        </nav>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th class="title text-truncate" scope="col">新聞標題(點擊預覽)</th>
                    <th scope="col">作者</th>
                    <th scope="col">發佈時間</th>
                    <th class="content text-truncate" scope="col">內文</th>
                    <th scope="col">編輯/刪除</i></th>
                </tr>
            </thead>
            <tbody id="data_body">
            </tbody>
        </table>
    </div>

</section>

<script>
let page = 1;
let oriData;
const ul_page = document.querySelector('.pagination');
const data_body = document.querySelector('#data_body');

let tr_str = `<tr>
                <th scope="row"><%= sid %></th>
                <td class="title text-truncate"><a href="article_preview.php?sid=<%= sid %>"><%= title %></a></td>
                <td><%= author %></td>
                <td><%= date %></td>
                <td class="content text-truncate"><%= content %></td>
                <td>
                <a href="article_edit.php?sid=<%= sid %>"><i class="fas fa-edit"></i></a>/
                <a href="javascript:deleteIt(<%= sid %>)"><i class="fas fa-trash-alt"></i></a>
                </td>
                </tr>`;

const tr_func = _.template(tr_str);


let page_str = `<li class="page-item <%= active %>">
                <a class="page-link" href="#<%= page %>"><%= page %></a>
                </li>`;

const page_func = _.template(page_str);


const gosearch = () => {
    var searchform = new FormData(document.searchform);

    fetch('article_search_api.php?searchkey='+document.searchform.searchkey.value)
        .then(response => response.json())
        .then(json => {
            oriData = json;
            console.log(oriData);
            let str='';
            for(k in oriData.data){
                str += tr_func(oriData.data[k]);
            }
            data_body.innerHTML = str;
        });
    return false;
}; 

const myHashChange = () => {
    let h = location.hash.slice(1);
    page = parseInt(h);
    if (isNaN(page)) {
        page = 1;
    };
    // ul_page.innerHTML = page;
    

    fetch('article_search_api.php?page=' + page+'&searchkey='+document.searchform.searchkey.value)
        .then(res => {
            return res.json();
        })
        .then(json => {
            oriData = json;
            // console.log(oriData);
            let str = '';
            for (k in oriData.data) {
                // .data = api那邊的data內容
                str += tr_func(oriData.data[k]);
                //_將data轉完放到str  k= data裡的陣列位置
            }
            data_body.innerHTML = str;
            // str = 塞好data的tr_str 
            if(page>oriData.totalPages){
                page=oriData.totalPages;
                $('#next').addClass('none');
            };
            if(page<=1){
                page=1;
                $('#prev').addClass('none');
            };
            str = '';
            for (i = 1; i <= oriData.totalPages; i++) {

                let active = oriData.page === i ? 'active' : '';

                str += page_func({
                    active: active,
                    page: i
                });
            }
            ul_page.innerHTML = `<li class="page-item" id="prev">
                <a class="page-link" href="#${page-1}">上一頁</a>
                </li>` + str + `<li class="page-item ">
                <a class="page-link" href="#${page+1}" id="next">下一頁</a>
                </li>`;
        });

};

window.addEventListener('hashchange', myHashChange);
myHashChange();


//刪除資料
function deleteIt(sid){
    
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
    title: `確定要刪除編號 ${sid} 的文章嗎?`,
    text: "檔案刪除過後將無法還原!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: '確認刪除',
    cancelButtonText: '我再想想',
    reverseButtons: true
    }).then((result) => {
    if (result.value) {
        swalWithBootstrapButtons.fire({
            type: 'success',
            title: '確認刪除',
            text: '您的資料已經刪除。',
            footer: '提示：即將返回主畫面',
            timer: 3000,
        }).then((result) => {
            location.href = 'article_delete.php?sid=' + sid;
        })
    } else if (
        result.dismiss === Swal.DismissReason.cancel
    ) {
        swalWithBootstrapButtons.fire({
            type: 'error',
            title: '取消刪除',
            text: '您的資料沒有刪除。'
        })
    }
    })
}
</script>
