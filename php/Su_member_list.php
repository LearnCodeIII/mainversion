<?php
require __DIR__.'/PDO.php';
$pagename = "member";
$spname = 'member_list';
?>
<?php include __DIR__.'/head.php' ?>
<?php include __DIR__.'/nav.php' ?>
<?php include __DIR__.'./Su_sidenav.php'?>
<section class="dashboard">
<div class="row d-flex justify-content-center">
  <div class="col-lg data_info"></div>
  <div class="col-lg-4">
    <div class="row d-flex justify-content-center flex-nowrap">
      <div class="col-lg">
        <nav class="d-flex justify-content-center">
          <ul id="first_page" class="pagination pagination-sm justify-content-center"></ul>   
          <ul id="pre_page" class="pagination pagination-sm justify-content-center"></ul>
        </nav> 
      </div>
      <div class="col-lg-5">
        <nav class="d-flex justify-content-center">
          <ul id="page_list" class="pagination pagination-sm justify-content-center"></ul>
        </nav> 
      </div>
      <div class="col-lg">
        <nav class="d-flex justify-content-center">
          <ul id="next_page" class="pagination pagination-sm justify-content-center"></ul>
          <ul id="end_page" class="pagination pagination-sm justify-content-center"></ul>
        </nav> 
      </div>
    </div>
  </div>
  <div class="col-lg page_info"></div>
</div>

<div class="row">
  <div class="col-lg-12 table-responsive">
    <table class="table table-bordered table-hover text-center">
    <thead class="thead-dark">
      <tr>
        <th scope="col" class="text-nowrap"><i class="fas fa-edit"></i></th>
        <th><i class="fas fa-trash-alt"></i></th>
        <th scope="col" class="text-nowrap">會員編號</th>
        <th scope="col" class="text-nowrap">姓名</th>
        <th scope="col" class="text-nowrap">暱稱</th>
        <th scope="col" class="text-nowrap">性別</th>
        <th scope="col" class="text-nowrap">年齡</th>
        <th scope="col" class="text-nowrap">生日</th>
        <th scope="col" class="text-nowrap">email(*帳號)</th>
        <th scope="col" class="text-nowrap">手機</th>
        <th scope="col" class="text-nowrap">電影喜好類型</th>
        <th scope="col" class="text-nowrap">頭像</th>
        <th scope="col" class="text-nowrap">入會日期</th>
        <th scope="col" class="text-nowrap">密碼</th>
        <th scope="col" class="text-nowrap">密碼修改日期</th>
        <th scope="col" class="text-nowrap">密碼錯誤次數</th>
        <th scope="col" class="text-nowrap">最近登入日期</th>
        <th scope="col" class="text-nowrap">登入次數</th>
        <th scope="col" class="text-nowrap">排名</th>
        <th scope="col" class="text-nowrap">權限</th>
      </tr>
    </thead>
    <tbody id="data_body">

    </tbody>
    </table>
  </div>
</div>
</section>
<script>
let ori_data;
const ul_pagi = document.querySelector('#page_list');
const data_body = document.querySelector('#data_body');
const pre_page = document.querySelector('#pre_page');
const next_page = document.querySelector('#next_page');
const first_page = document.querySelector('#first_page');
const end_page = document.querySelector('#end_page');
const data_info = document.querySelector('.data_info');
const page_info = document.querySelector('.page_info');


//使用underscore.js的template字串
const tr_str = `<tr>
          <th scope="row">
            <a href="Su_member_edit.php?sid=<%= sid %>"> <i class="fas fa-edit"></i></a>
          </th>
          <td>
                <a href="javascript: delete_it(<%= sid %>)">
                <i class="text-danger fas fa-trash-alt"></i>
                </a>
          </td>
          <th scope="row"><%= sid %></th>
          <td class="text-nowrap"><%= name %></td>
          <td><%= nickname %></td>
          <td><%= gender %></td>
          <td><%= age %></td>
          <td class="text-nowrap"><%= birthday %></td>
          <td><%= email %></td>
          <td class="text-nowrap"><%= mobile %></td>
          <td><%= fav_type %></td>
          <td><img src="../pic/avatar/<%= avatar %>" alt="" width="100"></td>
          <td><%= join_date %></td>
          <td><%= pwd %></td>
          <td><%= pwd_change_d %></td>
          <td><%= pwd_err_c %></td>
          <td><%= last_login_d %></td>
          <td><%= login_c %></td>
          <td><%= rank %></td>
          <td><%= permission %></td>
          </tr>`;
