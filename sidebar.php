<?php
include 'conect.php'
?>

<?php
$sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
$statement = $connection->prepare($sql);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$posts = $statement->fetchAll();
?>
<aside class="col-sm-3 ml-sm-auto blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>Last post</h4>
        <?php
        foreach ($posts as $post) {
        ?>
            <p><a href="single-post.php?id=<?php echo ($post['id']) ?>"><?php echo ($post['title']) ?></a></p>
        <?php
        }
        ?>

        <div>

        </div>
    </div>

</aside>