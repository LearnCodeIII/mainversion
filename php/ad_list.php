<?php

require __DIR__ . '/PDO.php'; 
$pagename = 'ad_list';
$groupname = 'ad';

$per_page = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$t_sql = "SELECT COUNT(1) FROM ad";
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

$total_pages = ceil($total_rows / $per_page);

if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;


$sql = sprintf("SELECT * FROM ad ORDER BY sn DESC LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
$stmt = $pdo->query($sql);

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include __DIR__.'/head.php' ?>
<?php include __DIR__.'/sidenav.php'?>
<script src="../js/sweet.js"></script>

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
        <!-- <div><?= $page . " / " . $total_pages ?></div> -->

        <h2 class="text-muted">客戶管理</h2>

        <nav class="mx-auto"aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#">首頁</a></li>
                <li class="breadcrumb-item active" aria-current="page">客戶管理</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover table-responsive">
                    <thead class="thead-dark">
                        <tr class="align-middle">
                            <th scope="col" class="align-middle text-center"></th>
                            <th scope="col" class="align-middle text-center">公司名稱</th>
                            <th scope="col" class="align-middle text-center">統一編號</th>
                            <th scope="col" class="align-middle text-center">地址</th>
                            <th scope="col" class="align-middle text-center">聯絡人</th>
                            <th scope="col" class="align-middle text-center">電話</th>
                            <th scope="col" class="align-middle text-center">信箱</th>
                            <th scope="col" class="align-middle text-center">狀態</th>
                            <th scope="col" class="align-middle text-center">合約開始日</th>
                            <th scope="col" class="align-middle text-center">合約結束日</th>
                            <th scope="col" class="align-middle text-center">廣告名稱</th>
                            <th scope="col" class="align-middle text-center">廣告圖檔</th>
                            <th scope="col" class="align-middle text-center">廣告連結</th>
                            <th scope="col" class="align-middle text-center">點擊次數</th>
                            <th scope="col" class="align-middle text-center">廣告放送開始時間</th>
                            <th scope="col" class="align-middle text-center">廣告放送結束時間</th>
                            <th scope="col" class="align-middle text-center"><i class="fas fa-edit"
                                    style="display: none"></i></th>
                            <th scope="col" class="align-middle text-center"><i class="far fa-trash-alt"
                                    style="display: none"></i></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($rows as $row): ?>
                        <tr class="text-justify text-muted">
                            <td class="align-middle"><?= $row['sn'] ?></td>
                            <td class="align-middle"><?= $row['client_name'] ?></td>
                            <td class="align-middle"><?= $row['client_number'] ?></td>
                            <td class="align-middle"><?= strip_tags($row['client_address']) ?></td>
                            <td class="align-middle"><?= $row['client_poc'] ?></td>
                            <td class="align-middle"><?= $row['client_mobile'] ?></td>
                            <td class="align-middle"><?= $row['client_email'] ?></td>
                            <td class="align-middle"><?= $row['contract_budget'] ?></td>
                            <td class="align-middle"><?= $row['contract_start_date'] ?></td>
                            <td class="align-middle"><?= $row['contract_end_date'] ?></td>
                            <td class="align-middle"><?= $row['ad_name'] ?></td>
                            <td class="align-middle"><?= $row['ad_pic'] ?></td>
                            <td class="align-middle"><?= $row['ad_link'] ?></td>
                            <td class="align-middle"><?= $row['ad_link_count'] ?></td>
                            <td class="align-middle"><?= $row['ad_start_time'] ?></td>
                            <td class="align-middle"><?= $row['ad_end_time'] ?></td>
                            <td>
                                <a href="ad_client_update.php?sn=<?= $row['sn'] ?>">
                                    <i class="fas fa-edit align-middle"></i>
                                </a>
                            </td>
                            <td>
                                <a href="javascript: delete_it(<?= $row['sn'] ?>)">
                                    <i class="far fa-trash-alt align-middle"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="Page navigation example" class="d-flex justify-content-start">
                            <ul class="pagination pagination-sm">
                                <li class="page-item">
                                    <a class="page-link"
                                        href="ad_list.php?page=<?php echo $pages=1;?>">l&lt;</a>
                                </li>
                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" aria-label="Previous" href="?page=<?= $page - 1 ?>">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                                <?php endfor ?>
                                <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                                    <a class="page-link" aria-label="Next" href="?page=<?= $page + 1 ?>">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="ad_list.php?page=<?php echo $total_pages;?>">&gt;l</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

<script>
/* function delete_it(sn) {
    if (confirm("確定要刪除編號為" + sn + "的資料嗎?")) {
        location.href = 'ad_client_delete.php?sn=' + sn;
    }
} */

function delete_it(sn){
    
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
    title: `確定要刪除資料嗎?`,
    text: "檔案刪除後將無法還原!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: '確認刪除',
    cancelButtonText: '取消刪除',
    reverseButtons: true
    }).then((result) => {
    if (result.value) {
        swalWithBootstrapButtons.fire({
            type: 'success',
            title: '確認刪除',
            text: '您的資料已刪除成功',
            footer: '即將返回主畫面',
            timer: 3000,
        }).then((result) => {
            location.href = 'ad_client_delete.php?sn=' + sn;
        })
    } else if (
        result.dismiss === Swal.DismissReason.cancel
    ) {
        swalWithBootstrapButtons.fire({
            type: 'error',
            title: '取消刪除',
            text: '您的資料沒有刪除'
        })
    }
    })
}

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false,
})

</script>

<?php include __DIR__ . '/foot.php'; ?>