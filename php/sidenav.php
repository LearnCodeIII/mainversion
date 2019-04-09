<?php include __DIR__.'./session_test.php'
?>
<section class="accordion nav_width bg-dark">
    <div class="nav_wrapper">
        <div class="navbar-brand d-flex justify-content-center align-content-center text-light">
            <div class="p-3"><a href="mainpage.php">.<span class="text-warning">M</span>ovieee</a></div>
        </div>
        <div class="bg-gradient-dark" id="accordionExample">
            <div class="card bg-dark">
                <div class="card-header" id="heading1">
                    <h2 class="mb-0 pl-3">
                        <button class="btn btn-link text-light text-decoration-none" type="button"
                            data-toggle="collapse" data-target="#collapse1" aria-expanded="false"
                            aria-controls="collapse1"><i class="fas fa-user fa-fw"></i><span class="px-2"> 會員系統</span>
                        </button>
                    </h2>
                </div>

                <div id="collapse1" class="collapse <?= $groupname == "member"?"show":""; ?>" aria-labelledby="heading1"
                    data-parent="#accordionExample">
                    <div class="card-body bg_gray">
                    <ul class="text-light pl-4">
                            <li class="<?= $pagename == "member_search"?"thisPage":""; ?>"><a
                                    href="./Su_member_search.php">會員總覽</a></li>
                            <li class="<?= $pagename == "member_insert"?"thisPage":""; ?>"><a
                                    href="./Su_member_insert.php">新增會員資料</a></li>
                            <li class="<?= $pagename == "member_blacklist"?"thisPage":""; ?>"><a
                                    href="./Su_member_blacklist.php">管理黑名單</a></li>
                            <li class="<?= $pagename == "member_permission"?"thisPage":""; ?>"><a
                                    href="./Su_member_permission.php">權限管理</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-header" id="heading2">
                    <h2 class="mb-0 pl-3">
                        <button class="btn btn-link text-light text-decoration-none" type="button"
                            data-toggle="collapse" data-target="#collapse2" aria-expanded="false"
                            aria-controls="collapse2"><i class="fas fa-landmark fa-fw"></i>
                            <span class="px-2">廠商系統</span>
                        </button>
                    </h2>
                </div>

                <div id="collapse2" class="collapse <?= $groupname == "theater"?"show":""; ?>" aria-labelledby="heading2"
                    data-parent="#accordionExample">
                    <div class="card-body bg_gray">
                        <ul class="pl-4">
                            <li class="<?= $pagename == "cinema_ifmt_list"?"thisPage":""; ?>"><a
                                    href="cinema_ifmt_list.php">戲院資訊</a></li>
                            <li class="<?= $pagename == "cinema_insert"?"thisPage":""; ?>"><a
                                    href="cinema_insert.php">新增戲院資料</a></li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-header" id="heading3">
                    <h2 class="mb-0 pl-3">
                        <button class="btn btn-link text-light text-decoration-none" type="button"
                            data-toggle="collapse" data-target="#collapse3" aria-expanded="false"
                            aria-controls="collapse3"><i class="fas fa-film fa-fw"></i>
                            <span class="px-2">電影資料庫</span>
                        </button>
                    </h2>
                </div>

                <div id="collapse3" class="collapse <?= $groupname == "film"?"show":""; ?>" aria-labelledby="heading3"
                    data-parent="#accordionExample">
                    <div class="card-body bg_gray">
                        <ul class="pl-4">
                            <li class="<?= $pagename == "film_main"?"thisPage":""; ?>"><a
                                    href="./film_main.php">影片總覽</a></li>
                            <li class="<?= $pagename == "film_data_list"?"thisPage":""; ?>"><a
                                    href="./film_data_list.php">影片清單</a></li>
                            <li class="<?= $pagename == "film_list_choose"?"thisPage":""; ?>"><a
                                    href="./film_list_choose.php">自訂影片清單</a></li>
                            <li class="<?= $pagename == "film_data_search"?"thisPage":""; ?>"><a
                                    href="./film_data_search.php">影片搜尋</a></li>
                            <li class="<?= $pagename == "film_data_insert"?"thisPage":""; ?>"><a
                                    href="./film_data_insert.php">新增影片資訊</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-header" id="heading4">
                    <h2 class="mb-0 pl-3">
                        <button class="btn btn-link text-light text-decoration-none" type="button"
                            data-toggle="collapse" data-target="#collapse4" aria-expanded="false"
                            aria-controls="collapse4"><i class="far fa-newspaper fa-fw"></i>
                            <span class="px-2">文章專區</span>
                        </button>
                    </h2>
                </div>

                <div id="collapse4" class="collapse <?= $groupname == "article"?"show":""; ?>"
                    aria-labelledby="heading4" data-parent="#accordionExample">
                    <div class="card-body bg_gray">
                        <ul class="pl-4">
                            <!-- <li class="<?= $pagename == "article_list"?"thisPage":""; ?>"><a
                                    href="article_list.php">新聞列表</a></li> -->
                            <li class="<?= $pagename == "article_search"?"thisPage":""; ?>"><a
                                    href="article_search.php">新聞搜尋</a></li>
                            <li class="<?= $pagename == "comment_list"?"thisPage":""; ?>"><a
                                    href="comment_list.php">留言列表</a></li>
                            <li class="<?= $pagename == "article_insert"?"thisPage":""; ?>"><a
                                    href="article_insert.php">新增文章</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-header" id="heading5">
                    <h2 class="mb-0 pl-3">
                        <button class="btn btn-link text-light text-decoration-none" type="button"
                            data-toggle="collapse" data-target="#collapse5" aria-expanded="false"
                            aria-controls="collapse5"> <i class="fas fa-calendar-check fa-fw"></i>
                            <span class="px-2">活動系統</span>
                        </button>
                    </h2>
                </div>

                <div id="collapse5" class="collapse <?= $groupname == "activity"?"show":""; ?>"
                    aria-labelledby="heading5" data-parent="#accordionExample">
                    <div class="card-body bg_gray">
                        <ul class="pl-4">
                            <li class="<?= $pagename == "ShawnpageMain"?"thisPage":""; ?>"><a
                                    href="./ShawnpageMain.php">活動總覽</a></li>
                            <li class="<?= $pagename == "ShawnpageDatalist"?"thisPage":""; ?>"><a
                                    href="./ShawnpageDatalist.php">活動搜尋</a></li>
                            <li class="<?= $pagename == "ShawnpageAdd"?"thisPage":""; ?>"><a
                                    href="./ShawnpageAdd.php">新增活動</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-header" id="heading6">
                    <h2 class="mb-0 pl-3">
                        <button class="btn btn-link text-light text-decoration-none" type="button"
                            data-toggle="collapse" data-target="#collapse6" aria-expanded="false"
                            aria-controls="collapse6"><i class="fas fa-ad fa-fw"></i>
                            <span class="px-2">廣告管理</span>
                        </button>
                    </h2>
                </div>

                <div id="collapse6" class="collapse <?= $groupname == "ad"?"show":""; ?>" aria-labelledby="heading6"
                    data-parent="#accordionExample">
                    <div class="card-body bg_gray">
                        <ul class="pl-4">
                            <li class="<?= $pagename == "ad_list"?"thisPage":""; ?>"><a
                                    href="ad_list.php">客戶管理</a></li>
                            <li class="<?= $pagename == "ad_client_update"?"thisPage":""; ?>"><a
                                    href="ad_client_create.php">新增廣告</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-header" id="heading7">
                    <h2 class="mb-0 pl-3">
                        <button class="btn btn-link text-light text-decoration-none" type="button"
                            data-toggle="collapse" data-target="#collapse7" aria-expanded="false"
                            aria-controls="collapse7"><i class="fas fa-comments fa-fw"></i>
                            <span class="px-2">論壇管理</span>
                            </button>
                    </h2>
                </div>

                <div id="collapse7" class="collapse <?= $groupname == "forum"?"show":""; ?>" aria-labelledby="heading7"
                    data-parent="#accordionExample">
                    <div class="card-body bg_gray">
                        <ul class="pl-4">
                            <li class="<?= $pagename == "Roy_datalist"?"thisPage":""; ?>"><a
                                    href="./Roy_datalist.php">討論區</a></li>
                            <li class="<?= $pagename == "Roy_admin_data_insert_ajax"?"thisPage":""; ?>"><a
                                    href="./Roy_admin_data_insert_ajax.php">新增主題</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card myinfo bg-dark" style="width:100%;">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="text-center info_img">
                        <img src="../pic/avatar/<?=$user_avatar?>" class="img-fluid" alt="...">
                    </div>
                    <p class="card-text text-light m-2">wellcom!<?=$user_name?></p>
                    <div class="">
                        <!-- <h5 class="card-title text-light">wellcome! admin</h5> -->
                        <div class="">
                            <a href="./logout.php" class="btn btn-danger">LOGOUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- -------------------------menu------------------------------- -->

