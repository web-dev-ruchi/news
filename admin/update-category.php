<?php include "header.php";
include "config.php";
if($_SESSION['user_role']=='0'){
    header("location:{$hostname}/admin/post.php");
}
if (isset($_POST['submit'])) {
    $category_id = $_POST['cat_id'];
    $category_name = $_POST['cat_name'];
    $query2 = "UPDATE category SET  category_name='{$category_name}' WHERE category_id='{$category_id}'";
    $res2 = mysqli_query($conn, $query2) or die("Query2 Failed!");
    if ($res2) {
        header("location:{$hostname}/admin/category.php");
    }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                $category_id = $_GET['id'];
                $query = "SELECT * FROM category WHERE category_id={$category_id}";
                $res = mysqli_query($conn, $query) or die("Query Failed!");
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="cat_id" class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>" placeholder="" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>

                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>