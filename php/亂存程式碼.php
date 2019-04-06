<script>


//1-----------------------------------------------------
// => 直接下在 option中  用 " selected   "
// 用前端方式  如果data = 值  則在該element中下  " selected   "


/*function setOption(selectElement, value) {
        var options = selectElement.options;
        for (var i = 0; i < options.length; i++) {
            if (options[i].value == value) {
                selectElement.selectedIndex = i;
                return true;
            }
        }
        return false;
    }

    siteid.forEach(element => {
        setOption(
            ("select[name='']"),
            "")
        }); */

//不必上面這麼麻煩，直接寫死即可
document.querySelector('#movie_ver').value = '<?= $row['movie_ver'] ?>';
        document.querySelector('#movie_rating').value = '<?= $row['movie_rating'] ?>';
        document.querySelector('#subtitle').value = '<?= $row['subtitle'] ?>';
//1------------------------------------------------------

        </script>