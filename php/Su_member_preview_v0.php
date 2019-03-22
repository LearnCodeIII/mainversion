<?php
require __DIR__.'/PDO.php';
$groupname = "member";


$sid = isset($_GET['sid'])? intval($_GET['sid']) : 0;
$sql = "SELECT * FROM `member` WHERE sid=$sid";
$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);


?>
<?php include __DIR__.'/head.php' ?>

<style>
#ori-av{
    object-fit:contain;
}
</style>
<script>
$(document).ready(function () {
  bsCustomFileInput.init()
})
</script>
<style>
    .contain{
        margin:20px 10px;
    }
</style>
<div class="contain">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">                       
                <div class="card-body px-5">
                    <div class="d-flex justify-content-center">
                        <h5 class="card-title text-center">會員資料預覽</h5>
                    </div>
                    <form name="form1" method="">
                    <input type="hidden" name="checkme" value="check123">
                        <div class="row justify-content-between">
                            <div class="col-lg-4 align-self-center order-lg-1 text-center">
                                    <input type="hidden" name="ori_pic" value="<?= $row['avatar'] ?>">
                                    <img src="../pic/avatar/<?= $row['avatar'] ?>" alt="" id="ori-av" class="img-thumbnail" style="width:200px ; height:200px">
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row align-items-center my-4 flex-nowrap">
                                    <label for="name" class="col-lg-4 mx-2 col-form-label text-center bg-dark text-white rounded">會員編號</label>
                                    <input type="hidden" class="form-control text-center" name="sid" placeholder="" value="<?= $row['sid'] ?>">
                                    <input type="text" class="col-lg-8 ml-2 form-control text-center"  placeholder="" value="<?= $row['sid'] ?>" disabled>
                                </div>
                                <div class="form-group row align-items-center my-4 flex-nowrap">
                                    <label for="name" class="col-lg-4 mx-2 col-form-label text-center bg-dark text-white rounded">姓名</label>
                                    <input type="text" class="col-lg-8 mx-2 form-control text-center" id="name" name="name" placeholder="" value="<?= $row['name'] ?>" disabled>
                                    <small id="nameHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group row align-items-center my-4 flex-nowrap">
                                    <label for="nickname" class="col-lg-4 mx-2 col-form-label text-center bg-dark text-white rounded">暱稱</label>
                                    <input type="text" class="col-lg-8 mx-2 form-control text-center" id="nickname" name="nickname" placeholder="" value="<?= $row['nickname'] ?>" disabled>
                                    <small id="nicknameHelp" class="form-text text-muted"></small>
                                </div>
                            </div>  
                        </div>
                        <div class="form-group row align-items-center mt-0 mb-4">
                            <label for="birthday" class="col-lg-2 mx-2  col-form-label text-center bg-dark text-white rounded">生日</label>
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="birthday" name="birthday" placeholder="YYYY - MM - DD" value="<?= $row['birthday'] ?>" disabled>
                            <small id="birthdayHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="age" class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">年齡</label>
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="age" name="age" placeholder="" value="<?= $row['age'] ?>" disabled>
                        </div>
                        <div class="form-group row align-items-center my-4">
                                    <legend class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">性別</legend>
                                    <input type="text" class="col-lg-4 mx-2 form-control text-center" id="" name="age" placeholder="" value="<?= $row['gender'] ?>" disabled>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="mobile" class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">手機</label>
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="mobile" name="mobile" placeholder="" value="<?= $row['mobile'] ?>" disabled>
                            <small id="mobileHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="email" class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">電子信箱</label>
                            <input type="text" class="col-lg-7 mx-2 form-control text-center" id="email" name="email" placeholder="" value="<?= $row['email'] ?>" disabled>
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group row my-4 flex-nowrap">
                            <div class="col-lg-2 mx-2 col-form-label d-flex align-items-center justify-content-center bg-dark text-white rounded">
                            <label class="text-center" for="fav_type">喜愛電影類型</label>
                            </div>
                            <div class="col-lg-9 d-flex flex-wrap justify-content-lg-start justify-content-md-center">
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type1" name="chk[]" value="動作片"  disabled >
                                    <label class="custom-control-label" for="type1">動作片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type2" name="chk[]" value="動畫片" disabled >
                                    <label class="custom-control-label" for="type2">動畫片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type3" name="chk[]" value="喜劇片" disabled>
                                    <label class="custom-control-label" for="type3">喜劇片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type4"  name="chk[]" value="偵探片" disabled>
                                    <label class="custom-control-label" for="type4">偵探片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type5" name="chk[]" value="紀錄片" disabled>
                                    <label class="custom-control-label" for="type5">紀錄片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type6" name="chk[]" value="戲劇片" disabled>
                                    <label class="custom-control-label" for="type6">戲劇片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type7" name="chk[]" value="英雄片" disabled>
                                    <label class="custom-control-label" for="type7">英雄片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type8" name="chk[]" value="恐怖片" disabled>
                                    <label class="custom-control-label" for="type8">恐怖片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type9" name="chk[]" value="武俠片" disabled>
                                    <label class="custom-control-label" for="type9">武俠片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type10" name="chk[]" value="靈異片" disabled>
                                    <label class="custom-control-label" for="type10">靈異片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type11" name="chk[]" value="文藝片" disabled>
                                    <label class="custom-control-label" for="type11">文藝片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type12" name="chk[]" value="警匪片" disabled>
                                    <label class="custom-control-label" for="type12">警匪片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type13" name="chk[]" value="科幻片" disabled>
                                    <label class="custom-control-label" for="type13">科幻片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type14" name="chk[]" value="懸疑片" disabled>
                                    <label class="custom-control-label" for="type14">懸疑片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type15" name="chk[]" value="驚悚片" disabled>
                                    <label class="custom-control-label" for="type15">驚悚片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type16" name="chk[]" value="戰爭片" disabled>
                                    <label class="custom-control-label" for="type16">戰爭片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type17" name="chk[]" value="愛情片" disabled>
                                    <label class="custom-control-label" for="type17">愛情片</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center my-4">
                                    <label class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">權限</label>
                                    <input type="text" class="col-lg-4 mx-2 form-control text-center" id="" name="permission" placeholder="" 
                                    value="<?php switch($row['gender'])
                                    {case 0:
                                        echo '黑名單';
                                        break;
                                    case 1 :
                                        echo '一般會員';
                                        break;
                                    case 2 :
                                        echo 'VIP會員';
                                        break;
                                    case 3 :
                                        echo '版主';
                                    } ?>" disabled>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4  d-flex justify-content-center">
                                <a class="btn btn-primary btn-block my-3" onclick="goback()" style="color:white;cursor: pointer">回到上一頁</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const info = document.querySelector('#info');
    const submit_btn = document.querySelector('#submit_btn');


    //判斷原始勾選狀態
    let php_row1 = "<?= $row['fav_type']; ?>";
    const fav_types=['動作片','動畫片','喜劇片','偵探片','紀錄片','戲劇片','英雄片','恐怖片','武俠片','靈異片','文藝片','警匪片','科幻片','懸疑片','驚悚片','戰爭片','愛情片'];
    for(let i=0 ; i<fav_types.length ; i++){
        if(php_row1.indexOf(fav_types[i]) != -1){
            document.getElementsByName('chk[]')[i].checked = 'checked';
        }
    }


    //返回前頁
    var sun_times=0;
    const goback=()=>{
        let pre_p = document.referrer;
        if(pre_p == null){
            location.href = "Su_member_list.php";
        }
        history.go(-1);
    }


</script>

<?php include __DIR__.'/foot.php' ?>