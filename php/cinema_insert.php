<?php
include __DIR__. './cinema_Login_SQL.php';

if(isset($_POST['checkme'])){
    $sql = "INSERT INTO `cinema`(
            `name`,`img`, `taxID`, `phone`, `address`, `account` ,`password` , `intro`
            ) VALUES (
              ?, ?, ?, ?, ?, ?, ?, ?
            )";


    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['name'],
            '/images/cinema/'.$_POST['img'],
            $_POST['taxID'],
            $_POST['phone'],
            $_POST['address'],
            $_POST['account'],
            $_POST['password'],
            $_POST['intro'],
        ]);

        if($stmt->rowCount()==1) {
            $success = true;
            $msg = [
                'type' => 'success',
                'info' => '資料新增成功',
            ];
        } else {
            $msg = [
                'type' => 'danger',
                'info' => '資料新增錯誤',
            ];
        }
    } catch(PDOException $ex){
        $msg = [
            'type' => 'danger',
            'info' => '資料未新增',
        ];
    }
}

?>
<?php include __DIR__. './cinema_Login_SQL.php'?>
<?php include __DIR__. './hp_head.php' ?>
<?php $pagename = "cinema_ifmt"; ?>
<?php include __DIR__. './hp_nav.php' ?>
<?php include __DIR__. './hp_sidenav.php' ?>
    <section class="dashboard">
    <style>
        .form-group small {
            color: red !important;
        }

    </style>
<div class="container">

    <div class="row">
        <div class="col-lg">
            <?php if(isset($msg)): ?>
                <div class="alert alert-<?= $msg['type'] ?>" role="alert">
                    <?= $msg['info'] ?>
                </div>
            <?php endif ?>
            <h5 class="card-title">戲院註冊
            </h5>
            <div class="card">
                <div class="card-body">
                    <form name="form1" method="post" onsubmit="return checkForm();" class="d-flex flex-column align-items-center" >
                        <input type="hidden" name="checkme" value="check123">
                        <div class="d-flex col-12">
                            <div class="col-6">
                                <div class="form-group my-4">
                                    <label for="name">戲院名稱</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="請輸入戲院名稱">
                                    <small id="nameHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group my-4">
                                    <label for="taxID">統一編號</label>
                                    <input type="text" class="form-control" id="taxID" name="taxID" placeholder="請輸入統一編號">
                                    <small id="taxIDHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group my-4">
                                    <label for="phone">電話</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="請輸入電話">
                                    <small id="phoneHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group my-4">
                                    <label for="address">地址</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="請輸入地址">
                                    <small id="addressHelp" class="form-text text-muted"></small>
                                </div>

                                <div class="form-group my-4">
                                    <label for="intro">戲院簡介</label>
                                    <textarea class="form-control" id="intro" name="intro" cols="20" rows="6"></textarea>
                                    <small id="introHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="mt-4">戲院預覽圖</label>
                                <div class="img-thumbnail mb-3 w-50 overflow-hidden">
                                    <img id="output" src="" alt="" class="img-thumbnail m-0 w-100 p-0">
                                </div>

                                <label for="img">戲院圖</label>
                                <div class="custom-file form-group col-12 mb-3">
                                    <input type="file" class="custom-file-input" accept="image/*" onchange="loadFile(event)" id="img" name="img">
                                    <label class="custom-file-label overflow-hidden" for="customFile" data-browse="上傳檔案">選擇檔案</label>
                                    <small id="imgHelp" class="form-text text-muted"></small>
                                </div>

                                <div class="form-group col-12 p-0 mb-3">
                                    <label for="account">登入帳號</label>
                                    <input type="text" class="form-control" id="account" name="account" placeholder="請輸入帳號">
                                    <small id="accountHelp" class="form-text text-muted"></small>
                                </div>

                                <div class="form-group col-12 p-0 mb-3">
                                    <label for="password">登入密碼</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="請輸入密碼">
                                    <small id="passwordHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary my-3 col-10 py-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>
    <script>
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

        // 表單驗證欄
        const checkForm = ()=>{
            let isPassed = true;

            // 拿到每個欄位的值
            const fsv = {};
            for(let v of fields){
                fsv[v] = fs[v].value;
            }
            console.log(fsv);


            let phone_pattern = /^02\-?\d{4}\-?\d{4}$/;

            for(let v of fields){
                fs[v].style.borderColor = '#cccccc';
                document.querySelector('#' + v + 'Help').innerHTML = '';
            }

            if(fsv.name.length < 2){
                fs.name.style.borderColor = 'red';
                document.querySelector('#nameHelp').innerHTML = '請填寫正確的姓名!';
                isPassed = false;
            }

            if(! phone_pattern.test(fsv.phone)){
                fs.phone.style.borderColor = 'red';
                document.querySelector('#phoneHelp').innerHTML = '請填寫正確的電話號碼!';
                isPassed = false;
            }
            if(fsv.address.length < 1){
                fs.address.style.borderColor = 'red';
                document.querySelector('#addressHelp').innerHTML = '請填寫正確的地址!';
                isPassed = false;
            }
            if(fsv.account.length < 1){
                fs.account.style.borderColor = 'red';
                document.querySelector('#accountHelp').innerHTML = '請填寫正確的帳號!';
                isPassed = false;
            }
            if(fsv.password.length < 1){
                fs.password.style.borderColor = 'red';
                document.querySelector('#passwordHelp').innerHTML = '請填寫正確的密碼!';
                isPassed = false;
            }

            return isPassed;
        };

        // 圖片輸入欄
        $(document).ready(function () {
            bsCustomFileInput.init();
        })

        // 預覽圖
        var loadFile = function (event) {
            var output = document.querySelector('#output');
            output.src = URL.createObjectURL(event.target.files[0]);
        }

        // 圖片移致指定資料夾
        const myimg = document.querySelector('#myimg');
        const img = document.querySelector('#img');

        img.addEventListener('change', event=>{
            //console.log(event.target);
            const fd = new FormData();

            fd.append('img', img.files[0]);

            fetch('cinema_ifmt_insert_api.php', {
                method: 'POST',
                body: fd
            })
                .then(response=>response.json())
                .then(obj=>{
                    console.log(obj);
                    // myimg.setAttribute('src', '/images/cinema/' +obj.filename);
                });
        });


    </script>

<?php include __DIR__. './hp_foot.php' ?>