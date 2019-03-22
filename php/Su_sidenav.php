<nav class="sidenav">
    <ul class="navbar-nav">
        <li class="nav-item <?= $spname == "member_list"?"active":"" ?>">
            <a class="nav-link" href="./Su_member_list.php">會員資料總覽</a>
        </li>
        <li class="nav-item <?= $spname == "member_list_choose"?"active":"" ?>">
            <a class="nav-link" href="./Su_member_list_choose.php">會員列表(自訂)</a>
        </li>
        <li class="nav-item <?= $spname == "member_search"?"active":"" ?>">
            <a class="nav-link" href="./Su_member_search.php">會員搜尋</a>
        </li>
        <li class="nav-item">
        <li class="nav-item <?= $spname == "member_insert"?"active":"" ?>">
            <a class="nav-link" href="./Su_member_insert.php">新增會員資料</a>
        </li>
        <li class="nav-item <?= $spname == "member_blacklist"?"active":"" ?>">
            <a class="nav-link" href="./Su_member_blacklist.php">黑名單管理</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">--以下待補--</a>
        </li>
            <a class="nav-link" href="#">成就管理</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">會員排名</a>
        </li>


    </ul>
</nav>