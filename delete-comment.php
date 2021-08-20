<?php
include 'conect.php'
?>
<?php
$id = $_GET['id'];
$post_id = $_GET['post_id'];
$sql = "Delete from comments where id= '$id'";
$statement = $connection->prepare($sql);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
//header("Location:single-post.php?id=$post_id");
