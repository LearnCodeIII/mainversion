<?php
require __DIR__.'/PDO.php';
$pagename = "member";
$spname = 'member_search';
?>
<?php include __DIR__.'/head.php' ?>
<?php include __DIR__.'/nav.php' ?>
<?php include __DIR__.'./Su_sidenav.php'?>
<section class="dashboard">
<div class="alert alert-warning" role="alert">
 尚存BUG:(1)關鍵字搜尋，含有空值之欄位的資料不會被抓取(導致查無資料)
</div>
    <form name="form1"  method="post" action="" onsubmit="return checkForm()">
        <input type="hidden" name="" value="sid"> 
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <label class="sr-only" for="inlineFormInputName2">Name</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="keyword" name="keyword" placeholder="請填入關鍵字">
            </div>
            <div class="col-lg-1">
                <button id="submit_btn" type="submit" class="btn btn-primary mb-2">開始搜尋</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="all" name="all" onclick="check_all('chk[]',this)">
                    <label id="l_all" class="custom-control-label" for="all">全選</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="sid" name="chk[]" value="sid" >
                    <label name="sid" class="custom-control-label" for="sid">會員編號</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="name" name="chk[]" value="name" onclick="check(this,'all','chk[]')">
                    <label name="name" class="custom-control-label" for="name">姓名</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="nickname"  name="chk[]" value="nickname" onclick="check(this,'all','chk[]')">
                    <label name="nickname" class="custom-control-label" for="nickname">暱稱</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="gender" name="chk[]" value="gender" onclick="check(this,'all','chk[]')">
                    <label name="gender" class="custom-control-label" for="gender">性別</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="age" name="chk[]" value="age" onclick="check(this,'all','chk[]')">
                    <label name="age" class="custom-control-label" for="age">年齡</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="birthday" name="chk[]" value="birthday" onclick="check(this,'all','chk[]')">
                    <label name="birthday" class="custom-control-label" for="birthday">生日</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="email" name="chk[]" value="email" onclick="check(this,'all','chk[]')">
                    <label name="email" class="custom-control-label" for="email">email</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="mobile" name="chk[]" value="mobile" onclick="check(this,'all','chk[]')">
                    <label name="mobile" class="custom-control-label" for="mobile">手機</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="fav_type" name="chk[]" value="fav_type" onclick="check(this,'all','chk[]')">
                    <label name="fav_type" class="custom-control-label" for="fav_type">電影喜愛類型</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="avatar" name="chk[]" value="avatar" onclick="check(this,'all','chk[]')">
                    <label name="avatar" class="custom-control-label" for="avatar">頭像</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="join_date" name="chk[]" value="join_date" onclick="check(this,'all','chk[]')">
                    <label name="join_date" class="custom-control-label" for="join_date">入會日期</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="pwd" name="chk[]" value="pwd" onclick="check(this,'all','chk[]')">
                    <label name="pwd" class="custom-control-label" for="pwd">密碼</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="pwd_change_d" name="chk[]" value="pwd_change_d" onclick="check(this,'all','chk[]')">
                    <label name="pwd_change_d" class="custom-control-label" for="pwd_change_d">密碼修改日期</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="pwd_err_c" name="chk[]" value="pwd_err_c" onclick="check(this,'all','chk[]')">
                    <label name="pwd_err_c" class="custom-control-label" for="pwd_err_c">密碼錯誤次數</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="last_login_d" name="chk[]" value="last_login_d" onclick="check(this,'all','chk[]')">
                    <label name="last_login_d" class="custom-control-label" for="last_login_d">最近登入日期</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="login_c" name="chk[]" value="login_c" onclick="check(this,'all','chk[]')">
                    <label name="login_c" class="custom-control-label" for="login_c">登入次數</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="rank" name="chk[]" value="rank" onclick="check(this,'all','chk[]')">
                    <label name="rank" class="custom-control-label" for="rank">排名</label>
                </div>
                <div class="col-lg-2 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="permission" name="chk[]" value="permission" onclick="check(this,'all','chk[]')">
                    <label name="permission" class="custom-control-label" for="permission">權限</label>
                </div>
            </div>
        </div>
    </form>
    

