<?php
include 'conect.php'
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $textComment = $_POST['textComment'];
    $author = $_POST['author'];
    $post_id = $_POST['post_id'];
    if ($textComment != '' && $author != '') {
        $sql = "INSERT INTO comments (author, text, post_id)
        VALUES ('$textComment',  '$author', $post_id)";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        header("Location:single-post.php?id=$post_id");
    } else {
        ('Sva polja su obavezna');
    }
}
