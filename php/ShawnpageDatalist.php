<?php
include __DIR__.'/PDO.php';
$groupname = "activity";
$pagename = "pageMain";

if(isset($_SESSION['admin'])){
    $user = "小編：";
    $user .= $_SESSION['admin'];
    $level = 10;
    
}else if(isset($_SESSION['theater'])){
    $theater=$_SESSION['theater'];
    $sql = "SELECT * FROM `cinema` where account = '$theater' ";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row){
        $c_sid = $row['sid'];
        $c_user = $row['name'];
        $c_img = $row['img'];
        $c_taxID = $row['taxID'];
        $c_phone = $row['phone'];
        $c_address = $row['address'];
        $c_intro = $row['intro'];
    
    }
    $level = 2;
}else {
    header("Location: ./login.php");
    exit;
};
?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./nav.php'?>
<?php include __DIR__.'./Shawnsidenav.php'?>
<script src="../js/sweet.js"></script>
<section class="dashboard">
<input type="text" id="list_level" value="<?= $level ?>" hidden>
    <div class="container-fulid">
        <div class="row d-flex ">
            <div class="col-md-8">
                <ul class="list-unstyled" >
                </ul>  
            </div>
            <form class="col-md-4" method="post" name="form1" onsubmit="return searchForm();">    
                <div class="input-group mt-3 mb-3">
                    <div class="input-group-prepend ">
                        <span class="input-group-text bg-dark text-white">活動關鍵字</span>
                    </div>
                    <input type="text" class="form-control" id="search_keyword" name="search_keyword" placeholder="廠商、標題、內文、地址">
                </div>

                <div class="input-group mt-3 mb-3">
                    <div class="input-group-prepend ">
                        <span class="input-group-text bg-dark text-white">活動開始日期</span>
                    </div>
                    <input type="date" class="form-control" id="search_dateStart" name="search_dateStart">
                </div>

                <div class="input-group mt-3 mb-3">
                    <div class="input-group-prepend ">
                        <span class="input-group-text bg-dark text-white">活動結束日期</span>
                    </div>
                    <input type="date" class="form-control" id="search_dateEnd" name="search_dateEnd">
                </div>




                <div class="btn-group mt-2 mb-2 d-flex justify-content-between" role="group">
                    <label class="btn btn-dark ">活動類型</label>               
                    <label class="btn btn-light" for="search_primary" onclick="btn_changeColor(this)">徵才資訊</label>
                    <label class="btn btn-light" for="search_success" onclick="btn_changeColor(this)">長期活動</label>
                    <label class="btn btn-light" for="search_warning" onclick="btn_changeColor(this)">戲院公告</label>
                    <label class="btn btn-light" for="search_danger" onclick="btn_changeColor(this)">會員專屬</label>
                    <label class="btn btn-light" for="search_info" onclick="btn_changeColor(this)">電影資訊</label>
                    <label class="btn btn-light" for="search_secondary" onclick="btn_changeColor(this)">官方活動</label>
                    <label class="btn btn-light" for="search_dark" onclick="btn_changeColor(this)">維修公告</label>
                </div>
                <div class="btn-group mt-3 mb-3 d-flex justify-content-between" role="group">
                    <button class="btn btn-dark" type="submit" id="search_btn" >搜尋</button>
                </div>
                <nav>
                    <ul class="pagination justify-content-center" id="search_pagination">
                    </ul>
                </nav>
                <input class="form-check-input" type="checkbox" id="search_primary" value="search_primary" name="search_contenttype[]" hidden><br>
                <input class="form-check-input" type="checkbox" id="search_success" value="search_success" name="search_contenttype[]" hidden><br>
                <input class="form-check-input" type="checkbox" id="search_warning" value="search_warning" name="search_contenttype[]" hidden><br>
                <input class="form-check-input" type="checkbox" id="search_danger" value="search_danger" name="search_contenttype[]" hidden><br>
                <input class="form-check-input" type="checkbox" id="search_info" value="search_info" name="search_contenttype[]" hidden><br>
                <input class="form-check-input" type="checkbox" id="search_secondary" value="search_secondary" name="search_contenttype[]" hidden><br>
                <input class="form-check-input" type="checkbox" id="search_dark" value="search_dark" name="search_contenttype[]" hidden><br>
            </form>
            
        </div>
    </div>
	
