<?php
$pagename = "article_insert";
$groupname = "article";

include __DIR__.'/PDO.php';

if(isset($_SESSION['admin'])){
    $user = "小編：";
    $user_name = "小編";
    $user .= $_SESSION['admin'];
    $level = 10;
    $user_avatar = 'null.jpg';
    
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
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./sidenav.php'?>
<!-- <link rel="stylesheet" href="../css/jquery-ui.css"> -->
<!-- <script src="../tinymce/js/tinymce/tinymce.js"></script> -->
<!-- <script src="../js/jquery-ui.js"></script> -->
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
        <form name="form1" method="post" runat="server" onsubmit="return postya();">
            <label>Title</label>
            <div>
                <input type="text" class="form-control mb-2" id="title" name="title" placeholder="title">
                <small id="titleHelp" class="form-text text-muted"></small>
            </div>
            <label>Author</label>
            <div class="form-row d-flex flex-column">
                <div class="col-12">
                    <img src="../pic/avatar/<?=$user_avatar?>" class="figure-img img-fluid rounded" width="100" alt="作者頭像">
                    <input type="text" class="form-control" id="author" name="author" value="<?=$user_name?>" readonly>
                    <small id="authorHelp" class="form-text text-muted"></small>
                    <input type="hidden" class="form-control" id="avatar" name="avatar" placeholder="作者頭像" value="<?=$user_avatar?>">
                    
                </div>
            </div>

            <label>Date</label>
            <div class="">
                <input type="date" class="form-control mb-2" id="datepicker" name="date" placeholder="請輸入日期 YY-MM-DD">
                <small id="dateHelp" class="form-text text-muted"></small>
            </div>
            <label>Image</label>
            <div class="img">
                <img id="blah" src="" onerror="this.src='../pic/article/defaultpreview.jpg'" class="d-block" alt="your image" width="500" height="auto" />
            </div>
            <div class="custom-file">
                <input type="file" class="" id="image" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
            </div>
            <label>Link</label>
            <input type="text" class="form-control" id="link" name="link" placeholder="link">
            <small id="linkHelp" class="form-text text-muted"></small>
            <div>
                <label for="validationTextarea" class="my-2">Textarea</label>
                <textarea id="editor" name="content"></textarea>
            <!-- 2131 -->
            </div>
            
            
            <button id="submitBtn" type="submit" class="btn btn-primary my-2">Submit</button>
        </form>
</section>
<script>
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