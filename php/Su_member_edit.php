<?php
require __DIR__.'/PDO.php';
$groupname = "member";
$page_name = 'member_edit';

$sid = isset($_GET['sid'])? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `member` WHERE sid=$sid";
$stmt = $pdo->query($sql);

$goto = "Su_member_search.php";
if($stmt->rowCount()==0){
    if(isset($_SERVER['HTTP_REFERER'])){
        $goto = $_SERVER['HTTP_REFERER'];
    } 
    header("Location: $goto");
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);


?>
<?php include __DIR__.'/head.php' ?>
<?php include __DIR__.'/sidenav.php' ?>
<style>
    .form-group small {
        color: red !important;
    }

    #ori-av {
        object-fit: contain;
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
            <div class="card">
                <div class="card-body px-5">
                    <div class="d-flex justify-content-between">
                        <a href="Su_member_edit.php?sid=<?= ($row['sid'])-1 ?>"><i class="fas fa-arrow-circle-left"></i>
                            前一筆</a>
                        <h5 class="card-title text-center">會員資料修改</h5>
                        <a href="Su_member_edit.php?sid=<?= ($row['sid'])+1 ?>">下一筆 <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <form name="form1" method="post" onsubmit="return checkForm()">
                        <input type="hidden" name="checkme" value="check123">
                        <div class="row justify-content-between">
                            <div class="col-lg-4 align-self-center order-lg-1 text-center">
                                <input type="hidden" name="ori_pic" value="<?= $row['avatar'] ?>">
                                <img src="../pic/avatar/<?= $row['avatar'] ?>" alt="" id="ori-av" class="img-thumbnail"
                                    style="width:200px ; height:200px">
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row align-items-center my-4 flex-nowrap">
                                    <label for="name"
                                        class="col-lg-4 mx-2 col-form-label text-center bg-dark text-white rounded">會員編號</label>
                                    <input type="hidden" class="form-control text-center" name="sid" placeholder=""
                                        value="<?= $row['sid'] ?>">
                                    <input type="text" class="col-lg-8 ml-2 form-control text-center" placeholder=""
                                        value="<?= $row['sid'] ?>" disabled>
                                </div>
                                <div class="form-group row align-items-center my-4 flex-nowrap">
                                    <label for="name"
                                        class="col-lg-4 mx-2 col-form-label text-center bg-dark text-white rounded">姓名</label>
                                    <input type="text" class="col-lg-8 mx-2 form-control text-center" id="name"
                                        name="name" placeholder="" value="<?= $row['name'] ?>" disabled>
                                    <small id="nameHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group row align-items-center my-4 flex-nowrap">
                                    <label for="nickname"
                                        class="col-lg-4 mx-2 col-form-label text-center bg-dark text-white rounded">暱稱</label>
                                    <input type="text" class="col-lg-8 mx-2 form-control text-center" id="nickname"
                                        name="nickname" placeholder="" value="<?= $row['nickname'] ?>">
                                    <small id="nicknameHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mt-0 mb-4">
                            <label for="birthday"
                                class="col-lg-2 mx-2  col-form-label text-center bg-dark text-white rounded">生日</label>
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="birthday"
                                name="birthday" placeholder="YYYY - MM - DD" value="<?= $row['birthday'] ?>"
                                onchange="checkBirth(this.id)">
                            <small id="birthdayHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="age"
                                class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">年齡</label>
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="age" name="age"
                                placeholder="" value="<?= $row['age'] ?>">
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <legend class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">性別
                            </legend>
                            <div class="col-lg-1 col-sm-5 mx-2 form-check mr-4">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="男"
                                    <?= $row['gender']=="男" ? 'checked' :'' ?>>
                                <label class="form-check-label" for="male">
                                    男
                                </label>
                            </div>
                            <div class="col-lg-1 col-sm-5 mx-2 form-check mr-4">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="女"
                                    <?= $row['gender']=="女" ? 'checked':'' ?>>
                                <label class="form-check-label" for="female">
                                    女
                                </label>
                            </div>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="mobile"
                                class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">手機</label>
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="mobile" name="mobile"
                                placeholder="" value="<?= $row['mobile'] ?>" onchange="checkMobile(this.id)">
                            <small id="mobileHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="email"
                                class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">電子信箱</label>
                            <input type="text" class="col-lg-7 mx-2 form-control text-center" id="email" name="email"
                                placeholder="" value="<?= $row['email'] ?>" onchange="checkEmail(this.id)">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="pwd" class="col-sm-2 col-form-label text-center bg-dark text-white rounded">設定密碼</label>
                            <div class="col-sm-4">
                            <input type="text" class="form-control text-center" id="pwd" name="pwd" placeholder="" value=">
                            </div>
                            <small id="pwdHelp" class="form-text text-muted"></small>
                        </div> -->
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
                            <div class="col-lg-8 mx-2 custom-file">
                                <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                    accept="image/png, image/jpeg" onchange="loadFile(event)">
                                <label id="l_for_avatar" class="custom-file-label" for="avatar"
                                    data-browse="選擇圖片"></label>
                            </div>
                        </div>
                        <div class="previewImg text-center" style="display:none">
                            <div class="row justify-content-center">
                                <div style="width:200px">
                                    <img id="output" style="width:200px">
                                </div>
                                <a href="javascript: cancel()"><i class="fas fa-times-circle"
                                        style="font-size:30px ; color:red"></i></a>
                            </div>
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
                                    <label class="custom-control-label" for="type1">動作片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type2" name="chk[]"
                                        value="動畫片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type2">動畫片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type3" name="chk[]"
                                        value="喜劇片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type3">喜劇片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type4" name="chk[]"
                                        value="偵探片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type4">偵探片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type5" name="chk[]"
                                        value="紀錄片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type5">紀錄片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type6" name="chk[]"
                                        value="戲劇片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type6">戲劇片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type7" name="chk[]"
                                        value="英雄片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type7">英雄片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type8" name="chk[]"
                                        value="恐怖片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type8">恐怖片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type9" name="chk[]"
                                        value="武俠片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type9">武俠片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type10" name="chk[]"
                                        value="靈異片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type10">靈異片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type11" name="chk[]"
                                        value="文藝片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type11">文藝片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type12" name="chk[]"
                                        value="警匪片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type12">警匪片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type13" name="chk[]"
                                        value="科幻片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type13">科幻片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type14" name="chk[]"
                                        value="懸疑片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type14">懸疑片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type15" name="chk[]"
                                        value="驚悚片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type15">驚悚片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type16" name="chk[]"
                                        value="戰爭片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type16">戰爭片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type17" name="chk[]"
                                        value="愛情片" onclick="check(this,'all','chk[]')">
                                    <label class="custom-control-label" for="type17">愛情片</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label
                                class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">權限</label>
                            <div class="col-lg-9 d-flex" id="perm_options">
                                <!-- <div class="col-lg-2 col-sm-3 mx-2 flex-sm-shrink-1">
                                            <input class="form-check-input" type="radio" name="permission" id="perm0" value="0">
                                            <label class="form-check-label" for="perm0">
                                                黑名單
                                            </label>
                                        </div>
                                        <div class="col-lg-2 col-sm-3 mx-2 flex-sm-shrink-1">
                                            <input class="form-check-input" type="radio" name="permission" id="perm1" value="1">
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
                                        </div> -->
                            </div>
                        </div>
                        
                        <div class="row justify-content-center">
                            <div class="col-lg-4  d-flex justify-content-center">
                                <button id="submit_btn" type="submit"
                                    class="btn btn-primary btn-block my-3">確認送出</button>
                            </div>
                            <div class="col-lg-4  d-flex justify-content-center">
                                <a class="btn btn-primary btn-block my-3" onclick="gobackpage()"
                                    style="color:white;cursor: pointer">返回會員列表</a>
                            </div>
                        </div>
                        <!-- 訊息提示窗 -->
                        <!-- <div id="info" style="display:none">
                            <div class="modal fade show" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
                                style="background-color:rgba(0,0,0,.5);padding-right: 17px; display: block;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div id="infoMsg">
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="button" class="btn btn-secondary"
                                                onclick="closemodal()">確認</button>
                                            <button type="button" class="btn btn-primary"
                                                onclick="gobackpage()">返回會員列表</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--  -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    const info = document.querySelector('#info');
    const submit_btn = document.querySelector('#submit_btn');
    const infoMsg = document.querySelector('#infoMsg');
    const perm_options = document.querySelector('#perm_options');

    const fields = [
        'email',
        'mobile',
        'birthday'
    ];

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
                let php_row2 = <?= $row['permission']; ?>;//取得該sid在`member`的`permission`
                let str = ""
                for (let i = 0; i < perm_num; i++) {
                    if (i == php_row2) {
                        str += `<div class="col-lg-2 col-sm-3 mx-2 flex-sm-shrink-1">
                            <input class="form-check-input" type="radio" name="permission" id="perm${i}" value="${i}" checked>
                            <label class="form-check-label" for="perm${i}">${permissions.data[i]['name']}</label>
                        </div>`
                    } else {
                        str += `<div class="col-lg-2 col-sm-3 mx-2 flex-sm-shrink-1">
                            <input class="form-check-input" type="radio" name="permission" id="perm${i}" value="${i}">
                            <label class="form-check-label" for="perm${i}">${permissions.data[i]['name']}</label>
                        </div>`
                    }
                }
                perm_options.innerHTML = str;
            })
    }
    permission_catch();

    //拿到每個input參照
    const fs = {};
    for (let v of fields) {
        fs[v] = document.form1[v];
    };
    console.log(fs);

    //判斷原始勾選狀態
    let php_row1 = "<?= $row['fav_type']; ?>";
    const fav_types = ['動作片', '動畫片', '喜劇片', '偵探片', '紀錄片', '戲劇片', '英雄片', '恐怖片', '武俠片', '靈異片', '文藝片', '警匪片', '科幻片', '懸疑片', '驚悚片', '戰爭片', '愛情片'];
    for (let i = 0; i < fav_types.length; i++) {
        if (php_row1.indexOf(fav_types[i]) != -1) {
            document.getElementsByName('chk[]')[i].checked = 'checked';
        }
    }


    //圖片檔案預覽
    var output = document.getElementById('output');//預覽img
    var pre = document.querySelector('.previewImg');//包img的div(控制display)
    var avatar = document.querySelector('#avatar');
    var l_for_avatar = document.querySelector('#l_for_avatar');//label:顯示檔名
    var ppp;

    const loadFile = function (event) {
        if (avatar.files.length > 0) {//如果有選擇檔案
            l_for_avatar.innerText = '';
            pre.style.display = 'block';
            output.src = URL.createObjectURL(event.target.files[0]);
            l_for_avatar.innerText = event.target.files[0]['name'];
            ppp = event.target.files;//把檔案資訊(陣列)存到ppp
        }
        else {//如果沒選擇檔案
            avatar.files = ppp;//原本選取的檔案資料會被代回，不會消失
        }
    };
    //消除選擇的檔案
    const cancel = () => {
        avatar.value = ''; //清空夾帶檔案
        l_for_avatar.innerText = '';
        output.src = '';
        pre.style.display = 'none';
    }




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

    //返回前頁
    // var sun_times = 0;
    // const goback = () => {
    //     let pre_p = document.referrer;
    //     if (pre_p == null) {
    //         location.href = "Su_member_list.php";
    //     }
    //     history.go(-1);
    // }

    //輸入格式檢查
    let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    let mobile_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;
    let birthday_pattern = /^\d{4}\-?\d{2}\-?\d{2}$/;


    const checkName = (x) => {
        let obj = document.getElementById(x);
        if (obj.value.length < 2) {
            obj.style.borderColor = 'red';
            document.querySelector('#' + x + 'Help').innerHTML = '請輸入正確的姓名!';
        } else {
            obj.style.borderColor = '#ccc';
            document.querySelector('#' + x + 'Help').innerHTML = '';
        }
    }
    const checkBirth = (x) => {
        let obj = document.getElementById(x);
        if (!birthday_pattern.test(obj.value)) {
            obj.style.borderColor = 'red';
            document.querySelector('#' + x + 'Help').innerHTML = '請輸入正確的生日!';
        } else {
            obj.style.borderColor = '#ccc';
            document.querySelector('#' + x + 'Help').innerHTML = '';
        }
    }
    const checkMobile = (x) => {
        let obj = document.getElementById(x);
        if (!mobile_pattern.test(obj.value)) {
            obj.style.borderColor = 'red';
            document.querySelector('#' + x + 'Help').innerHTML = '請輸入正確的手機號碼!';
        } else {
            obj.style.borderColor = '#ccc';
            document.querySelector('#' + x + 'Help').innerHTML = '';
        }
    }
    const checkEmail = (x) => {
        let obj = document.getElementById(x);
        if (!email_pattern.test(obj.value)) {
            obj.style.borderColor = 'red';
            document.querySelector('#' + x + 'Help').innerHTML = '請輸入正確的Email!';
        } else {
            obj.style.borderColor = '#ccc';
            document.querySelector('#' + x + 'Help').innerHTML = '';
        }
    }



    // 訊息提示窗btn
    // const closemodal = () => {
    //     info.style.display = "none";
    // }
    const gobackpage = () => {
        location.href = "Su_member_search.php";
    }





    const checkForm = () => {
        submit_btn.style.display = 'none';
        let isPassed = true;

        //拿到每個input的value(值是在輸入後才會產生，故拿值須放在function內)
        const fsv = {};
        for (let v of fields) {
            fsv[v] = fs[v].value;
        };

        for (let v of fields) {
            fs[v].style.borderColor = '#ccc';
            document.querySelector('#' + v + 'Help').innerHTML = '';
        };


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

            fetch('Su_member_edit_api.php', {
                method: 'POST',
                body: form
            })
                .then(response => response.json())
                .then(obj => {
                    console.log(obj);
                    // info.style.display = 'block';
                    if (obj.success) {
                        // info.style.display = "block";
                        // infoMsg.className = "alert alert-success my-0";
                        // infoMsg.innerHTML = `<h5>資料修改成功!</h5>`;
                        Swal.fire({
                            // position: 'top-end',
                            type: 'success',
                            title: '資料修改成功！',
                            showConfirmButton: false,
                            timer: 1200
                        })
                    } else {
                        // info.style.display = "block";
                        // infoMsg.className = "alert alert-danger my-0";
                        // infoMsg.innerHTML = `<h5>${obj.errorMsg}</h5>`;
                        Swal.fire({
                            // position: 'top-end',
                            type: 'warning',
                            title: `${obj.errorMsg}`,
                            showConfirmButton: true
                        })
                    }
                    submit_btn.style.display = 'block';

                });
        }
        submit_btn.style.display = 'block';
        return false;

    }

</script>
<script src="../js/sweet.js"></script>
<?php include __DIR__.'/foot.php' ?>