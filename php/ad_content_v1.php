<?php

require __DIR__ . '/PDO.php';
$pagename = 'ad_content_v1.php';

?>

<?php include __DIR__ . '/head.php'?>
<?php include __DIR__ . '/sidenav.php'?>

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
            <i class="fas fa-pencil-alt"></i>&nbsp 編輯橫幅
        </div> <!-- card-header -->

        <ul class="list-group list-group-flush ">
            <li class="list-group-item">
                <div class="form-group d-flex">
                    <label for="adName" class="col-sm-2 col-form-label">橫幅名稱</label>
                    <input type="text" class="form-control" id="adName" aria-describedby="adNameHelp" placeholder="電影分類頁廣告" readonly>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-group d-flex">
                    <label for="status" class="col-sm-2 col-form-label">狀態</label>
                    <select id="inputState" class="form-control">
                        <option selected>啟用</option>
                        <option>停用</option>
                    </select>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-group d-flex">

                    <label for="status" class="col-sm-2 col-form-label">查詢</label>

                    <div class="row">
                        
                        <div class="col">
                            <div class="form-group d-flex">
                                <label for="status" class="col-sm-2 col-form-label inline">標題</label>
                                <input type="text" class="form-control" placeholder="標題">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group d-flex">
                                <label for="status" class="col-sm-2 col-form-label inline">連結</label>
                                <input type="text" class="form-control" placeholder="http://...">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group d-flex">
                                <label for="status" class="col-sm-2 col-form-label inline">廣告起始日</label>
                                <input type="text" class="form-control" placeholder="YYYY-MM-DD">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group d-flex">
                                <label for="status" class="col-sm-2 col-form-label inline">廣告結束日</label>
                                <input type="text" class="form-control" placeholder="YYYY-MM-DD">
                            </div>
                        </div>

                     </div>

                </div> 
            </li>

        </ul>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <table id="example" class="table table-bordered table-hover" style="width:100%">

                        <thead class="thead-dark">
                            <tr class="align-middle">
                                <th scope="col" class="text-left">標題</th>
                                <th scope="col" class="text-left">連結(請填寫完整連結)</th>
                                <th scope="col" class="text-right">廣告起始日</th>
                                <th scope="col" class="text-right">廣告結束日</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="text-muted">
                                <td class="align-middle text-left">Title</td>
                                <td class="align-middle text-left">https://</td>
                                <td class="align-middle text-right">
                                    <a href="./ad_list.php" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="編輯">
                                    <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td class="align-middle text-left">Dates</td>
                            </tr>
                            <tr class="text-muted">
                                <td class="align-middle text-left">Title</td>
                                <td class="align-middle text-left">https://</td>
                                <td class="align-middle text-right">
                                    <a href="./ad_list.php" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="編輯">
                                    <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td class="align-middle text-left">Dates</td>
                            </tr>
                            <tr class="text-muted">
                                <td class="align-middle text-left">Title</td>
                                <td class="align-middle text-left">https://</td>
                                <td class="align-middle text-right">
                                    <a href="./ad_list.php" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="編輯">
                                    <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td class="align-middle text-left">Dates</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>

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

<?php include __DIR__ . '/foot.php';?>