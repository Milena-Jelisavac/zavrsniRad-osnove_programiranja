<?php
include 'conect.php'
?>
<?php
$id = $_GET['id'];

$sql = "Delete from posts where id= '$id'";
$statement = $connection->prepare($sql);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
header("Location:index.php");
