<?php

require __DIR__ . '/PDO.php';
$page_name = 'ann_complete_list';

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
        <div><?= $page . " / " . $total_pages ?></div>
            <div class="row">
                <div class="col-lg-12">
                    <nav>
                        <ul class="pagination pagination-sm">
                            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page - 1 ?>">&lt;</a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor ?>
                            <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page + 1 ?>">&gt;</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr> <!-- 16 items -->
                                <th scope="col">#</th>
                                <th scope="col">客戶公司</th>
                                <th scope="col">客戶編號</th>
                                <th scope="col">客戶地址</th>
                                <th scope="col">聯絡人</th>
                                <th scope="col">連絡電話</th>
                                <th scope="col">連絡信箱</th>
                                <th scope="col">合約預算</th>
                                <th scope="col">合約開始日</th>
                                <th scope="col">合約結束日</th>
                                <th scope="col">廣告名稱</th>
                                <th scope="col">廣告圖檔</th>
                                <th scope="col">廣告連結</th>
                                <th scope="col">點擊次數</th>
                                <th scope="col">廣告放送開始時間</th>
                                <th scope="col">廣告放送結束時間</th>
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
                                    <td><?= htmlentities($row['contract_start_date']) ?></td>
                                    <td><?= htmlentities($row['contract_end_date']) ?></td>
                                    <td><?= $row['ad_name'] ?></td>
                                    <td><?= $row['ad_pic'] ?></td>
                                    <td><?= $row['ad_link'] ?></td>
                                    <td><?= $row['ad_link_count'] ?></td>
                                    <td><?= $row['ad_start_time'] ?></td>
                                    <td><?= $row['ad_end_time'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>   
    </div>
    
</section>

<?php include __DIR__ . '/foot.php'; ?>