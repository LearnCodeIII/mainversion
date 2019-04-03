<?php
include __DIR__.'/PDO.php';

$pagename = "article_list";
$groupname = "article";

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM article WHERE `sid`=$sid";

$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

date_default_timezone_set('Asia/Taipei');
$cm_time = '';

if(isset($_SESSION['admin'])){
    $user = "小編：";
    $user .= $_SESSION['admin'];
    $level = 10;
    
}else if(isset($_SESSION['member'])){
    $member=$_SESSION['member'];
    $lo_sql = "SELECT * FROM `member` where email = '$member' ";
    $lo_stmt = $pdo->query($lo_sql);
    $lo_rows = $lo_stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($lo_rows as $lo_row){
        $user = $lo_row['sid'];
        $user_name = $lo_row['name'];
        $user_avatar = $lo_row['avatar'];

    
    }
    $level = 2;
}else {
    header("Location: ./login.php");
    exit;
};

?>

<?php include __DIR__.'./new_head.php'?>
<?php include __DIR__.'./new_nav.php'?>


<style>
.card-text {
    line-height: 2;
}

;

.re_btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
}

.toast-header {
    border-radius: 10px 10px 10px 0px;
    box-shadow: 1px 1px 5px #cccccc;
}

;

.border10 {
    border-radius: 10%;
}
</style>

<section class="dashboard">
    <div class="d-flex fixed-bottom justify-content-end">
        <button type="button" class="btn btn-secondary btn-lg" onclick="history.back()">返回上一頁</button>
    </div>
    <div class="container">
        <div class="card mb-3">
            <img src="../pic/article/<?= $row['image']?>" class="card-img-top" alt="">
            <div class="card-body" id="card_body">
                <h5 class="card-title"><?= $row['title']?></h5>
                <p class="card-text"><?= $row['author']?></p><img src="" alt="">
                <p class="card-text"><small class="text-muted"><?= $row['date']?></small></p>
                <p class="card-text"><?= $row['content']?></p>
            </div>
        </div>

        <h4 class="mb-3">網友評論</h4>
        <div id="commentarea" class="justify-content-between">
            <!-- <div class="toast-header">
                <img src="..." class="rounded mr-2" alt="...">
                <strong class="mr-auto">Bootstrap</strong>
                <small>11 mins ago</small>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div> -->
        </div>

        <form name="form1" method="post" onsubmit="return postya();">
            <div class="form-row">
                <input type="hidden" class="form-control" name="member_sid" value="<?=$lo_row['sid']?>">
                <div class="">
                    <img src="../pic/avatar/<?=$user_avatar?>" class="mt-1 ml-2" width="30" height="auto" alt="...">
                </div>
                <div>
                    <p class="mt-2"><?=$user_name?></p>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control" id="content" name="comment" placeholder="留下評論......">
                    <input type="hidden" class="form-control" name="article_sid" value="<?= $row['sid']?>">
                    <input type="hidden" class="form-control" id="cm_date" name="cm_date" value="<?= $cm_time ?>">
                </div>
                <div class="col">
                    <div>
                        <button type="submit" id="gocomment" class="btn btn-primary">送出留言</button>
                    </div>
                </div>

            </div>
            <div class="form-row">
            </div>
        </form>
    </div>
</section>

<script>
let page = location.search;
let oriData;
const data_body = document.querySelector('#commentarea');

let tr_str = `<div class="toast-header my-2">
                <div class="">
                <img src="../pic/avatar/<%= avatar%>" class="mb-1" width="30" alt="...">
                </div>
                <div class="ml-2">
                <strong"><%= name%></strong>：<%= comment %>
                </div>
                <div class="ml-auto">
                <small><%= cm_date %></small>
                </div>
                 </div>`;

const tr_func = _.template(tr_str);

// escape.html(_.escape(input.val(tr_str)));

// let page_str = `<li class="page-item <%= active %>">
//                 <a class="page-link" href="#<%= page %>"><%= page %></a>
//                 </li>`;

// const page_func = _.template(page_str);


const myHashChange = () => {
    // let h = location.search.slice(1);
    page = <?= isset($_GET['sid']) ? intval($_GET['sid']) : 0 ?>;
    console.log(page)
    if (isNaN(page)) {
        page = 1;
    };

    fetch('comment_article_api.php?sid=' + page)
        .then(response => response.json())
        .then(json => {
            oriData = json;
            console.log(oriData);
            let str = '';
            for (k in oriData.data) {
                str += tr_func(oriData.data[k]);
            }
            data_body.innerHTML = str;
        });

};

$('#gocomment').click(function(){
    var date = new Date().toDateString();
    var time = new Date().toLocaleTimeString();
    $('#cm_date').val(date + time);
})
// var cm_time = Date()
// $('#cm_date').val(cm_time)
var cm_time;
myHashChange();

const postya = () => {
    var form1 = new FormData(document.form1);
    fetch('comment_insert_api.php', {
            method: 'POST',
            body: form1
        })
        .then(response => response.json())
        .then(obj => {
            console.log(obj);
            // let str = '';
            // for (k in oriData.data) {
            //     str += tr_func(oriData.data[k]);
            // }
            // data_body.innerHTML = str;
            setTimeout(myHashChange(), 300);
        });
        $('#content').val('');
    return false;
};
</script>

<!-- <?php include __DIR__.'/__html_foot.php'; ?> -->