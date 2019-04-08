<?php
require __DIR__.'/PDO.php';
$groupname = "member";
$pagename = 'member_permission';

$sql = "SELECT * FROM `permission`";
$stmt = $pdo->query($sql);
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include __DIR__.'/head.php' ?>
<?php include __DIR__.'/sidenav.php' ?>
<section class="dashboard">
<h2 class="sticky-top bg-light py-2">權限總覽　<a class="btn btn-success" data-toggle="collapse" href="#add" role="button" aria-expanded="false"
        aria-controls="add">新增權限</a></h2>    

    <div class="collapse mb-3" id="add">
        <div class="card card-body ">
            <form name="formAdd" method="post" onsubmit="return checkForm()">
            <input type="hidden" name="checkme" value="check123">
                <div class="form-inline my-3">
                    <div class="form-group">
                        <label for="perm_name">權限名稱</label>
                        <input type="text" class="form-control mx-3" id="perm_name" name="perm_name" required>
                    </div>
                    <div class="form-group">
                        <label for="perm_no">權限代號</label>
                        <input type="number" class="form-control mx-3" id="perm_no" name="perm_no" min=0 placeholder="請填寫大於零的整數"  required>
                    </div>
                </div>
                <div class="form-group mt-3" id="chkboxes">
                    <div>
                        <label for="">權限內容</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="all" name="all">
                        <label id="l_all" class="custom-control-label" for="all">全選</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="chkitems custom-control-input" id="comment" name="can[]" value="留言">
                        <label class="custom-control-label" for="comment">留言</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="chkitems custom-control-input" id="score" name="can[]" value="影片評分">
                        <label class="custom-control-label" for="score">影片評分</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="chkitems custom-control-input" id="collect" name="can[]" value="收藏影片">
                        <label class="custom-control-label" for="collect">收藏影片</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="chkitems custom-control-input" id="article_post" name="can[]" value="討論區發文">
                        <label class="custom-control-label" for="article_post">討論區發文</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="chkitems custom-control-input" id="article_reply" name="can[]" value="討論區回覆">
                        <label class="custom-control-label" for="article_reply">討論區回覆</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="chkitems custom-control-input" id="article_manage" name="can[]" value="討論區文章管理">
                        <label class="custom-control-label" for="article_manage">討論區文章管理</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="chkitems custom-control-input" id="activity_apply" name="can[]" value="活動報名">
                        <label class="custom-control-label" for="activity_apply">活動報名</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="chkitems custom-control-input" id="activity_VIPapply" name="can[]" value="活動VIP報名">
                        <label class="custom-control-label" for="activity_VIPapply">活動VIP報名</label>
                    </div>
                </div>
                <small id="candoHelp" class="form-text my-2 text-danger"></small>
                <button type="submit" id="submit_btn" class="btn btn-primary">確認新增</button>
            </form>
        </div>
    </div>
    <div class="row mt-3" id="perm_cards">

    </div>

    <div id="edit_cards">

    </div>
    <!-- <a href="#" id="testtest" class="btn btn-info mx-2" data-izimodal-open="#modal" data-izimodal-transitionin="fadeInDown" data-no="6" data-name="編輯測試" data-can="留言,收藏影片">變更</a> -->
