<?php
require __DIR__.'/PDO.php';

$groupname = "film";
$pagename = "film_data_search";

include __DIR__.'./head.php';
include __DIR__.'./sidenav.php'

?>

<section class="dashboard">

    <!-- <div class="alert alert-warning" role="alert">
        尬廣跟上?
    </div> -->

    <h2 class="card-title text-center">搜尋影片資料
    </h2>

    <form name="form1" method="post" action="" onsubmit="return checkForm()">
        <input type="hidden" name="" value="sid">


        <div class="row justify-content-center">
            <div class="col-lg-5">
                <label class="sr-only" for="inlineFormInputName2">Name</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="keyword" name="keyword" placeholder="請填入關鍵字">
            </div>
            <!-- <div class="col-lg-1">
                <button id="submit_btn" type="submit" class="btn btn-primary mb-2">開始搜尋</button>
            </div> -->
        </div>


        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="row text-center">
                    <div class="col-lg-12">
                        <p class="h4">用那些欄位搜尋及顯示</p>
                    </div>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="all" name="all"
                        onclick="check_all('chk[]',this)">
                    <label id="l_all" class="custom-control-label" for="all">全選</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="sid" name="sid" value="sid" checked
                        disabled>
                    <label name="sid" class="custom-control-label" for="sid">影片編號</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="name_tw" name="chk[]" value="name_tw"
                        onclick="check(this,'all','chk[]')">
                    <label name="name_tw" class="custom-control-label" for="name_tw">電影名稱中文</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="name_en" name="chk[]" value="name_en"
                        onclick="check(this,'all','chk[]')">
                    <label name="name_en" class="custom-control-label" for="name_en">電影名稱英文</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="intro_tw" name="chk[]" value="intro_tw"
                        onclick="check(this,'all','chk[]')">
                    <label name="intro_tw" class="custom-control-label" for="intro_tw">電影介紹中文</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="intro_en" name="chk[]" value="intro_en"
                        onclick="check(this,'all','chk[]')">
                    <label name="intro_en" class="custom-control-label" for="intro_en">電影介紹英文</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="movie_pic" name="chk[]" value="movie_pic"
                        onclick="check(this,'all','chk[]')">
                    <label name="movie_pic" class="custom-control-label" for="movie_pic">電影圖</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="movie_genre" name="chk[]"
                        value="movie_genre" onclick="check(this,'all','chk[]')">
                    <label name="movie_genre" class="custom-control-label" for="movie_genre">電影類別</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="movie_ver" name="chk[]" value="movie_ver"
                        onclick="check(this,'all','chk[]')">
                    <label name="movie_ver" class="custom-control-label" for="movie_ver">放映類型</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="movie_rating" name="chk[]"
                        value="movie_rating" onclick="check(this,'all','chk[]')">
                    <label name="movie_rating" class="custom-control-label" for="movie_rating">電影分級</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="trailer" name="chk[]" value="trailer"
                        onclick="check(this,'all','chk[]')">
                    <label name="trailer" class="custom-control-label" for="trailer">預告片</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="pirce" name="chk[]" value="pirce"
                        onclick="check(this,'all','chk[]')">
                    <label name="pirce" class="custom-control-label" for="pirce">價格</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="schedule" name="chk[]" value="schedule"
                        onclick="check(this,'all','chk[]')">
                    <label name="schedule" class="custom-control-label" for="schedule">檔期</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="in_theaters" name="chk[]"
                        value="in_theaters" onclick="check(this,'all','chk[]')">
                    <label name="in_theaters" class="custom-control-label" for="in_theaters">上映日期</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="out_theaters" name="chk[]"
                        value="out_theaters" onclick="check(this,'all','chk[]')">
                    <label name="out_theaters" class="custom-control-label" for="out_theaters">下檔日期</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="runtime" name="chk[]" value="runtime"
                        onclick="check(this,'all','chk[]')">
                    <label name="runtime" class="custom-control-label" for="runtime">片長</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="director_tw" name="chk[]"
                        value="director_tw" onclick="check(this,'all','chk[]')">
                    <label name="director_tw" class="custom-control-label" for="director_tw">導演名稱中文</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="director_en" name="chk[]"
                        value="director_en" onclick="check(this,'all','chk[]')">
                    <label name="director_en" class="custom-control-label" for="director_en">導演名稱英文</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="country" name="chk[]" value="country"
                        onclick="check(this,'all','chk[]')">
                    <label name="country" class="custom-control-label" for="country">發行國家</label>
                </div>

                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="subtitle" name="chk[]" value="subtitle"
                        onclick="check(this,'all','chk[]')">
                    <label name="subtitle" class="custom-control-label" for="subtitle">提供字幕</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="subtitle_lang" name="chk[]"
                        value="subtitle_lang" onclick="check(this,'all','chk[]')">
                    <label name="subtitle_lang" class="custom-control-label" for="subtitle_lang">字幕語言</label>
                </div>


            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-2  d-flex justify-content-center">
                <button id="submit_btn" type="submit" class="btn btn-primary btn-block my-3">開始搜尋</button>
            </div>
        </div>

    </form>


    <div class="row info justify-content-center"></div>
    <div class="row d-flex justify-content-center">
        <div class="col-lg data_info"></div>
        <div class="col-lg-4">
            <div class="row d-flex justify-content-center flex-nowrap">
                <div class="col-lg">
                    <nav class="d-flex justify-content-center">
                        <ul id="first_page" class="pagination pagination-sm justify-content-center"></ul>
                        <ul id="pre_page" class="pagination pagination-sm justify-content-center"></ul>
                    </nav>
                </div>
                <div class="col-lg-5">
                    <nav class="d-flex justify-content-center">
                        <ul id="page_list" class="pagination pagination-sm justify-content-center"></ul>
                    </nav>
                </div>
                <div class="col-lg">
                    <nav class="d-flex justify-content-center">
                        <ul id="next_page" class="pagination pagination-sm justify-content-center"></ul>
                        <ul id="end_page" class="pagination pagination-sm justify-content-center"></ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-lg page_info"></div>
    </div>

    <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="thead-dark">
                    <tr id="title">

                    </tr>
                </thead>
                <tbody id="data_body"></tbody>
            </table>
        </div>
    </div>
