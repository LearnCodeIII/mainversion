<?php
$pagename = "comment_list";
$groupname = "article";

include __DIR__.'/PDO.php';
?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./sidenav.php'?>

<!-- <link rel="stylesheet" href="../css/jquery-ui.css"> -->
<!-- <script src="../js/jquery-ui.js"></script> -->
<style>
.content {
    /* display: block; */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 400px;
}

;

.title {
    /* display: block; */
    text-overflow: ellipsis;
    max-width: 50px;
}

;
</style>
<script src="../js/sweet.js"></script>
<section class="dashboard">

    <div class="container-fluid">
        <!-- <form class="form-inline">
            <div class="form-group my-3">
                <input type="text" class="form-control" id="Search" placeholder="Search">
                <button type="submit" class="btn btn-primary mx-1">go</button>
            </div>
        </form> -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">

            </ul>
        </nav>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col-1">評論序號</th>
                    <th scope="col-1">文章序號</th>
                    <th scope="col-1">會員帳號</th>
                    <th scope="col">作者</th>
                    <th scope="col">作者頭像</th>
                    <th scope="col">評論時間</th>
                    </th>
                    <th scope="col">評論內容</th>
                    <!-- <th scope="col">預覽</i></th> -->
                    <!-- <th scope="col">編輯</i></th> -->
                    <th scope="col">刪除</i></th>
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
                    <th scope="col"><%= sid %></th>
                    <th scope="col"><%= article_sid %></th>
                    <th scope="col-1"><%= member_sid %></th>
                    <th scope="col"><%= nickname %></th>
                    <th scope="col"><img src="../pic/avatar/<%= avatar %>" width="100" height="auto"></th>
                    <th scope="col"><%= cm_date %></th></th>
                    <th scope="col"><%= comment %></th>
                    <th scope="col"><a href="javascript: delete_it(<%= sid %>)"><i class="fas fa-trash-alt"></i><a></th>
                </tr>`;

                    // <th scope="col">預覽</image></th>
                    // <th scope="col">編輯</i></th>
const tr_func = _.template(tr_str);

// escape.html(_.escape(input.val(tr_str)));

let page_str = `<li class="page-item <%= active %>">
                <a class="page-link" href="#<%= page %>"><%= page %></a>
                </li>`;

const page_func = _.template(page_str);



const myHashChange = () => {
    let h = location.hash.slice(1);
    page = parseInt(h);
    if (isNaN(page)) {
        page = 1;
    };
    // ul_page.innerHTML = page;

    fetch('comment_list_api.php?page=' +page)
    .then(response => response.json())
    .then(json => {
        oriData = json;
        console.log(oriData);
        let str = '';
        for (k in oriData.data) {
            str += tr_func(oriData.data[k]);
        }
        data_body.innerHTML = str;
    
    str = '';
            for (i = 1; i <= oriData.totalPages; i++) {

                let active = oriData.page === i ? 'active' : '';

                str += page_func({
                    active: active,
                    page: i
                });
            }
            ul_page.innerHTML = `<li class="page-item <%= active %>">
                <a class="page-link" href="#${page-1}">上一頁</a>
                </li>` + str + `<li class="page-item <%= active %>">
                <a class="page-link" href="#${page+1}">下一頁</a>
                </li>`;
            });

};

window.addEventListener('hashchange', myHashChange);
myHashChange();


// function delete_it(sid) {
//     if (confirm(`確定要刪除編號 ${sid} 的資料嗎?`)) {
//         location.href = 'comment_delete.php?sid=' + sid;
//     }
// };

//刪除資料
function delete_it(sid){
    
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
    title: `確定要刪除編號 ${sid} 的留言嗎?`,
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
            location.href = 'comment_delete.php?sid=' + sid;
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

<!-- <?php include __DIR__.'/__html_foot.php'; ?> -->