<?php
include "config.php";
if(empty($_FILES['logo']['name'])){
$file_name = isset($_POST['old-logo']) ? $_POST['old-logo'] : '';

}else{
 $errors = array();
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $extensions=array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions)===false){
      $errors[]=  "This Extension File isnot allowed , Please choose a jpg or png img.";
    }
    if($file_size >2097152 ){
$errors[]="File size must be 2mb or lower.";
    } 
    if(empty($errors)==true){
        move_uploaded_file($file_temp,"images/".$file_name);
    }else{
        print_r($errors);
        die();
    }
}

    $name=mysqli_real_escape_string($conn, $_POST['webname']);
    $logo =mysqli_real_escape_string($conn, $file_name);
    $desc=mysqli_real_escape_string($conn,$_POST['webdesc']);
    $query="UPDATE settings SET websitename='{$name}',logo='{$logo}',footerdesc='{$desc}'";

    $res=mysqli_query($conn,$query) or die ("Query failed!");
    if($res){
        header("location:{$hostname}/admin/setting.php");
    }


?>