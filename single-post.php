<?php
include 'conect.php'
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <title>Vivify Blog</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'header.php'; ?>
    <?php
    if (isset($_GET['id'])) {
        $sql = "SELECT title, body, author,created_at FROM posts WHERE id = {$_GET['id']}";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $singlePost = $statement->fetch();

        $sqlcomm = "SELECT id, author, text, post_id FROM comments  WHERE post_id = {$_GET['id']}";
        $statementcomm = $connection->prepare($sqlcomm);
        $statementcomm->execute();
        $statementcomm->setFetchMode(PDO::FETCH_ASSOC);
        $comment = $statementcomm->fetchAll();

    ?>
    <?php
    } else {
        echo ('Željeni članak ne postoji');
    }
    ?>
    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                <h2><?php echo $singlePost['title'] ?></h2>
                <p class="blog-post-meta"><?php echo ($singlePost['created_at']) ?> by <a href="#"><?php echo ($singlePost['author']) ?></a></p>
                <p><?php echo ($singlePost['body']) ?></p>
                <div>
                    <?php
                    foreach ($comment as $comm) {
                    ?>
                        <ul>
                            <li>
                                <?php echo ($comm['author']) ?>
                                <?php echo ($comm['text']) ?>
                            </li>
                            <hr>
                        </ul>

                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            include 'sidebar.php';
            ?>
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>
        </div>
    </main>
    <?php include 'footer.php';
    ?>
</body>

</html>