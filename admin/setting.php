<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <h1 style="margin-top: -90px; margin-left:100px;">Website Setting</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6" style="margin-bottom:70px;">
                    <?Php
                    include "config.php";
                    $query="SELECT * FROM settings";
                    $res=mysqli_query($conn,$query) or die ("Query Failed!");
                    $row = null;
                    if(mysqli_num_rows($res)>0){
                    $row=mysqli_fetch_assoc($res);
                    }
                    ?>
                    <!-- Form Start -->
                    <form action="save-setting.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="webname">Website Name</label>
                            <input type="text" value="<?php echo $row['websitename'] ?>" name="webname" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="weblogo">Website Logo</label>
                            <input type="file" name="logo" >
                            <img class="logo" src="images/<?php echo $row['logo'] ?>" style="height: 60px; width: 60px; margin-top: 10px;" alt="Logo">
                            <input type="hidden" name="old-logo" value="<?php echo $row['logo']; ?>">  

                        </div>
                        <div class="form-group">
                            <label for="webdesc">Footer Description</label>
                            <textarea name="webdesc"  class="form-control" rows="5" required><?php echo $row['footerdesc'] ?></textarea>
                        </div>
                        <input type="submit" name="save" class="btn btn-primary" value="Save" />
                    </form>
                    <!-- /Form  End -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include "footer.php";
?>