<?php
include "config.php";
if (isset($_FILES['fileToUpload'])) {
    $errors = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_temp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
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
session_start();
$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d M, Y");
$author = $_SESSION['user_id'];

$query="INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('{$title}','{$desc}',{$category},'{$date}',{$author},'{$file_name}');";
$query .="UPDATE category SET post=post+1 WHERE category_id={$category}";
$res=mysqli_multi_query($conn,$query) or die ("Query Failed!");//ek se jyada query run krne ke liye.
if($res){
    header("Location:{$hostname}/admin/post.php");
}
