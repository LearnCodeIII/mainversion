<?php
$pagename = "pageMain";

include __DIR__.'/PDO.php';

#每頁筆數
$per_page = 5;

#設定當前頁數
$page = isset($_GET['page'])? intval($_GET['page']):1;

#算總筆數
$t_sql = "SELECT COUNT(1) FROM activity";
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

#總頁數
$total_pages = ceil($total_rows/$per_page);
if($page<1)$page=1;
if($page>$total_pages)$page=$total_pages;

#顯示資料
$sql = sprintf("SELECT * FROM `activity` LIMIT %s, %s",($page-1)*$per_page,$per_page);
$stmt = $pdo->query($sql);
$rows = $stmt->fetchALL(PDO::FETCH_ASSOC);

?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./nav.php'?>
<?php include __DIR__.'./Shawnsidenav.php'?>
<section class="dashboard">

<?php 
 #TODO: PHP超出頁面，下面會消失
?>

	<!-- <div class="container-fulid">
		<div class="row">
			<h5 class="title mb-3">活動狀態：</h5>
			<div class="title">[全部]</div>
			<div class="title">[報名中]</div>
			<div class="title">[報名截止]</div>
			<div class="title">[已結束]</div>
		</div>
	</div>
	<div class="container-fulid">
		<div class="row">
			<h5 class="title mb-3">發布時間：</h5>
			<div class="title">[全部]</div>
			<div class="title">[一周內]</div>
			<div class="title">[一個月內]</div>
			<div class="title">[三個月內]</div>
			<div class="title">[手動輸入起始日期]</div>
		</div>
	</div> -->
	


	<ul class="list-unstyled" >

		<?php foreach($rows as $row):?>
			<div class="activityWrap mb-3" style="background-color:white;">
				<li class="media">
				<img src="<?=$row['picture']?>" class="card-img-top" style="display:block;width:100%;height:100%;max-width:180px;max-height:120px">
					<div class="media-body " >
						<h5 class="card-title ml-1 mt-3"><?=$row['name']?></h5>
						<p class="card-text ml-3 mb-3"><?=$row['content']?></p>
					</div>
				</li>
				<div class="card-footer d-flex justify-content-between">
					<small >活動期限：<?=$row['dateStart']?>-<?=$row['dateEnd']?></small>
					<small class="d-flex justify-content-between">
<?php 
 #TODO: font-awesome 一掛上去就掛
?>
							<div class="ml-3"><a href="#">修改</a></div> 
							<div class="ml-3"><a href="javascript:deleteIt(<?= $row['sid'] ?>);">刪除</a></div>
					</small>
				</div>
			</div>
		<?php endforeach ?>
	
	<nav aria-label="Page navigation ">
		<ul class="pagination justify-content-center">

			<li class="page-item <?=$page==1?"disabled":""; ?>">
				<a class="page-link" href="?page=1">首頁</a>
			</li>
			<li class="page-item <?=$page==1?"disabled":""; ?>">
				<a class="page-link" href="?page=<?= $page-1 ?>">&lt;</a>
			</li>
			<?php for($i=1;$i<=$total_pages;$i++):?>
			<li class="page-item <?=$i==$page?'active':''?>">
				<a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
			</li>
			<?php endfor?>
			<li class="page-item <?=$page==$total_pages?"disabled":""; ?>">
				<a class="page-link" href="?page=<?= $page+1 ?>">&gt;</a>
			</li>
			<li class="page-item <?=$page==$total_pages?"disabled":""; ?>">
				<a class="page-link" href="?page=<?= $total_pages ?>">最後一頁</a>
			</li>

		</ul>
	</nav>
</section>
<?php include __DIR__.'./foot.php'?>