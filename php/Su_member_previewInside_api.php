<?php
require __DIR__.'/PDO.php';
$result=[
    'fav_types'=>[],
    'count-fav_types'=>[],
    'recommend_m'=>[],
    'rec_m_num'=>''
];

$sid = isset($_GET['sid'])? intval($_GET['sid']) : 0;
$sql = "SELECT m.*, p.`name` `perm_name` FROM `member` m JOIN `permission` p ON m.`permission`=p.`no` WHERE m.`sid`=$sid";
$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);


$result['fav_types'] = explode(',',$row['fav_type']);
$tps = $result['fav_types'];

//判斷fav_types是否為空
if($tps==[""]){
    $count_tps = 0;
}else{
    $count_tps = count($tps);
}
$result['count-fav_types'] = $count_tps;


for($i=0 ; $i < $count_tps ; $i++){
    $r_sql = sprintf("SELECT `name_tw`,`name_en`,`intro_tw`,`movie_genre`,`in_theaters`,`out_theaters`,`movie_pic` FROM `film_primary_table` WHERE `movie_genre` LIKE %s","'%".$tps[$i]."%'");
    $r_stmt =$pdo->query($r_sql);
    $r_rows = $r_stmt-> fetchAll(PDO::FETCH_ASSOC);
    $result['recommend_m'] += $r_rows;
}
$result['rec_m_num'] = count($result['recommend_m']);
// echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>

<style>
#ori-av{
    object-fit:contain;
}
    .contain{
        margin:20px 10px;
    }
