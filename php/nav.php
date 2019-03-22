<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="mainpage.php">.Moiveee</a>
	<div class="container-fulid">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse " id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?= $groupname == "member"?"active":""; ?>">
					<a class="nav-link" href="Su_member_list.php"><i class="fas fa-user-tie"></i> 會員系統</a>
				</li>
				<li class="nav-item <?= $groupname == "theater"?"active":""; ?>">
					<a class="nav-link" href="cinema_ifmt_list.php"><i class="fas fa-theater-masks"></i> 戲院系統</a>
				</li>
				<li class="nav-item <?= $groupname == "film"?"active":""; ?>">
					<a class="nav-link" href="film_main.php"><i class="fas fa-film"></i> 影片系統</a>
				</li>
				<li class="nav-item <?= $groupname == "article"?"active":""; ?>">
					<a class="nav-link" href="article_list.php"><i class="far fa-newspaper"></i></i> 文章系統</a>
				</li>
				<li class="nav-item <?= $groupname == "activity"?"active":""; ?>">
					<a class="nav-link" href="ShawnpageDatalist.php"><i class="fas fa-snowboarding"></i> 活動系統</a>
				</li>
				<li class="nav-item <?= $groupname == "forum"?"active":""; ?>">
					<a class="nav-link" href="Roy_datalist.php"><i class="fas fa-igloo"></i> 論壇系統</a>
				</li>
				<li class="nav-item <?= $groupname == "adversite"?"active":""; ?>">
					<a class="nav-link" href="ann_client_list.php"><i class="fas fa-ad"></i> 廣告系統</a>
				</li>
			</ul>
			<!-- <ul class="navbar-nav mr-auto">
				<li class="nav-item <?= $groupname == "non"?"active":""; ?>">
					<a class="nav-link" href="logout.php"><i class="fas fa-user-circle"></i> 登出</a>
				</li>
			</ul> -->
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?= $groupname == "member"?"active":""; ?>">
					<a class="nav-link" href="work.php"> 　　</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
