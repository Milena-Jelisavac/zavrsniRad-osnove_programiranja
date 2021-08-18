<?php
include 'conect.php'
?>
<!doctype html>
<div class="blog-post">
    <?php
    $sql = "SELECT id,title, body, author,created_at FROM posts order by created_at desc";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $posts = $statement->fetchAll();
    ?>
    <?php
    foreach ($posts as $post) {
    ?>
        <h2 class="blog-post-title"><a href="single-post.php?id=<?php echo ($post['id']) ?>"><?php echo ($post['title']) ?></a></h2>
        <p class="blog-post-meta"><?php echo ($post['created_at']) ?> by <a href="#"><?php echo ($post['author']) ?></a></p>
        <p><?php echo ($post['body']) ?></p>

    <?php
    }
    ?>

</div>