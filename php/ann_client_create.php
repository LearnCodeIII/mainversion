<?php
require __DIR__ . '/PDO.php';
$page_name = 'ann_client_create';
?>

<?php include __DIR__ . '/head.php'; ?>
<?php include __DIR__ . '/nav.php'; ?>
<?php include __DIR__.'/ann_side_nav.php'?>

<style>
.form-group small {
    color: red !important;
}
</style>

<section class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <!-- <div class="alert alert-success" role="alert" style="display: none"></div> -->
                <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
                </div>

                <div class="card">
                    <h5 class="card-header">新增客戶資料</h5>
                    <div class="card-body">
                        <form name="form1" method="post" onsubmit="return checkForm();">
                            <input type="hidden" name="checkme" value="check123">
                            <input type="hidden" name="sn" value="<?= $row['sn']?>">

                            <div class="form-group">
                                <label for="client_name">公司名稱</label>
                                <input type="text" class="form-control" id="client_name" name="client_name"
                                    placeholder="" value="">
                                <small id="client_nameHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="client_number">客戶編號</label>
                                <input type="text" class="form-control" id="client_number" name="client_number"
                                    placeholder="" value="">
                                <small id="client_numberHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="client_address">客戶地址</label>
                                <textarea class="form-control" id="client_address" name="client_address" cols="30"
                                    rows="3"></textarea>
                                <small id="client_addressHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="client_poc">聯絡人</label>
                                <input type="text" class="form-control" id="client_poc" name="client_poc" placeholder=""
                                    value="">
                                <small id="client_pocHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="client_mobile">連絡電話</label>
                                <input type="text" class="form-control" id="client_mobile" name="client_mobile"
                                    placeholder="" value="">
                                <small id="client_mobileHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="client_email">連絡信箱</label>
                                <input type="text" class="form-control" id="client_email" name="client_email"
                                    placeholder="" value="">
                                <small id="client_emailHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="contract_budget">廣告預算</label>
                                <input type="text" class="form-control" id="contract_budget" name="contract_budget"
                                    placeholder="" value="">
                                <small id="contract_budgetHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="contract_start_date">合約開始日</label>
                                <input type="text" class="form-control" id="contract_start_date"
                                    name="contract_start_date" placeholder="" value="">
                                <small id="contract_start_dateHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="contract_end_date">合約結束日</label>
                                <input type="text" class="form-control" id="contract_end_date" name="contract_end_date"
                                    placeholder="" value="">
                                <small id="contract_end_dateHelp" class="form-text text-muted"></small>
                            </div>

                            <button id="submit_btn" type="submit" class="btn btn-primary">新增資料</button>
                            <button id="submit_btn" type="reset" class="btn btn-primary">重新填寫</button>
                        </form>

                    </div> <!-- card -->
                </div> <!-- col-lg-6 -->
            </div> <!-- row -->
        </div> <!-- container -->
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

const fs = {};
for (let v of fields) {
    fs[v] = document.form1[v];
}
console.log(fs);
console.log('fs.client_name:', fs.client_name);

const checkForm = () => {
    let isPassed = true;
    info_bar.style.display = 'none';

    const fsv = {};
    for (let v of fields) {
        fsv[v] = fs[v].value;
    }
    console.log(fsv);

    let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    let mobile_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;


    for (let v of fields) {
        fs[v].style.borderColor = '#cccccc';
        document.querySelector('#' + v + 'Help').innerHTML = '';
    }

    if (fsv.client_name.length < 2) {
        fs.client_name.style.borderColor = 'red';
        document.querySelector('#client_nameHelp').innerHTML = "請輸入正確客戶公司!";
        isPassed = false;
    }

    if (!email_pattern.test(fsv.client_email)) {
        fs.client_email.style.borderColor = 'red';
        document.querySelector('#client_emailHelp').innerHTML = "請輸入正確連絡信箱!";
        isPassed = false;
    }

    if (!mobile_pattern.test(fsv.client_mobile)) {
        fs.client_mobile.style.borderColor = 'red';
        document.querySelector('#client_mobileHelp').innerHTML = "請輸入正確連絡電話!";
        isPassed = false;
    }

    // return isChecked;

    if (isPassed) {
        let form = new FormData(document.form1);

        submit_btn.style.display = 'none';

        fetch('ann_client_create_api.php', {
                method: 'POST',
                body: form
            })
            .then(response => response.json())
            .then(obj => {
                console.log(obj);

                info_bar.style.display = 'block';

                if (obj.success) {
                    info_bar.className = 'alert alert-success';
                    info_bar.innerHTML = '資料新增成功';
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