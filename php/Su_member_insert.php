<?php
require __DIR__.'/PDO.php';
$pagename = "member";
$page_name = 'member_insert';

?>
<?php include __DIR__.'/head.php' ?>
<?php include __DIR__.'/nav.php' ?>
<?php include __DIR__.'./Su_sidenav.php'?>
<style>
    .form-group small {
        color: red !important;
    }
</style>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init()
    })
</script>
<section class="dashboard">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div id="info" class="alert alert-success" style="display:none" role="alert">
            </div>
            <div class="card">
                <div class="card-body px-5">
                    <h5 class="card-title text-center">新增會員資料
                    </h5>
                    <form name="form1" method="post" onsubmit="return checkForm()">
                        <input type="hidden" name="checkme" value="check123">
                        <div class="form-group row align-items-center my-4">
                            <label for="name"
                                class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">姓名</label>
                            <!-- <div class="col-lg-4"> -->
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="name" name="name"
                                placeholder="" value="">
                            <!-- </div> -->
                            <small id="nameHelp" class="form-text text-muted ml-2 my-0"></small>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="nickname"
                                class="col-lg-2 mx-2  col-form-label text-center bg-dark text-white rounded">暱稱</label>
                            <!-- <div class="col-sm-4"> -->
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="nickname"
                                name="nickname" placeholder="" value="">
                            <!-- </div> -->
                            <!-- <small id="nicknameHelp" class="form-text text-muted"></small> -->
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="birthday"
                                class="col-lg-2 mx-2  col-form-label text-center bg-dark text-white rounded">生日</label>
                            <!-- <div class="col-sm-4"> -->
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="birthday"
                                name="birthday" placeholder="YYYY - MM - DD" value="">
                            <!-- </div> -->
                            <small id="birthdayHelp" class="form-text text-muted ml-2 my-0"></small>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="age"
                                class="col-lg-2 mx-2  col-form-label text-center bg-dark text-white rounded">年齡</label>
                            <!-- <div class="col-sm-4"> -->
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="age" name="age"
                                placeholder="" value="">
                            <!-- </div> -->
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <!-- <fieldset class="form-group col-sm-8 mb-0"> -->
                            <!-- <div class="row align-items-center"> -->
                            <label
                                class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">性別</label>
                            <!-- <div class="col-sm-10 d-flex"> -->
                            <div class="col-lg-1 col-sm-5 mx-2 form-check">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="男" checked>
                                <label class="form-check-label" for="male">
                                    男
                                </label>
                            </div>
                            <div class="col-lg-1 col-sm-5 mx-2 form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="女">
                                <label class="form-check-label" for="female">
                                    女
                                </label>
                            </div>
                            <!-- </div> -->
                            <!-- </div> -->
                            <!-- </fieldset> -->
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="mobile"
                                class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">手機</label>
                            <!-- <div class="col-sm-4"> -->
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="mobile" name="mobile"
                                placeholder="" value="">
                            <!-- </div> -->
                            <small id="mobileHelp" class="form-text text-muted ml-2 my-0"></small>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="email"
                                class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">電子信箱</label>
                            <!-- <div class="col-sm-8 ml-0"> -->
                            <input type="text" class="col-lg-7 mx-2 form-control text-center" id="email" name="email"
                                placeholder="" value="">
                            <!-- </div> -->
                            <small id="emailHelp" class="form-text text-muted ml-2 my-0"></small>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="pwd"
                                class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">設定密碼</label>
                            <!-- <div class="col-sm-4"> -->
                            <input type="password" class="col-lg-4 mx-2 form-control text-center" id="pwd" name="pwd"
                                placeholder="" value="">
                            <!-- </div> -->
                            <!-- <small id="pwdHelp" class="form-text text-muted"></small> -->
                        </div>
                        <!-- <div class="form-group row">
                            <label for="pwdchk" class="col-sm-2 col-form-label text-center bg-dark text-white rounded">確認密碼</label>
                            <div class="col-sm-4 ml-0">
                            <input type="password" class="form-control text-center" id="pwdchk" name="pwdchk" placeholder="請再次輸入您設定的密碼" value="">
                            </div>
                            <small id="pwdchkHelp" class="form-text text-muted"></small>
                        </div> -->
                        <div class="form-group row align-items-center my-4">
                            <label for="avatar"
                                class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">上傳頭像</label>
                            <!-- <div class="col-sm-8"> -->
                            <div class="col-lg-8 mx-2 custom-file">
                                <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                <label class="custom-file-label" for="avatar" data-browse="選擇圖片"></label>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="form-group row my-4">
                            <div
                                class="col-lg-2 mx-2 col-form-label d-flex align-items-center justify-content-center bg-dark text-white rounded">
                                <label class="text-center" for="fav_type">喜愛電影類型</label>
                            </div>
                            <div class="col-lg-9 d-flex flex-wrap justify-content-lg-start justify-content-md-center">
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="all" name="all"
                                        onclick="check_all('chk[]',this)">
                                    <label id="l_all" class="custom-control-label" for="all">全選</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type1" name="chk[]"
                                        value="動作片" onclick="check(this,'all','chk[]')">
                                    <label name="sid" class="custom-control-label" for="type1">動作片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type2" name="chk[]"
                                        value="動畫片" onclick="check(this,'all','chk[]')">
                                    <label name="sid" class="custom-control-label" for="type2">動畫片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type3" name="chk[]"
                                        value="喜劇片" onclick="check(this,'all','chk[]')">
                                    <label name="name" class="custom-control-label" for="type3">喜劇片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type4" name="chk[]"
                                        value="偵探片" onclick="check(this,'all','chk[]')">
                                    <label name="nickname" class="custom-control-label" for="type4">偵探片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type5" name="chk[]"
                                        value="紀錄片" onclick="check(this,'all','chk[]')">
                                    <label name="gender" class="custom-control-label" for="type5">紀錄片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type6" name="chk[]"
                                        value="戲劇片" onclick="check(this,'all','chk[]')">
                                    <label name="age" class="custom-control-label" for="type6">戲劇片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type7" name="chk[]"
                                        value="英雄片" onclick="check(this,'all','chk[]')">
                                    <label name="birthday" class="custom-control-label" for="type7">英雄片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type8" name="chk[]"
                                        value="恐怖片" onclick="check(this,'all','chk[]')">
                                    <label name="email" class="custom-control-label" for="type8">恐怖片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type9" name="chk[]"
                                        value="武俠片" onclick="check(this,'all','chk[]')">
                                    <label name="email" class="custom-control-label" for="type9">武俠片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type10" name="chk[]"
                                        value="靈異片" onclick="check(this,'all','chk[]')">
                                    <label name="email" class="custom-control-label" for="type10">靈異片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type11" name="chk[]"
                                        value="文藝片" onclick="check(this,'all','chk[]')">
                                    <label name="email" class="custom-control-label" for="type11">文藝片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type12" name="chk[]"
                                        value="警匪片" onclick="check(this,'all','chk[]')">
                                    <label name="email" class="custom-control-label" for="type12">警匪片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type13" name="chk[]"
                                        value="科幻片" onclick="check(this,'all','chk[]')">
                                    <label name="email" class="custom-control-label" for="type13">科幻片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type14" name="chk[]"
                                        value="懸疑片" onclick="check(this,'all','chk[]')">
                                    <label name="email" class="custom-control-label" for="type14">懸疑片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type15" name="chk[]"
                                        value="驚悚片" onclick="check(this,'all','chk[]')">
                                    <label name="email" class="custom-control-label" for="type15">驚悚片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type16" name="chk[]"
                                        value="戰爭片" onclick="check(this,'all','chk[]')">
                                    <label name="email" class="custom-control-label" for="type16">戰爭片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type17" name="chk[]"
                                        value="愛情片" onclick="check(this,'all','chk[]')">
                                    <label name="email" class="custom-control-label" for="type17">愛情片</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center my-4">

                            <!-- <div class="row align-items-center col-sm-8"> -->
                            <label
                                class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">權限</label>
                            <div class="col-lg-9 d-flex">
                                <div class="col-lg-2 col-sm-3 mx-2 flex-sm-shrink-1">
                                    <input class="form-check-input" type="radio" name="permission" id="perm0" value="0">
                                    <label class="form-check-label" for="perm0">
                                        黑名單
                                    </label>
                                </div>
                                <div class="col-lg-2 col-sm-3 mx-2 flex-sm-shrink-1">
                                    <input class="form-check-input" type="radio" name="permission" id="perm1" value="1"
                                        checked>
                                    <label class="form-check-label" for="perm1">
                                        一般會員
                                    </label>
                                </div>
  
                               <div class="col-lg-2 col-sm-3 mx-2 flex-sm-shrink-1">
                                    <input class="form-check-input" type="radio" name="permission" id="perm2" value="2">
                                    <label class="form-check-label" for="perm2">
                                        VIP會員
                                    </label>
                                </div>
                                <div class="col-lg-2 col-sm-3 mx-2 flex-sm-shrink-1">
                                    <input class="form-check-input" type="radio" name="permission" id="perm3" value="3">
                                    <label class="form-check-label" for="perm3">
                                        版主
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4  d-flex justify-content-center">
                                <button id="submit_btn" type="submit"
                                    class="btn btn-primary btn-block my-3">確認送出</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    const info = document.querySelector('#info');
    const submit_btn = document.querySelector('#submit_btn');

    const fields = [
        'name',
        'email',
        'mobile',
        'birthday',
    ];

    //拿到每個input參照
    const fs = {};
    for (let v of fields) {
        fs[v] = document.form1[v];
    };
    console.log(fs);


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

    const checkForm = () => {
        submit_btn.style.display = 'none';//按下提交後，按鈕消失(當資料處理結束才再設定顯示)
        let isPassed = true;

        //拿到每個input的value(值是在輸入後才會產生，故拿值須放在function內)
        const fsv = {};
        for (let v of fields) {
            fsv[v] = fs[v].value;
        };

        // let name = document.form1.name.value;



        let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        let mobile_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;
        let birthday_pattern = /^\d{4}\-?\d{2}\-?\d{2}$/;



        for (let v of fields) {
            fs[v].style.borderColor = '#ccc';
            document.querySelector('#' + v + 'Help').innerHTML = '';
        };


        if (fsv.name.length < 2) {
            fs.name.style.borderColor = 'red';
            document.querySelector('#nameHelp').innerHTML = '請輸入正確的姓名!';
            isPassed = false;
        }
        if (!email_pattern.test(fsv.email)) {
            fs.email.style.borderColor = 'red';
            document.querySelector('#emailHelp').innerHTML = '請輸入正確的Email!';
            isPassed = false;
        }
        if (!mobile_pattern.test(fsv.mobile)) {
            fs.mobile.style.borderColor = 'red';
            document.querySelector('#mobileHelp').innerHTML = '請輸入正確的手機號碼!';
            isPassed = false;
        }
        if (!birthday_pattern.test(fsv.birthday)) {
            fs.birthday.style.borderColor = 'red';
            document.querySelector('#birthdayHelp').innerHTML = '請輸入正確的生日!';
            isPassed = false;
        }

        if (isPassed) {
            let form = new FormData(document.form1);

            fetch('Su_member_insert_api.php', {
                method: 'POST',
                body: form
            })
                .then(response => response.json())
                .then(obj => {
                    console.log(obj);
                    info.style.display = 'block';
                    if (obj.success) {
                        info.className = "alert alert-success";
                        info.innerHTML = "資料新增成功";
                    } else {
                        info.className = "alert alert-danger";
                        info.innerHTML = obj.errorMsg;
                    }
                    submit_btn.style.display = 'block';
                });
        }
        submit_btn.style.display = 'block';
        return false;

    }



</script>

<?php include __DIR__.'/foot.php' ?>