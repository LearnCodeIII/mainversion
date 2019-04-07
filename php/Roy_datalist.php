<?php
$pagename = "Roy_datalist";
include __DIR__ . '/PDO.php';

if (!isset($_SESSION["admin"]) && !isset($_SESSION["member"]) && !isset($_SESSION["theater"])) {
    header('Location: login.php');
}
?>
<?php include __DIR__ . './head.php'?>
<?php include __DIR__ . './sidenav.php'?>

<head>
    <script src="../js/sweet.js"></script>

    <!-- datatablb  B4style -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>

    <!-- datatable  default style -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css"> -->
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js">
    </script> -->


</head>

<style>
.transiton {
    transition: 0.3s;
}

.margin1 {
    margin: 0 auto
}

.roundright {
    border-radius: 0 16px 16px 0;
}

.roundleft {
    border-radius: 16px 0 0 16px;
}

.statushidden,
.statusactive.active {
    height: 36px;
    max-width: 0
}

.statusactive,
.statushidden.active {
    height: 36px;
    flex: 1;
    max-width: 100%
}

/* .showhidemenuleftarea{
    height: 30px;
    border: 3px solid transparent;
    border-radius: 10px;
} */


/* .review-content {
    width: 4%;
    表頭欄寬
} */
</style>
<section class="dashboard <?=isset($_SESSION["admin"]) ? "" : "d-none"?>">
    <div class="container-fluid ">
        <div class="col-lg-12 ">
            <div class="row">
                <!-- Button trigger modal -->
                <!-- data-target="#exampleModalCenter導向開關內容 -->
                <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#hideshowevent">
                    隱藏欄位清單
                </button>
            </div>
            <div class="row d-none">
                <div class="col-lg-12 d-flex justify-content-center ">
                    <div class="pagenav">
                    </div>
                </div>
            </div>
            <div class="row d-none">
                <div class="col-lg-12 d-flex justify-content-center">
                    <nav class="d-flex">
                        <ul class="firstpage pagination pagination-sm">
                        </ul>
                        <ul class="prepage pagination pagination-sm">
                        </ul>
                        <ul class="allpages pagination pagination-sm">
                        </ul>
                        <ul class="nextpage pagination pagination-sm">
                        </ul>
                        <ul class="lastpage pagination pagination-sm">
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- 設TABLERESPONSIVE -->
            <div class="row table-responsive ">
                <table class="table table-bordered text-center text-nowrap " id="mytable">
                    <thead class="  thead-dark table-bordered">
                        <tr>
                            <th class="review-content" scope="col">編號</th>
                            <th class="review-content" scope="col">操作</th>
                            <!-- <th class="review-content" scope="col">編輯</th> -->
                            <!-- <th class="review-content" scope="col">隱藏</th> -->
                            <!-- <th class="review-content" scope="col">刪除</th> -->
                            <th class="review-content" scope="col">評論者</th>
                            <th class="review-content" scope="col">電影</th>
                            <th class="review-content" scope="col">爆雷</th>
                            <th class="review-content" scope="col">電影評分</th>
                            <th class="review-content" scope="col">電影最愛</th>
                            <th class="review-content" scope="col">文章點擊</th>
                            <th class="review-content" scope="col">標題</th>
                            <th class="review-content" scope="col">影評</th>

                            <th class="review-content" scope="col">觀看戲院</th>
                            <th class="review-content" scope="col">戲院評論</th>
                            <th class="review-content" scope="col">戲院評分</th>
                            <th class="review-content" scope="col">戲院最愛</th>

                            <th class="review-content" scope="col">檢舉內容</th>
                            <th class="review-content" scope="col">檢舉數</th>
                            <th class="review-content" scope="col">文章票數</th>
                            <th class="review-content" scope="col">文章推數</th>
                            <th class="review-content" scope="col">留言數</th>
                            <th class="review-content" scope="col">發布時間</th>
                            <th class="review-content" scope="col">觀看日期</th>
                            <th class="review-content" scope="col">最後修改</th>
                        </tr>
                    </thead>
                    <tbody id="forum_databody" class="thead-light table-bordered">
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <!-- ID要對應到隱藏欄位清單BUTTON TOGGLE -->
    <div class="modal fade" id="hideshowevent" tabindex="-1" role="dialog" aria-labelledby="hideshoweventTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hideshoweventTitle">請選擇需隱藏與顯示之欄位</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <!-- 控制預設不能開關 -->
                        <!-- <div class="showhidemenu d-flex ">
                            <div class="showhidemenuleftarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 編號</p>
                                </div>
                                <a type="button "
                                    class="status status0 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="0" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 編號</p>
                                </div>
                            </div>
                            <div class="showhidemenurightarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 操作</p>
                                </div>
                                <a type="button "
                                    class="status status1 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="1" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 操作</p>
                                </div>
                            </div>
                        </div> -->
                        <div class="showhidemenu d-flex ">
                            <div class="showhidemenuleftarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 評論者</p>
                                </div>
                                <a type="button "
                                    class="status status2 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="2" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 評論者</p>
                                </div>
                            </div>
                            <div class="showhidemenurightarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 電影</p>
                                </div>
                                <a type="button "
                                    class="status status3 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="3" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 電影</p>
                                </div>
                            </div>
                        </div>
                        <div class="showhidemenu d-flex ">
                            <div class="showhidemenuleftarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 爆雷</p>
                                </div>
                                <a type="button "
                                    class="status status4 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="4" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 爆雷</p>
                                </div>
                            </div>
                            <div class="showhidemenurightarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 電影評分</p>
                                </div>
                                <a type="button "
                                    class="status status5 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="5" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 電影評分</p>
                                </div>
                            </div>
                        </div>
                        <div class="showhidemenu d-flex ">
                            <div class="showhidemenuleftarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 電影最愛</p>
                                </div>
                                <a type="button "
                                    class="status status6 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="6" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 電影最愛</p>
                                </div>
                            </div>
                            <div class="showhidemenurightarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 文章點擊</p>
                                </div>
                                <a type="button "
                                    class="status status7 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="7" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 文章點擊</p>
                                </div>
                            </div>
                        </div>
                        <div class="showhidemenu d-flex ">
                            <div class="showhidemenuleftarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 標題</p>
                                </div>
                                <a type="button "
                                    class="status status8 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="8" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 標題</p>
                                </div>
                            </div>
                            <div class="showhidemenurightarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 影評</p>
                                </div>
                                <a type="button "
                                    class="status status9 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="9" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 影評</p>
                                </div>
                            </div>
                        </div>

                        <div class="showhidemenu d-flex ">
                            <div class="showhidemenuleftarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 觀看戲院</p>
                                </div>
                                <a type="button "
                                    class="status status10 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="10" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 觀看戲院</p>
                                </div>
                            </div>
                            <div class="showhidemenurightarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 戲院評論</p>
                                </div>
                                <a type="button "
                                    class="status status11 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="11" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 戲院評論</p>
                                </div>
                            </div>
                        </div>
                        <div class="showhidemenu d-flex ">
                            <div class="showhidemenuleftarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 戲院評分</p>
                                </div>
                                <a type="button "
                                    class="status status12 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="12" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 戲院評分</p>
                                </div>
                            </div>
                            <div class="showhidemenurightarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 戲院最愛</p>
                                </div>
                                <a type="button "
                                    class="status status13 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="13" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 戲院最愛</p>
                                </div>
                            </div>
                        </div>


                        <div class="showhidemenu d-flex ">
                            <div class="showhidemenuleftarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 檢舉內容</p>
                                </div>
                                <a type="button "
                                    class="status status14 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="14" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 檢舉內容</p>
                                </div>
                            </div>
                            <div class="showhidemenurightarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 檢舉數</p>
                                </div>
                                <a type="button "
                                    class="status status15 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="15" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 檢舉數</p>
                                </div>
                            </div>
                        </div>
                        <div class="showhidemenu d-flex ">
                            <div class="showhidemenuleftarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 文章票數</p>
                                </div>
                                <a type="button "
                                    class="status status16 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="16" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 文章票數</p>
                                </div>
                            </div>
                            <div class="showhidemenurightarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 文章推數</p>
                                </div>
                                <a type="button "
                                    class="status status17 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="17" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 文章推數</p>
                                </div>
                            </div>
                        </div>
                        <div class="showhidemenu d-flex ">
                            <div class="showhidemenuleftarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 留言數</p>
                                </div>
                                <a type="button "
                                    class="status status18 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="18" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 留言數</p>
                                </div>
                            </div>
                            <div class="showhidemenurightarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 發布時間</p>
                                </div>
                                <a type="button "
                                    class="status status19 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="19" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 發布時間</p>
                                </div>
                            </div>
                        </div>
                        <div class="showhidemenu d-flex ">
                            <div class="showhidemenuleftarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 觀看日期</p>
                                </div>
                                <a type="button "
                                    class="status status20 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="20" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 觀看日期</p>
                                </div>
                            </div>
                            <div class="showhidemenurightarea col-lg-6 m-2 p-0 flex-fill d-flex ">
                                <div
                                    class="statushidden btn-secondary roundleft col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 最後修改</p>
                                </div>
                                <a type="button "
                                    class="status status21 toggle-vis transiton btn rounded-0 col-2 p-0 border-0 justify-content-center d-flex align-items-center"
                                    data-column="21" role="group" aria-label="Basic example">
                                    <i class="far fa-eye text-light "></i>
                                    <i class="fas fa-ban text-light "></i>
                                </a>
                                <div
                                    class="statusactive btn-secondary roundright col-0 p-0 border-0 transiton justify-content-center d-flex align-items-center active">
                                    <p class="m-0 "> 最後修改</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="poparea">
        <!-- 用來暫存標題文章內容 -->
    </div>