</style>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">                       
                <div class="card-body px-5">
                    <!-- <div class="d-flex justify-content-center">
                        <h5 class="card-title text-center">會員資料預覽</h5>
                    </div> -->
                    <form name="form2" method="">
                    <input type="hidden" name="checkme" value="check123">
                        <div class="row justify-content-between">
                            <div class="col-lg-4 align-self-center order-lg-1 text-center">
                                    <input type="hidden" name="ori_pic" value="<?= $row['avatar'] ?>">
                                    <img src="../pic/avatar/<?= $row['avatar'] ?>" alt="" id="ori-av" class="img-thumbnail" style="width:200px ; height:200px">
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row align-items-center my-4 flex-nowrap">
                                    <label for="name" class="col-lg-4 mx-2 col-form-label text-center bg-dark text-white rounded">會員編號</label>
                                    <input type="text" class="col-lg-8 ml-2 form-control text-center"  placeholder="" value="<?= $row['sid'] ?>" readonly>
                                </div>
                                <div class="form-group row align-items-center my-4 flex-nowrap">
                                    <label for="name" class="col-lg-4 mx-2 col-form-label text-center bg-dark text-white rounded">姓名</label>
                                    <input type="text" class="col-lg-8 mx-2 form-control text-center" id="name" name="name" placeholder="" value="<?= $row['name'] ?>" readonly>
                                </div>
                                <div class="form-group row align-items-center my-4 flex-nowrap">
                                    <label for="nickname" class="col-lg-4 mx-2 col-form-label text-center bg-dark text-white rounded">暱稱</label>
                                    <input type="text" class="col-lg-8 mx-2 form-control text-center" id="nickname" name="nickname" placeholder="" value="<?= $row['nickname'] ?>" readonly>
                                </div>
                            </div>  
                        </div>
                        <div class="form-group row align-items-center mt-0 mb-4">
                            <label for="birthday" class="col-lg-2 mx-2  col-form-label text-center bg-dark text-white rounded">生日</label>
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="birthday" name="birthday" placeholder="YYYY - MM - DD" value="<?= $row['birthday'] ?>" readonly>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="age" class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">年齡</label>
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="age" name="age" placeholder="" value="<?= $row['age'] ?>" readonly>
                        </div>
                        <div class="form-group row align-items-center my-4">
                                    <legend class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">性別</legend>
                                    <input type="text" class="col-lg-4 mx-2 form-control text-center" id="" name="age" placeholder="" value="<?= $row['gender'] ?>" readonly>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="mobile" class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">手機</label>
                            <input type="text" class="col-lg-4 mx-2 form-control text-center" id="mobile" name="mobile" placeholder="" value="<?= $row['mobile'] ?>" readonly>
                        </div>
                        <div class="form-group row align-items-center my-4">
                            <label for="email" class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">電子信箱</label>
                            <input type="text" class="col-lg-7 mx-2 form-control text-center" id="email" name="email" placeholder="" value="<?= $row['email'] ?>" readonly>
                        </div>
                        <div class="form-group row my-4 ">
                            <div class="col-lg-2 mx-2 col-form-label d-flex align-items-center justify-content-center bg-dark text-white rounded">
                            <label class="text-center" for="fav_type">喜愛電影類型</label>
                            </div>
                            <div class="col-lg-9 d-flex flex-wrap justify-content-lg-start justify-content-md-center">
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type1" name="chk[]" value="動作片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='動作片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type1">動作片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type2" name="chk[]" value="動畫片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='動畫片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled >
                                    <label class="custom-control-label" for="type2">動畫片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type3" name="chk[]" value="喜劇片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='喜劇片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type3">喜劇片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type4"  name="chk[]" value="偵探片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='偵探片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type4">偵探片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type5" name="chk[]" value="紀錄片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='紀錄片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type5">紀錄片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type6" name="chk[]" value="戲劇片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='戲劇片'){
                                            echo 'checked';
                                        }
                                    } ?>  disabled>
                                    <label class="custom-control-label" for="type6">戲劇片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type7" name="chk[]" value="英雄片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='英雄片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type7">英雄片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type8" name="chk[]" value="恐怖片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='恐怖片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type8">恐怖片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type9" name="chk[]" value="武俠片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='武俠片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type9">武俠片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type10" name="chk[]" value="靈異片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='靈異片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type10">靈異片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type11" name="chk[]" value="文藝片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='文藝片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type11">文藝片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type12" name="chk[]" value="警匪片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='警匪片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type12">警匪片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type13" name="chk[]" value="科幻片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='科幻片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type13">科幻片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type14" name="chk[]" value="懸疑片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='懸疑片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type14">懸疑片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type15" name="chk[]" value="驚悚片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='驚悚片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type15">驚悚片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type16" name="chk[]" value="戰爭片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='戰爭片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type16">戰爭片</label>
                                </div>
                                <div class="col-lg-2 col-md-3 custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="type17" name="chk[]" value="愛情片" <?php for($i=0;$i<$result['count-fav_types'];$i++){
                                        if($result['fav_types'][$i]==='愛情片'){
                                            echo 'checked';
                                        }
                                    } ?> disabled>
                                    <label class="custom-control-label" for="type17">愛情片</label>
                                </div>
                            </div>
                            <!-- <a class="btn btn-primary text-center" style="color:white;cursor: pointer" data-toggle="collapse" data-target="#rec_m_card" aria-expanded="true" aria-controls="rec_m_card">相<br>關<br>推<br>薦</a> -->
                        </div>
                        <div class="form-group row align-items-center my-4">
                                <label class="col-lg-2 mx-2 col-form-label text-center bg-dark text-white rounded">權限</label>
                                <input type="text" class="col-lg-4 mx-2 form-control text-center" id="" name="permission" placeholder="" 
                                    value="<?= $row['perm_name']?>" readonly>
                        </div>
                        <div class="d-flex row">
                        <div class="col-6 form-group row align-items-center mt-0 mx-0 px-0">
                                <label for="join_date" class="col-lg-4 mx-2 col-form-label text-center bg-dark text-white rounded">入會日期</label>
                                <input type="text" class="col-lg-7 mx-2 form-control text-center"  placeholder="" value="<?= $row['join_date'] ?>" readonly>
                        </div>
                        <div class="col-6 form-group row align-items-center mt-0 mx-0 px-0">
                                <label for="last_login_d" class="col-lg-4 mx-2 col-form-label text-center bg-dark text-white rounded">最近登入</label>
                                <input type="text" class="col-lg-7 mx-2 form-control text-center" id="last_login_d" name="last_login_d" placeholder="" value="<?= $row['last_login_d'] ?>" readonly>
                        </div>
                     </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 collapse" id="temp_fav" data-fav="<?= $row['fav_type']; ?>">
            
        </div>
    </div>
