<?php

session_start();

if (isset($_POST['id'])) {
    include '../conn/db.php';
    // set status approved where newsID = newsID
    $stmt = $db->prepare('UPDATE news SET Status = "approved" WHERE newsID = :newsID');
    //id is text
    $stmt->bindValue(':newsID', $_POST['id'], SQLITE3_TEXT);
    // execute the statement
    $stmt->execute();
    echo '<script>alert("Post Approved.")</script>';
    // redirect to postRequest.php
    header('Location: ../postRequest.php');
   
}

?>