</section>

<script>
//
(function () {
  var ie = !!(window.attachEvent && !window.opera);
  var wk = /webkit\/(\d+)/i.test(navigator.userAgent) && (RegExp.$1 < 525);
  var fn = [];
  var run = function () { for (var i = 0; i < fn.length; i++) fn[i](); };
  var d = document;
  d.ready = function (f) {
    if (!ie && !wk && d.addEventListener)
      return d.addEventListener('DOMContentLoaded', f, false);
    if (fn.push(f) > 1) return;
    if (ie)
      (function () {
        try { d.documentElement.doScroll('left'); run(); }
        catch (err) { setTimeout(arguments.callee, 0); }
      })();
    else if (wk)
      var t = setInterval(function () {
        if (/^(loaded|complete)$/.test(d.readyState))
          clearInterval(t), run();
      }, 0);
  };
})();




//按鈕
function btn_changeColor(e){
    switch(e.className){
        case 'btn btn-light':
            e.className='btn btn-light active';
            break;
        case 'btn btn-light active':
            e.className='btn btn-light';
            break;
    };
};



//換頁功能
const pagi = document.querySelector('#pagination');
const search_pagi = document.querySelector('#search_pagination');
const data_body = document.querySelector('ul.list-unstyled');

const wrap_str = 
`<div class="card mb-3" style="background-color:white;">
    <div class="row no-gutters">
        
        <div class="card-body col-xl-11 col-lg-9 col-md-9 col-sm-8 p-3">
            <h5 class="card-title" id="text123" style="font-weight=bold;">【<%= company %>】<%= name %></h5>
            <h6 class="card-subtitle mb-2 ml-2 text-muted">
                <span class="badge badge-primary " id="badge-primary"><%= primary%></span>
                <span class="badge badge-success" id="badge-success"><%= success%></span>
                <span class="badge badge-warning" id="badge-warning"><%= warning%></span>
                <span class="badge badge-danger" id="badge-danger"><%= danger%></span>
                <span class="badge badge-info" id="badge-info"><%= info%></span>
                <span class="badge badge-secondary" id="badge-secondary"><%= secondary%></span>
                <span class="badge badge-dark" id="badge-dark"><%= dark%></span>
            </h6>
        </div>
        <div class="col-xl-1 col-lg-3 col-md-3 col-sm-4">
            <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&choe=UTF-8&chl=http://192.168.27.179/mainversion/mainversion/php/ShawnpageDisplay.php?sid=<%= sid %>" class="card-img-top" style="display:block;max-height:200px;max-width:200px;">
        </div>
    </div>
    
<div class="accordion" id="accordionExample<%=sid%>">
    <div id="collapseTwo<%=sid%>" class="collapse" data-parent="#accordionExample<%=sid%>">
        <div class="card-body">
        <h5 class="card-text ml-2">活動內容：</h5>
        <p class="card-text ml-2"><%= content %></p>
        <h5 class="card-text ml-2">活動地址：</h5>
        <p class="card-text ml-2"><%= region %></p>
        </div>
    </div>
</div>

    
    <div class="card-footer d-flex justify-content-between bg-dark text-white" onclick="highlightContent();">
        <small >活動期限：<%= dateStart %>-<%= dateEnd %></small>
        <small class="ml-3 collapsed"  data-toggle="collapse" data-target="#collapseTwo<%=sid%>" aria-expanded="false" aria-controls="collapseTwo<%=sid%>"><a class="text-white">更多資訊 <i class="fas fa-info-circle"></i></a></small> 
        <small class="d-flex justify-content-between">
                
                <div class="ml-3"><a class="text-white" href="ShawnpageEdit.php?sid=<%= sid %>">修改<i class="fas fa-edit ml-1"></i></a></div> 
                <div class="ml-3"><a class="text-white" href="javascript:deleteIt(<%= sid %>);">刪除<i class="far fa-trash-alt ml-1"></i></a></div>
        </small>
    </div>
</div>`;

const wrap_func = _.template(wrap_str);

const search_pagi_str = `<li class="page-item <%= active %>">
				<a class="page-link" href="#/page=<%= page %>"><%= page %></a>
            </li>`;
const search_pagi_func = _.template(search_pagi_str);

//搜尋功能

