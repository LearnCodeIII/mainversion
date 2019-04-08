<?php
include __DIR__.'/PDO.php';
$groupname = "activity";
$pagename = "pageMain";


?>
<?php include __DIR__.'./head.php'?>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="../js/sweet.js"></script>
<script src="../js/tilt.js"></script>
<script src="../zoom-master/jquery.zoom.min.js"></script>
<style>
    *{
        transition:0.4s;
    }
    html,body{
        font-family : 'Noto Sans TC', sans-serif,Verdana, Geneva, Tahoma, sans-serif;
        
    }
    .change{
        position:fixed;
        bottom:20%;
        right:5%;
        font-size:1.5rem;
        border:2px solid black;
        padding:1.3rem;
        border-radius:10px;
    }
</style>

<div class="container">
    <ul class="list-unstyled" >
    </ul>  
</div>
<div class="change">
    <div class="setting mb-2 mr-2">
    設定觀賞模式
    </div>
    <div class="sun">
        <i class="fas fa-sun mb-2 mr-2"></i>白天模式
    </div>
    <div class="moon">
        <i class="fas fa-moon mb-2 mr-2"></i>黑夜模式
    </div>
    <div class="share mt-5 mb-2 mr-2">
        分享連結<br>
        <div onclick="javascript: void(window.open('http://www.facebook.com/share.php?kid_directed_site=0&sdk=joey&u='.concat(encodeURIComponent(location.href)) ));">
            <i class="fab fa-facebook mb-2 mr-2"></i>Facebook
        </div>
        <div onclick="javascript: void(window.open('http://plus.google.com/share?url='.concat(encodeURIComponent(location.href))));">
            <i class="fab fa-google-plus-square mb-2 mr-2"></i>Google
        </div>
        <div onclick="javascript: void(window.open('http://pinterest.com/pin/create/button/?url='.concat(encodeURIComponent(location.href))));">
            <i class="fab fa-pinterest-square mb-2 mr-2"></i>Pinterset
        </div>
        <div onclick="javascript: void(window.open('http://twitter.com/home/?status='.concat(encodeURIComponent(document.title)) .concat(' ') .concat(encodeURIComponent(location.href))));">
            <i class="fab fa-twitter-square mb-2 mr-2"></i>Twitter
        </div>
        <div onclick="javascript: void(window.open('http://www.plurk.com/?qualifier=shares&amp;status=' .concat(encodeURIComponent(location.href)) .concat(' ') .concat('(') .concat(encodeURIComponent(document.title)) .concat(')')));">
            <i class="fab fa-product-hunt mb-2 mr-2"></i>Plurk
        </div>
    </div>
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


$(document).ready(function(){
  $('div').zoom({url: 'ShawnpageDisplay.php?sid=84'});
});








//換文字顏色
$('.sun').on("click",function(){
    $('div').css({
        "background":"white",
        "color":"black"
    });
    $('body').css({
        "background":"white",
        "color":"black"
    });
});
$('.moon').on("click",function(){
    $('div').css({
        "background":"black",
        "color":"white"
    });
    $('body').css({
        "background":"black",
        "color":"white"
    });
});




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
    </div>
</div>
`;

const wrap_func = _.template(wrap_str);

const search_pagi_str = `<li class="page-item <%= active %>">
				<a class="page-link" href="#/page=<%= page %>"><%= page %></a>
            </li>`;
const search_pagi_func = _.template(search_pagi_str);

 
const searchForm = () =>{
    let sid;

    let h = location.href.slice(location.href.indexOf('sid=')+4)
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
            document.title=d.company+d.name;
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
$
$('html').on("mouseover",function(){
    $('img').tilt({
        glare: true,
        maxGlare: .5
    })
})

</script>

<?php include __DIR__.'./foot.php'?>