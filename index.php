<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <?php
                    include "config.php";
                    $limit = 4;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;

                    $query2 = "SELECT * FROM post p LEFT JOIN category c
                     ON  p.category= c.category_id
                     LEFT JOIN user ON p.author=user.user_id
                     ORDER BY p.post_id DESC LIMIT {$offset},{$limit}";
                    $res2 = mysqli_query($conn, $query2) or die("Query Failed: SELECT");
                    if (mysqli_num_rows($res2) > 0) {
                        while ($row = mysqli_fetch_assoc($res2)) {

                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row['post_id']?>"><img src="admin/upload/<?php echo $row['post_img']?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row['post_id']?>'><?php echo $row['title'] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?aid=<?php echo $row['author']?>'><?php echo $row['username'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date'] ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr( $row['description'],0,200)."....." ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }else{
                        echo "Record Not Found.";
                    }
                    ?>
                    <?php
                    $query = "SELECT * FROM post";
                    $res = mysqli_query($conn, $query) or die("Query Failed!");
                    if (mysqli_num_rows($res)) {
                        $total_record = mysqli_num_rows($res);
                        $limit = 4;
                        $total_pages = ceil($total_record / $limit);
                        echo "
                        <ul class='pagination'>
                            
                            ";
                        if ($page > 1) {
                            echo "<li><a href='index.php?page=" . ($page - 1) . "'>Prev</a></li>";
                        }

                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = " ";
                            }
                            echo "
                                <li class='{$active}'><a href='index.php?page={$i}'>{$i}</a></li>
                                ";
                        }
                        if ($total_pages > $page) {
                            echo "   <li><a href='index.php?page=" . ($page + 1) . "'>Next</a></li>";
                        }

                        echo "
                              </ul>
                            ";
                    }
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>