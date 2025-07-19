<?php

include 'config.php';
$page = basename($_SERVER['PHP_SELF']);
switch ($page) {
    case "single.php";
        if (isset($_GET['id'])) {
            $query2 = "SELECT * FROM post WHERE post_id={$_GET['id']}";
            $res2 = mysqli_query($conn, $query2) or die("Query Failed!");
            $title = mysqli_fetch_assoc($res2);
            $page_title = $title['title'];
        } else {
            $page_title = "Record Not Found!";
        }
        break;
    case "category.php";
        if (isset($_GET['cid'])) {
            $query3 = "SELECT * FROM category WHERE category_id={$_GET['cid']}";
            $res3 = mysqli_query($conn, $query3) or die("Query Failed!");
            $title2 = mysqli_fetch_assoc($res3);
            $page_title = $title2['category_name'] . " News";
        } else {
            $page_title = "Record not Found!";
        }
        break;
    case "author.php";
        if (isset($_GET['aid'])) {
            $query4 = "SELECT * FROM user WHERE user_id={$_GET['aid']}";
            $res4 = mysqli_query($conn, $query4) or die("Query Failed Author");
            $title3 = mysqli_fetch_assoc($res4);
            $page_title = " News By" . $title3['username'];
        } else {
            $page_title = "Record not Found!";
        }
        break;
    case "search.php";
        if (isset($_GET['search'])) {

            $page_title = $_GET['search'];
        } else {
            $page_title = "Search Record not Found!";
        }
        break;


    default:
        $page_title = "News Site";
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php
            echo "{$page_title}";
            ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <?php
                    include "config.php";
                    $qu = "SELECT * FROM setting";
                    $re = mysqli_query($conn, $qu) or die("Query Failed!");
                    if (mysqli_num_rows($re) > 0) {
                        while ($ro = mysqli_fetch_assoc($re)) {
                            if ($ro['logo'] == "") {
                                echo '<a href="index.php"><h1>' . $ro['websitename'] . '</h1></a>';
                            } else {
                                echo '
                    <a href="index.php" id="logo"><img style="height:60px"; src="admin/images/' . $ro['logo'] . '"></a>';
                            }
                        }
                    }
                    ?>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    include "config.php";
                    if (isset($_GET['cid'])) {
                        $cid = $_GET['cid'];
                    }
                    $query = "SELECT * FROM category WHERE post >0";
                    $res = mysqli_query($conn, $query) or die("Query Failed!");
                    if (mysqli_num_rows($res) > 0) {
                        $active = "";
                    ?>
                        <ul class='menu'>
                            echo " <li><a href='<?php echo $hostname; ?>'> Home</a></li>";

                            <?php
                            while ($row = mysqli_fetch_assoc($res)) {
                                if (isset($_GET['cid'])) {
                                    if ($cid == $row['category_id']) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                }

                                echo " <li ><a class='{$active}'  href='category.php?cid=$row[category_id]'> $row[category_name]</a></li>";
                            } ?>
                        </ul>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->