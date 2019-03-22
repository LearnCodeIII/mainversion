<?php

require __DIR__ . '/PDO.php';
$page_name = 'ann_ad_list';

?>

<?php include __DIR__ . '/head.php';?>
<?php include __DIR__ . '/nav.php';?>
<?php include __DIR__ . '/ann_side_nav.php'?>

<section class="dashboard">

    <div class="container">
        <!-- <div><?=$page . " / " . $total_pages?></div> -->
        <div class="row">
            <div class="col-lg-12">
                <nav>
                    <ul class="pagination pagination-sm">

                        <!-- <li class="page-item <?=$page <= 1 ? 'disabled' : ''?>">
                                <a class="page-link" href="?page=<?=$page - 1?>">&lt;</a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?=$i == $page ? 'active' : ''?>">
                                    <a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
                                </li>
                            <?php endfor?>
                            <li class="page-item <?=$page >= $total_pages ? 'disabled' : ''?>">
                                <a class="page-link" href="?page=<?=$page + 1?>">&gt;</a>
                            </li> -->

                    </ul>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">廣告名稱</th>
                            <th scope="col">廣告圖檔</th>
                            <th scope="col">廣告連結</th>
                            <th scope="col">點擊次數</th>
                            <th scope="col">廣告放送開始時間</th>
                            <th scope="col">廣告放送結束時間</th>
                        </tr>
                    </thead>

                    <tbody id="data_body">

                        <!-- <?php foreach ($rows as $row): ?>
                            <tr>
                                <td>
                                    <a href="_clientAnnDataEdit.php?sn=<?=$row['sn']?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td><?=$row['sn']?></td>
                                <td><?=$row['client_name']?></td>
                                <td><?=$row['client_number']?></td>
                                <td><?=strip_tags($row['client_address'])?></td>
                                <td><?=$row['client_poc']?></td>
                                <td><?=$row['client_mobile']?></td>
                                <td><?=$row['client_email']?></td>
                                <td><?=$row['contract_budget']?></td>
                                <td><?=$row['contract_start_date']?></td>
                                <td><?=$row['contract_end_date']?></td>
                                <td>
                                    <a href="javascript: delete_it(<?=$row['sn']?>)">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach;?> -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<script>
    let page = 1;
    let ori_data;
    const ul_pagi = document.querySelector('.pagination');
    const data_body = document.querySelector('#data_body');

    // 字串轉function
    // Template functions can interpolate values using <%= … %>
    const tr_str = `<tr>
                        <td><%= sn %></td>
                        <td><%= ad_name %></td>
                        <td><%= ad_pic %></td>
                        <td><%= ad_link %></td>
                        <td><%= ad_link_count %></td>
                        <td><%= ad_start_time %></td>
                        <td><%= ad_end_time %></td>
                    </tr>`;

    // underscore.js - _.template(templateString) compiles JavaScript templates into functions that can be evaluated for rendering. Useful for rendering complicated bits of HTML from JSON data sources.
    const tr_func = _.template(tr_str);

    const pagi_str = `<li class="page-item <%= active %>">
                        <a class="page-link" href="#<%= page %>">
                            <%= page %>
                        </a>
                      </li>`;
    const pagi_func = _.template(pagi_str);

    const myHashChange = () => {

        // string = object.hash - Returns the anchor part of a URL
        // str.slice(beginIndex[, endIndex]) - Extracts a section of a string and returns it as a new string
        let h = location.hash.slice(1);
        // parseInt(string) - Parses a string argument and returns an integer
        page = parseInt(h);
        // isNaN(value) - Determines whether a value is NaN or not
        if (isNaN(page)) {
            page = 1;
        };
        // ul_pagi.innerHTML = page;

        // To fetch data
        fetch('ann_ad_list_api.php?page=' + page)
            /* .then(res =>{
                return res.json();
            }) */
            .then(res => res.json())
            .then(json => {
                ori_data = json;
                console.log(ori_data);

                // 資料內容的表格
                let str = '';
                /* for(let s in ori_data){
                    str += tr_func(ori_data.data[s]);
                }
                data_body.innerHTML = str;
                */
                for (let v of ori_data.data) {
                    str += tr_func(v);
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
                ul_pagi.innerHTML = str;

            });
    };

    window.addEventListener('hashchange', myHashChange);
    myHashChange();
    // function delete_it(sn) {
    //     if (confirm ("確定要刪除編號為" + sn + "的資料嗎?")) {
    //         location.href = '_clientAnnDataDelete.php?sn=' + sn;
    //     }
    // }
</script>

<?php include __DIR__ . '/foot.php';?>