</section>
<script>
    let page = 1;
    let ori_data;

    const data_page = document.querySelector('.pagination');
    const page_list = document.querySelector('#page_list');
    const data_body = document.querySelector('#data_body');

    const pre_page = document.querySelector('#pre_page');
    const next_page = document.querySelector('#next_page');
    const first_page = document.querySelector('#first_page');
    const end_page = document.querySelector('#end_page');
    const data_info = document.querySelector('.data_info');
    const page_info = document.querySelector('.page_info');

    const submit_btn = document.querySelector('#submit_btn');
    const title = document.querySelector('#title');
    const info = document.querySelector('.info');



    //使用underscore.js的template功能
    //先建立template字串 
    const page_str = `
                  <li class="page-item  <%= active %>" style="visibility:<%= v %>">
                  <a class="page-link" href="#<%= page %>"><%= page %></a></li>
                 `;
    const page_func = _.template(page_str);
    document.getElementById('all').checked = false;


    //checkbox全選
    function check_all(cName, obj) {
        var checkboxs = document.getElementsByName(cName);
        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].checked = obj.checked;
        }
    }

    //checkbox勾選狀態判斷
    function check(obj, chkall, cName) {
        if (obj.checked == false) {
            document.getElementById(chkall).checked = false;
        } else {
            let checkItem = document.getElementsByName(cName).length;
            let ci = 0;
            for (let i = 0; i < checkItem; i++) {
                if (document.getElementsByName(cName)[i].checked == true) {
                    ci++;
                }
            }
            if (ci == checkItem) {
                document.getElementById(chkall).checked = true;
            }
        }
    }

    //按delete時先跳出確認視窗後再刪除
    const checkDelete = (sid) => {

        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`) == true) {
            location.href = 'film_data_delete.php?sid=' + sid;
        } else {
            alert("無資料被刪除");
        }
    }



    const checkForm = () => {

        //submit_btn.style.display = 'none';按下提交後，按鈕消失(當資料處理結束才再設定顯示)
        info.innerHTML = "";
        title.innerHTML = "";
        data_body.innerHTML = "";
        page_list.innerHTML = "";
        data_info.innerHTML = "";
        page_info.innerHTML = "";
        first_page.innerHTML = "";
        pre_page.innerHTML = "";
        next_page.innerHTML = "";
        end_page.innerHTML = "";



        // 如果沒輸入值則跳提醒及回到原本頁面
        if(keyword.value == ""){
            alert("未填入要搜尋的資料喔");
            location.href="film_data_search.php";
            return false;
        }
           

        let form = new FormData(document.form1);

        fetch("film_data_search-api.php?page=" + page, {
            method: 'POST',
            body: form
        })
            .then(res => {
                return res.json();
            })
            .then(json => {
                ori_data = json;
                // console.log(ori_data);//得到api中的result陣列

                if (ori_data.success == false) {
                    console.log(ori_data);
                    info.innerHTML = `<div class="alert alert-danger col-lg-4 text-center my-3" role="alert"> ${ori_data.errorMsg} </div>`;
                } else {

                    //取得勾選的欄位
                    const temp_title = [];//存放取得結果
                    function printObject(obj) {
                        obj = ori_data.data[0];
                        for (var i in obj) {
                            temp_title.push(i);
                        }
                        console.log(temp_title)
                    };
                    printObject();

                    //製作欄位標題
                    let column_num = temp_title.length;
                    let title_index = column_num - 1;
                    let str = "";
                    let input_label = document.getElementsByTagName('label');
                    title.innerHTML = `<th scope="row"><i class="fas fa-edit"></i></th>
                            <th><i class="fas fa-trash-alt"></i></th>`
                    for (let i = 0; i <= title_index; i++) {
                        title.innerHTML += `<th scope="col" class="text-nowrap">${input_label[temp_title[i]].innerText}</th>`
                    }



                    //製作資料表格
                    for (let s in ori_data.data) {//用for in拿取ori_data(result陣列)中'data'的值
                        str = '';
                        str += `<th scope="row">
                            <a href="film_data_edit.php?sid=${ori_data.data[s][temp_title[0]]}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </th>
                        <td>
                            <a href="javascript: checkDelete(${ori_data.data[s][temp_title[0]]})">
                                <i class="text-danger fas fa-trash-alt"></i>
                            </a>
                        </td>`;
                        for (let i = 0; i < column_num; i++) {
                            if (temp_title[i] == 'movie_pic') {
                                str += `<td>
                                    <img src="../pic/film_upload/${ori_data.data[s][temp_title[i]]}" alt="" width="100">
                                </td>`
                            } else {
                                str += `<td>${ori_data.data[s][temp_title[i]]}</td>`
                            }

                        }
                        data_body.innerHTML += '<tr>' + str + '</tr>';
                    };



                    //製作頁碼按鈕
                    p_btn_num = 7;//設定可顯示幾個頁碼按鈕(建議使用奇數)
                    str = '';
                    for (let i = -parseInt(p_btn_num / 2); i <= parseInt(p_btn_num / 2); i++) {
                        let active = i === 0 ? 'active' : '';
                        let vh = '';
                        if (parseInt(ori_data.page) + i <= 0 || parseInt(ori_data.page) + i > parseInt(ori_data.tol_page)) {
                            vh = 'hidden';
                        }
                        str += page_func({
                            active: active,
                            v: vh,
                            page: ori_data.page + i,
                        });
                    }
                    page_list.innerHTML = str;


                    if (page <= 1) {
                        first_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="#1">&lt;&lt;</a></li>`
                    } else {
                        first_page.innerHTML = `<li class="page-item"><a class="page-link" href="#1" title="回到第一頁">&lt;&lt;</a></li>`
                    }
                    if (page <= 1) {
                        pre_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="?page=${page - 1}">&lt;</a></li>`
                    } else {
                        pre_page.innerHTML = `<li class="page-item"><a class="page-link" href="#${page - 1}" title="前一頁">&lt;</a></li>`
                    }
                    if (page >= ori_data.tol_page) {
                        next_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="?page=${page - 1}">&gt;</a></li>`
                    } else {
                        next_page.innerHTML = `<li class="page-item"><a class="page-link" href="#${page + 1}"  title="下一頁">&gt;</a></li>`
                    }
                    if (page >= ori_data.tol_page) {
                        end_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="#${ori_data.tol_page}">&gt;&gt;</a></li>`
                    } else {
                        end_page.innerHTML = `<li class="page-item"><a class="page-link" href="#${ori_data.tol_page}" title="跳到最末頁">&gt;&gt;</a></li>`
                    }


                    //資料筆數、頁數資訊
                    if (page >= ori_data.tol_page) {
                        data_info.innerHTML = `
                            <div class="col-lg-5">總資料筆數：${ori_data.row_count} 筆</div>
                            <div class="col-lg-7">本頁資料：第${(ori_data.tol_page - 1) * ori_data.per_page + 1} ~ ${ori_data.row_count} 筆</div>`
                        page_info.innerHTML = `
                            <div class="text-right">頁數：${ori_data.tol_page}  /  ${ori_data.tol_page}</div>`
                    } else if (page < 1) {
                        data_info.innerHTML = `
                            <div class="col-lg-5">總資料筆數：${ori_data.row_count} 筆</div>
                            <div class="col-lg-7">本頁資料：第1 ~ ${ori_data.per_page} 筆</div>`
                        page_info.innerHTML = `
                            <div class="text-right">頁數：1 / ${ori_data.tol_page}</div>`
                    } else {
                        data_info.innerHTML = `
                            <div class="col-lg-5">總資料筆數：${ori_data.row_count} 筆</div>
                            <div class="col-lg-7">本頁資料：第${(page - 1) * ori_data.per_page + 1} ~ ${page * ori_data.per_page} 筆</div>`
                        page_info.innerHTML = `
                            <div class="text-right">頁數：${page} / ${ori_data.tol_page}</div>`
                    }

                }
                submit_btn.style.display = 'block';

            });
        return false;
    }






    const myHashChange = () => {
        let h = location.hash.slice(1);
        page = parseInt(h);
        if (isNaN(page)) {
            page = 1;
        }


        let form = new FormData(document.form1);
        fetch("film_list_choose-api.php?page=" + page, {
            method: 'POST',
            body: form
        })
            .then(res => {
                return res.json();
            })
            .then(json => {
                ori_data = json;
                // console.log(ori_data);//得到api中的result陣列


                //取得勾選的欄位
                const temp_title = [];//存放取得結果
                function printObject(obj) {
                    obj = ori_data.data[0];
                    for (var i in obj) {
                        temp_title.push(i);
                    }
                    console.log(temp_title)
                };
                printObject();

                let column_num = temp_title.length;
                let title_index = column_num - 1;
                let str = "";
                let input_label = document.getElementsByTagName('label');
                title.innerHTML = "";
                //先放edit欄位
                title.innerHTML = `<th scope="row"><i class="fas fa-edit"></i></th>
                            <th><i class="fas fa-trash-alt"></i></th>`
                for (let i = 0; i <= title_index; i++) {
                    title.innerHTML += `<th scope="col" class="text-nowrap">${input_label[temp_title[i]].innerText}</th>`
                }

                //製作資料表格
                data_body.innerHTML = "";
                for (let s in ori_data.data) {//用for in拿取ori_data(result陣列)中'data'的值
                    str = '';
                    //先放edit連結
                    str += `<th scope="row">
                    <a href="film_data_edit.php?sid=${ori_data.data[s][temp_title[0]]}">
                      <i class="fas fa-edit"></i>
                    </a>
                  </th>
                  <td>
                    <a href="javascript: checkDelete(${ori_data.data[s][temp_title[0]]})">
                    <i class="text-danger fas fa-trash-alt"></i>
                    </a>
                </td>`;
                    for (let i = 0; i < column_num; i++) {
                        if (temp_title[i] == 'movie_pic') {
                            str += `<td>
                        <img src="../pic/film_upload/${ori_data.data[s][temp_title[i]]}" alt="" width="100">
                      </td>`
                        } else {
                            str += `<td vertical-align="middle">${ori_data.data[s][temp_title[i]]}</td>`
                        }
                    }
                    data_body.innerHTML += '<tr>' + str + '</tr>';
                };



                //製作頁碼按鈕
                p_btn_num = 7;//設定可顯示幾個頁碼按鈕(需使用奇數)
                str = '';
                for (let i = -parseInt(p_btn_num / 2); i <= parseInt(p_btn_num / 2); i++) {
                    let active = i === 0 ? 'active' : '';
                    let vh = '';
                    if (parseInt(ori_data.page) + i <= 0 || parseInt(ori_data.page) + i > parseInt(ori_data.totalPage)) {
                        vh = 'hidden';
                    }
                    str += page_func({
                        active: active,
                        v: vh,
                        page: ori_data.page + i,
                    });
                }

                page_list.innerHTML = str;


                if (page <= 1) {
                    first_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="#1">&lt;&lt;</a></li>`
                } else {
                    first_page.innerHTML = `<li class="page-item"><a class="page-link" href="#1" title="回到第一頁">&lt;&lt;</a></li>`
                }
                if (page <= 1) {
                    pre_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="?page=${page - 1}">&lt;</a></li>`
                } else {
                    pre_page.innerHTML = `<li class="page-item"><a class="page-link" href="#${page - 1}" title="前一頁">&lt;</a></li>`
                }
                if (page >= ori_data.totalPage) {
                    next_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="?page=${page - 1}">&gt;</a></li>`
                } else {
                    next_page.innerHTML = `<li class="page-item"><a class="page-link" href="#${page + 1}"  title="下一頁">&gt;</a></li>`
                }
                if (page >= ori_data.totalPage) {
                    end_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="#${ori_data.totalPage}">&gt;&gt;</a></li>`
                } else {
                    end_page.innerHTML = `<li class="page-item"><a class="page-link" href="#${ori_data.totalPage}" title="跳到最末頁">&gt;&gt;</a></li>`
                }


                //資料筆數、頁數資訊
                if (page >= ori_data.totalPage) {
                    data_info.innerHTML = `
                        <div class="col-lg-5">總資料筆數：${ori_data.totalRows} 筆</div>
                        <div class="col-lg-7">本頁資料：第${(ori_data.totalPage - 1) * ori_data.dperPage + 1} ~ ${ori_data.totalRows} 筆</div>`
                    page_info.innerHTML = `
                        <div class="text-right">頁數：${ori_data.totalPage}  /  ${ori_data.totalPage}</div>`
                } else if (page < 1) {
                    data_info.innerHTML = `
                        <div class="col-lg-5">總資料筆數：${ori_data.totalRows} 筆</div>
                        <div class="col-lg-7">本頁資料：第1 ~ ${ori_data.dperPage} 筆</div>`
                    page_info.innerHTML = `
                        <div class="text-right">頁數：1 / ${ori_data.totalPage}</div>`
                } else {
                    data_info.innerHTML = `
                        <div class="col-lg-5">總資料筆數：${ori_data.totalRows} 筆</div>
                        <div class="col-lg-7">本頁資料：第${(page - 1) * ori_data.dperPage + 1} ~ ${page * ori_data.dperPage} 筆</div>`
                    page_info.innerHTML = `
                        <div class="text-right">頁數：${page} / ${ori_data.totalPage}</div>`
                }

            });

    };

    window.addEventListener('hashchange', myHashChange);
// myHashChange();

</script>
<?php include __DIR__.'/foot.php' ?>