</section>

<script>
let page = 1;

let ori_data;
const ul_pagi = document.querySelector('.allpages');
const pagenav = document.querySelector('.pagenav');
const ul_first = document.querySelector('.firstpage');
const ul_pre = document.querySelector('.prepage');
const ul_next = document.querySelector('.nextpage');
const ul_last = document.querySelector('.lastpage');
const forum_databody = document.querySelector("#forum_databody");


// 資料TABLE生成
// ?sid=<%=sid%>要加才能選定刪除的sid
// <a href="./Roy_data_delete.php?sid=<%=sid%>"> 不須刪除提醒的寫法
const tr_str = ` <tr>
                    <td><%=sid%></td>
                    <td>
                        <a href="./Roy_datapreview.php?sid=<%=sid%>"><i class="fas fa-eye mx-1"></i></a>
                        <a href="./Roy_data_edit.php?sid=<%=sid%>"><i class="far fa-edit mx-1"></i></a>
                        <a href="javascript:delete_it(<%=sid%>)"><i class="far fa-trash-alt mx-1"></i></a>
                    </td>
                    <td><%=issuer%></td>
                    <td><%=w_film%></td>
                    <td><%=re_spoilers%></td>
                    <td><%=film_rate%></td>
                    <td><%=film_fav_count%></td>
                    <td><%=review_click%></td>
                    <td>
                        <a href="#set_headline<%=sid%>" data-toggle="modal" data-target="#set_headline<%=sid%>">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#set_review<%=sid%>" data-toggle="modal" data-target="#set_review<%=sid%>">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td><%=w_cinema%></td>
                    <td>
                        <a href="#set_cinema_comment<%=sid%>" data-toggle="modal" data-target="#set_cinema_comment<%=sid%>">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td><%=cinema_rate%></td>
                    <td><%=cinema_push_count%></td>
                    <td>
                        <a href="#set_report<%=sid%>" data-toggle="modal" data-target="#set_report<%=sid%>">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>

                    <td><%=re_report%></td>
                    <td><%=re_vote_count%></td>
                    <td><%=re_push_count%></td>
                    <td><%=re_reply_count%></td>
                    <td class="text-nowrap"><%=i_date%></td>
                    <td><%=w_date%></td>
                    <td class="text-nowrap"><%=re_last_edit%></td>
                </tr>
                
                `

