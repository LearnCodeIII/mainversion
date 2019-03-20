<?php
require __DIR__. '/cinema_Login_SQL.php';
$page_name = 'list_edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM cinema WHERE sid=$sid";

$stmt = $pdo->query($sql);
if($stmt->rowCount()==0){
    header('Location: data_list.php');
    exit;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<?php include __DIR__. './hp_head.php' ?>
<?php include __DIR__. './hp_nav.php' ?>
<?php include __DIR__. './hp_sidenav.php' ?>
    <style>
        .form-group small {
            color: red !important;
        }

    </style>
    <section class="dashboard">
<div class="container">

    <div class="row">
        <div class="col-lg-6">

                <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
                </div>

            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">修改資料
                    </h5>

                    <form name="form1" method="post" onsubmit="return checkForm();">
                        <input type="hidden" name="checkme" value="check123">
                        <input type="hidden" name="sid" value="<?= $row['sid']?>">
                            <div class="form-group">
                                <label for="name">戲院名稱</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="請輸入戲院名稱" value="<?= $row['name']?>">
                                <small id="nameHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="account">登入帳號</label>
                                <input type="text" class="form-control" id="account" name="account" placeholder="請輸入帳號"  value="<?= $row['account']?>">
                                <small id="accountHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="password">登入密碼</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="請輸入密碼"  value="<?= $row['password']?>">
                                <small id="passwordHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="taxID">統一編號</label>
                                <input type="text" class="form-control" id="taxID" name="taxID" placeholder="請輸入統一編號"  value="<?= $row['taxID']?>">
                                <small id="taxIDHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="phone">電話</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="請輸入電話"  value="<?= $row['phone']?>">
                                <small id="phoneHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="address">地址</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="請輸入地址"  value="<?= $row['address']?>">
                                <small id="addressHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="intro">戲院簡介</label>
                                <textarea class="form-control" id="intro" name="intro" cols="20" rows="3"><?= $row['intro']?></textarea>
                                <small id="introHelp" class="form-text text-muted"></small>
                            </div>

                        <button id="submit_btn" type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        const info_bar = document.querySelector('#info_bar');
        const submit_btn = document.querySelector('#submit_btn');

        const fields = [
            'name',
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
<?php include __DIR__. './hp_foot.php' ?>