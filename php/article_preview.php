<?php
include __DIR__.'/PDO.php';

$pagename = "preview";

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM article WHERE `sid`=$sid";

$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// if($stmt->rowCount()==0){
//     header('Location: article_list.php');
//     exit;
// }
?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./nav.php'?>
<?php include __DIR__.'./RuthNav.php'?>


<style>
.card-text{
    line-height:2;
};
</style>

<section class="dashboard">
    <div class="container">
    <button type="button" class="btn btn-secondary btn-lg" onclick="history.back()">返回列表</button>    
        <div class="card mb-3">
            <img src="../pic/<?= $row['image']?>" class="card-img-top" alt="">
            <div class="card-body" id="card_body">
                <h5 class="card-title"><?= $row['title']?></h5>
                <p class="card-text"><?= $row['author']?></p><img src="" alt="">
                <p class="card-text"><small class="text-muted"><?= $row['date']?></small></p>
                <p class="card-text"><?= $row['content']?></p>
            </div>
        </div>
    </div>
</section>

<script>
// let oriData;
// // const ul_page = document.querySelector('.pagination');
// const card_body = document.querySelector('#card_body');

// let tr_str = `<tr>
//                 <img src="...<%= image %>" class="card-img-top" alt="...">
//                 <h5 class="card-title"><%= title %></h5>
//                 <p class="card-text"><%= date %></p>
//                 <p class="card-text"><%= author %></p><img src="//.....<%= avatar %>" alt="">
//                 <p class="card-text"><%= content %></p>
//                 <p class="card-text"><%= link %></p>
//             </tr>`;
// const tr_func = _.template(tr_str);

// fetch ('article_preview_api.php?sid=' + $sid)
//             .then (res => {
//                 return res.json();
//             })
//             .then (json=>{
//                 oriData = json;
//                 console.log(oriData);
//                 let str = '';
//                 str += tr_func(oriData.data);
//                 };
//                 card_body.innerHTML = str;
//             );

</script>

<!-- <?php include __DIR__.'/__html_foot.php'; ?> -->