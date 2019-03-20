<?php

$pagename = "film_main.php";

include __DIR__.'/PDO.php';
include __DIR__.'./head.php';
include __DIR__.'./nav.php';
include __DIR__.'./film_sidenav.php';

?>

<section class="dashboard">

<!-- <div class="container"> -->
    <?php /*
    <div class="">資料共<?= $row_count ?>筆</div>
<div class="">本頁共<?= $stamt->rowCount() ?>筆</div>
<div class="">頁數：<?= $page."/".$tol_page ?></div>
*/ ?>
<div class="row">
    <div class="col-lg-12">
        <nav aria-label="...">
            <ul class="pagination pagination-sm">

                <?php
                /*
                //設定上一頁
                    <li class="page-item <?= $page<=1?'disabled':''?>">
                <a class="page-link" href="?page=<?= $page-1 ?>">&lt</a>
                </li>

                //設定資料有多少就做幾頁
                <?php for ($i=1;$i<=$tol_page;$i++): ?>
                <li class="page-item <?= $i==$page?'active':''?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
                <?php endfor ?>

                //設定下一頁
                <li class="page-item <?= $page>=$tol_page?'disabled':''?>">
                    <a class="page-link" href="?page=<?= $page+1 ?>">&gt</a>
                </li>
                */
                ?>
            </ul>
        </nav>
    </div>
</div>




<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">電影中文名稱</th>
            <th scope="col">電影英文名稱</th>
            <!-- <th scope="col">intro_tw</th> -->
            <!-- <th scope="col">intro_en</th> -->
            <th scope="col">movie_pic</th>
            <th scope="col">movie_genre</th>
            <!-- <th scope="col">movie_ver</th> -->
            <!-- <th scope="col">movie_rating</th> -->
            <th scope="col">trailer</th>
            <th scope="col">pirce</th>
            <!-- <th scope="col">schedule</th> -->
            <th scope="col">in_theaters</th>
            <th scope="col">out_theaters</th>
            <th scope="col">runtime</th>
            <!-- <th scope="col">director_tw</th> -->
            <!-- <th scope="col">director_en</th> -->
            <!-- <th scope="col">country</th> -->
            <!-- <th scope="col">subtitle</th> -->
            <th scope="col">subtitle_lang</th>
        </tr>
    </thead>
    <tbody id="data_body">
        <?php /*
                <?php foreach ($rows as $row): ?>

        <tr>
            <td><?= $row['uid'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['selfphone'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['adress'] ?></td>
            <td><?= $row['facebook'] ?></td>
            <td><?= $row['IG'] ?></td>

        </tr>
        <?php endforeach; ?>
        */ ?>
    </tbody>
</table>

<!-- </div> -->

</section>
<script>
    let page = 1;
    let ori_data;

    const data_page = document.querySelector('.pagination');
    const data_body = document.querySelector('#data_body');

    const tr_str = `
            <tr>
                <td><%= sid %></td>
                <td><%= name_tw %></td>
                <td><%= name_en %></td>

                <td><%= movie_pic %></td>
                <td><%= movie_genre %></td>

                <td><%= trailer %></td>
                <td><%= pirce %></td>

                <td><%= in_theaters %></td>
                <td><%= out_theaters %></td>
                <td><%= runtime %></td>

                <td><%= subtitle_lang %></td>

            </tr>
            `;

            // const tr_str = `
            // <tr>
            //     <td><%= sid %></td>
            //     <td><%= name_tw %></td>
            //     <td><%= name_en %></td>
            //     <td><%= intro_tw %></td>
            //     <td><%= intro_en %></td>
            //     <td><%= movie_pic %></td>
            //     <td><%= movie_genre %></td>
            //     <td><%= movie_ver %></td>
            //     <td><%= movie_rating %></td>
            //     <td><%= trailer %></td>
            //     <td><%= pirce %></td>
            //     <td><%= schedule %></td>
            //     <td><%= in_theaters %></td>
            //     <td><%= out_theaters %></td>
            //     <td><%= runtime %></td>
            //     <td><%= director_tw %></td>
            //     <td><%= director_en %></td>
            //     <td><%= country %></td>
            //     <td><%= subtitle %></td>
            //     <td><%= subtitle_lang %></td>

            // </tr>
            // `;


    const tr_func = _.template(tr_str);

    const pagi_str = `<li class="page-item <%= active %>">
                        <a class="page-link" href="#<%= page %>"><%= page %></a>
                    </li>`;

    const pagi_func = _.template(pagi_str);

    const myHashChange = () => {
        let h = location.hash.slice(1);
        page = parseInt(h);
        if (isNaN(page)) {
            page = 1;
        }
        // data_page.innerHTML = page;


        fetch('film_data_list-api.php?page=' + page)
            .then(res =>res.json())
            .then(json => {
                ori_data = json;
                console.log(ori_data);

                //資料內容的表格
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

                str='';
                for(let i=1 ; i<=ori_data.totalPages ; i++){
                    let active = ori_data.page === i ? 'active' : '';

                    str += pagi_func({
                        active: active,
                        page: i
                    });
                }
                data_page.innerHTML = str;
                
            });
        };
        
        window.addEventListener('hashchange', myHashChange);
        myHashChange();

</script>

<?php include __DIR__.'./foot.php'?>