<!-- Modal structure -->
<div id="modal" data-iziModal-fullscreen="true"  data-iziModal-title="變更權限" data-iziModal-icon="icon-home"> 
    <!-- Modal content -->
    <form name="formA" method="post" onsubmit="return editForm()">
                                <input type="hidden" name="checkme" value="check123">
                                    <div class="my-3">
                                        <div class="form-group">
                                            <label for="">權限名稱</label>
                                            <input type="text" class="form-control" id="edit_perm_name" name="edit_perm_name" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">權限代號</label>
                                            <input type="text" class="form-control" id="edit_perm_no" name="edit_perm_no"value="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3" id="edit_chkboxes">
                                        <div>
                                            <label for="">權限內容</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="edit_all" name="all">
                                            <label id="l_all" class="custom-control-label" for="edit_all">全選</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="edit_chkitems custom-control-input" id="edit_comment" name="edit_can[]" value="留言">
                                            <label class="custom-control-label" for="edit_comment">留言</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="edit_chkitems custom-control-input" id="edit_score" name="edit_can[]" value="影片評分">
                                            <label class="custom-control-label" for="edit_score">影片評分</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="edit_chkitems custom-control-input" id="edit_collect" name="edit_can[]" value="收藏影片">
                                            <label class="custom-control-label" for="edit_collect">收藏影片</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="edit_chkitems custom-control-input" id="edit_article_post" name="edit_can[]" value="討論區發文">
                                            <label class="custom-control-label" for="edit_article_post">討論區發文</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="edit_chkitems custom-control-input" id="edit_article_reply" name="edit_can[]" value="討論區回覆">
                                            <label class="custom-control-label" for="edit_article_reply">討論區回覆</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="edit_chkitems custom-control-input" id="edit_article_manage" name="edit_can[]" value="討論區文章管理">
                                            <label class="custom-control-label" for="edit_article_manage">討論區文章管理</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="edit_chkitems custom-control-input" id="edit_activity_apply" name="edit_can[]" value="活動報名">
                                            <label class="custom-control-label" for="edit_activity_apply">活動報名</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="edit_chkitems custom-control-input" id="edit_activity_VIPapply" name="edit_can[]" value="活動VIP報名">
                                            <label class="custom-control-label" for="edit_activity_VIPapply">活動VIP報名</label>
                                        </div>
                                    </div>
                                    <small id="edit_candoHelp" class="form-text my-2 text-danger"></small>
                                    <div class="text-center">

                                        <button type="submit" id="submit_edit" class="btn btn-primary">確認變更</button>
                                    </div>
                        </form>
</div>
    <script>

        //製作權限卡片
        let perms =<?= json_encode($row, JSON_UNESCAPED_UNICODE) ?>;
        console.log(perms);
        const perm_count = perms.length;
        console.log(perm_count);
        let cards = '';
        let edits = '';
        for (i = 0; i < perm_count; i++) {
            let can_do_ar = perms[i]['can_do'].split(',');
            console.log(can_do_ar);
            let can_do_list = ''
            for (k = 0; k < can_do_ar.length; k++) {
                can_do_list += `<p>${can_do_ar[k]}</p>`;
            }
            cards += `  <div class="col-md-3 my-3">
                            <div class="card text-white bg-dark text-center">
                            <div class="card-body">
                                <h5 class="card-title">${perms[i]['name']}</h5>
                                <p class="card-text bg-secondary">權限代號：${perms[i]['no']}</p>
                                <div class="collapse mb-3" id="card${perms[i]['no']}">
                                    <div class="card card-body alert-warning">
                                        ${can_do_list}
                                    </div>
                                </div>
                                <a class="btn btn-warning mx-2" data-toggle="collapse" href="#card${perms[i]['no']}" role="button" aria-expanded="false" aria-controls="collapseExample">查看內容</a>
                                <a href="#" class="btn btn-info mx-2 changes" data-izimodal-open="#modal" data-izimodal-transitionin="fadeInDown" data-no="${perms[i]['no']}" data-name="${perms[i]['name']}">變更</a>
                                <a href="javascript:delete_it(${perms[i]['sid']},${perms[i]['no']})" class="btn btn-danger mx-2">刪除</a>
                            </div>
                            </div>
                        </div>
                    `
            edits +=`<div class="modals" id="modal${perms[i]['no']}"data-iziModal-fullscreen="true"  data-iziModal-title="變更權限"  data-iziModal-subtitle=""  data-iziModal-icon="icon-home"> 
                        <form name="form${perms[i]['no']}" method="post" onsubmit="return editForm()">
                                <input type="hidden" name="checkme" value="check123">
                                    <div class="my-3">
                                        <div class="form-group">
                                            <label for="">權限名稱</label>
                                            <input type="text" class="form-control" id="edit_perm_name" name="edit_perm_name" value="${perms[i]['name']}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">權限代號</label>
                                            <input type="text" class="form-control" id="edit_perm_no" name="edit_perm_no"value="${perms[i]['no']}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3" id="edit_chkboxes">
                                        <div>
                                            <label for="">權限內容</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="edit_all" name="all">
                                            <label id="l_all" class="custom-control-label" for="edit_all">全選</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="chkitems custom-control-input" id="edit_comment${perms[i]['no']}" name="edit_can[]" value="留言">
                                            <label class="custom-control-label" for="edit_comment${perms[i]['no']}">留言</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="chkitems custom-control-input" id="edit_score${perms[i]['no']}" name="edit_can[]" value="影片評分">
                                            <label class="custom-control-label" for="edit_score${perms[i]['no']}">影片評分</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="chkitems custom-control-input" id="edit_collect${perms[i]['no']}" name="edit_can[]" value="收藏影片">
                                            <label class="custom-control-label" for="edit_collect${perms[i]['no']}">收藏影片</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="chkitems custom-control-input" id="edit_article_post${perms[i]['no']}" name="edit_can[]" value="討論區發文">
                                            <label class="custom-control-label" for="edit_article_post${perms[i]['no']}">討論區發文</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="chkitems custom-control-input" id="edit_article_reply${perms[i]['no']}" name="edit_can[]" value="討論區回覆">
                                            <label class="custom-control-label" for="edit_article_reply${perms[i]['no']}">討論區回覆</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="chkitems custom-control-input" id="edit_article_manage${perms[i]['no']}" name="edit_can[]" value="討論區文章管理">
                                            <label class="custom-control-label" for="edit_article_manage${perms[i]['no']}">討論區文章管理</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="chkitems custom-control-input" id="edit_activity_apply${perms[i]['no']}" name="edit_can[]" value="活動報名">
                                            <label class="custom-control-label" for="edit_activity_apply${perms[i]['no']}">活動報名</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="chkitems custom-control-input" id="edit_activity_VIPapply${perms[i]['no']}" name="edit_can[]" value="活動VIP報名">
                                            <label class="custom-control-label" for="edit_activity_VIPapply${perms[i]['no']}">活動VIP報名</label>
                                        </div>
                                    </div>
                                    <small id="edit_candoHelp" class="form-text my-2 text-danger"></small>
                                    <div class="text-center">

                                        <button type="submit" id="submit_edit" class="btn btn-primary sumbitEdit" data-no="${perms[i]['no']}">確認變更</button>
                                    </div>
                        </form>
                    </div>`
        }
        $("#perm_cards").html(cards);
        // $("#edit_cards").html(edits);


