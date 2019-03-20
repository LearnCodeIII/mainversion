<nav class="sidenav">
    <ul class="navbar-nav">
    <li class="nav-item <?= $phpname == "phpHome"?"active":""; ?>">
            <a class="nav-link" href="./RuthPageMain.php">文章列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./RuthPageAdd.php">新增文章</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">留言管理</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">還沒想到</a>
        </li>
        <li class="nav-item <?= $phpname == "phpSetting"?"active":""; ?>">
            <a class="nav-link" href="#">管理者設置</a>
        </li>
    </ul>
</nav>