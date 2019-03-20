<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">.Moiveee</a>
	<div class="container-fulid">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?= $pagename == "pageData"?"active":""; ?>">
					<a class="nav-link" href="Su_member_list.php">會員系統</a>
				</li>
				<li class="nav-item <?= $pagename == "pageData"?"active":""; ?>">
					<a class="nav-link" href="cinema_ifmt_list.php">戲院系統</a>
				</li>
				<li class="nav-item <?= $pagename == "pageData"?"active":""; ?>">
					<a class="nav-link" href="film_data_list.php">影片系統</a>
				</li>
				<li class="nav-item <?= $pagename == "pageData"?"active":""; ?>">
					<a class="nav-link" href="RuthPageMain.php">文章系統</a>
				</li>
				<li class="nav-item <?= $pagename == "pageHome"?"active":""; ?>">
					<a class="nav-link" href="ShawnpageDatalist.php">活動系統</a>
				</li>
				<li class="nav-item <?= $pagename == "pageData"?"active":""; ?>">
					<a class="nav-link" href="Roy_datalist.php">論壇系統</a>
				</li>
				<li class="nav-item <?= $pagename == "pageData"?"active":""; ?>">
					<a class="nav-link" href="ann_client_list.php">廣告系統</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
