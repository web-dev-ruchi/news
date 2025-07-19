<?php include "header.php";
include "config.php"; 
if($_SESSION['user_role']=='0'){
    header("location:{$hostname}/admin/post.php");
}?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php

                if (isset($_POST['save'])) {
                    $category = $_POST['cat'];
                    $query = "SELECT category_name FROM category WHERE category_name='{$category}'";
                    $res=mysqli_query($conn,$query) or die ("Query Failed!");
                    if(mysqli_num_rows($res)>0){
                        echo "<p style='color:red;text-align:center;margin:10px 0;'>Categpry All Ready Decalared!</p>";
                    }else{
                      $query1="INSERT INTO category ( category_name)VALUES('{$category}')";
                      $res1=mysqli_query($conn,$query1)or die ("Query2 Failed!");
                      if($res1){
                        header("Location:{$hostname}/admin/category.php");
                      }
                    }
                }
                ?>
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>