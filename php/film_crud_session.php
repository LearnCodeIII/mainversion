<?php
if(! isset($_SESSION)){
    session_start();

    if(isset($_SESSION['admin'])){
        header("Location: ./$pagename.php");
    }
    else{
        echo '您無權限觀看此頁面!';
        header("Location: ./login.php");
        exit;
    }
}

