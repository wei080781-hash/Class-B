<?php
include_once "db.php";

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../upload/".$_FILES['img']['name']);
    $_POST['img']=$_FILES['img']['name'];
}
$countSH=$Title->count(['sh'=>1]);
$_POST['sh']=($countSH==0)?1:0;
// if($countSH==0){    
//     $_POST['sh']=1;
// }else{
//     $_POST['sh']=0;
// }

$Title->save($_POST);

to("../back.php?do=title");

?>