const search_btn = document.querySelector('#search_btn');
 
const searchForm = () =>{
    console.log('GO!')
    if(search_keyword.value=="" && search_dateStart.value =="" && search_dateEnd.value ==""){
        search_keyword.value=="";
        search_dateStart.value ="1000-01-01";
        search_dateEnd.value ="9999-01-01";
    }
    if(search_dateStart.value ==""){
        search_dateStart.value ="1000-01-01";
    }
    if(search_dateEnd.value ==""){
        search_dateEnd.value ="9999-01-01";
    }


    let h = location.hash.slice(7);
    page = parseInt(h);
    if(isNaN(page)){
        page = 1;
    }
    search_pagi.innerHTML = page;
    let form = new FormData(document.form1);
    fetch('ShawnpageSearchapi.php?page='+page,{
        method:'POST',
        body:form
    })
    .then(response=>{return response.json();})
    .then(json=>{
        ori_data = json;
        console.log(ori_data);
        
        
        let str='';
        for(let d of ori_data.data){

            if(d.contenttype.indexOf('primary')>-1){
                d.primary="徵才資訊"
            }else d.primary="";
            if(d.contenttype.indexOf('success')>-1){
                d.success="長期活動"
            }else d.success="";
            if(d.contenttype.indexOf('warning')>-1){
                d.warning="戲院公告"
            }else d.warning="";
            if(d.contenttype.indexOf('danger')>-1){
                d.danger="會員專屬"
            }else d.danger="";
            if(d.contenttype.indexOf('info')>-1){
                d.info="電影資訊"
            }else d.info="";
            if(d.contenttype.indexOf('secondary')>-1){
                d.secondary="官方活動"
            }else d.secondary="";
            if(d.contenttype.indexOf('dark')>-1){
                d.dark="維修公告";
            }else d.dark="";
            str += wrap_func(d);

        }
        
        data_body.innerHTML = str;
        
        str = '';
            for(let i=1;i<=ori_data.totalPages;i++){
                let active = ori_data.page === i ? 'active':'';
                str += search_pagi_func({
                    active:active,
                    page:i
                });
            }
        search_pagi.innerHTML =str;
        if(!ori_data.success){
        return search_pagi.innerHTML ="<a href='./ShawnpageDatalist.php'>搜尋結果沒有符合此條件的活動，點此重新搜尋</a>";
        }
        highlight();
    });
    search_dateStart.value="";
    search_dateEnd.value="";
    return false;
};

window.addEventListener('hashchange',searchForm);
searchForm();

//標提高亮
function highlight(){
    var value = search_keyword.value;
    if(removeAllSpace(value) != ""){
    for(var i=0;i<100;i++){
        var values = document.querySelectorAll('.card-title')[i].innerHTML.split(value);
        document.querySelectorAll('.card-title')[i].innerHTML = values.join('<span style="background:yellow;">' + value + '</span>')
        };
    }
};


//內文高亮
function highlightContent(){
    var value = search_keyword.value;
    if(removeAllSpace(value) != ""){
        for(var i=0;i<100;i++){
        var values = document.querySelectorAll('.card-body')[i].innerHTML.split(value);
        document.querySelectorAll('.card-body')[i].innerHTML = values.join('<span style="background:yellow;">' + value + '</span>')
        };
    }
}

//去除字串所有空白
function removeAllSpace(str) {
return str.replace(/\s+/g, "");
}


//刪除功能
function deleteIt(sid){
    
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
    title: `確認要刪除資料嗎?`,
    text: "檔案刪除過後將無法還原!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: '確認刪除',
    cancelButtonText: '我再想想',
    reverseButtons: true
    }).then((result) => {
    if (result.value) {
        swalWithBootstrapButtons.fire({
            type: 'success',
            title: '確認刪除',
            text: '您的資料已經刪除。',
            footer: '提示：即將返回主畫面',
            timer: 3000,
        }).then((result) => {
            location.href = 'ShawnpageDelete.php?sid=' + sid;
        })
    } else if (
        result.dismiss === Swal.DismissReason.cancel
    ) {
        swalWithBootstrapButtons.fire({
            type: 'error',
            title: '取消刪除',
            text: '您的資料沒有刪除。'
        })
    }
    })
}






</script>

<?php include __DIR__.'./foot.php'?>