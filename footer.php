<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    include 'config.php';
                    $q="SELECT * FROM settings";
                    $r=mysqli_query($conn,$q);
                    if(mysqli_num_rows($r)>0){
                       while($ro=mysqli_fetch_assoc($r)) {
?>
                <span><?php echo $ro["footerdesc"]?></span>
                      <?php
                    }
                     }
                    ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