//         $(".modals").iziModal({
//             padding:20,
//             width:500
//         });
// $(document).on('click', '.trigger', function (event) {
//     event.preventDefault();
//     $('.modals').iziModal('open');
// });



//         $("#modal").iziModal({
//             padding:20,
//             width:500
//         });
// $(document).on('click', '.trigger', function (event) {
//     let no = $(this).data("no");
//     let name = $(this).data("name");
//     $("#modal input").eq(1).val(name);
//     $("#modal input").eq(2).val(no);
//     console.log(no);
//     event.preventDefault();
//     $('#modal').iziModal('open');
// });

// $("#testtest").on("click",function(){
//     let no = $(this).data("no");
//     let name = $(this).data("name");
//     console.log(no);
//     console.log(name);

//     $("#modal input").eq(1).val(name);
//     $("#modal input").eq(2).val(no);
// })
        $("#modal").iziModal({
            padding:20,
            width:500
        });
$(document).on('click', '.changes', function (event){
// $(".changes").on("click",function(){
    let no = $(this).data("no");
    let name = $(this).data("name");
    console.log(this);
    console.log(no);
    console.log(name);
    $("#modal input").eq(1).val(name);
    $("#modal input").eq(2).val(no);
    event.preventDefault();
    $('#modal').iziModal('open');
})

//checkbox全選判斷
var checkbox_count=$(".chkitems").length;//計算checkbox總數
var checked_count = $("#chkboxes .chkitems:checked").length;//計算被勾選的數量
$("#all").click(function(){
    var chkAllchecked = $(this).prop("checked");
    $(".chkitems").prop("checked", chkAllchecked);
});
$(".chkitems").click(function () {
            var checked = $(this).prop("checked");
            checked_count = $("#chkboxes .chkitems:checked").length;//重新抓取被勾選的數量
            console.log(checkbox_count);
            console.log(checked_count);
            if (checked_count == checkbox_count){//如果與checkbox總數相等則將全選勾選
                $("#all").prop("checked","checked");
            }else{
                $("#all").prop("checked","");
            }
        });


