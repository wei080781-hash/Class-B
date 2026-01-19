<?php
include_once "db.php";

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../upload/".$_FILES['img']['name']);
    $_post['img']=$_FILES['img']['name'];
}

$POST['sh']=1;

$Title->save($_POST);

to("../back.php?do=title");

?>