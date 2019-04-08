<?php
if(! isset($_SESSION)){
    session_start();
  }
  if(! isset($_SESSION['admin'])){
    header('Location:login.php');
    exit;
  }
require __DIR__.'/PDO.php';
$groupname = "member";
$pagename = 'member_search';
?>
<?php include __DIR__.'/head.php' ?>
<?php include __DIR__.'/sidenav.php' ?>
<style>
    #show_avatar {
        object-fit: contain;
    }

    .fa-chevron-down {
        position: absolute;
        right: 20px;
        transition: .5s;
        transform-origin: calc(50%-7px) calc(50%-8px);
    }

    .rotate {
        transform: rotate(180deg);
    }

    .swal-title{
        font-size: 1.5rem !important;
        color: #ccc;
    }
    .modal{
        z-index:100  !important;
    }
    .iziModal-overlay{
        z-index:50  !important;
    }
    #sticky{
        z-index:10;
    }
</style>
<section class="dashboard">
    <div class="row mx-3">
        <button id="hideSrchbar" class="btn btn-info" style="color:white " data-toggle="collapse"
            data-target="#searchbar" aria-expanded="true" aria-controls="searchbar">隱藏搜尋列</button>

        <div class="card col collapse show" id="searchbar">
            <div class="card-body">
                <form name="form1" method="post" action="" onsubmit="return checkForm()">
                    <div id="step1" class="alert alert-primary text-center position-relative" role="alert"
                        data-toggle="collapse" data-target="#set_condition" aria-expanded="true"
                        aria-controls="set_condition">
                        STEP-(1)設定搜尋條件
                        <i id="step1Arrow" class="fas fa-chevron-down"></i>
                    </div>
                    <div class="col-lg-12 show" id="set_condition">
                        <div class="row justify-content-center">
                            <select class="col-md-3 custom-select" name="sel-1">
                                <option selected value='none'>選擇搜尋欄位</option>
                                <option value="sid" class="custom-control-inline">會員編號</option>
                                <option value="name" class="custom-control-inline">姓名</option>
                                <option value="nickname" class="custom-control-inline">暱稱</option>
                            </select>
                            <div class="col-md-9 px-0 px-lg-3">
                                <input type="text" class="form-control mb-2 mr-sm-2" id="" name="sel-1-k"
                                    placeholder="請填入關鍵字">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label class="col-md-3 form-check form-control" for="">性別</label>
                            <div class="col-md-9 d-flex align-items-center">
                                <div class="col-lg-2 col-sm-5 form-check">
                                    <input class="form-check-input" type="radio" id="both" name="sel-2-k" value="男','女"
                                        checked>
                                    <label class="form-check-label" for="both">
                                        不拘
                                    </label>
                                </div>
                                <div class="col-lg-2 col-sm-5 form-check">
                                    <input class="form-check-input" type="radio" id="male" name="sel-2-k" value="男','">
                                    <label class="form-check-label" for="male">
                                        男
                                    </label>
                                </div>
                                <div class="col-lg-2 col-sm-5 form-check">
                                    <input class="form-check-input" type="radio" id="female" name="sel-2-k"
                                        value="女','">
                                    <label class="form-check-label" for="female">
                                        女
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <label class="col-md-3 form-check form-control" for="">權限</label>
                            <div class="col-md-9 d-flex align-items-center flex-wrap" id="perm_options">
                                <!-- <div class="col-lg-2 col-sm-5 form-check">
                                        <input class="form-check-input" type="radio" id="allperm" name="sel-3-k" value="0,1,2,3" checked>
                                        <label class="form-check-label" for="allperm">
                                            不拘
                                        </label>
                                    </div>
                                    <div class="col-lg-2 col-sm-5 form-check">
                                        <input class="form-check-input" type="radio" id="perm0" name="sel-3-k" value="0,''">
                                        <label class="form-check-label" for="perm0">
                                            黑名單
                                        </label>
                                    </div>
                                    <div class="col-lg-2 col-sm-5 form-check">
                                        <input class="form-check-input" type="radio" id="perm1" name="sel-3-k" value="1,''">
                                        <label class="form-check-label" for="perm1">
                                            一般會員
                                        </label>
                                    </div>
                                    <div class="col-lg-2 col-sm-5 form-check">
                                        <input class="form-check-input" type="radio" id="perm2" name="sel-3-k" value="2,''">
                                        <label class="form-check-label" for="perm2">
                                            VIP會員
                                        </label>
                                    </div>
                                    <div class="col-lg-2 col-sm-5 form-check">
                                        <input class="form-check-input" type="radio" id="perm3" name="sel-3-k" value="3,''">
                                        <label class="form-check-label" for="perm3">
                                            版主
                                        </label>
                                    </div> -->
                            </div>
                        </div>
                    </div>

                    <div id="step2" class="alert alert-primary text-center mt-3 position-relative" role="alert"
                        data-toggle="collapse" data-target="#set_column" aria-expanded="true"
                        aria-controls="set_column">
                        STEP-(2)選擇顯示的資料欄位
                        <i id="step2Arrow" class="fas fa-chevron-down"></i>
                    </div>
                    <!-- <input type="hidden" name="" value="sid"> -->
                    <div class="row justify-content-center show" id="set_column">
                        <div class="col-lg-12">
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="all" name="all"
                                    onclick="check_all('chk[]',this)">
                                <label id="l_all" class="custom-control-label" for="all">全選</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="sid" value="sid" checked
                                    disabled>
                                <label name="sid" class="custom-control-label" for="sid">會員編號</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="name" name="chk[]" value="name"
                                    onclick="check(this,'all','chk[]')">
                                <label name="name" class="custom-control-label" for="name">姓名</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="nickname" name="chk[]"
                                    value="nickname" onclick="check(this,'all','chk[]')">
                                <label name="nickname" class="custom-control-label" for="nickname">暱稱</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="gender" name="chk[]"
                                    value="gender" onclick="check(this,'all','chk[]')">
                                <label name="gender" class="custom-control-label" for="gender">性別</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="age" name="chk[]" value="age"
                                    onclick="check(this,'all','chk[]')">
                                <label name="age" class="custom-control-label" for="age">年齡</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="birthday" name="chk[]"
                                    value="birthday" onclick="check(this,'all','chk[]')">
                                <label name="birthday" class="custom-control-label" for="birthday">生日</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="email" name="chk[]"
                                    value="email" onclick="check(this,'all','chk[]')">
                                <label name="email" class="custom-control-label" for="email">email</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="mobile" name="chk[]"
                                    value="mobile" onclick="check(this,'all','chk[]')">
                                <label name="mobile" class="custom-control-label" for="mobile">手機</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="fav_type" name="chk[]"
                                    value="fav_type" onclick="check(this,'all','chk[]')">
                                <label name="fav_type" class="custom-control-label" for="fav_type">電影喜愛類型</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="avatar" name="chk[]"
                                    value="avatar" onclick="check(this,'all','chk[]')">
                                <label name="avatar" class="custom-control-label" for="avatar">頭像</label>
                            </div>
                            <!-- <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="join_date" name="chk[]"
                                    value="join_date" onclick="check(this,'all','chk[]')">
                                <label name="join_date" class="custom-control-label" for="join_date">入會日期</label>
                            </div> -->
                            <!-- <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="pwd" name="chk[]" value="pwd"
                                    onclick="check(this,'all','chk[]')">
                                <label name="pwd" class="custom-control-label" for="pwd">密碼</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="pwd_change_d" name="chk[]"
                                    value="pwd_change_d" onclick="check(this,'all','chk[]')">
                                <label name="pwd_change_d" class="custom-control-label"
                                    for="pwd_change_d">密碼修改日期</label>
                            </div>
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="pwd_err_c" name="chk[]"
                                    value="pwd_err_c" onclick="check(this,'all','chk[]')">
                                <label name="pwd_err_c" class="custom-control-label" for="pwd_err_c">密碼錯誤次數</label>
                            </div> -->
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="last_login_d" name="chk[]"
                                    value="last_login_d" onclick="check(this,'all','chk[]')">
                                <label name="last_login_d" class="custom-control-label"
                                    for="last_login_d">最近登入日期</label>
                            </div>
                            <!-- <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="login_c" name="chk[]"
                                    value="login_c" onclick="check(this,'all','chk[]')">
                                <label name="login_c" class="custom-control-label" for="login_c">登入次數</label>
                            </div> -->
                            <!-- <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="rank" name="chk[]" value="rank"
                                    onclick="check(this,'all','chk[]')">
                                <label name="rank" class="custom-control-label" for="rank">排名</label>
                            </div> -->
                            <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="permission" name="chk[]"
                                    value="permission" onclick="check(this,'all','chk[]')">
                                <label name="permission" class="custom-control-label" for="permission">權限</label>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-2  d-flex justify-content-center">
                            <button id="submit_btn" type="submit" class="btn btn-primary btn-block my-3">開始搜尋</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <div class="row info justify-content-center"></div>
    <div class="row d-flex justify-content-center sticky-top bg-light" id="sticky">
        <div class="col-lg data_info"></div>
        <div class="col-lg-4 d-flex  justify-content-center align-items-center">
            <div class="row d-flex justify-content-center flex-nowrap">
                <div class="col-lg">
                    <nav class="d-flex justify-content-center">
                        <ul id="first_page" class="pagination pagination-sm justify-content-center my-0"></ul>
                        <ul id="pre_page" class="pagination pagination-sm justify-content-center my-0"></ul>
                    </nav>
                </div>
                <div class="col-lg-5">
                    <nav class="d-flex justify-content-center">
                        <ul id="page_list" class="pagination pagination-sm justify-content-center my-0"></ul>
                    </nav>
                </div>
                <div class="col-lg">
                    <nav class="d-flex justify-content-center">
                        <ul id="next_page" class="pagination pagination-sm justify-content-center my-0"></ul>
                        <ul id="end_page" class="pagination pagination-sm justify-content-center my-0"></ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-lg page_info d-flex justify-content-end align-items-center"></div>
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
    const ul_pagi = document.querySelector('#page_list');
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
    const set_condition = document.querySelector('#set_condition');
    const set_column = document.querySelector('#set_column');
    const step1Arrow = document.querySelector('#step1Arrow');
    const step2Arrow = document.querySelector('#step2Arrow');
    const searchbar = document.querySelector('#searchbar');
    const hideSrchbar = document.querySelector('#hideSrchbar');
    const perm_options = document.querySelector('#perm_options');

    //使用underscore.js的template功能
    //先建立template字串 
    const page_str = `
                  <li class="page-item  <%= active %>" style="visibility:<%= v %>">
                  <a class="page-link" href="#<%= page %>"><%= page %></a></li>
                 `;
    const page_function = _.template(page_str);
    document.getElementById('all').checked = false;


    //-------------------------------Functions---------------------------------//
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
            let ci = 0;//勾選數量
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

    //刪除資料
    function delete_it(sid) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mx-2',
                cancelButton: 'btn btn-danger mx-2',
                title: 'swal-title'
            },
            buttonsStyling: false,
        })
        swalWithBootstrapButtons.fire({
            title: `確定刪除「會員編號：${sid}」的資料嗎?`,
            text: "注意：刪除的資料無法被復原！",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: '確定刪除',
            cancelButtonText: '取消',
            reverseButtons: false
        }).then((result) => {
            if (result.value) {
                swalWithBootstrapButtons.fire(
                    '刪除完成！',
                    `已刪除「會員編號：${sid}」的資料`,
                    'success'
                ).then(result=>{
                    location.href = 'Su_member_list_delete.php?sid=' + sid;
                })
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    '已取消！',
                    '沒有刪除任何資料',
                    'error',
                )
            }
        })
    }
    //取得勾選的欄位
    const get_checked_items = () => {
        temp_title = [];//存放取得結果
        function printObject(obj) {
            obj = ori_data.data[0];
            for (var i in obj) {
                temp_title.push(i);
            }
            console.log(temp_title)
        };
        printObject();
    }
    //製作資料表格
    //欄位名
    const create_data_table = () => {
        let column_num = temp_title.length;
        let title_index = column_num - 1;
        let str = "";
        let input_label = document.getElementsByTagName('label');
        title.innerHTML = `<th scope="row"><i class="fas fa-edit"></i></th>
                                <th><i class="fas fa-trash-alt"></i></th>
                                <th><i class="fas fa-eye"></i></th>`
        for (let i = 0; i <= title_index; i++) {
            title.innerHTML += `<th scope="col" class="text-nowrap">${input_label[temp_title[i]].innerText}</th>`
        }
        //資料列
        for (let s in ori_data.data) {//用for in拿取ori_data(result陣列)中'data'的值
            let sid = ori_data.data[s][temp_title[0]];
            str = '';
            str += `<th scope="row">
                      <a href="Su_member_edit.php?sid=${ori_data.data[s][temp_title[0]]}">
                        <i class="fas fa-edit"></i>
                      </a>
                    </th>
                    <td>
                      <a  style="cursor: pointer" href="javascript:delete_it(${ori_data.data[s][temp_title[0]]});">
                      <i class="text-danger fas fa-trash-alt"></i>
                    </a>
                    </td>
                    <td>
                      <a href="" data-izimodal-open="#modal${ori_data.data[s][temp_title[0]]}" data-izimodal-transitionin="fadeInDown" class="trigger"  data-num="${ori_data.data[s][temp_title[0]]}">
                      <i class="text-success fas fa-eye"></i>
                        </a>
                        <div class="modal" id="modal${ori_data.data[s][temp_title[0]]}" data-iziModal-fullscreen="true" data-iziModal-title='<h5 class="text-center text-white font-weight-bold">會員資料預覽</h5>' data-iziModal-icon="icon-home" data-sid="${ori_data.data[s][temp_title[0]]}"> 
                        </div>
                    </td>`;

            for (let i = 0; i < column_num; i++) {
                if (temp_title[i] == 'avatar') {
                    str += `<td>
                        <img id="show_avatar" src="../pic/avatar/${ori_data.data[s][temp_title[i]]}" alt="" style="width:100px ; height:100px">
                      </td>`
                } else {
                    str += `<td>${ori_data.data[s][temp_title[i]]}</td>`
                }
            }
            data_body.innerHTML += '<tr>' + str + '</tr>';
        };
    }

    //製作頁碼按鈕
    const create_page_btn = () => {
        p_btn_num = 7;//設定可顯示幾個頁碼按鈕(需使用奇數)
        str = '';
        for (let i = -parseInt(p_btn_num / 2); i <= parseInt(p_btn_num / 2); i++) {
            let active = i === 0 ? 'active' : '';
            let vh = '';
            if (parseInt(ori_data.page) + i <= 0 || parseInt(ori_data.page) + i > parseInt(ori_data.totalPage)) {
                vh = 'hidden';
            }
            str += page_function({
                active: active,
                v: vh,
                page: ori_data.page + i,
            });
        }
        ul_pagi.innerHTML = str;
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
    }
    //資料筆數、頁數資訊
    const create_data_info = () => {
        if (page >= ori_data.totalPage) {
            data_info.innerHTML = `
          <div class="col-lg">總資料筆數：${ori_data.totalRows} 筆</div>
          <div class="col-lg">本頁資料：第${(ori_data.totalPage - 1) * ori_data.dperPage + 1} ~ ${ori_data.totalRows} 筆</div>`
            page_info.innerHTML = `
          <div class="text-right">頁數：${ori_data.totalPage}  /  ${ori_data.totalPage}</div>`
        } else if (page < 1) {
            data_info.innerHTML = `
          <div class="col-lg">總資料筆數：${ori_data.totalRows} 筆</div>
          <div class="col-lg">本頁資料：第1 ~ ${ori_data.dperPage} 筆</div>`
            page_info.innerHTML = `
          <div class="text-right">頁數：1 / ${ori_data.totalPage}</div>`
        } else {
            data_info.innerHTML = `
          <div class="col-lg">總資料筆數：${ori_data.totalRows} 筆</div>
          <div class="col-lg">本頁資料：第${(page - 1) * ori_data.dperPage + 1} ~ ${page * ori_data.dperPage} 筆</div>`
            page_info.innerHTML = `
          <div class="text-right">頁數：${page} / ${ori_data.totalPage}</div>`
        }
    }

    //權限選擇欄位
    const permission_catch = () => {
        fetch("Su_member_permission_catch_api.php")
            .then(res => {
                return res.json();
            })
            .then(json => {
                permissions = json;
                console.log(permissions);
                let perm_num = permissions.data.length;
                console.log(perm_num);
                let str = `<div class="col-lg-2 col-sm-5 form-check">
                        <input class="form-check-input" type="radio" id="allperm" name="sel-3-k" value="0,1,2,3" checked>
                        <label class="form-check-label" for="allperm">不拘</label>
                     </div>`;
                for (let i = 0; i < perm_num; i++) {
                    str += `<div class="col-lg-2 col-sm-5 form-check">
                            <input class="form-check-input" type="radio" id="perm${i}" name="sel-3-k" value="${i},''">
                            <label class="form-check-label" for="perm${i}">${permissions.data[i]['name']}</label>
                        </div>`
                }
                perm_options.innerHTML = str;
            })
    }
    //-----------------------------End Of Functions-------------------------------//

    const checkForm = () => {
        submit_btn.style.display = 'none';//按下提交後，按鈕消失(當資料處理結束才再設定顯示)
        info.innerHTML = "";
        title.innerHTML = "";
        data_body.innerHTML = "";
        ul_pagi.innerHTML = "";
        data_info.innerHTML = "";
        page_info.innerHTML = "";
        first_page.innerHTML = "";
        pre_page.innerHTML = "";
        next_page.innerHTML = "";
        end_page.innerHTML = "";
        location.hash="";

        let form = new FormData(document.form1);

        fetch("Su_member_search_api.php?page=" + page, {
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
                    get_checked_items();

                    //製作資料表格
                    create_data_table();

                    //製作頁碼按鈕
                    create_page_btn();

                    //資料筆數、頁數資訊
                    create_data_info();

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
        fetch("Su_member_search_api.php?page=" + page, {
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
                get_checked_items();

                //製作資料表格
                title.innerHTML = "";
                data_body.innerHTML = "";
                create_data_table();

                //製作頁碼按鈕
                create_page_btn();

                //資料筆數、頁數資訊
                create_data_info();
            });

    };


    //搜尋條件箭頭
    const arrow1change = () => {
        if (set_condition.className === "col-lg-12 collapse") {
            step1Arrow.className = "fas fa-chevron-down";
        } else {
            step1Arrow.className = "fas fa-chevron-down rotate";
        }
    }

    //選擇欄位箭頭
    const arrow2change = () => {
        if (set_column.className === "row justify-content-center collapse") {
            step2Arrow.className = "fas fa-chevron-down";
        } else {
            step2Arrow.className = "fas fa-chevron-down rotate";
        }
    }

    //搜尋列開合按鈕
    const hideSearchbar = () => {
        if (searchbar.className === "card col collapse") {
            hideSrchbar.innerHTML = '隱藏搜尋列';
        } else {
            hideSrchbar.innerHTML = '打開搜尋列';
        }
    }



    permission_catch();
    window.addEventListener('hashchange', myHashChange);
    step1.addEventListener('click', arrow1change);
    step2.addEventListener('click', arrow2change);
    hideSrchbar.addEventListener('click', hideSearchbar);

    var data_fav='';
    $(document).on('click', '.trigger',  function(event) {
        let dataNum=$(this).data("num");
                console.log('Num: '+dataNum);
        $(`#modal${dataNum}`).iziModal({
            width:1000,
            onOpening: function(modal){
                modal.startLoading();
                let getSid=$(`#modal${dataNum}`).data("sid");
                console.log('sid:'+getSid);
                    $.get('Su_member_previewInside_api.php', {
                        "sid":getSid
                        },function(data) {
                            // console.log(data);
                            $(`#modal${dataNum} .iziModal-content`).html(data);
                        modal.stopLoading();
                        },'html'); 

            }
        });
        event.preventDefault();
        $(`#modal${dataNum}`).iziModal('open');
    });
</script>
<script src="../js/sweet.js"></script>
<?php include __DIR__.'/foot.php' ?>