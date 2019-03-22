<?php


?>


<nav class="sidenav">
    <ul class="navbar-nav">
        <li class="nav-item <?=isset($_SESSION["admin"])?"":"d-none" ?>">
            <a class="nav-link" href="./Roy_datalist.php">資料列表</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="./Roy_admin_data_insert_ajax.php">新增文章</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="./Roy_datalist_search.php">搜尋資料</a>
        </li> -->

    </ul>
</nav>