<?php
include __DIR__.'/PDO.php';

header("Content-type:application/json");

$result = [
    'success'=>false,
    'code'=>0,
    'msg'=>'未輸入任何資料',
    'post'=>[]
];

$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;

if(isset($_POST['name'])){


    $name=$_POST['name'];
	$content=$_POST['content'];
	$dateStart=$_POST['dateStart'];
	$dateEnd=$_POST['dateEnd'];
    $company=$_POST['company'];
    $contenttype=implode($_POST['contenttype']);

    $result['post']=$_POST;




    $sql = "UPDATE `activity` SET 
        `name`=?,
        `content`=?,
        `dateStart`=?,
        `dateEnd`=?,
        `company`=?,
        `contenttype`=?,
        `picture`=?,
        `region`=?
        WHERE `sid`=?";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['name'],
            $_POST['content'],
            $_POST['dateStart'],
            $_POST['dateEnd'],
            $_POST['company'],
            implode(",",$_POST['contenttype']),
            $_POST['picture'],
            $_POST['region'],
            $sid
        ]);
        if($stmt->rowCount()==1) {
            $result['success'] = true;
            $result['code'] = 200;
            $result['msg'] = '資料更改成功';
        } else {
            $result['code'] = 402;
            $result['msg'] = '資料沒有修改';
        };
    } catch(PDOException $ex){
        $result['code'] = 403;
        $result['msg'] = '資料更新發生錯誤';
    }
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>