<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    include "config.php";

                    $post_id = $_GET['id'];
                    $query = "SELECT * FROM post p LEFT JOIN category c ON p.category=c.category_id
                   LEFT JOIN user u ON p.author=u.user_id
                   WHERE p.post_id={$post_id}";
                    $res = mysqli_query($conn, $query) or die("Query Failed!");
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {

                    ?>

                            <div class="post-content single-post">
                                <h3><?php echo $row['title'] ?></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <a href='category.php?cid=<?php echo $row['category']; ?>'>
                                            <?php echo $row['category_name'] ?></a>
                                    </span>
                                    <span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <a href='author.php?aid=<?php echo $row['author'] ?>'><?php echo $row['username'] ?></a>
                                        </a>
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?php echo $row['post_date'] ?>

                                    </span>
                                </div>
                                <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img'] ?>" alt="" />
                                <div class="speak-section">
                                    <p class="description speak-text"><?php echo $row['description'] ?></p>
                                    <button style="background-color: #1e90ff;
    color: white;
    border: none;
    padding: 5px 10px;
    margin-top: 5px;
    border-radius: 4px;
    cursor: pointer;" class="speak-btn" onclick="speak(this)">🔊 Play</button>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>

<script>
    function speak(btn) {
        const text = btn.previousElementSibling.innerText;
        responsiveVoice.speak(text, "Hindi Female", {
            pitch: 1
        });
    }
</script>