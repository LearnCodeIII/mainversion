<?php

require __DIR__ . '/PDO.php';
$pagename = 'ad_main_v1.php';

?>

<?php include __DIR__.'/head.php' ?>
<?php include __DIR__.'/sidenav.php'?>

<style>
table {
    white-space: nowrap;
    font-size: 12px;
}

.bread {
    display: inline;
}
</style>

<section class="dashboard">

    <div class="container-fluid">

        <div class="page-header d-flex">

                <h2 class="text-muted">橫幅廣告</h2>

                    <ul class="breadcrumb bg-transparent">
                        <li class="breadcrumb-item"><a href="#">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">橫幅廣告</li>
                    </ul>

        </div> <!-- page-header -->        


    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> &nbsp 橫幅清單
        </div> <!-- card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <table id="example" class="table table-bordered table-hover" style="width:100%">

                        <thead class="thead-dark">
                            <tr class="align-middle">
                                <th scope="col" class="text-left">橫幅名稱</th>
                                <th scope="col" class="text-left">狀態</th>
                                <th scope="col" class="text-right">管理</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="text-muted">
                                <td class="align-middle text-left">電影分類頁廣告</td>
                                <td class="align-middle text-left">啟用</td>
                                <td class="align-middle text-right">
                                    <a href="./ad_list.php" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="編輯">
                                    <i class="fas fa-pencil-alt"></i>                                   </a>
                                </td>
                            </tr>
                            <tr class="text-muted">
                                <td class="align-middle text-left">文章分類頁廣告</td>
                                <td class="align-middle text-left">啟用</td>
                                <td class="align-middle text-right">
                                    <a href="./ad_list.php" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="編輯">
                                    <i class="fas fa-pencil-alt"></i>                                   </a>
                                </td>
                            </tr>
                            <tr class="text-muted">
                                <td class="align-middle text-left">活動分類頁廣告</td>
                                <td class="align-middle text-left">啟用</td>
                                <td class="align-middle text-right">
                                    <a href="./ad_list.php" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="編輯">
                                    <i class="fas fa-pencil-alt"></i>                                   </a>
                                </td>
                            </tr>
                            <tr class="text-muted">
                                <td class="align-middle text-left">論壇分類頁廣告</td>
                                <td class="align-middle text-left">啟用</td>
                                <td class="align-middle text-right">
                                    <a href="./ad_list.php" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="編輯">
                                    <i class="fas fa-pencil-alt"></i>                                   </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>               
                </div> <!-- col-lg-12 -->
            </div> <!-- row -->
        </div> <!-- card-body -->
    </div> <!-- card --> 

    </div> <!-- container-fluid -->

</section>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    
    function delete_it(sn) {
        if (confirm("確定要編輯編號為" + sn + "的資料嗎?")) {
            location.href = 'ad_client_delete.php?sn=' + sn;
        }
    }
</script>

<?php include __DIR__ . '/foot.php'; ?>