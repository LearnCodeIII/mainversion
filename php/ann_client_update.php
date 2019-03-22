<?php
//require __DIR__. '/__cred.php';
require __DIR__ . '/PDO.php';
$page_name = 'ann_client_update';

$sn = isset($_GET['sn']) ? intval($_GET['sn']) : 0;

$sql = "SELECT * FROM ad WHERE sn = $sn";

$stmt = $pdo->query($sql);
if($stmt->rowCount() == 0){
    header('Location: ann_client_list.php');
    exit;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<?php include __DIR__ . '/head.php'; ?>
<?php include __DIR__ . '/nav.php'; ?>
<?php include __DIR__.'/ann_side_nav.php'?>

<style>
.form-group small {
    color: red !important;
    /* To override the default color */
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
                        <h5 class="card-title">客戶資料修改</h5>

                        <form name="form1" method="post" onsubmit="return checkForm();">
                            <input type="hidden" name="checkme" value="check123">
                            <input type="hidden" name="sn" value="<?= $row['sn']?>">

                            <div class="form-group">
                                <label for="client_name">客戶公司</label>
                                <input type="text" class="form-control" id="client_name" name="client_name"
                                    placeholder="" value="<?= $row['client_name']?>">
                                <small id="client_nameHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="client_number">客戶編號</label>
                                <input type="text" class="form-control" id="client_number" name="client_number"
                                    placeholder="" value="<?= $row['client_number']?>">
                                <small id="client_numberHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="client_address">客戶地址</label>
                                <textarea class="form-control" id="client_address" name="client_address" cols="30"
                                    rows="3"><?= $row['client_address']?></textarea>
                                <small id="client_addressHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="client_poc">聯絡人</label>
                                <input type="text" class="form-control" id="client_poc" name="client_poc" placeholder=""
                                    value="<?= $row['client_poc']?>">
                                <small id="client_pocHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="client_mobile">連絡電話</label>
                                <input type="text" class="form-control" id="client_mobile" name="client_mobile"
                                    placeholder="" value="<?= $row['client_mobile']?>">
                                <small id="client_mobileHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="client_email">連絡信箱</label>
                                <input type="text" class="form-control" id="client_email" name="client_email"
                                    placeholder="" value="<?= $row['client_email']?>">
                                <small id="client_emailHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="contract_budget">合約預算</label>
                                <input type="text" class="form-control" id="contract_budget" name="contract_budget"
                                    placeholder="" value="<?= $row['contract_budget']?>">
                                <small id="contract_budgetHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="contract_start_date">合約開始日</label>
                                <input type="text" class="form-control" id="contract_start_date"
                                    name="contract_start_date" placeholder="" value="<?= $row['contract_start_date']?>">
                                <small id="contract_start_dateHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="contract_end_date">合約結束日</label>
                                <input type="text" class="form-control" id="contract_end_date" name="contract_end_date"
                                    placeholder="" value="<?= $row['contract_end_date']?>">
                                <small id="contract_end_dateHelp" class="form-text text-muted"></small>
                            </div>

                            <button id="submit_btn" type="submit" class="btn btn-primary">Submit</button>
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

const fields = [
    'client_name',
    'client_number',
    'client_address',
    'client_poc',
    'client_mobile',
    'client_email',
    'contract_budget',
    'contract_start_date',
    'contract_end_date',
];

// 拿到每個欄位的參照
const fs = {};
for (let v of fields) {
    fs[v] = document.form1[v];
}
console.log(fs);
console.log('fs.client_name:', fs.client_name);

const checkForm = () => {
    let isPassed = true;
    info_bar.style.display = 'none';

    // 拿到每個欄位的值
    const fsv = {};
    for (let v of fields) {
        fsv[v] = fs[v].value;
    }
    console.log(fsv);

    let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    let mobile_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;

    for (let v of fields) {
        fs[v].style.borderColor = '#cccccc';
        // console.log('#' + v + 'Help'); Added by Shinder
        document.querySelector('#' + v + 'Help').innerHTML = '';
    }

    if (fsv.client_name.length < 2) {
        fs.client_name.style.borderColor = 'red';
        document.querySelector('#client_nameHelp').innerHTML = '請輸入正確客戶公司!';
        isPassed = false;
    }
    if (!email_pattern.test(fsv.client_email)) {
        fs.client_email.style.borderColor = 'red';
        document.querySelector('#client_emailHelp').innerHTML = '請輸入正確連絡信箱';
        isPassed = false;
    }
    if (!mobile_pattern.test(fsv.client_mobile)) {
        fs.client_mobile.style.borderColor = 'red';
        document.querySelector('#client_mobileHelp').innerHTML = '請輸入正確連絡電話!';
        isPassed = false;
    }

    if (isPassed) {
        let form = new FormData(document.form1);

        submit_btn.style.display = 'none';

        fetch('AnnDataEdit_client_api.php', {
                method: 'POST',
                body: form
            })
            .then(response => response.json())
            .then(obj => {
                console.log(obj);

                info_bar.style.display = 'block';

                if (obj.success) {
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

<?php include __DIR__ . '/foot.php'; ?>