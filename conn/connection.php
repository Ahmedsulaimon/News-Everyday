<?php
 include_once 'db.php';

 function createUser()
{
    $created = false;
    $db = new SQLite3('C:\xampp\htdocs\NewsApplication\data\News_Application.db');

    // Check if the username or email already exist in the database
    $checkUsername = $db->prepare('SELECT COUNT(*) FROM users WHERE username = :sUsername');
    $checkUsername->bindParam(':sUsername', $_POST['username'], SQLITE3_TEXT);
    $usernameExists = $checkUsername->execute()->fetchArray()[0];

    $checkEmail = $db->prepare('SELECT COUNT(*) FROM users WHERE Email = :sEmail');
    $checkEmail->bindParam(':sEmail', $_POST['email'], SQLITE3_TEXT);
    $emailExists = $checkEmail->execute()->fetchArray()[0];

    if ($usernameExists > 0) {
        $invalidMesg = 'Username already exists';
        return $created;
    }

    if ($emailExists > 0) {
        $invalidMesg = 'Email already exists';
        return $created;
    }

    // Insert the data into the database if the username and email don't exist
    $sql = 'INSERT INTO users(FirstName, LastName, Email, DOB, userRole,username,userPassword) VALUES ( :sFName,:sLName, :sEmail,:sDOB,:sRole, :suserName, :sPassword)';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':sFName', $_POST['fname'], SQLITE3_TEXT);
    $stmt->bindParam(':sLName', $_POST['lname'], SQLITE3_TEXT);
    $stmt->bindParam(':sEmail', $_POST['email'], SQLITE3_TEXT);
    $stmt->bindParam(':sDOB', $_POST['birthday'], SQLITE3_TEXT);
    $stmt->bindParam(':sRole', $_POST['userRole'], SQLITE3_TEXT);
    $stmt->bindParam(':suserName', $_POST['username'], SQLITE3_TEXT);
    $stmt->bindParam(':sPassword', $_POST['pwd'], SQLITE3_TEXT);

    $stmt->execute();

    if ($stmt) {
        $created = true;
    }

    return $created;
}


?>
