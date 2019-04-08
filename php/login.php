<?php
include __DIR__.'/PDO.php';

$user = '';
$password = '';

if(isset($_POST['user']) and isset($_POST['password'])){

    $user = $_POST['user'];
    $password = $_POST['password'];


    //Admin方登入
    $sql = "SELECT * FROM `admins` WHERE `admin_id`=? AND `password`=SHA1(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $user,
        $password,
    ]);
    if($stmt->rowCount()==1) {
        $_SESSION['admin'] = $user;

        header('Location: ./mainpage.php');
        exit;
    }
    
    //member方登入
    $m_sql = "SELECT * FROM `member` WHERE `email`=? AND `pwd`=?";
    $m_stmt = $pdo->prepare($m_sql);
    $m_stmt->execute([
        $user,
        $password,
    ]);
    if($m_stmt->rowCount()==1) {
        $_SESSION['member'] = $user;

        header('Location: ./mainpage.php');
        exit;
    }
    
    //cinema
    $c_sql = "SELECT * FROM `cinema` WHERE `account`=? AND `password`=?";
    $c_stmt = $pdo->prepare($c_sql);
    $c_stmt->execute([
        $user,
        $password,
    ]);
    if($c_stmt->rowCount()==1) {
        $_SESSION['theater'] = $user;




        header('Location: ./mainpage.php');
        exit;
    }

    $msg = '帳號或密碼錯誤';
 

}

?>
<?php include __DIR__.'/head.php'?>
<style>
    html,body{
        height:100%;
        
    }
    
</style>
<section style="height:100%">
    <div class="container d-flex justify-content-center align-items-center" style="height:100%;">
        <?php if(! isset($_SESSION['admin'])  || isset($_SESSION['member']) ||  isset($_SESSION['theater'])  ): ?>
            <?php if(isset($msg)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $msg ?>
                </div>
            <?php endif ?>
            <form method="post" class="p-4" style="border-radius:5px;background:rgba(0,0,0,0.6)">
                <h1 class="mb-3" style="color:white;font-weight:bold;font-family:'Noto Sans TC';border-radius:5px;">.Movieee後台管理登入</h1>
                <div class="form-group">
                    <input type="text" class="form-control text-center" name="user" placeholder="帳號" value="<?= $user ?>" style="font-family:'Noto Sans TC'">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control text-center" name="password" placeholder="密碼" value="<?= $password ?>" style="font-family:'Noto Sans TC'">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-dark" style="background:black;border:1px solid white;font-family:'Noto Sans TC'">登入</button>
                </div>
            </form>
        <?php else: ?>
            <script>
                location.href = './mainpage.php';
            </script>
        <?php endif; ?>
    </div>
</section>
<script>
    $("body").vegas({
    slides: [
        { src: "https://images.unsplash.com/photo-1440404653325-ab127d49abc1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
        { src: "https://images.unsplash.com/photo-1424223022789-26fd8f34bba2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" },
        { src: "https://images.unsplash.com/photo-1532800783378-1bed60adaf58?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" },
        { src: "https://images.unsplash.com/photo-1460881680858-30d872d5b530?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80" },
        { src: "https://images.unsplash.com/photo-1520904541532-f47ac41fec59?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" },
        { src: "https://images.unsplash.com/photo-1520904541532-f47ac41fec59?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" },
    ],
    timer: false,
    delay: 3500,
    overlay: '../vegas/overlays/02.png'
});
</script>
<?php include __DIR__.'/foot.php'?>