<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
$file_name=$_POST['old-image'];
}else{
 $errors = array();
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_temp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $extensions=array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions)===false){
      $errors[]=  "This Extension File isnot allowed , Please choose a jpg or png img.";
    }
    if($file_size >2097152 ){
$errors[]="File size must be 2mb or lower.";
    } 
    if(empty($errors)==true){
        move_uploaded_file($file_temp,"upload/".$file_name);
    }else{
        print_r($errors);
        die();
    }
}

    $post_id=$_POST['post_id'];
    $post_title=$_POST['post_title'];
    $postdesc=$_POST['postdesc'];
    $category=$_POST['category'];
    $query="UPDATE post SET title='{$post_title}',description='{$postdesc}',category={$category},post_img='{$file_name}'
    WHERE post_id={$post_id}";
    $res=mysqli_query($conn,$query) or die ("Query failed!");
    if($res){
        header("location:{$hostname}/admin/post.php");
    }


?>