var edit_checkbox_count=$(".edit_chkitems").length;//計算checkbox總數
var edit_checked_count = $("#edit_chkboxes .edit_chkitems:checked").length;//計算被勾選的數量
$("#edit_all").click(function(){
    var edit_chkAllchecked = $(this).prop("checked");
    $(".edit_chkitems").prop("checked", edit_chkAllchecked);
});
$(".edit_chkitems").click(function () {
            var edit_checked = $(this).prop("checked");
            edit_checked_count = $("#edit_chkboxes .edit_chkitems:checked").length;//重新抓取被勾選的數量
            console.log(edit_checkbox_count);
            console.log(edit_checked_count);
            if (edit_checked_count == edit_checkbox_count){//如果與checkbox總數相等則將全選勾選
                $("#edit_all").prop("checked","checked");
            }else{
                $("#edit_all").prop("checked","");
            }
        });
//編輯資料
const editForm = () => {
    $("#submit_edit").css("display","none");
            let isPassed = true;
            let name=$("#edit_perm_name").val();
            if(name==''){
                isPassed = false;
            }
            if($("#edit_chkboxes .edit_chkitems:checked").length==0){
                isPassed = false;
                document.querySelector('#edit_candoHelp').innerHTML = '請選擇權限內容!';
            }

            if (isPassed) {
            let form = new FormData(document.formA);
            console.log(form);
            fetch('Su_permission_edit_api.php', {
                method: 'POST',
                body: form
            })
                .then(response => response.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        Swal.fire({
                            // position: 'top-end',
                            type: 'success',
                            title: '資料修改成功！',
                            showConfirmButton: false,
                            timer: 1200
                        }).then(setInterval(function () {
                            location.reload();}, 1500))//1.5秒自動刷新
                    } else {
                        Swal.fire({
                            // position: 'top-end',
                            type: 'warning',
                            title: `${obj.errorMsg}`,
                            showConfirmButton: true
                        })
                    }
                });
            }
            $("#submit_edit").css("display","block");
        return false;
}         
//新增資料
        const checkForm = () => {
            $("#submit_btn").css("display","none");
            let isPassed = true;

            let name=$("#perm_name").val();
            let no=$("#perm_no").val();
            if(name==''){
                isPassed = false;
            }
            if(no==''){
                isPassed = false;
            }
            if($("#chkboxes .chkitems:checked").length==0){
                isPassed = false;
                document.querySelector('#candoHelp').innerHTML = '請選擇權限內容!';
            }
            if (isPassed) {
            let form = new FormData(document.formAdd);
            fetch('Su_member_permission_api.php', {
                method: 'POST',
                body: form
            })
                .then(response => response.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        Swal.fire({
                            // position: 'top-end',
                            type: 'success',
                            title: '資料新增成功！',
                            showConfirmButton: false,
                            timer: 1200
                        }).then(setInterval(function () {
                            location.reload();}, 1500))//1.5秒自動刷新
                    } else {
                        Swal.fire({
                            // position: 'top-end',
                            type: 'warning',
                            title: `${obj.errorMsg}`,
                            showConfirmButton: true
                        })
                        // $("#submit_btn").css("display","block");
                    }
                });
            }
            $("#submit_btn").css("display","block");
        return false;
    }

//刪除資料
function delete_it(sid,no) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mx-2',
                cancelButton: 'btn btn-danger mx-2',
                title: 'swal-title'
            },
            buttonsStyling: false,
        })
        swalWithBootstrapButtons.fire({
            title: `確定刪除「權限：${no}」的資料嗎?`,
            text: "注意：刪除的資料無法被復原！",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: '確定刪除',
            cancelButtonText: '取消',
            reverseButtons: false
        }).then((result) => {
            if (result.value) {
                swalWithBootstrapButtons.fire(
                    '刪除完成！',
                    `已刪除「權限：${no}」的資料`,
                    'success'
                ).then(result=>{
                    location.href = 'Su_permission_delete.php?sid=' + sid;
                })
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    '已取消！',
                    '沒有刪除任何資料',
                    'error',
                )
            }
        })
    }


    </script>
    <script src="../js/sweet.js"></script>
</section>