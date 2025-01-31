<?php

include_once('./database.php');

if (isset($_GET['id'])) {
    $userid = $_GET['id'];

    $sql = "DELETE  FROM users WHERE id='$userid'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    header('Location:./users.php');
    die;

}







?>