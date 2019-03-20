<nav class="sidenav">
    <ul class="navbar-nav">
        <li class="nav-item <?= $spname == "member_list"?"active":"" ?>">
            <a class="nav-link" href="./Su_member_list.php">會員列表</a>
        </li>
        <li class="nav-item <?= $spname == "member_list_choose"?"active":"" ?>">
            <a class="nav-link" href="./Su_member_list_choose.php">會員列表(自訂)</a>
        </li>
        <li class="nav-item <?= $spname == "member_search"?"active":"" ?>">
            <a class="nav-link" href="./Su_member_search.php">會員資料搜尋</a>
        </li>
        <li class="nav-item <?= $spname == "member_insert"?"active":"" ?>">
            <a class="nav-link" href="./Su_member_insert.php">新增會員資料</a>
        </li>
        <li class="nav-item <?= $spname == "member_blacklist"?"active":"" ?>">
            <a class="nav-link" href="./Su_member_blacklist.php">黑名單管理</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">成就管理</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">會員排名</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">參數設置</a>
        </li>
        <li class="nav-item <?= $phpname == "phpSetting"?"active":""; ?>">
            <a class="nav-link" href="#">管理者設置</a>
        </li>
    </ul>
</nav>