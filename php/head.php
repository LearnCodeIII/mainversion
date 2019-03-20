<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>後台管理系統</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC:400,700" rel="stylesheet">
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/underscore.js"></script>
    <script src="../js/bs-custom-file-input.min.js"></script>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        html,body{
    background:#eee;
    font-family:'Noto Sans TC', sans-serif,Verdana, Geneva, Tahoma, sans-serif;
    }
    .navbar {
        position:fixed;
        top:0;
        left:0;
        right:0;
        z-index:99;
        background-color:rgb(39, 39, 39) !important;
    }
    .navbar-brand{
        font-weight: bold;
    }
    .sidenav {
        font-family : 'Noto Sans TC', sans-serif,Verdana, Geneva, Tahoma, sans-serif;
        background:rgb(39, 39, 39);
        width:100%;
        max-width:120px;
        position:fixed;
        top:56px;
        left:0;
        bottom:0;
        z-index:98;
        display:flex;
        justify-content: center;
        
    }
    .sidenav a {
        color:rgb(216, 216, 216);
    }
    .dashboard {
        position:absolute;
        top:56px;
        left:120px;
        right:0;
        padding:3rem;
    }

    </style>

</head>
<body>