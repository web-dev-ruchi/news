<?php
include "config.php";
if($_SESSION['user_role']=='0'){
    header("location:{$hostname}/admin/post.php");
}
$cat_id=$_GET['id'];
$query="DELETE  FROM category WHERE category_id='{$cat_id}'";
$res=mysqli_query($conn,$query) or die ("Query Failed!");
if($res){
    header("Location:{$hostname}/admin/category.php");
}
mysqli_close($conn);
?>