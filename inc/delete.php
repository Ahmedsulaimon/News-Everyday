 <?php

// check for delete post
if (isset($_POST['id'])) {
    include '../conn/db.php';
    // bind the values and prepare the statement
    $stmt = $db->prepare('DELETE FROM comments WHERE id = :id');
    $stmt->bindValue(':id', $_POST['id'], SQLITE3_INTEGER);
    // execute the statement
    $stmt->execute();
    // redirect to test.php
    header("Location: ../events.php");
    // set confirmation message
    $_SESSION['message'] = 'Comment deleted!';
}

?> 
 <?php

// check for delete post
if (isset($_POST['sportid'])) {
    include '../conn/db.php';
    // bind the values and prepare the statement
    $stmt = $db->prepare('DELETE FROM comments WHERE id = :id');
    $stmt->bindValue(':id', $_POST['sportid'], SQLITE3_INTEGER);
    // execute the statement
    $stmt->execute();
    // redirect to test.php
    header("Location: ../sport.php");
    // set confirmation message
    $_SESSION['message'] = 'Comment deleted!';
}

?> 
 <?php

// check for delete post
if (isset($_POST['politicsid'])) {
    include '../conn/db.php';
    // bind the values and prepare the statement
    $stmt = $db->prepare('DELETE FROM comments WHERE id = :id');
    $stmt->bindValue(':id', $_POST['politicsid'], SQLITE3_INTEGER);
    // execute the statement
    $stmt->execute();
    // redirect to test.php
    header("Location: ../politics.php");
    // set confirmation message
    $_SESSION['message'] = 'Comment deleted!';
}

?> 
 <?php

// check for delete post
if (isset($_POST['businessid'])) {
    include '../conn/db.php';
    // bind the values and prepare the statement
    $stmt = $db->prepare('DELETE FROM comments WHERE id = :id');
    $stmt->bindValue(':id', $_POST['businessid'], SQLITE3_INTEGER);
    // execute the statement
    $stmt->execute();
    // redirect to test.php
    header("Location: ../business.php");
    // set confirmation message
    $_SESSION['message'] = 'Comment deleted!';
}

?> 