<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    include "config.php";
                    if (isset($_GET['cid'])) {
                        $cid = $_GET['cid'];

                        $query3 = "SELECT * FROM category WHERE category_id={$cid}";
                        $res3 = mysqli_query($conn, $query3) or die("Query Failed!");
                        $row3 = mysqli_fetch_assoc($res3);
                    ?>
                        <h2 class="page-heading"><?php echo $row3['category_name'] ?> </h2>
                        <?php

                        $limit = 3;
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;
                        $cid = $_GET['cid'];
                        $query = "SELECT * FROM post p LEFT JOIN category c 
                  ON p.category=c.category_id LEFT JOIN user u 
                  ON p.author=u.user_id WHERE p.category={$cid} ORDER BY p.post_id 
                   DESC LIMIT {$offset} , {$limit}";
                        $res = mysqli_query($conn, $query) or die("Query FAiled!");

                        while ($row = mysqli_fetch_assoc($res)) {

                        ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?aid=<?php echo $row['author'] ?>'><?php echo $row['username'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date'] ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['description'], 0, 200) . "....." ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }

                        ?>
                    <?php
                        if (mysqli_num_rows($res3) > 0) {

                            $count_query = "SELECT COUNT(*) as total_posts FROM post WHERE category = {$cid}";
                            $count_result = mysqli_query($conn, $count_query) or die("Count Query Failed");
                            $count_row = mysqli_fetch_assoc($count_result);
                            $total_record = $count_row['total_posts'];

                            $total_pages = ceil($total_record / $limit);
                            echo "
                        <ul class='pagination'>
                            ";
                            if ($page > 1) {
                                echo "<li><a href='category.php?cid=" . $cid . "&page=" . ($page - 1) . "'>Prev</a></li>";
                            }

                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = " ";
                                }
                                echo "
                                <li class='{$active}'><a href='category.php?cid=" . $cid . "&page={$i}'>{$i}</a></li>
                                ";
                            }
                            if ($total_pages > $page) {
                                echo "   <li><a href='category.php?cid=" . $cid . "&page=" . ($page + 1) . "'>Next</a></li>";
                            }

                            echo "
                              </ul>
                            ";
                        }
                    } else {
                        echo "<h1>Record not Found!</h1>";
                    }
                    ?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>