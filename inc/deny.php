<?php

session_start();

if (isset($_POST['id'])) {
    include '../conn/db.php';
    // delete from news where newsID = newsID
    $stmt = $db->prepare('DELETE FROM news WHERE newsID = :newsID');
    //id is text
    $stmt->bindValue(':newsID', $_POST['id'], SQLITE3_TEXT);
    // execute the statement
    $stmt->execute();
    echo '<script>alert("post request was denied")</script>';
   // redirect to postRequest.php
   header('Location: ../postRequest.php');
   
}


?>