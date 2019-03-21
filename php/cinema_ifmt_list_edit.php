<?php
require __DIR__. '/PDO.php';
$groupname = 'theater';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM cinema WHERE sid=$sid";

$stmt = $pdo->query($sql);
if($stmt->rowCount()==0){
    header('Location: data_list.php');
    exit;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$img = '../pic/cinema/'.$row['img'];
?>

<?php include __DIR__. './head.php' ?>
<?php include __DIR__. './nav.php' ?>
<?php include __DIR__. './cinema_sidenav.php' ?>
    <section class="dashboard">
        <style>
            .form-group small {
                color: red !important;
            }
            #myimg{
                object-fit: cover;
            }
        </style>
        <div class="container">

            <div class="row">
                <div class="col-lg">
                    <div id="info_bar" class="alert alert-success" role="alert" style="display: none"> </div>
                    <h5 class="card-title">戲院註冊
                    </h5>
                    <div class="card">
                        <div class="card-body">

                            <form name="form1" method="post" onsubmit="return checkForm();" class="d-flex flex-column align-items-center" >
                                <input type="hidden" name="checkme" value="check123">
                                <input type="hidden" name="sid" value="<?= $row['sid']?>">
                                <div class="d-flex col-12">
                                    <div class="col-6">
                                        <div class="form-group my-4">
                                            <label for="name">戲院名稱</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="請輸入戲院名稱" value="<?= $row['name'] ?>">
                                            <small id="nameHelp" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group my-4">
                                            <label for="taxID">統一編號</label>
                                            <input type="text" class="form-control" id="taxID" name="taxID" placeholder="請輸入統一編號" value="<?= $row['taxID'] ?>">
                                            <small id="taxIDHelp" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group my-4">
                                            <label for="phone">電話</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="請輸入電話" value="<?= $row['phone'] ?>">
                                            <small id="phoneHelp" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group my-4">
                                            <label for="address">地址</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="請輸入地址" value="<?= $row['address'] ?>">
                                            <small id="addressHelp" class="form-text text-muted"></small>
                                        </div>

                                        <div class="form-group my-4">
                                            <label for="intro">戲院簡介</label>
                                            <textarea class="form-control" id="intro" name="intro" cols="20" rows="6"><?= $row['intro'] ?></textarea>
                                            <small id="introHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="mt-4">戲院預覽圖</label>
                                        <div class="img-thumbnail mb-3 overflow-hidden" style="width:250px;height: 250px">
                                            <img id="myimg" src="<?= $img ?>" alt="" class="img-thumbnailp-0 w-100 h-100">
                                        </div>

                                        <label for="img">戲院圖</label>
                                        <div class="custom-file form-group col-12 mb-3">
                                            <input type="file" class="custom-file-input" id="img" name="img"">
                                            <input type="hidden" class="custom-file-input" id="imgupload" name="imgupload">
                                            <label class="custom-file-label overflow-hidden" for="customFile" data-browse="上傳檔案" >選擇檔案</label>
                                            <small id="imgHelp" class="form-text text-muted"></small>
                                        </div>

                                        <div class="form-group col-12 p-0 mb-3">
                                            <label for="account">登入帳號</label>
                                            <input type="text" class="form-control" id="account" name="account" placeholder="請輸入帳號" value="<?= $row['account'] ?>">
                                            <small id="accountHelp" class="form-text text-muted"></small>
                                        </div>

                                        <div class="form-group col-12 p-0 mb-3">
                                            <label for="password">登入密碼</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="請輸入密碼" value="<?= $row['password'] ?>">
                                            <small id="passwordHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>
                                <button id="submit_btn" type="submit" class="btn btn-primary my-3 col-10 py-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const info_bar = document.querySelector('#info_bar');
        const submit_btn = document.querySelector('#submit_btn');

        // 圖片輸入欄
        $(document).ready(function () {
            bsCustomFileInput.init();
        })

        // 圖片移致指定資料夾
        const img = document.querySelector('#img');
        const myimg = document.querySelector('#myimg')
        var imgupload = document.querySelector('#imgupload');

        img.addEventListener('change', event=>{
            const fd = new FormData();

            fd.append('img', img.files[0]);

            fetch('cinema_imgmove_api.php', {
                method: 'POST',
                body: fd
            })
                .then(response=>response.json())
                .then(obj=>{
                    console.log(obj);
                    myimg.setAttribute('src', `../pic/cinema/${obj.filename}`);
                    imgupload.setAttribute('value', obj.filename);
                    console.log('imgupload.value='+ imgupload.value);
                });
        });



        const fields = [
            'name',
            'img',
            'taxID',
            'phone',
            'address',
            'account',
            'password',
            'intro',
        ];

        // 拿到每個欄位的參照
        const fs = {};
        for(let v of fields){
            fs[v] = document.form1[v];
        }

        const checkForm = ()=>{
            let isPassed = true;
            info_bar.style.display = 'none';

            // 拿到每個欄位的值
            const fsv = {};
            for(let v of fields){
                fsv[v] = fs[v].value;
            }

            for(let v of fields){
                fs[v].style.borderColor = '#cccccc';
                document.querySelector('#' + v + 'Help').innerHTML = '';
            }

            if(fsv.name.length < 2){
                fs.name.style.borderColor = 'red';
                document.querySelector('#nameHelp').innerHTML = '請填寫正確的姓名!';
                isPassed = false;
            }

            if(isPassed) {
                let form = new FormData(document.form1);

                submit_btn.style.display = 'none';

                fetch('cinema_ifmt_list_edit_api.php', {
                    method: 'POST',
                    body: form
                })
                    .then(response=>response.json())
                    .then(obj=>{
                        info_bar.style.display = 'block';

                        if(obj.success){
                            info_bar.className = 'alert alert-success';
                            info_bar.innerHTML = '資料修改成功';
                        } else {
                            info_bar.className = 'alert alert-danger';
                            info_bar.innerHTML = obj.errorMsg;
                        }
                        submit_btn.style.display = 'block';
                    });
            }
            return false;
        };


    </script>
    </section>
<?php include __DIR__. './foot.php' ?>