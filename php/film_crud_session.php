<?php

if(! isset($_SESSION)){
    session_start();
}
elseif(! isset($_SESSION['admin'])){
    header('Location: ./mainpage.php');
    exit;
}
elseif(! isset($_SESSION['theater'])){
    header('Location: ./mainpage.php');
    exit;
}
elseif(! isset($_SESSION['member'])){
    header('Location: ./mainpage.php');
    exit;
}
else{
    echo '您無權限觀看此頁面!';

}