<div class="row info justify-content-center"></div>
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
      <tr id="title">

      </tr>
    </thead>
    <tbody id="data_body"></tbody>
    </table>
  </div>
</div>
</section>
<script>
let page = 1;
let ori_data;
const ul_pagi = document.querySelector('#page_list');
const data_body = document.querySelector('#data_body');
const pre_page = document.querySelector('#pre_page');
const next_page = document.querySelector('#next_page');
const first_page = document.querySelector('#first_page');
const end_page = document.querySelector('#end_page');
const data_info = document.querySelector('.data_info');
const page_info = document.querySelector('.page_info');
const submit_btn = document.querySelector('#submit_btn');
const title = document.querySelector('#title');
const info = document.querySelector('.info');



// const fields = [
//     'sid',
//     'name',
//     'nickname',
//     'gender',
//     'age',
//     'birthday',
//     'email',
//     'mobile',
//     'fav_type',
//     'avatar',
//     'join_date',
//     'pwd',
//     'pwd_change_d',
//     'pwd_err_c',
//     'last_login_d',
//     'login_c',
//     'rank',
//     'permission'
//     ];
//拿到每個欄位參照
// const fs={};
// for(let v of fields){
//     fs[v] = document.form1[v];
// };
// console.log(fs);


//使用underscore.js的template功能
//先建立template字串 
const page_str = `
                  <li class="page-item  <%= active %>" style="visibility:<%= v %>">
                  <a class="page-link" href="#<%= page %>"><%= page %></a></li>
                 `;
const page_function = _.template(page_str);
document.getElementById('all').checked = false;


//全選
function check_all(cName,obj){ 
    var checkboxs = document.getElementsByName(cName); 
    for(var i=0 ; i<checkboxs.length ; i++){
      checkboxs[i].checked = obj.checked;
    }
} 


function check(obj,chkall,cName){
  if(obj.checked == false){
    document.getElementById(chkall).checked = false;
  }else{
    let checkItem = document.getElementsByName(cName).length;
    let ci = 0;
    for(let i=0 ; i< checkItem  ; i++){
      if(document.getElementsByName(cName)[i].checked == true){
        ci ++;
      }
    }
    if(ci == checkItem){
      document.getElementById(chkall).checked = true;
    }
  }
}

//刪除資料
function delete_it(sid){
  if(confirm(`確定要刪除編號為${sid}的資料嗎?`)){
    location.href= 'Su_member_list_delete.php?sid='+sid;
  }
}