const tr_function = _.template(tr_str);


const page_str = `<li class="page-item  <%= active %>" style="visibility:<%= v %>">
                  <a class="page-link" href="#<%= page %>"><%= page %></a></li>`;
const page_function = _.template(page_str);

function delete_it(sid){
  if(confirm(`確定要刪除編號為${sid}的資料嗎?`)){
    location.href= 'Su_member_list_delete.php?sid='+sid;
  }
}



const myHashChange = () =>{
    let h = location.hash.slice(1);
    page = parseInt(h);
    if(isNaN(page)){
        page = 1;
    }


    fetch("Su_member_list_api.php?page="+page)
    .then(res=>{
        return res.json();
    })
    .then(json=>{
        ori_data = json;
        console.log(ori_data);


        //製作資料表格
        let str = '';
        for(let s in ori_data.data){
          str += tr_function(ori_data.data[s]);
          console.log(ori_data.data[s]);
        };
        data_body.innerHTML = str;

 
        //製作頁碼按鈕
        p_btn_num=7;//設定可顯示幾個頁碼按鈕(需使用奇數)
        str = '';
        for(let i=-parseInt(p_btn_num/2); i<=parseInt(p_btn_num/2); i++){
          let active = i=== 0 ? 'active': '';
          let vh='';
          if(parseInt(ori_data.page)+i<=0 || parseInt(ori_data.page)+i>parseInt(ori_data.totalPage)){
              vh = 'hidden';
          }
          str += page_function({
            active:active,
            v:vh,
            page:ori_data.page+i,
          });
        } 
        ul_pagi.innerHTML = str;


        if(page <= 1){
          first_page.innerHTML=`<li class="page-item disabled"><a class="page-link" href="#1">&lt;&lt;</a></li>`
        }else{
          first_page.innerHTML=`<li class="page-item"><a class="page-link" href="#1" title="回到第一頁">&lt;&lt;</a></li>`
        }
        if(page <= 1){
          pre_page.innerHTML=`<li class="page-item disabled"><a class="page-link" href="?page=${page-1}">&lt;</a></li>`
        }else{
          pre_page.innerHTML=`<li class="page-item"><a class="page-link" href="#${page-1}" title="前一頁">&lt;</a></li>`
        }
        if(page >= ori_data.totalPage){
          next_page.innerHTML=`<li class="page-item disabled"><a class="page-link" href="?page=${page-1}">&gt;</a></li>`
        }else{
          next_page.innerHTML=`<li class="page-item"><a class="page-link" href="#${page+1}"  title="下一頁">&gt;</a></li>`
        }
        if(page >= ori_data.totalPage){
          end_page.innerHTML=`<li class="page-item disabled"><a class="page-link" href="#${ori_data.totalPage}">&gt;&gt;</a></li>`
        }else{
          end_page.innerHTML=`<li class="page-item"><a class="page-link" href="#${ori_data.totalPage}" title="跳到最末頁">&gt;&gt;</a></li>`
        }


        //資料筆數、頁數資訊
        if(page>=ori_data.totalPage){
          data_info.innerHTML=`
          <div class="col-lg-5">總資料筆數：${ori_data.totalRows} 筆</div>
          <div class="col-lg-7">本頁資料：第${(ori_data.totalPage-1)*ori_data.dperPage+1} ~ ${ori_data.totalRows} 筆</div>`
          page_info.innerHTML=`
          <div class="text-right">頁數：${ori_data.totalPage}  /  ${ori_data.totalPage}</div>`
        }else if(page<1){
          data_info.innerHTML=`
          <div class="col-lg-5">總資料筆數：${ori_data.totalRows} 筆</div>
          <div class="col-lg-7">本頁資料：第1 ~ ${ori_data.dperPage} 筆</div>`
          page_info.innerHTML=`
          <div class="text-right">頁數：1 / ${ori_data.totalPage}</div>`
        }else{
          data_info.innerHTML=`
          <div class="col-lg-5">總資料筆數：${ori_data.totalRows} 筆</div>
          <div class="col-lg-7">本頁資料：第${(page-1)*ori_data.dperPage+1 } ~ ${page*ori_data.dperPage} 筆</div>`
          page_info.innerHTML=`
          <div class="text-right">頁數：${page} / ${ori_data.totalPage}</div>`
        }
    });
};

window.addEventListener('hashchange',myHashChange);
myHashChange();

</script>
<?php include __DIR__.'/foot.php' ?>