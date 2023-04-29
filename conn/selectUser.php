<?php 

    function verifyUsers ($username, $password) {
        $_SESSION['loginAttempt'] = "true";

        $db = new SQLite3('C:\xampp\htdocs\NewsApplication\data\News_Application.db');
        $stmt = $db->prepare('SELECT * FROM users WHERE username=:usrname AND userPassword=:password' );
        $stmt->bindParam(':usrname', $username, SQLITE3_TEXT);
        $stmt->bindParam(':password', $password, SQLITE3_TEXT);
        $result = $stmt->execute();

        $rows_array = [];
        while ($row=$result->fetchArray())
        {
            $rows_array[]=$row; 
        }

        $_SESSION['loginError'] = "true";
        
            return $rows_array;
    }
?>