// 生成標題內文用
const pop_str = `
    <div class="modal fade" id="set_headline<%=sid%>" tabindex="-1" role="dialog"
        aria-labelledby="set_headlineCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="set_headlineTitle">編號<%=sid%>標題內容</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <tr class="col-lg-12 panel-collapse collapse in" id="set_headline<%=sid%>">
                        <td colspan="100%" class=" text-left">
                            <%=headline%>
                        </td>
                    </tr>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="set_review<%=sid%>" tabindex="-1" role="dialog"
        aria-labelledby="set_reviewCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="set_reviewTitle">編號<%=sid%>電影評價內容</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <tr class="col-lg-12 panel-collapse collapse in" id="set_review<%=sid%>">
                        <td colspan="100%" class=" text-left">
                            <%=review%>
                        </td>
                    </tr>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="set_report<%=sid%>" tabindex="-1" role="dialog"
        aria-labelledby=""set_reportCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=""set_reportTitle">編號<%=sid%>檢舉內容</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <tr class="col-lg-12 panel-collapse collapse in" id="set_report<%=sid%>">
                        <td colspan="100%" class=" text-left">
                           <%=re_report_content%>
                        </td>
                    </tr>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="set_cinema_comment<%=sid%>" tabindex="-1" role="dialog"
        aria-labelledby=""set_cinema_commentCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=""set_cinema_commentTitle">編號<%=sid%>戲院評價內容</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <tr class="col-lg-12 panel-collapse collapse in" id="set_cinema_comment<%=sid%>">
                        <td colspan="100%" class=" text-left">
                           <%=cinema_comment%>
                        </td>
                    </tr>
                </div>
            </div>
        </div>
    </div>

`


