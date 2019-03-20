<?php
#頁面名稱
$pagename = "film_data_list";

include __DIR__.'/PDO.php';
include __DIR__.'./head.php';
include __DIR__.'./nav.php';
include __DIR__.'./film_sidenav.php';

?>
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


    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><i class="fas fa-edit"></i></th>
                <th scope="col"><i class="fas fa-trash-alt"></i></th>
                <th scope="col">#</th>
                <th scope="col">name_tw</th>
                <th scope="col">name_en</th>
                <th scope="col">intro_tw</th>
                <th scope="col">intro_en</th>
                <th scope="col">movie_pic</th>
                <th scope="col">movie_genre</th>
                <th scope="col">movie_ver</th>
                <th scope="col">movie_rating</th>
                <th scope="col">trailer</th>
                <th scope="col">pirce</th>
                <th scope="col">schedule</th>
                <th scope="col">in_theaters</th>
                <th scope="col">out_theaters</th>
                <th scope="col">runtime</th>
                <th scope="col">director_tw</th>
                <th scope="col">director_en</th>
                <th scope="col">country</th>
                <th scope="col">subtitle</th>
                <th scope="col">subtitle_lang</th>
            </tr>
        </thead>
        <tbody id="data_body">

        </tbody>
    </table>

    <!-- </div> -->
</section>

<script>
    let page = 1;
    let ori_data;

    const data_page = document.querySelector('.pagination');
    const page_list = document.querySelector('#page_list');
    const data_body = document.querySelector('#data_body');

    const pre_page = document.querySelector('#pre_page');
    const next_page = document.querySelector('#next_page');
    const first_page = document.querySelector('#first_page');
    const end_page = document.querySelector('#end_page');
    const data_info = document.querySelector('.data_info');
    const page_info = document.querySelector('.page_info');

    //用underscore.js的template字串
    const tr_str = `
            <tr>
                <td>
                    <a href="film_data_edit.php?sid=<%= sid%>"><i class="fas fa-edit"></i></a>
                </td>
                <td>
                    <a href="javascript:checkDelete(<%= sid%>)"><i class="fas fa-trash-alt"></i></a>
                </td>
                <td><%= sid %></td>
                <td><%= name_tw %></td>
                <td><%= name_en %></td>
                <td><%= intro_tw %></td>
                <td><%= intro_en %></td>
                <td><%= movie_pic %></td>
                <td><%= movie_genre %></td>
                <td><%= movie_ver %></td>
                <td><%= movie_rating %></td>
                <td><%= trailer %></td>
                <td><%= pirce %></td>
                <td><%= schedule %></td>
                <td><%= in_theaters %></td>
                <td><%= out_theaters %></td>
                <td><%= runtime %></td>
                <td><%= director_tw %></td>
                <td><%= director_en %></td>
                <td><%= country %></td>
                <td><%= subtitle %></td>
                <td><%= subtitle_lang %></td>

            </tr>
            `;
    const tr_func = _.template(tr_str);

    const page_str = `<li class="page-item  <%= active %>" style="visibility:<%= v %>">
                        <a class="page-link" href="#<%= page %>"><%= page %></a>
                    </li>`;

    const page_func = _.template(page_str);

    const myHashChange = () => {
        let h = location.hash.slice(1);
        page = parseInt(h);
        if (isNaN(page)) {
            page = 1;
        }
        // data_page.innerHTML = page;


        fetch('film_data_list-api.php?page=' + page)
            .then(res => res.json())
            .then(json => {
                ori_data = json;
                console.log(ori_data);

                // 資料內容的表格
                // let str = '';
                // for (let s in ori_data.data) {
                //     str += tr_func(ori_data.data[s]);
                // }
                // data_body.innerHTML = str;
                let str = '';
                for (let v of ori_data.data) {
                    str += tr_func(v);
                    // console.log(v);
                }

                data_body.innerHTML = str;

                str = '';
                for (let i = 1; i <= ori_data.totalPages; i++) {
                    let active = ori_data.page === i ? 'active' : '';

                    str += pagi_func({
                        active: active,
                        page: i
                    });
                }
                data_page.innerHTML = str;


                //製作頁碼按鈕
                p_btn_num = 7;//設定可顯示幾個頁碼按鈕(建議使用奇數)
                str = '';
                for (let i =-parseInt(p_btn_num/2); i<=parseInt(p_btn_num/2); i++) {
                    let active = i === 0 ? 'active' : '';
                    let vh = '';
                    if (parseInt(ori_data.page)+i<=0 || parseInt(ori_data.page) + i > parseInt(ori_data.tol_page)) {
                        vh = 'hidden';
                    }
                    str += page_func({
                        active: active,
                        v:vh,
                        page: ori_data.page+i,
                    });
                }
                page_list.innerHTML = str;


                if (page <= 1) {
                    first_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="#1">&lt;&lt;</a></li>`
                } else {
                    first_page.innerHTML = `<li class="page-item"><a class="page-link" href="#1" title="回到第一頁">&lt;&lt;</a></li>`
                }
                if (page <= 1) {
                    pre_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="?page=${page - 1}">&lt;</a></li>`
                } else {
                    pre_page.innerHTML = `<li class="page-item"><a class="page-link" href="#${page - 1}" title="前一頁">&lt;</a></li>`
                }
                if (page >= ori_data.tol_page) {
                    next_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="?page=${page - 1}">&gt;</a></li>`
                } else {
                    next_page.innerHTML = `<li class="page-item"><a class="page-link" href="#${page + 1}"  title="下一頁">&gt;</a></li>`
                }
                if (page >= ori_data.tol_page) {
                    end_page.innerHTML = `<li class="page-item disabled"><a class="page-link" href="#${ori_data.tol_page}">&gt;&gt;</a></li>`
                } else {
                    end_page.innerHTML = `<li class="page-item"><a class="page-link" href="#${ori_data.tol_page}" title="跳到最末頁">&gt;&gt;</a></li>`
                }


                //資料筆數、頁數資訊
                if (page >= ori_data.tol_page) {
                    data_info.innerHTML = `
                        <div class="col-lg-5">總資料筆數：${ori_data.row_count} 筆</div>
                        <div class="col-lg-7">本頁資料：第${(ori_data.tol_page - 1) * ori_data.per_page + 1} ~ ${ori_data.row_count} 筆</div>`
                    page_info.innerHTML = `
                        <div class="text-right">頁數：${ori_data.tol_page}  /  ${ori_data.tol_page}</div>`
                } else if (page < 1) {
                    data_info.innerHTML = `
                        <div class="col-lg-5">總資料筆數：${ori_data.row_count} 筆</div>
                        <div class="col-lg-7">本頁資料：第1 ~ ${ori_data.per_page} 筆</div>`
                    page_info.innerHTML = `
                        <div class="text-right">頁數：1 / ${ori_data.tol_page}</div>`
                } else {
                    data_info.innerHTML = `
                        <div class="col-lg-5">總資料筆數：${ori_data.row_count} 筆</div>
                        <div class="col-lg-7">本頁資料：第${(page - 1) * ori_data.per_page + 1} ~ ${page * ori_data.per_page} 筆</div>`
                    page_info.innerHTML = `
                        <div class="text-right">頁數：${page} / ${ori_data.tol_page}</div>`
                }


            });
    };

    //按delete時先跳出確認視窗後再刪除
    const checkDelete = (sid) => {

        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`) == true) {
            location.href = 'film_data_delete.php?sid=' + sid;
        } else {
            alert("無資料被刪除");
        }
    }




    window.addEventListener('hashchange', myHashChange);
    myHashChange();

</script>

<?php include __DIR__.'./foot.php'?>