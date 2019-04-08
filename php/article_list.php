<?php
$pagename = "article_list";
$groupname = "article";

include __DIR__.'/PDO.php';
?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./sidenav.php'?>

<!-- <link rel="stylesheet" href="../css/jquery-ui.css"> -->
<!-- <script src="../js/jquery-ui.js"></script> -->
<!-- <link rel="stylesheet" href="../css/animate.css"> -->
<script src="../js/sweet.js"></script>
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
    text-overflow: ellipsis;
    max-width:50px;
}

;
</style>

<section class="dashboard">

    <div class="container-fluid">
        <!-- <form class="form-inline">
            <div class="form-group my-3">
                <input type="text" class="form-control" id="Search" placeholder="Search">
                <button type="submit" class="btn btn-primary mx-1">go</button>
            </div>
        </form> -->
        <nav aria-label="Page navigation example">
                <!-- <div class="page-item <?= $page <=1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?=$page-1?>">Previous</a></button> -->
            <ul class="pagination">

            </ul>
        </nav>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th class="title text-truncate" scope="col">新聞標題（Preview）</th>
                    <th scope="col">作者</th>
                    <th scope="col">日期</th>
                    <th class="content text-truncate" scope="col">新聞內容預覽</th>
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
                <a href="" type="button" id="delete<%= sid %>"><i class="fas fa-trash-alt"></i></a>
                </td>
                </tr>`;

const tr_func = _.template(tr_str);
// escape.html(_.escape(input.val(tr_str)));

let page_str = `<li class="page-item <%= active %>">
                <a class="page-link" href="#<%= page %>"><%= page %></a>
                </li>`;

const page_func = _.template(page_str);

// 換頁
const myHashChange = () => {
    let h = location.hash.slice(1);
    page = parseInt(h);
    if (isNaN(page)) {
        page = 1;
    };
    // ul_page.innerHTML = page;

    fetch('article_list_api.php?page=' + page)
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

//刪除資料
// function deleteIt(sid){
    
//     const swalWithBootstrapButtons = Swal.mixin({
//     customClass: {
//         confirmButton: 'btn btn-success',
//         cancelButton: 'btn btn-danger'
//     },
//     buttonsStyling: false,
//     })

//     swalWithBootstrapButtons.fire({
//     title: `確定要刪除編號 ${sid} 的文章嗎?`,
//     text: "檔案刪除過後將無法還原!",
//     type: 'warning',
//     showCancelButton: true,
//     confirmButtonText: '確認刪除',
//     cancelButtonText: '我再想想',
//     reverseButtons: true
//     }).then((result) => {
//     if (result.value) {
//         swalWithBootstrapButtons.fire({
//             type: 'success',
//             title: '確認刪除',
//             text: '您的資料已經刪除。',
//             footer: '提示：即將返回主畫面',
//             timer: 3000,
//         }).then((result) => {
//             location.href = 'article_delete.php?sid=' + sid;
//         })
//     } else if (
//         result.dismiss === Swal.DismissReason.cancel
//     ) {
//         swalWithBootstrapButtons.fire({
//             type: 'error',
//             title: '取消刪除',
//             text: '您的資料沒有刪除。'
//         })
//     }
//     })
// }

var dSid = 'delete'+`${sid}`; 


$('#dSid`).click(){
    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Poof! Your imaginary file has been deleted!", {
      icon: "success",
    });
  } else {
    swal("Your imaginary file is safe!");
  }
});
}


</script>

<?php include __DIR__.'./foot.php'; ?>