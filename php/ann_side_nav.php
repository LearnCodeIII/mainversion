<nav class="sidenav">
    <ul class="navbar-nav">
        <li class="nav-item <?= $phpname == "phpHome" ? "active" : ""; ?>">
            <a class="nav-link" href="./AnnPageMain.php"></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="ann_complete_list.php">全部列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="ann_client_list.php">客戶列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="ann_client_create.php">客戶新增</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="ann_ad_list.php">廣告列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">廣告新增</a>
        </li>
        <li class="nav-item <?= $phpname == "phpSetting" ? "active" : ""; ?>">
            <a class="nav-link" href="#">管理員</a>
        </li>
    </ul>
</nav>