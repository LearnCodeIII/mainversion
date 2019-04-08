<?php
include __DIR__.'/PDO.php';
$groupname = "activity";
$pagename = "ShawnpageEdit";

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$sql = "SELECT * FROM activity WHERE sid=$sid";

$stmt = $pdo->query($sql);
if($stmt->rowCount()==0){
    header('Location: ShawnpageDatalist.php');
    exit;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./sidenav.php'?>
<script>
    $(document).ready(function () {
  bsCustomFileInput.init()
})
</script>
<script src="../js/sweet.js"></script>
<script src="../ckeditor/ckeditor.js"></script>
<style>
        .form-group small {
            color: red !important;
        }

</style>
<section class="dashboard">

<div class="container-fulid ">
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-md-12 ">
                    <h5 class="card-title">修改活動
                        <small class="text-danger font-italic">(*號為必填)</small>
                    </h5>
                    
                </div>
                    <form class="col-md-12"method="post" name="form1" onsubmit="return checkForm();">                 
                        <div class="row">
                        <div class="col-md-6 ">
                                <input type="text" name="sid" id="sid" value="<?= $row['sid'] ?>" hidden>
                                <div class="input-group mt-3 ">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-dark text-white">活動名稱</span>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="活動名稱長度需介於五至五十字" value="<?=$row['name']?>">
                                    <span class="text-danger">*</span>
                                </div>  
                                <small id="nameHelp" class="form-text text-muted"></small>
                                
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-dark text-white">開始日期</span>
                                    </div>
                                    <input type="date" class="form-control" id="dateStart" name="dateStart" placeholder="" value="<?=$row['dateStart']?>">
                                    <span class="text-danger">*</span>
                                </div>
                                <small id="dateStartHelp" class="form-text text-muted"></small>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-dark text-white">結束日期</span>
                                    </div>
                                    <input type="date" class="form-control" id="dateEnd" name="dateEnd" placeholder="" value="<?=$row['dateEnd']?>">
                                    <span class="text-danger">*</span>
                                </div>
                                <small id="dateEndHelp" class="form-text text-muted"></small>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-dark text-white">活動名稱</span>
                                    </div>
                                    <input type="text" class="form-control" id="company" name="company" placeholder="" value="<?=$row['company']?>" readonly>
                                    <span class="text-danger">*</span>
                                </div>
                                <small id="companyHelp" class="form-text text-muted"></small>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-dark text-white">活動地址</span>
                                    </div>
                                    <input type="text" class="form-control" id="region" name="region" placeholder="" value="<?=$row['region']?>" >
                                    <span class="text-danger">*</span>
                                </div>
                                <small id="regionHelp" class="form-text text-muted"></small>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend mr-3">
                                        <span class="input-group-text bg-dark text-white">活動類型</span>
                                        <div class="ml-3 mt-2 mb-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="primary" value="primary" name="contenttype[]" 
                                                <?php
                                                if(stripos($row['contenttype'],"primary")>-1){echo "checked";};
                                                ?>
                                                >
                                                <label class="form-check-label" for="primary">徵才資訊</label>
                                            </div>
                                            <div class="form-check form-check-inline" >
                                                <input class="form-check-input" type="checkbox" id="success" value="success" name="contenttype[]"
                                                <?php
                                                if(stripos($row['contenttype'],"success")>-1){echo "checked";};
                                                ?>>
                                                <label class="form-check-label" for="success">長期活動</label>
                                            </div>
                                            <div class="form-check form-check-inline" >
                                                <input class="form-check-input" type="checkbox" id="warning" value="warning" name="contenttype[]"
                                                <?php
                                                if(stripos($row['contenttype'],"warning")>-1){echo "checked";};
                                                ?>>
                                                <label class="form-check-label" for="warning">戲院公告</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="danger" value="danger" name="contenttype[]"
                                                <?php
                                                if(stripos($row['contenttype'],"danger")>-1){echo "checked";};
                                                ?>>
                                                <label class="form-check-label" for="danger">會員專屬</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="info" value="info" name="contenttype[]"
                                                <?php
                                                if(stripos($row['contenttype'],"info")>-1){echo "checked";};
                                                ?>>
                                                <label class="form-check-label" for="info">電影資訊</label>
                                            </div>
                                            <div class="form-check form-check-inline" >
                                                <input class="form-check-input" type="checkbox" id="secondary" value="secondary" name="contenttype[]"
                                                <?php
                                                if(stripos($row['contenttype'],"secondary")>-1){echo "checked";};
                                                ?>>
                                                <label class="form-check-label" for="secondary">官方活動</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="dark" value="dark" name="contenttype[]"
                                                <?php
                                                if(stripos($row['contenttype'],"dark")>-1){echo "checked";};
                                                ?>>
                                                <label class="form-check-label" for="dark">維修公告</label>
                                            </div>
                                            <input class="form-check-input" type="checkbox" id="space" value="space" name="contenttype[]" checked hidden >
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend mr-3">
                                        <span class="input-group-text bg-dark text-white">開放報名</span>
                                        <div class="ml-3 mt-2 mb-2">
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" id="signNo" value="no" name="signup[]"
                                                <?php
                                                if(stripos($row['signup'],"no")>-1){echo "checked";};
                                                ?>
                                                >
                                                <label class="form-check-label" for="signNo">否。</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="signYes" value="yes" name="signup[]"
                                                <?php
                                                if(stripos($row['signup'],"yes")>-1){echo "checked";};
                                                ?>>
                                                <label class="form-check-label" for="signYes">是，人數不限。</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="signOther" value="other" name="signup[]"
                                                <?php
                                                if(stripos($row['signup'],"other")>-1){echo "checked";};
                                                ?>>
                                                <label class="form-check-label" for="signOther">是，上限人數</label>
                                                <input class="form-check-input ml-1" type="text" id="signOtherNumber"  name="signup[]" size="3" value="<?php
                                                if(stripos($row['signup'],"other")>-1){echo  preg_replace('/[^\d]/','',$row['signup']);};
                                                ?>"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-dark text-white" id="inputGroupFileAddon01">活動圖片上傳</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="picture_number">
                                        <input type="text" name="picture" id="picture" value="<?= $row['picture'] ?>" hidden>
                                        <label class="custom-file-label " for="picture" data-browse="搜尋檔案">更換活動圖片</label>
                                        
                                    </div>
                                </div>
                                <small id="pictureHelp" class="form-text text-muted"></small>
                                <div class="input-group mt-3">
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark text-white" id="inputGroupFileAddon01">活動圖片預覽</span>
                                    </div>
                                    <div class="imgWarp" style="height:400px width:700px;">
                                        <img id="myimg" class="mt-3 mb-3" src="../pic/activity/<?= $row['picture'] ?>" alt="" style="height:100% width:100%;">
                                    </div>        
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-dark text-white">活動內容</span>
                                    </div>
                                </div>
                                <small id="contentHelp" class="form-text text-muted"></small>
                                <textarea type="text" class="form-control" id="content" name="content" placeholder="活動介紹需至少五個字" rows="3"><?=$row['content']?></textarea>
                            </div> 
                        </div>
                    </div>
                    <div class="alert alert-success mt-3" id="info_bar" role="alert" style="display:none">
                    </div>
                    <button type="submit" id="submit_btn" class="btn btn-dark text-white mt-3">送出活動</button>
                </form>
            </div>
        </div>
    </div>
</div>
</section>

<script>
//CKEditor
CKEDITOR.replace( 'content');



    const myimg = document.querySelector('#myimg');
    const my_file = document.querySelector('#picture_number');

    my_file.addEventListener('change', event=>{
       //console.log(event.target);
        const fd = new FormData();

        fd.append('my_file', my_file.files[0]);

        fetch('ShawnpageUpload.php', {
            method: 'POST',
            body: fd
        })
            .then(response=>response.json())
            .then(obj=>{

                myimg.setAttribute('src', '../pic/activity/' +obj.filename);
                myimg.setAttribute('style', 'height:400px');

                picture.value = obj.filename;
            });
    });








    const info_bar = document.querySelector('#info_bar');
    const submit_btn = document.querySelector('#submit_btn');

	const fields=[
            'name',
            'content',
            'dateStart',
            'dateEnd',
            'company',
        ]
	const fs={};
	for(let v of fields){
        fs[v] = document.form1[v];

	};
    
    const checkForm = () =>{
        let isPassed = true;
        info_bar.style.display='none';
		CKEDITOR.instances.content.updateElement();
		const fsv={};
		for(let v of fields){
            
			fsv[v] = fs[v].value;
		}

		for(let v of fields){
			fs[v].style.borderColor = "#ccc";
			document.querySelector('#' + v + 'Help').innerHTML = '';
		}
        if(fsv.name.length<1){
					fs.name.style.borderColor="red";
					nameHelp.innerHTML='活動名稱必填';
          isPassed = false;
        }
        if(fsv.name.length>50){
					fs.name.style.borderColor="red";
					nameHelp.innerHTML='活動名稱需小於五十字';
          isPassed = false;
        }
        if(fsv.content.length<5){
					fs.content.style.borderColor="red";
					contentHelp.innerHTML='活動介紹不得少於五個字';
          isPassed = false;
        }
        if(fsv.dateStart.length<1){
					fs.dateStart.style.borderColor="red";
					dateStartHelp.innerHTML='活動開始日期必填';
          isPassed = false;
        }
        if(fsv.dateEnd.length<1){
					fs.dateEnd.style.borderColor="red";
					dateEndHelp.innerHTML='活動結束日期必填';
          isPassed = false;
        }
        if(fsv.company.length<1){
					fs.company.style.borderColor="red";
					companyHelp.innerHTML='廠商名稱為必填';
          isPassed = false;
        }
        if(isPassed){

            let form = new FormData(document.form1);
            submit_btn.style.display = 'none';
            fetch('ShawnpageEditapi.php',{
                method: 'POST',
                body: form
            })
                .then(response=>response.json())
                .then(obj=>{



                    if(obj.success){
                        const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false,
                        });
                        swalWithBootstrapButtons.fire({
                            title: `成功`,
                            text: "已經修改此筆資料!",
                            footer: '提示：即將返回主畫面',
                            type: 'success',
                            timer: 3000,
                        }).then((result) => {
                            location.href = 'ShawnpageDatalist.php';
                        })

                    } else {
                        const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false,
                        });
                        swalWithBootstrapButtons.fire({
                            title: `失敗`,
                            text: obj.msg,
                            footer: '提示：請確認資料是否填寫正確',
                            type: 'error',
                        })
                    }

                    submit_btn.style.display = 'block';
                });
        }
        return false;
    };

</script>

<?php include __DIR__.'./foot.php'?>