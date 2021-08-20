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
        //sql post
        $sql = "SELECT  title, body, author,created_at FROM posts WHERE id = {$_GET['id']}";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $singlePost = $statement->fetch();
        //sql comm
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
                <form method='POST' id="form" action='/create_comment.php'>
                    <textarea name='textComment' type='text' id="text" placeholder="Unesite svoj komentar"></textarea>
                    <br><br>
                    <input name='author' type='text' id="author" placeholder="Jhon Doe">
                    <br><br>
                    <input name="post_id" type='hidden' value=<?php echo ($_GET['id']) ?>>
                    <button id="submitbutton" value="sumbit"> Submit </button>
                    <br><br>
                </form>

                <script>
                    const submitit = document.getElementById('submitbutton');
                    submitit.addEventListener("click", function(e) {
                        const author = document.getElementById('author');
                        const text = document.getElementById('text');
                        if (author.value == '' && text.value == '') {
                            e.preventDefault();
                            alert("Molimo vas popunite sva polja");
                        }
                    });
                </script>
                <button id="buttonHide" class="btn btn-default" value="click" onclick="changeButtonName(); hideComments();">Hide comments</button>
                <script>
                    function changeButtonName() {
                        var button = document.getElementById("buttonHide");
                        if (button.innerText === "Hide comments") {
                            button.innerText = "Show comments"

                        } else {
                            button.innerText = "Hide comments"
                        }
                    };
                </script>
                <script>
                    function hideComments() {
                        var x = document.getElementsByClassName("hide");
                        for (var i = 0; i < x.length; i += 1) {
                            if (x[i].style.display !== "none") {
                                x[i].style.display = "none";
                            } else {
                                x[i].style.display = "block";
                            }
                        }
                    };
                </script>
                <div>
                    <?php
                    foreach ($comment as $comm) {
                    ?>
                        <ul class="hide">
                            <li idComm="<?php echo ($comm['id']) ?>" style="display: inline">
                                <input name="post_id" type='hidden' value=<?php echo ($_GET['id']) ?>>
                                <?php echo ($comm['author']) ?>
                                <?php echo ($comm['text']) ?>
                                <button class="btn btn-default" onclick="deleteComm()"> Delete</button>
                                <br><br>
                                <script>
                                    function deleteComm() {
                                        window.location.href = "delete-comment.php?id=<?php echo ($comm['id']) ?> && post_id = <?php echo ($_GET['id']) ?> "
                                    }
                                </script>
                            </li>

                            <hr>
                        </ul>

                    <?php
                    }
                    ?>
                    <br><br>
                    <button class='btn btn-primary' onclick='deletePost()'>Delete post</button>
                    <script>
                        function deletePost() {
                            var ask = window.confirm("Do you really want to delete this post?");
                            if (ask) {
                                window.alert("This post was successfully deleted.");

                                window.location.href = "delete_post.php?id=<?php echo ($_GET['id']) ?>";

                            }
                        }
                    </script>
                    <br><br>
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