//刪除提醒
function delete_it(sid) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false,
    })
    swalWithBootstrapButtons.fire({
        title: "確定要刪除編號" + sid + "的資料嗎",
        text: "刪除後將無法回復",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: '確認刪除',
        cancelButtonText: '取消刪除',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            swalWithBootstrapButtons.fire({
                title: '刪除成功',
                text: "您的檔案已被刪除",
                confirmButtonText: '確認',
                type: 'success'
            }).then((result) => {
                location.href = "Roy_data_delete.php?sid=" + sid;
            })
        } else if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: '取消成功',
                text: "檔案未被刪除",
                confirmButtonText: '確認',
                type: 'error'
            })
        }
    })
}


const tr_func = _.template(tr_str);

// 生成標題內文用
const pop_func = _.template(pop_str);
//分頁按鈕生成
const pagi_str = `<li class="page-item  <%= active%>" style="visibility:<%= h %>">
                    <a class="page-link" href="#<%= page %>"><%= page %></a>
                  </li>`;



const pagi_func = _.template(pagi_str);

// 文章匯入
const myHashChange = () => {
    let h = location.hash.slice(1);
    page = parseInt(h);

    if (isNaN(page)) {
        page = 1;
    }
    const pagi_first = `<li class="page-item ${page<=1? "disabled":""} ">
                    <a class="page-link" href="#1">&lt;&lt;</a>
                  </li>`;
    const pagi_pre = `<li class="page-item ${page<=1? "disabled":""} ">
                    <a class="page-link" href="#${page-1}">&lt;</a>
                  </li>`;

    ul_first.innerHTML = pagi_first;
    ul_pre.innerHTML = pagi_pre;


    fetch("Roy_datalist_api.php?page=" + page)
        .then(response => response.json())
        .then(json => {
            ori_data = json;
            console.log(ori_data);

            // 文章內容匯入
            let str = '';
            let pop = "";
            for (let v of ori_data.data) {

                console.log(ori_data.data[0]["re_spoilers"])

                // 生成TABLE用
                str += tr_func(v);
                // 生成標題內文用
                pop += pop_func(v)
            }
            // 生成TABLE用
            forum_databody.innerHTML = str;
            // 生成標題內文用
            poparea.innerHTML = pop;

            //等到文HTML匯入後用 JQ TABLE自動分頁篩選
            $(document).ready(function() {

                var dynamicallytable = $('#mytable').DataTable({
                    // 固定只捲動資料內容，頭尾不動
                    scrollY: '70vh',
                    // 顯示所有頁面按鈕包含第一最後頁
                    pagingType: 'full_numbers',
                    // 儲存當下頁面，重新導向後還是會停留在當頁
                    stateSave: true,
                    // 讓PAGE顯示再TABLE外卷軸不會影響到位置，但內文會依據最寬欄位固定大小然如有設SCRROLL Y則不必
                    "scrollX": true,
                    // 設定顯示字體
                    "language": {
                        "search": "搜尋",
                        "lengthMenu": "每頁顯示比數 _MENU_",
                        // 找不到結果顯示
                        "zeroRecords": "找不到哦",
                        // "info": "Showing page _PAGE_ of _PAGES_",
                        "info": "目前頁面_START_ 至 _END_ 筆/總共_TOTAL_ 筆",
                        // 搜尋過程中後面持續顯示總比數
                        "infoFiltered": "(從總共_MAX_筆資料中篩選結果)",
                        "infoEmpty": "沒有符合搜尋結果",
                        "paginate": {
                            "first": "首頁",
                            "last": "末頁",
                            "next": "下一頁",
                            "previous": "上一頁"
                        },
                    },

                    // 設定table dom位置
                    "dom": '<"justify-content-start d-flex"<f>>' +
                        // 搜尋f
                        '<"justify-content-between d-flex"<l><i>>' +
                        // 顯示頁數比數L 和目前頁數與總數I
                        '<"justify-content-center d-flex"<"bottom"p>>' +
                        // 頁碼p
                        'r' +
                        // 不知啥r
                        't' +
                        // table t
                        '<"justify-content-center d-flex"<"bottom"p>>' +
                        // 頁碼p
                        '<"clear">'
                });

                // 這個要擺在外面用來切換欄位消失顯示，要先製作a.toggle-vis的超連結
                $('a.toggle-vis').on('click', function(e) {
                    e.preventDefault();

                    // Get the column API object
                    // 抓到目前attr data-column的值導向的欄位,dynamicallytable在上面VAR
                    var column = dynamicallytable.column($(this).attr('data-column'));

                    // Toggle the visibility
                    column.visible(!column.visible());
                });



                var i = 0
                var showstatus = ""
                for (i = 0; i < 22; i++) {
                    // 抓到當下TABLE是否顯示
                    showstatus = $('#mytable').DataTable().column(i).visible()
                    // console.log(showstatus)

                    if (showstatus) {
                        // $(`.status${i}`).removeClass("btn-danger")
                        $(`.status${i}`).removeClass("btn-primary")
                        $(`.status${i}`).addClass("btn-danger")
                        $(`.status${i}`).closest("div").find(".statusactive").removeClass("active");
                        $(`.status${i}`).closest("div").find(".statushidden").removeClass("active");
                        $(`.status${i}`).closest("div").find(".statusactive p").removeClass("d-none");
                        $(`.status${i}`).closest("div").find(".statushidden p").addClass("d-none");
                        $(`.status${i}`).closest("div").find(".fa-ban").removeClass("d-none");
                        $(`.status${i}`).closest("div").find(".fa-eye").addClass("d-none");
                    } else {
                        console.log("12313213")
                        // ICON顏色
                        $(`.status${i}`).removeClass("btn-danger")
                        $(`.status${i}`).addClass("btn-primary")
                        // 灰底收縮
                        $(`.status${i}`).closest("div").find(".statusactive").addClass("active");
                        $(`.status${i}`).closest("div").find(".statushidden").addClass("active");
                        // 欄位標題
                        $(`.status${i}`).closest("div").find(".statushidden p").removeClass("d-none");
                        $(`.status${i}`).closest("div").find(".statusactive p").addClass("d-none");
                        // ICON內容
                        $(`.status${i}`).closest("div").find(".fa-eye").removeClass("d-none");
                        $(`.status${i}`).closest("div").find(".fa-ban").addClass("d-none");
                    }
                }


                // 單獨控制按下BUTTON切換顏色與色塊移動
                $(".status").click(function() {
                    // 偵測目前點到的項次欄位為隱藏還顯示
                    var currenthideshowstatus = $('#mytable').DataTable().column($(this).attr(
                        'data-column')).visible()

                    // 反向再反向，多打的
                    // 因為點下去後會從原狀態變更為反狀態，因此要再把值反倒
                    // 點下後把值用相反值倒
                    // k = !currenthideshowstatus
                    // console.log(k)

                    // 讓BUTTON根據TRUE FALSE調整外觀
                    if (currenthideshowstatus) {
                        // 要轉變成顯示模式
                        $(this).removeClass("btn-primary")
                        $(this).addClass("btn-danger")
                        $(this).closest("div").find(".statushidden").find("p").addClass(
                            "d-none")
                        $(this).closest("div").find(".statusactive").find("p").removeClass(
                            "d-none")
                        // 要把眼睛顯示出來
                        $(this).find(".fa-eye").addClass("d-none")
                        // 把禁止隱藏起來
                        $(this).find(".fa-ban").removeClass("d-none")
                    } else {
                        $(this).removeClass("btn-danger")
                        $(this).addClass("btn-primary")
                        $(this).closest("div").find(".statusactive").find("p").addClass(
                            "d-none")
                        $(this).closest("div").find(".statushidden").find("p").removeClass(
                            "d-none")
                        $(this).find(".fa-ban").addClass("d-none")
                        $(this).find(".fa-eye").removeClass("d-none")
                    }

                    $(this).closest("div").find(".statusactive").toggleClass("active");
                    $(this).closest("div").find(".statushidden").toggleClass("active");
                })


            })
            // 分頁按鈕

            str = '';
            for (let i = 1; i <= ori_data.totalPages; i++) {
                let active = ori_data.page === i ? 'active' : '';

                let hide = ""
                str += pagi_func({
                    active: active,
                    h: hide,
                    page: i
                });
                const pagi_next = `<li class="page-item ${page>=ori_data.totalPages? "disabled":""}">
                    <a class="page-link" href="#${page+1}">&gt</a>
                  </li>`;

                const pagi_last = `<li class="page-item ${page>=ori_data.totalPages? "disabled":""}">
                    <a class="page-link" href="#${ori_data.totalPages}">&gt&gt</a>
                  </li>`;
                ul_next.innerHTML = pagi_next;
                ul_last.innerHTML = pagi_last;
                console.log(str)

            }
            ul_pagi.innerHTML = str;
            pagenav.innerHTML = "第" + page + "頁/共" + ori_data.totalPages + "頁";
        })

}

window.addEventListener('hashchange', myHashChange);
myHashChange();
</script>
<?php include __DIR__ . './foot.php'?>