<div class="pos-f-t">
    <nav class="navbar d-flex justify-content-end">
        <div class="navbar-brand d-flex justify-content-center align-content-center text-dard">
            <div class=""><a href="mainpage.php" class="">.Movieee</a></div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent"
            aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
    </nav>
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="nav_wrapper">

            <div class="bg-gradient-dark" id="accordionExample2">
                <div class="card bg-dark">
                    <div class="card-header" id="heading1">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-light text-decoration-none" type="button"
                                data-toggle="collapse" data-target="#collapse1" aria-expanded="false"
                                aria-controls="collapse1">
                                會員系統
                            </button>
                        </h2>
                    </div>

                    <div id="collapse1" class="collapse " aria-labelledby="heading1" data-parent="#accordionExample2">
                        <div class="card-body">
                            <ul class="text-light">
                                <li class="<?= $pagename == "member_list"?"thisPage":""; ?>"><a
                                        href="./Su_member_list.php">會員總覽</a></li>
                                <li class="<?= $pagename == "member_list_choose"?"thisPage":""; ?>"><a
                                        href="./Su_member_list_choose.php">自訂會員列表</a></li>
                                <li class="<?= $pagename == "member_search"?"thisPage":""; ?>"><a
                                        href="./Su_member_search.php">搜尋會員資料</a></li>
                                <li class="<?= $pagename == "member_insert"?"thisPage":""; ?>"><a
                                        href="./Su_member_insert.php">新增會員資料</a></li>
                                <li class="<?= $pagename == "member_blacklist"?"thisPage":""; ?>"><a
                                        href="./Su_member_blacklist.php">管理黑名單</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card bg-dark">
                    <div class="card-header" id="heading2">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-light text-decoration-none" type="button"
                                data-toggle="collapse" data-target="#collapse2" aria-expanded="false"
                                aria-controls="collapse2">
                                廠商系統
                            </button>
                        </h2>
                    </div>

                    <div id="collapse2" class="collapse " aria-labelledby="heading2" data-parent="#accordionExample2">
                        <div class="card-body">
                            <ul>
                                <li class="<?= $pagename == "cinema_ifmt_list"?"thisPage":""; ?>"><a
                                        href="cinema_ifmt_list.php">戲院資訊</a></li>
                                <li class="<?= $pagename == "cinema_insert"?"thisPage":""; ?>"><a
                                        href="cinema_insert.php">新增戲院資料</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card bg-dark">
                    <div class="card-header" id="heading3">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-light text-decoration-none" type="button"
                                data-toggle="collapse" data-target="#collapse3" aria-expanded="false"
                                aria-controls="collapse3">
                                電影資料庫
                            </button>
                        </h2>
                    </div>

                    <div id="collapse3" class="collapse " aria-labelledby="heading3" data-parent="#accordionExample2">
                        <div class="card-body">
                            <ul>
                                <li class="<?= $pagename == "film_main"?"thisPage":""; ?>"><a href="">影片總覽</a></li>
                                <li class="<?= $pagename == "film_data_list"?"thisPage":""; ?>"><a href="">影片清單</a></li>
                                <li class="<?= $pagename == "film_list_choose"?"thisPage":""; ?>"><a
                                        href="film_data_search.php">自訂影片清單</a></li>
                                <li class="<?= $pagename == "film_data_search"?"thisPage":""; ?>"><a href="">影片搜尋</a>
                                </li>
                                <li class="<?= $pagename == "film_data_insert"?"thisPage":""; ?>"><a
                                        href="./film_data_insert.php">新增影片資訊</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card bg-dark">
                    <div class="card-header" id="heading4">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-light text-decoration-none" type="button"
                                data-toggle="collapse" data-target="#collapse4" aria-expanded="false"
                                aria-controls="collapse4">
                                文章專區
                            </button>
                        </h2>
                    </div>

                    <div id="collapse4" class="collapse " aria-labelledby="heading4" data-parent="#accordionExample2">
                        <div class="card-body">
                            <ul>
                                <li class="<?= $pagename == "article_list"?"thisPage":""; ?>"><a
                                        href="article_list.php">新聞列表</a></li>
                                <li class="<?= $pagename == "article_search"?"thisPage":""; ?>"><a
                                        href="article_search.php">新聞搜尋</a></li>
                                <li class="<?= $pagename == "comment_list"?"thisPage":""; ?>"><a
                                        href="comment_list.php">留言列表</a></li>
                                <li class="<?= $pagename == "article_insert"?"thisPage":""; ?>"><a
                                        href="article_insert.php">新增文章</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card bg-dark ">
                    <div class="card-header" id="heading5">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-light text-decoration-none" type="button"
                                data-toggle="collapse" data-target="#collapse5" aria-expanded="false"
                                aria-controls="collapse5">
                                活動系統
                            </button>
                        </h2>
                    </div>

                    <div id="collapse5" class="collapse " aria-labelledby="heading5" data-parent="#accordionExample2">
                        <div class="card-body">
                            <ul>
                                <li class="<?= $pagename == "ShawnpageMain"?"thisPage":""; ?>"><a
                                        href="./ShawnpageMain.php">活動總覽</a></li>
                                <li class="<?= $pagename == "ShawnpageDatalist"?"thisPage":""; ?>"><a
                                        href="./ShawnpageDatalist.php">活動搜尋</a></li>
                                <li class="<?= $pagename == "ShawnpageAdd"?"thisPage":""; ?>"><a
                                        href="./ShawnpageAdd.php">新增活動</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card bg-dark">
                    <div class="card-header" id="heading6">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-light text-decoration-none" type="button"
                                data-toggle="collapse" data-target="#collapse6" aria-expanded="false"
                                aria-controls="collapse6">
                                廣告管理
                            </button>
                        </h2>
                    </div>

                    <div id="collapse6" class="collapse " aria-labelledby="heading6" data-parent="#accordionExample2">
                        <div class="card-body">
                            <ul>
                                <li class="<?= $pagename == "REVISION_ann_ad_list"?"thisPage":""; ?>"><a
                                        href="REVISION_ann_ad_list.php">客戶管理</a></li>
                                <li class="<?= $pagename == "REVISION_ann_client_create"?"thisPage":""; ?>"><a
                                        href="REVISION_ann_client_create.php">新增廣告</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card bg-dark">
                    <div class="card-header" id="heading7">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-light text-decoration-none" type="button"
                                data-toggle="collapse" data-target="#collapse7" aria-expanded="false"
                                aria-controls="collapse7">
                                論壇管理
                            </button>
                        </h2>
                    </div>

                    <div id="collapse7" class="collapse " aria-labelledby="heading7" data-parent="#accordionExample2">
                        <div class="card-body">
                            <ul>
                                <li class="<?= $pagename == "Roy_datalist"?"thisPage":""; ?>"><a
                                        href="./Roy_datalist.php">討論區</a></li>
                                <li class="<?= $pagename == "Roy_admin_data_insert_ajax"?"thisPage":""; ?>"><a
                                        href="./Roy_admin_data_insert_ajax.php">新增主題</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card myinfo2 bg-dark">
                    <div class="card-body d-flex align-items-center">
                        <div class="text-center info_img">
                            <img src="../pic/avatar/<?=$user_avatar?>" class="img-fluid" alt="...">
                        </div>
                        <p class="card-text text-light m-2"><?=$user_name?></p>
                        <div class="">
                            <!-- <h5 class="card-title text-light">wellcome! admin</h5> -->
                            <div class="">
                                <a href="./logout.php" class="btn btn-danger btn-sm">LOGOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>