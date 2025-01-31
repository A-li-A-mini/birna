<?php
include_once('./database.php');

if (isset($_GET['id'])) {
    $newsid = $_GET['id'];

    $sql = "DELETE  FROM news WHERE id='$newsid'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    header('Location:./news.php');
    die;

}
?>