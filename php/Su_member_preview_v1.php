<?php
require __DIR__.'/PDO.php';
$groupname = "member";

$result=[
    'fav_types'=>[],
    'recommend_m'=>[],
    'rec_m_num'=>''
];


$sid = isset($_GET['sid'])? intval($_GET['sid']) : 0;
$sql = "SELECT * FROM `member` WHERE sid=$sid";
$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);


$result['fav_types'] = explode(',',$row['fav_type']);
$tps = $result['fav_types'];

for($i=0 ; $i < count($tps) ; $i++){
    $r_sql = sprintf("SELECT `name_tw`,`name_en`,`intro_tw`,`movie_genre`,`in_theaters`,`out_theaters`,`movie_pic` FROM `film_primary_table` WHERE `movie_genre` LIKE %s","'%".$tps[$i]."%'");
    $r_stmt =$pdo->query($r_sql);
    $r_rows = $r_stmt-> fetchAll(PDO::FETCH_ASSOC);
    $result['recommend_m'] += $r_rows;
}
$result['rec_m_num'] = count($result['recommend_m']);
// echo json_encode($result, JSON_UNESCAPED_UNICODE);









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
                            <a class="btn btn-primary text-center" style="color:white;cursor: pointer" data-toggle="collapse" data-target="#rec_m_card" aria-expanded="true" aria-controls="rec_m_card">相<br>關<br>推<br>薦</a>
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
        <div class="col-md-4 collapse" id="rec_m_card">
            
        </div>
    </div>
</div>
<script>
    const info = document.querySelector('#info');
    const submit_btn = document.querySelector('#submit_btn');
    const rec_m_card = document.querySelector('#rec_m_card');


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


//使用underscore.js的template字串
const tr_str = `
            <p class="text-center my-0 bg-secondary border-top" style="color:white" data-toggle="collapse" data-target="#recommend_m<%= i %>" aria-expanded="true" aria-controls="recommend_m<%= i %>"><%= name_tw %></p>
            <div class="card mx-auto mb-2 collapse" style="max-width: 700px;" id="recommend_m<%= i %>">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="../pic/film_upload/<%= movie_pic %>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title"><%= name_tw %></h4>
                            <h6><%= name_en %></h6>
                            <span class="badge badge-pill badge-info"><%= movie_genre %></span>
                            <p class="card-text"><%= intro_tw %></p>
                            <p class="card-text"><small class="text-muted">檔期：<%= in_theaters %> ~ <%= out_theaters %></small></p>
                        </div>
                    </div>
                </div>
            </div>
          `;
const tr_function = _.template(tr_str);


//製作資料表格
    let str = '';
    let result_rec_m = <?php echo json_encode($result['recommend_m']) ?>;
    // console.log(result_rec_m);
    if( <?= $result['rec_m_num'] ?> >0){
        str =`<div class="alert-success my-0 border" role="alert"">
                <h5 class="text-center pt-2">共有 <?= $result['rec_m_num'] ?> 部推薦電影</h5>
             </div>`
        for(let i=0 ; i < <?= $result['rec_m_num'] ?>;i++){
            obj = result_rec_m[i];
            obj['i']=i+1;
            // console.log(obj);
            str += tr_function(obj);
        }
    }else{
        str = `<div class="alert-danger my-0 border" role="alert"">
                <p class="text-center pt-2">沒有推薦的電影</p>
            </div>`;
    }

    rec_m_card.innerHTML = str;



</script>

<?php include __DIR__.'/foot.php' ?>