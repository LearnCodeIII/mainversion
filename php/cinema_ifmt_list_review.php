<?php include __DIR__. './cinema_Login_SQL.php'?>
<?php
$sid = $_GET['sid'];
$sql = "SELECT * FROM cinema where sid='{$sid}'";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row){
    $name = $row['name'];
    $img = $row['img'];
    $taxID = $row['taxID'];
    $phone = $row['phone'];
    $address = $row['address'];
    $intro = $row['intro'];

}

?>
<?php include __DIR__. './hp_head.php' ?>
<?php include __DIR__. './hp_nav.php' ?>
<?php include __DIR__. './hp_sidenav.php' ?>
    <style>
        p{
            width: 75%;
        }
        label{
            width: 20%;
            height: 30px;
            font-size: 20px;
        }
    </style>
<section class="dashboard">
    <section class="d-flex">
<!--        左側資料-->
        <div style="width: 50%;background-color: #ccc;border-radius: 30px;">
<!--    圖像-->
            <img id="img" src=".<?= $img ?>" alt="..." class="img-thumbnail m-2 mb-4">

            <h2 id="name" class="font-weight-bolder m-2 mt-3" style="font-size: 50px"><?= $name ?></h2>

            <div class="d-flex align-items-center m-2">
                <label for="#sid">會員編號</label>
                <p contenteditable = "true" id="taxid" class=""><?= $taxID ?></p>
            </div>

            <div class=" d-flex align-items-center m-2">
                <label for="#taxid">統一編號:</label>
                <p contenteditable = "true" id="taxid" class=""><?= $taxID ?></p>
            </div>

            <div class="d-flex align-items-center m-2">
                <label for="#phone">連絡電話:</label>
                <p contenteditable = "true" id="phone" class=""><?= $phone ?></p>
            </div>

            <div class="d-flex align-items-center m-2">
                <label for="#address">地址:</label>
                <p contenteditable = "true" id="address" class=""><?= $address ?></p>
            </div>

            <div class="d-flex align-items-center m-2">
                <label for="#intro">簡介:</label>
                <p contenteditable = "true" id="intro" class=""><?= $intro ?></p>
            </div>

        </div>

<!--        右邊連結-->
        <div class="ml-5" style="width:50%;background-color:darkred">
            <div style="width:300px"></div>
            <div style="width:300px"></div>
            <div style="width:300px"></div>
        </div>
    </section>
    <script>
        function delete_it(sid){
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = 'cinema_ifmt_list_delete.php?sid=' + sid;
            }
        }


        //
        // const info_bar = document.querySelector('#info_bar');
        // const submit_btn = document.querySelector('#submit_btn');
        //
        // const fields = [
        //     'name',
        //     'img',
        //     'taxID',
        //     'phone',
        //     'address',
        //     'account',
        //     'password',
        //     'intro',
        // ];
        //
        // // 拿到每個欄位的參照
        // const fs = {};
        // for(let v of fields){
        //     fs[v] = document.form1[v];
        // }
        //
        //     // 拿到每個欄位的值
        //     const fsv = {};
        //     for(let v of fields){
        //         fsv[v] = fs[v].value;
        //     }
        //
        //     for(let v of fields){
        //         fs[v].style.borderColor = '#cccccc';
        //         document.querySelector('#' + v + 'Help').innerHTML = '';
        //     }
        //
        //     if(fsv.name.length < 2){
        //         fs.name.style.borderColor = 'red';
        //         document.querySelector('#nameHelp').innerHTML = '請填寫正確的姓名!';
        //         isPassed = false;
        //     }
        //
        //     if(isPassed) {
        //         let form = new FormData(document.form1);
        //
        //         submit_btn.style.display = 'none';
        //
        //         fetch('cinema_ifmt_list_edit_api.php', {
        //             method: 'POST',
        //             body: form
        //         })
        //             .then(response=>response.json())
        //             .then(obj=>{
        //                 info_bar.style.display = 'block';
        //
        //                 if(obj.success){
        //                     info_bar.className = 'alert alert-success';
        //                     info_bar.innerHTML = '資料修改成功';
        //                 } else {
        //                     info_bar.className = 'alert alert-danger';
        //                     info_bar.innerHTML = obj.errorMsg;
        //                 }
        //                 submit_btn.style.display = 'block';
        //             });
        //     }


    </script>

</section>
<?php include __DIR__. './hp_foot.php' ?>