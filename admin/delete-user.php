<?php
if($_SESSION['user_role']=='0'){
    header("location:{$hostname}/admin/post.php");
}
    $conn = mysqli_connect("localhost", "root", "", "news") or die("Connection Failed!:" . mysqli_connect_errno());
$userid=$_GET['id'];
$query="DELETE FROM user WHERE user_id='{$userid}'";
$res=mysqli_query($conn,$query) or die("Query Failed!");
if($res){
    header("Location:http://localhost/news/admin/users.php");
}
else{
    echo "<p style='color:red,text-align:center,margin:10px 0;'>Can't Delete user record.</p>";
}
mysqli_close($conn);

?>