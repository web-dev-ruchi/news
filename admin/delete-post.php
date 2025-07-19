<?php
include "config.php";
$post_id=$_GET['id'];
$cat_id=$_GET['catid'];
$query2="SELECT * FROM post WHERE post_id={$post_id}";
$res2=mysqli_query($conn,$query2) or die("Query FAiled : SELECT");
$row=mysqli_fetch_assoc($res2);
 unlink("upload/".$row ['post_img']);

    $query="DELETE FROM post WHERE post_id={$post_id};";
    $query.="UPDATE category SET post=post - 1  WHERE category_id={$cat_id}";
    $res=mysqli_multi_query($conn,$query) or die("Query Failed!");
if($res){
    header("Location:{$hostname}/admin/post.php");
}

?>