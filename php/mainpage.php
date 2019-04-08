<?php


include __DIR__.'/PDO.php';



?>
<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./sidenav.php'?>
<style>
html,body{
    overflow:hidden;
    height:100%;
    font-family:Verdana;
    font-weight:bolder;
}
.accordion{
    z-index:99;
}
.fullpage{
    position:relative;
    z-index:0;
    width:100%;
    height:100%;
    top:0;
    left:240px;
    right:0;
    background:black;
}
.board1{
    position:absolute;
    top:0;
    left:0;
    width:20%;
    height:50%;
    z-index:99;
}
.board2{
    position:absolute;
    top:-50%;
    left:20%;
    width:80%;
    height:20%;
    z-index:99;
}
.board3{
    position:absolute;
    top:-20%;
    left:0;
    width:50%;
    height:50%;
    z-index:99;
}
.board4{
    position:absolute;
    top:-100%;
    left:50%;
    width:50%;
    height:80%;
    z-index:99;
}
.board5{
    position:absolute;
    top:20%;
    left:20%;
    width:30%;
    height:30%;
    transition:0.5s;
    z-index:0;
}
</style>
<section class="fullpage">
    <div class="board1"></div>
    <div class="board2"></div>
    <div class="board3"></div>
    <div class="board4"></div>
    <div class="board5 p-2 px-3 d-flex justify-content-center align-items-center dashboardLogo flex-column">
        <h1 style="color:white" class="dashboardLogoContent">.Moiveee</h1>
        <p style="color:white" class="dashboardLogoContents dashboardLogoContent2">.Everything</p>
        <p style="color:white" class="dashboardLogoContents dashboardLogoContent3">.Everyday</p>
        <p style="color:white" class="dashboardLogoContents dashboardLogoContent4">.Everynight</p>
        <span style="color:white" class="dashboardLogoContents dashboardLogoContent5">.找製作團隊?</span>
        <span style="color:white" class="dashboardLogoContents dashboardLogoContent6" onclick="javascript:window.location ='http://192.168.27.179/mainversion/mainversion/php/work.php'">Trivago!</span>

    </div>
</section>
<script>
    $('.dashboardLogoContents').css({
            "color":"black"
        });
    $('.dashboardLogoContents').animate({
            "textIndent":"800px"
        });
    let secret=0;
    $('.dashboardLogo').on("mouseover",function(){
        $('.dashboardLogoContent').animate({
            "fontSize":"4rem"
        });
        $('.dashboardLogoContents').css({
            "color":"white"
        });
        $('.dashboardLogoContent2').animate({
            "textIndent":""
        },1500);
        $('.dashboardLogoContent3').animate({
            "textIndent":""
        },1800);
        $('.dashboardLogoContent4').animate({
            "textIndent":""
        },2200);
        if(secret>10){
            $('.dashboardLogoContent5').animate({
                "textIndent":""
            },1000);
        }
        if(secret>20){
            $('.dashboardLogoContent6').animate({
                "textIndent":""
            },1000);
        }

        secret+=1;
        console.log(secret)
    })



    $(".board1").vegas({
        slides: [
            { src: "https://images.unsplash.com/photo-1440404653325-ab127d49abc1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
            { src: "https://images.unsplash.com/photo-1424223022789-26fd8f34bba2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" },
            { src: "https://images.unsplash.com/photo-1532800783378-1bed60adaf58?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
            { src: "https://images.unsplash.com/photo-1460881680858-30d872d5b530?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80" },
            { src: "https://images.unsplash.com/photo-1520904541532-f47ac41fec59?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" },

        ],
        timer: false,
        delay: 3500,
        overlay: '../vegas/overlays/02.png'
    });
    $(".board2").vegas({
        slides: [
            { src: "https://images.unsplash.com/photo-1424223022789-26fd8f34bba2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" },
            { src: "https://images.unsplash.com/photo-1532800783378-1bed60adaf58?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
            { src: "https://images.unsplash.com/photo-1460881680858-30d872d5b530?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80" },
            { src: "https://images.unsplash.com/photo-1520904541532-f47ac41fec59?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" },

            { src: "https://images.unsplash.com/photo-1440404653325-ab127d49abc1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
        ],
        timer: false,
        delay: 3500,
        overlay: '../vegas/overlays/02.png'
    });
    $(".board3").vegas({
        slides: [

            { src: "https://images.unsplash.com/photo-1532800783378-1bed60adaf58?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
            { src: "https://images.unsplash.com/photo-1460881680858-30d872d5b530?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80" },
            { src: "https://images.unsplash.com/photo-1520904541532-f47ac41fec59?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" },

            { src: "https://images.unsplash.com/photo-1440404653325-ab127d49abc1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
            { src: "https://images.unsplash.com/photo-1424223022789-26fd8f34bba2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" },
        ],
        timer: false,
        delay: 3500,
        overlay: '../vegas/overlays/02.png'
    });
    $(".board4").vegas({
        slides: [

            { src: "https://images.unsplash.com/photo-1460881680858-30d872d5b530?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80" },
            { src: "https://images.unsplash.com/photo-1520904541532-f47ac41fec59?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" },

            { src: "https://images.unsplash.com/photo-1440404653325-ab127d49abc1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
            { src: "https://images.unsplash.com/photo-1424223022789-26fd8f34bba2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" },
            { src: "https://images.unsplash.com/photo-1532800783378-1bed60adaf58?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
        ],
        timer: false,
        delay: 3500,
        overlay: '../vegas/overlays/02.png'
    });
    // $(".board5").vegas({
    //     slides: [

    //         { src: "https://images.unsplash.com/photo-1520904541532-f47ac41fec59?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" },
    //         { src: "https://images.unsplash.com/photo-1440404653325-ab127d49abc1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
    //         { src: "https://images.unsplash.com/photo-1424223022789-26fd8f34bba2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" },
    //         { src: "https://images.unsplash.com/photo-1532800783378-1bed60adaf58?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
    //         { src: "https://images.unsplash.com/photo-1460881680858-30d872d5b530?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80" },

    //     ],
    //     timer: false,
    //     delay: 3500,
    //     overlay: '../vegas/overlays/02.png'
    // });
</script>
<?php include __DIR__.'./foot.php'?>