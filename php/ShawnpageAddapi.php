<?php
include __DIR__.'/PDO.php';

header("Content-type:application/json");

$result = [
    'success'=>false,
    'code'=>0,
    'msg'=>'未輸入任何資料',
    'post'=>[]
];

    

if(isset($_POST['name'])){

    



    

    $name=$_POST['name'];
	$content=$_POST['content'];
	$dateStart=$_POST['dateStart'];
	$dateEnd=$_POST['dateEnd'];
    $company=$_POST['company'];
    $picture=$_POST['picture'];
    $region=$_POST['region'];
    $contenttype=implode($_POST['contenttype']);

    $_POST['picture']=isset($_POST['picture'])?$_POST['picture']:"";
    $_POST['contenttype']=isset($_POST['contenttype'])?$_POST['contenttype']:"";

    $result['post']=$_POST;

    if(empty($name) or empty($content) or empty($dateStart) or empty($dateEnd)or empty($company)){
        $result['msg']="必填值有未填！";
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    };


    

    $sql = "INSERT INTO `activity`(
        `name`, `content`, `dateStart`, `dateEnd`, `company` , `contenttype`, `picture` , `region`
        ) VALUES (
          ?, ?, ?, ?, ? , ? , ? , ?
        )";


    try{
        $stmt = $pdo->prepare($sql);
    	$stmt->execute([
            $_POST['name'],
            $_POST['content'],
            $_POST['dateStart'],
            $_POST['dateEnd'],
            $_POST['company'],
            implode(",",$_POST['contenttype']),
            $_POST['picture'],
            $_POST['region']
        ]);

        if($stmt->rowCount()==1){
            $result['success']=true;
            $result['msg']="活動新增成功";
            $result['code']=200;
        }else{
            $result['msg']="活動新增錯誤，若有問題請洽管理員";
            $result['code']=401;
        }
    }catch(PDOException $x){
        $result['msg']="活動輸入錯誤，若有問題請洽管理員";
        $result['code']=402;
    };
};
echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>