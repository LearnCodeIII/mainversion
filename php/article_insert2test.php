<?php
$pagename = "pageMain";
$groupname = 'article';
include __DIR__.'/PDO.php';
?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./nav.php'?>
<?php include __DIR__.'./RuthNav.php'?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="../css/jquery-ui.css">




<script>
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

<style>
#editor-container {
  height: 375px;
}

</style>

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
            <label>Title</label>
            <div>
                <input type="text" class="form-control mb-2" id="title" name="title" placeholder="title">
                <small id="titleHelp" class="form-text text-muted"></small>
            </div>
            <label>Author</label>
            <div class="form-row">
                <div class="col-6">
                    <input type="text" class="form-control" id="author" name="author" placeholder="作者" value="">
                    <small id="authorHelp" class="form-text text-muted"></small>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" id="avatar" name="avatar" placeholder="作者頭像" value="">
                    <small id="avatarHelp" class="form-text text-muted"></small>
                </div>
            </div>

            <label>Date</label>
            <div class="form-row">
                <div class="col-6">
                    <input type="text" class="form-control mb-2" id="datepicker" name="date"
                        placeholder="請輸入日期 YY-MM-DD">
                    <small id="dateHelp" class="form-text text-muted"></small>
                </div>
                <div class="custom-file col-6">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image" data-browse="upload"></label>
                    <small id="imageHelp" class="form-text text-muted"></small>
                </div>
                <div class="col-12">
                <input name="content" type="hidden">
                <div id="editor-container">
                </div>
                </div>

                <label>Link</label>

                    <input type="text" class="form-control mb-2" id="link" name="link" placeholder="link">
                    <small id="linkHelp" class="form-text text-muted"></small>
                
                <button id="submitBtn" type="submit" class="btn btn-primary my-2">Submit</button>
        </form>
</section>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
var quill = new Quill('#editor-container', {
  modules: {
    toolbar: [
      [{ header: [1, 2, false] }],
      ['bold', 'italic', 'underline'],
      ['image', 'code-block']
    ]
  },
  placeholder: 'Compose an epic...',
  theme: 'snow'  // or 'bubble'
});

const postya = () => {
    submitBtn.style.display = 'none';

    var form1 = new FormData(document.form1);

    var content = document.querySelector('input[name=content]');
    content.value = quill.getContents();

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