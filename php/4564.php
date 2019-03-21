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

// $cmsql = "SELECT `comment`.*,`article`.`sid`,`article`.`title`,`member`.`name`,`member`.`nickname`,`member`.`avatar` FROM `comment`LEFT JOIN `member` ON `comment`.`member_sid` = `member`.`sid` LEFT JOIN `article` ON `comment`.`article_sid`=`article`.`sid` WHERE `article`.`sid`=$sid";

// $cmstmt = $pdo->query($cmsql);
// $cmrow = $cmstmt->fetch(PDP::FETCH_ASSOC);



?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./nav.php'?>
<?php include __DIR__.'./RuthNav.php'?>


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

;
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

        <h2 class="mb-3">網友留言</h2>
        <div id="commentarea">
            <!-- <div class="toast-header">
                <img src="..." class="rounded mr-2" alt="...">
                <strong class="mr-auto">Bootstrap</strong>
                <small>11 mins ago</small>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div> -->
        </div>

        <form name="form1" method="post" runat="server" onsubmit="return postya();">
            <div class="form-row">
                <div class="col-3">
                    <select class="form-control" name="member_sid">
                        <option value="1">皮卡丘</option>
                        <option value="2">小火龍</option>
                        <option value="3">傑尼龜</option>
                        <option value="4">妙蛙種子</option>
                    </select>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" name="comment" placeholder="留下評論......">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary mb-2">送出</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
let page = location.search;
let oriData;
const data_body = document.querySelector('#commentarea');

let tr_str = `<div class="toast-header">
                <img src="../pic/avatar/<%= avatar %>" class="rounded mr-2" width="30" alt="...">
                <%= name %>：<%= comment %>
                      </div>
            <div class="toast-body">
            <small><%= cm_date %></small>
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

myHashChange();


const postya = () => {
    submitBtn.style.display = 'none';

    const edt = document.querySelector('#editor')
    console.log(edt);
    edt.innerHTML += tinyMCE.activeEditor.getContent();
    var form1 = new FormData(document.form1);

    fetch('article_insert_api.php', {
            method: 'POST',
            body: form1
        })
        .then(response => response.json())
        .then(obj => {
            console.log(obj);
            infoMsg.style.display = 'block';
            if (obj.success) {
                infoMsg.className = 'alert alert-success';
                infoMsg.innerHTML = '資料新增成功';
            } else {
                infoMsg.className = 'alert alert-dager';
                infoMsg.innerHTML = obj.errorMsg;
            }
            submitBtn.style.display = 'block';
        });
    return false;
};


</script>

<!-- <?php include __DIR__.'/__html_foot.php'; ?> -->