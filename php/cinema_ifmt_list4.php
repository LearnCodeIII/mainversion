<?php include __DIR__. './PDO.php'?>

<?php
$groupname = 'theater';
$pagename = "cinema_ifmt_list";

//    一進來的瀏覽資料
$per_page = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 算總筆數
$t_sql = "SELECT COUNT(1) FROM cinema";
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
// 總頁數
$total_pages = ceil($total_rows/$per_page);

if($page < 1) $page = 1;
if($page > $total_pages) $page = $total_pages;

//排序按鈕
$queue_btn1 = isset($_POST['queue_btn1']) ? $_POST['queue_btn1']:'';
$queue_btn2 = isset($_POST['queue_btn2']) ? $_POST['queue_btn2']:'';

$queue_btn1_1 = $queue_btn1;
$queue_btn1_2 = $queue_btn1;
$queue_btn2_1 = $queue_btn2;
$queue_btn2_2 = $queue_btn2;

// 搜尋功能
$sn = isset($_GET['search']) ? $_GET['search'] : '';

//如果搜尋欄的值不是空的
try{
    if(! empty($sn)){
//        計算搜尋後資料的頁數
        $ssn = isset($sn) ? "'%".$_GET['search']."%'":'';
        $st_sql = sprintf("SELECT COUNT(1) FROM cinema where `name` like %s ",$ssn);
        $st_stmt = $pdo->query($st_sql);
        $stotal_rows = $st_stmt->fetch(PDO::FETCH_NUM)[0];
        $sper_page = 5;
        $stotal_pages = ceil($stotal_rows/$sper_page);
        if($page < 1) $page = 1;
        if($page > $stotal_pages) $page = $stotal_pages;

        $sql = sprintf("SELECT * FROM cinema where `name` like %s LIMIT %s, %s",$ssn ,($page-1)*$sper_page, $sper_page);
//        正排序
        if($queue_btn1 == true){
            $queue_btn2 = false;
            $sql = sprintf("SELECT * FROM cinema where `name` like %s LIMIT %s, %s",$ssn ,($page-1)*$sper_page, $sper_page);
        }
//        負排序
        if($queue_btn2 == true){
            $queue_btn1 = false;
            $sql = sprintf("SELECT * FROM cinema where `name` like %s ORDER BY `sid` DESC LIMIT %s, %s",$ssn ,($page-1)*$sper_page, $sper_page);
        }
//如果搜尋欄的是空的
    } else {
//        預設正排序
        $sql = sprintf("SELECT * FROM cinema LIMIT %s, %s", ($page-1)*$per_page, $per_page);
//        正排序
        if($queue_btn1 == true){
            $queue_btn2 = false;
            $sql = sprintf("SELECT * FROM cinema LIMIT %s, %s", ($page-1)*$per_page, $per_page);
        }
//        負排序
        if($queue_btn2 == true){
            $queue_btn1 = false;
            $sql = sprintf("SELECT * FROM cinema ORDER BY `sid` DESC LIMIT %s, %s", ($page-1)*$per_page, $per_page);
        }
    }

    $stmt = $pdo->query($sql);
    // 所有資料一次拿出來
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $ex){
    $error_msg = '查無此資料';
}


function name_queue(){

}


?>

<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./sidenav.php'?>
<?php include __DIR__. './cinema_sidenav.php' ?>
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
                <form id="queue" method="post">
                    <button type="submit" id="queue_btn1" name="queue_btn1" value="true" type="button" class="btn btn-dark btn-sm mx-2">較早創建</button>
                    <button type="submit" id="queue_btn2" name="queue_btn2" value="true" type="button" class="btn btn-dark btn-sm mx-2">最新創建</button>
                </form>
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
                <table class="table table-hover" id="tb">
                    <?php if(empty($error_msg)){ ?>
                    <thead class="thead-dark">
                    <tr">
                    <th scope="col" class="px-3" style="width: 70px">編號</th>
                    <th class="px-2" style="width: 120px" scope="col">戲院名稱</th>
                    <th scope="col">統一編號</th>
                    <th class="px-2" style="width: 140px" scope="col">電話</th>
                    <th class="px-2" style="width: 160px" scope="col">地址</th>
                    <th scope="col">簡介</th>
                    <th class="px-2" style="width: 40px" scope="col"><i class="far fa-eye"></i></i></th>
                    <th class="px-2" style="width: 40px" scope="col"><i class="fas fa-edit"></i></th>
                    <th class="px-2" style="width: 40px" scope="col"><i class="fas fa-trash-alt"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--                    --><?php //if(empty($error_msg)){ ?>
                    <?php foreach($rows as $row): ?>
                        <tr>
                            <td class="px-3" style="width: 70px"><?= $row['sid'] ?></td>
                            <td class="px-2" style="width: 120px"><?= $row['name'] ?></td>
                            <td><?= $row['taxID'] ?></td>
                            <td class="px-2" style="width: 140px"><?= $row['phone'] ?></td>
                            <td class="px-2" style="width: 160px"><?= strip_tags($row['address']) ?></td>
                            <td><?= htmlentities($row['intro']) ?></td>

                            <td class="px-2" style="width: 40px">
                                <a href="cinema_ifmt_list_review.php?sid=<?= $row['sid'] ?>"><i class="far fa-eye"></i></i></a>
                            </td>

                            <td class="px-2" style="width: 40px">
                                <a href="cinema_ifmt_list_edit.php?sid=<?= $row['sid'] ?>"><i class="fas fa-edit"></i></a>
                            </td>

                            <td class="px-2" style="width: 40px">
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
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script>

            // 廣告業Table
            $(document).ready( function () {
                $('#tb').DataTable();
            } );

            function delete_it(sid){
                if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                    location.href = 'cinema_ifmt_list_delete.php?sid=' + sid;
                }
            }
        </script>

    </section>
<?php include __DIR__. './foot.php' ?>