<?php include __DIR__. './cinema_Login_SQL.php'?>
<?php
    $page_name = 'data_list';

//    一進來的瀏覽資料
    $per_page = 10;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // 算總筆數
    $t_sql = "SELECT COUNT(1) FROM cinema";
    $t_stmt = $pdo->query($t_sql);
    $total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
    // 總頁數
    $total_pages = ceil($total_rows/$per_page);

    if($page < 1) $page = 1;
    if($page > $total_pages) $page = $total_pages;





    // 搜尋功能
    $sn = isset($_GET['search']) ? $_GET['search'] : '';

//如果搜尋欄的值不是空的
try{
    if(! empty($sn)){
//        計算搜尋後資料的頁數
        $ssn = "'%".$_GET['search']."%'";
        $st_sql = sprintf("SELECT COUNT(1) FROM cinema where `name` like %s ",$ssn);
        $st_stmt = $pdo->query($st_sql);
        $stotal_rows = $st_stmt->fetch(PDO::FETCH_NUM)[0];
        $sper_page = 15;
        $stotal_pages = ceil($stotal_rows/$sper_page);
        if($page < 1) $page = 1;
        if($page > $stotal_pages) $page = $stotal_pages;


        $sql = sprintf("SELECT * FROM cinema where `name` like %s LIMIT %s, %s",$ssn ,($page-1)*$sper_page, $sper_page);
//如果搜尋欄的是空的
    } else {
    $sql = sprintf("SELECT * FROM cinema LIMIT %s, %s", ($page-1)*$per_page, $per_page);
    }

    $stmt = $pdo->query($sql);
    // 所有資料一次拿出來
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $ex){
    $error_msg = '查無此資料';
}

?>

<?php include __DIR__. './hp_head.php' ?>
<?php include __DIR__. './hp_nav.php' ?>
<?php include __DIR__. './hp_sidenav.php' ?>
<section class="dashboard">
        <!--搜尋列-->
        <div class="input-group mb-3">
            <form name="search" class="form-inline md-form form-sm" method="GET">
                <input name="search" class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search" aria-label="Search" value="<?= $sn ?>">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search" aria-hidden="true"></i></button>
            </form>
        </div>

        <!--排序按鈕-->
        <div class="mb-3">
            <div class="d-flex align-items-md-end">
                <button type="button" class="btn btn-dark btn-sm mx-2">依姓名排序</button>
                <button type="button" class="btn btn-dark btn-sm mx-2">依位置排序</button>
            </div>
        </div>


        <!--換頁按鈕-->
    <?php if(! empty($sn)){ ?>
        <div class="row">
            <div class="col-lg-12">
                <nav>
                    <ul class="pagination pagination-sm">
                        <li class="page-item <?= $page<=1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?search=<?= isset($sn) ? $sn : ''?>&page=<?= $page-1 ?>">&lt;</a>
                        </li>
                        <?php for($i=1; $i<$stotal_pages; $i++): ?>
                            <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                                <a class="page-link" href="?search=<?= isset($sn) ? $sn : ''?>&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor ?>
                        <li  class="page-item <?= $page>=$stotal_pages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?search=<?= isset($sn) ? $sn : ''?>&page=<?= $page+1 ?>">&gt;</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    <?php } else{ ?>
        <div class="row">
            <div class="col-lg-12">
                <nav>
                    <ul class="pagination pagination-sm">
                        <li class="page-item <?= $page<=1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?search=<?= isset($sn) ? $sn : ''?>&page=<?= $page-1 ?>">&lt;</a>
                        </li>
                        <?php for($i=1; $i<=$total_pages; $i++): ?>
                            <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                                <a class="page-link" href="?search=<?= isset($sn) ? $sn : ''?>&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor ?>
                        <li class="page-item <?= $page>=$total_pages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?search=<?= isset($sn) ? $sn : ''?>&page=<?= $page+1 ?>">&gt;</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    <?php } ?>

        <!--資料表單-->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover">
                    <?php if(empty($error_msg)){ ?>
                    <thead class="thead-dark">
                    <tr">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">taxID</th>
                        <th scope="col">phone</th>
                        <th scope="col">address</th>
                        <th scope="col">intro</th>
                        <th scope="col"><i class="far fa-eye"></i></i></th>
                        <th scope="col"><i class="fas fa-edit"></i></th>
                        <th scope="col"><i class="fas fa-trash-alt"></i></th>
                    </tr>
                    </thead>
                    <tbody>
<!--                    --><?php //if(empty($error_msg)){ ?>
                        <?php foreach($rows as $row): ?>
                            <tr>
                                <td><?= $row['sid'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['taxID'] ?></td>
                                <td><?= $row['phone'] ?></td>
                                <td><?= strip_tags($row['address']) ?></td>
                                <td><?= htmlentities($row['intro']) ?></td>

                                <td>
                                    <a href="cinema_ifmt_list_review.php?sid=<?= $row['sid'] ?>"><i class="far fa-eye"></i></i></a>
                                </td>

                                <td>
                                    <a href="cinema_ifmt_list_edit.php?sid=<?= $row['sid'] ?>"><i class="fas fa-edit"></i></a>
                                </td>

                                <td>
                                    <a href="javascript: delete_it(<?= $row['sid'] ?>)">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php }else{ ?>
                            <h4><?= $error_msg ?></h4>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <script>
        function delete_it(sid){
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = 'cinema_ifmt_list_delete.php?sid=' + sid;
            }
        }
    </script>

</section>
<?php include __DIR__. './hp_foot.php' ?>