const checkForm = ()=>{

    submit_btn.style.display='none';//按下提交後，按鈕消失(當資料處理結束才再設定顯示)
    info.innerHTML ="";
    title.innerHTML="";
    data_body.innerHTML =""; 
    ul_pagi.innerHTML = "";
    data_info.innerHTML = "";
    page_info.innerHTML = "";
    first_page.innerHTML = "";
    pre_page.innerHTML = "";
    next_page.innerHTML = "";
    end_page.innerHTML = "";

        let form = new FormData(document.form1);

        fetch("Su_member_search_api.php?page="+page,{
            method:'POST',
            body:form
        })
        .then(res=>{
        return res.json();
        })
        .then(json=>{
            ori_data = json;
            // console.log(ori_data);//得到api中的result陣列
        
        if(ori_data.success==false){
          console.log(ori_data);
          info.innerHTML =`<div class="alert alert-danger col-lg-4 text-center my-5" role="alert"> ${ori_data.errorMsg} </div>`;
        }else{

        //取得勾選的欄位
        const temp_title = [];//存放取得結果
         function printObject(obj){
          obj = ori_data.data[0];
          for(var i in obj){
            temp_title.push(i);
          }
          console.log(temp_title)
        };
        printObject();
        let column_num = temp_title.length;
        let title_index = column_num-1;
        let str="";
        let input_label = document.getElementsByTagName('label');
        title.innerHTML = `<th scope="row"><i class="fas fa-edit"></i></th>
                            <th><i class="fas fa-trash-alt"></i></th>`

        for(let i = 0 ; i<=title_index ; i++){
          title.innerHTML +=`<th scope="col" class="text-nowrap">${input_label[temp_title[i]].innerText}</th>`
        }



        //製作資料表格
        data_body.innerHTML =""; 
        for(let s in ori_data.data){//用for in拿取ori_data(result陣列)中'data'的值
          str = '';
          str +=`<th scope="row">
                    <a href="Su_member_edit.php?sid=${ori_data.data[s][temp_title[0]]}">
                      <i class="fas fa-edit"></i>
                    </a>
                  </th>
                  <td>
                    <a href="javascript: delete_it(${ori_data.data[s][temp_title[0]]})">
                    <i class="text-danger fas fa-trash-alt"></i>
                    </a>
                </td>`;
          for(let i = 0 ; i < column_num ; i++){
            if(temp_title[i]=='avatar'){
              str +=  `<td>
                        <img src="../pic/avatar/${ori_data.data[s][temp_title[i]]}" alt="" width="100">
                      </td>`
            }else{
              str += `<td>${ori_data.data[s][temp_title[i]]}</td>`
            }

          }
          data_body.innerHTML += '<tr>'+ str +'</tr>';
        };



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


        // //資料筆數、頁數資訊
        // data_info.innerHTML=`
        //   <div class="col-lg-5">總資料筆數：${ori_data.totalRows} 筆</div>
        //   <div class="col-lg-7">本頁資料：第${page>ori_data.totalPage ? (ori_data.totalPage-1)*ori_data.dperPage+1 : (page-1)*ori_data.dperPage+1 } ~ ${page*ori_data.dperPage>ori_data.totalRows ? ori_data.totalRows : page*ori_data.dperPage} 筆</div>`
        // page_info.innerHTML=`
        //   <div class="text-right">頁數：${page>ori_data.totalPage ? ori_data.totalPage : page} /  ${ori_data.totalPage}</div>`


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




      }
        submit_btn.style.display='block';
      
        });
    return false;
  }  






const myHashChange = () =>{
    let h = location.hash.slice(1);
    page = parseInt(h);
    if(isNaN(page)){
        page = 1;
    }

    
    let form = new FormData(document.form1);
    fetch("Su_member_search_api.php?page="+page,{
            method:'POST',
            body:form
        })
    .then(res=>{
        return res.json();
    })
    .then(json=>{
        ori_data = json;
        // console.log(ori_data);//得到api中的result陣列


        //取得勾選的欄位
        const temp_title = [];//存放取得結果
         function printObject(obj){
          obj = ori_data.data[0];
          for(var i in obj){
            temp_title.push(i);
          }
          console.log(temp_title)
        };
        printObject();
        
        let column_num = temp_title.length;
        let title_index = column_num-1;
        let str="";
        let input_label = document.getElementsByTagName('label');
        title.innerHTML="";
        title.innerHTML = `<th scope="row"><i class="fas fa-edit"></i></th>
                            <th><i class="fas fa-trash-alt"></i></th>`
        for(let i = 0 ; i<=title_index ; i++){
          title.innerHTML +=`<th scope="col" class="text-nowrap">${input_label[temp_title[i]].innerText}</th>`
        }

        
        //製作資料表格
        data_body.innerHTML =""; 
        for(let s in ori_data.data){//用for in拿取ori_data(result陣列)中'data'的值
          str = '';
          str +=`<th scope="row">
                    <a href="Su_member_edit.php?sid=${ori_data.data[s][temp_title[0]]}">
                      <i class="fas fa-edit"></i>
                    </a>
                  </th>
                  <td>
                    <a href="javascript: delete_it(${ori_data.data[s][temp_title[0]]})">
                    <i class="text-danger fas fa-trash-alt"></i>
                    </a>
                </td>`;
          for(let i = 0 ; i < column_num ; i++){
            if(temp_title[i]=='avatar'){
              str +=  `<td>
                        <img src="../pic/avatar/${ori_data.data[s][temp_title[i]]}" alt="" width="100">
                      </td>`
            }else{
              str += `<td>${ori_data.data[s][temp_title[i]]}</td>`
            }

          }
          data_body.innerHTML += '<tr>'+ str +'</tr>';
        };


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
// myHashChange();

</script>
<?php include __DIR__.'/foot.php' ?>