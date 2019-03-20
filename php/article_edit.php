<?php
include __DIR__.'/PDO.php';
$pagename = "article_edit";

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `article` WHERE `sid`=$sid";

$stmt = $pdo->query($sql);

if($stmt->rowCount()==0){
    header('Location: article_list.php');
    exit;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./nav.php'?>
<?php include __DIR__.'./RuthNav.php'?>

<!-- <script src="../tinymce/js/tinymce/tinymce.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.6/tinymce.min.js"></script>
<script>
tinyMCE.init({
    // 初始化參數設定[註1]
    selector: "textarea", // 目標物件
    auto_focus: "editor", // 聚焦物件
    //language: "zh_TW", // 語系(CDN沒有中文，需要下載原始source才有)
    theme: "modern", // 模板風格
    plugins: "advlist autolink link image lists charmap print preview", // 套件設定: 進階清單、自動連結、連結、上傳圖片、清單、特殊字元表、列印、預覽
    mobile: { // 行動裝置設定
        theme: "mobile", // 模板風格
        plugins: ["autosave", "lists", "autolink"], // 套件設定: 自動儲存、清單、自動連結
        toolbar: ["undo", "bold", "italic", "styleselect"] // 工具列設定: 復原、粗體、斜體、樣式表
    }
});

$(document).ready(function() {
    bsCustomFileInput.init()
});

$(function() {
    $("#datepicker").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        dateFormat: 'yy-mm-dd'
    });
});
</script>

<section class="dashboard">
    <div class="container">
        <div id="infoMsg" class="alert alert-<?=$msg['type']?>" role="alert" style="display:none">
        </div>
        <?php if(isset($msg)): ?>
        <div class="alert alert-<?=$msg['type']?>" role="alert">
            <?= $msg['info'] ?>
        </div>
        <?php endif?>
        <form name="form1" method="post" onsubmit="return postya();">
        <input type="hidden" name="sid" value="<?= $row['sid']?>">
            <label>Title</label>
            <div>
                <input type="text" class="form-control mb-2" id="title" name="title" placeholder="title"
                    value="<?= $row['title']?>">
                <small id="titleHelp" class="form-text text-muted"></small>
            </div>
            <label>Author</label>
            <div class="form-row">
                <div class="col-6">
                    <input type="text" class="form-control" id="author" name="author" placeholder="作者"
                        value="<?= $row['author']?>">
                    <small id="authorHelp" class="form-text text-muted"></small>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" id="avatar" name="avatar" placeholder="作者頭像"
                        value="<?= $row['avatar']?>">
                    <small id="avatarHelp" class="form-text text-muted"></small>
                </div>
            </div>

            <label>Date</label>

            <div class="">
                <input type="text" class="form-control mb-2" id="datepicker" name="date" placeholder="請輸入日期 YY-MM-DD"
                    value="<?= $row['date']?>">
                <small id="dateHelp" class="form-text text-muted"></small>

                <div class="my-2 mx-auto">
                    <img src="../pic/<?= $row['image']?>" class="img-fluid max-width：100% height：auto" alt="<?= $row['image']?>">
                </div>
                <div class="custom-file">
                    <input type="hidden" class="custom-file-input" id="image" name="ori_img" value="<?= $row['image']?>">
                    <input type="file" class="custom-file-input" id="image" name="image" value="">
                    <label class="custom-file-label" for="image" data-browse="edit"><?= $row['image']?></label>
                    <small id="imageHelp" class="form-text text-muted"></small>
                </div>
                <label for="validationTextarea" class="my-2">Textarea</label>
                <textarea id="editor" name="content"><?= $row['content']?></textarea>

                <label>Link</label>
                <input type="text" class="form-control mb-2" id="link" name="link" placeholder="link"
                    value="<?= $row['link']?>">
                <small id="linkHelp" class="form-text text-muted"></small>
                <button id="submitBtn" type="submit" class="btn btn-primary my-2">Submit</button>
        </form>
</section>
<script>
const postya = () => {
    submitBtn.style.display = 'none';
    const edt = document.querySelector('#editor')
    console.log(edt);
    edt.innerHTML = tinyMCE.activeEditor.getContent();
    
    let form1 = new FormData(document.form1);
    fetch('article_edit_api.php', {
            method: 'POST',
            body: form1
        })
        .then(response => response.json())
        .then(obj => {
            console.log(obj);
            infoMsg.style.display = 'block';
            if (obj.success) {
                infoMsg.className = 'alert alert-success';
                infoMsg.innerHTML = '資料修改成功';
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