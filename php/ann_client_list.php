<?php

require __DIR__ . '/PDO.php';
$page_name = 'ann_client_list';

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

<?php include __DIR__ . '/head.php'; ?>
<?php include __DIR__ . '/nav.php'; ?>
<?php include __DIR__.'/ann_side_nav.php'?>

<section class="dashboard">

    <div class="container">
        <!-- <div><?= $page . " / " . $total_pages ?></div> -->
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
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
                            <a class="page-link" href="ann_client_list.php?page=<?php echo $total_pages;?>">最後一頁</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">序號</th>
                            <th scope="col" class="text-center">公司名</th>
                            <th scope="col" class="text-center">客戶編號</th>
                            <th scope="col" class="text-center">客戶地址</th>
                            <th scope="col" class="text-center">聯絡人</th>
                            <th scope="col" class="text-center">連絡電話</th>
                            <th scope="col" class="text-center">連絡信箱</th>
                            <th scope="col" class="text-center">合約預算</th>
                            <th scope="col" class="text-center">合約開始日</th>
                            <th scope="col" class="text-center">合約結束日</th>
                            <th scope="col"><i class="fas fa-edit" style="display: none"></i></th>
                            <th scope="col"><i class="far fa-trash-alt" style="display: none"></i></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($rows as $row): ?>
                        <tr>
                            <td><?= $row['sn'] ?></td>
                            <td><?= $row['client_name'] ?></td>
                            <td><?= $row['client_number'] ?></td>
                            <td><?= strip_tags($row['client_address']) ?></td>
                            <td><?= $row['client_poc'] ?></td>
                            <td><?= $row['client_mobile'] ?></td>
                            <td><?= $row['client_email'] ?></td>
                            <td><?= $row['contract_budget'] ?></td>
                            <td><?= $row['contract_start_date'] ?></td>
                            <td><?= $row['contract_end_date'] ?></td>
                            <td>
                                <a href="ann_client_update.php?sn=<?= $row['sn'] ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a href="javascript: delete_it(<?= $row['sn'] ?>)">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<script>
function delete_it(sn) {
    if (confirm("確定要刪除編號為" + sn + "的資料嗎?")) {
        location.href = 'ann_client_delete.php?sn=' + sn;
    }
}
</script>

<?php include __DIR__ . '/foot.php'; ?>