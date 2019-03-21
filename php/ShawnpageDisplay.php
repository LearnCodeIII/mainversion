<?php
$groupname = "activity";
$pagename = "pageMain";

include __DIR__.'/PDO.php';

?>
<?php include __DIR__.'./head.php'?>
<script src="../js/sweet.js"></script>
<div class="container">
    <ul class="list-unstyled" >
    </ul>  
</div>

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
        <div class="col-xl-1 col-lg-3 col-md-3 col-sm-4" hidden>
            <img src="../pic/activity/<%= picture %>" class="card-img-top" style="display:block;max-height:180px;max-width:180px;">
        </div>
    </div>
    
<div class="accordion"  id="accordionExample<%=sid%>">
    <div id="collapseTwo<%=sid%>" class="collapse show" data-parent="#accordionExample<%=sid%> ">
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
        <small class="ml-3 collapsed"  data-toggle="collapse" data-target="#collapseTwo<%=sid%>" aria-expanded="false" aria-controls="collapseTwo<%=sid%>"><a class="text-white">收合資訊 <i class="fas fa-info-circle"></i></a></small> 
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

 
const searchForm = () =>{
    let sid;

    let h = location.href.slice(75);
    sid = parseInt(h);
    if(isNaN(sid)){
        sid = 1;
    }
    let form = new FormData(document.form1);
    fetch('ShawnpageDisplayapi.php?sid='+sid,{
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

    });
};

searchForm();


</script>

<?php include __DIR__.'./foot.php'?>