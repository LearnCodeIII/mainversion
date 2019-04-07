<?php include __DIR__. './PDO.php'?>

<?php
$groupname = 'theater';
$pagename = "cinema_ifmt_list";
$sql = "SELECT * FROM `cinema`";
$stmt = $pdo->query($sql);
// 所有資料一次拿出來
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

function name_queue(){
}


?>

<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./sidenav.php'?>
    <!--資料表單-->
    <section class="dashboard">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover" id="tb">
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
                </tbody>
            </table>
        </div>
    </section>
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