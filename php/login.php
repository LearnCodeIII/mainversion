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
        $_SESSION['theater'] = 




        header('Location: ./mainpage.php');
        exit;
    }

    $msg = '帳號或密碼錯誤';
 

}

?>
<?php include __DIR__.'/head.php'?>
<?php include __DIR__.'/loginnav.php'?>
<?php include __DIR__.'./sidenav.php'?>
<section class="dashboard">
    <div class="container">
        <?php if(! isset($_SESSION['admin'])  || isset($_SESSION['member']) ||  isset($_SESSION['theater'])  ): ?>
            <?php if(isset($msg)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $msg ?>
                </div>
            <?php endif ?>
            <form method="post">
                <h1 class="mb-3">.Movieee後台管理登入</h1>
                <div class="form-group">
                    <input type="text" class="form-control" name="user" placeholder="帳號" value="<?= $user ?>">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="密碼" value="<?= $password ?>">
                    <small >提示：請洽詢管理員</small>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php else: ?>
            <script>
                location.href = './mainpage.php';
            </script>
        <?php endif; ?>
    </div>
</section>
<?php include __DIR__.'/foot.php'?>