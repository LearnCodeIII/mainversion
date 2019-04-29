<?php
$pagename = "article_list";
$groupname = "article";

include __DIR__.'/PDO.php';
?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./sidenav.php'?>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<!-- <link rel="stylesheet" href="http://cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css"> -->
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
        <table class="table table-bordered" id="myDataTalbe">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th class="title text-truncate" scope="col">新聞標題（Preview）</th>
                    <th scope="col">作者</th>
                    <th scope="col">日期</th>
                    <!-- <th class="content text-truncate" scope="col">新聞內容預覽</th> -->
                    <th scope="col">編輯/刪除</th>
                </tr>
            </thead>
            <tbody id="data_body">
            </tbody>
        </table>
    </div>

</section>
<script src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<!-- <script src="http://cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.js"></script> -->
<script>

var table = $('#myDataTalbe').DataTable({
      // 'serverSide':true,
      "ajax": {
        "type": "GET",
        "url": "./article_list_api.php",
        "dataSrc": function (json) {
          //Make your callback here.
          return json.data;
        }
      },
      "columns": [
        { 'data': "sid",
            render: function (data) {
            return '<a href="article_preview.php?sid=' + data + '">'+ data + '</a>'
            }},
        { "data": "title" },
        { "data": "author" },
        { "data": "date" },
        // { "data": "content" },
        {//這裡的data變數值為sysid，相等於row.sysid
          data: "sid",//資料行繫結屬性
          orderable: false, // 禁用排序
          render: function (data) {
            return '<a href="article_edit.php?sid=' + data + '"><i class="fas fa-edit"></i></a>' + '/' + '<a href="article_delete.php?sid=' + data + '"><i class="fas fa-trash-alt"></i></a>'
          }}
      ],
      'searching': true,
      // "jQueryUI": true,
    });



// window.addEventListener('hashchange', myHashChange);
// myHashChange();

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




</script>

<?php include __DIR__.'./foot.php'; ?>