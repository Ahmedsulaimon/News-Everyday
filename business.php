<?php
include 'conn/db.php';
include_once 'inc/header.php';  

if (!isset($_SESSION["users"])) {
    header('Location: LoginPortal.php');
} 

$_SESSION['username'];
$_SESSION['userRole'];

?>

<body>
    <?php  
    $db = new SQLite3('C:\xampp\htdocs\NewsApplication\data\News_Application.db');
    $sql = "SELECT * FROM news WHERE status = 'approved' AND news_type = 'Business'  ORDER BY  upload_date  DESC ";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':imageID', $contentID, SQLITE3_TEXT);
    $stmt->bindParam(':tileID', $titleID, SQLITE3_TEXT);
    $stmt->bindParam(':imageID', $newsContentID, SQLITE3_TEXT);
      
    $result = $stmt->execute();
    $fileName = [];

    while($row = $result->fetchArray()){
        $fileName[] = $row;
    }
    ?>           

    <?php
    // query all content related to business from database
    foreach ($fileName as &$img) {
        echo'<div class="content-style">';
        echo' <div class="content-container">';
        $newsid = $img['newsID'];
        
        // iset post
        if (isset($_POST['comment'])) {
            session_start();
            $username = $_SESSION['username'];
            $userid = $_SESSION['userID'];
            $comment = $_POST['comment'];
            date_default_timezone_set('Europe/London');
            $date = date("d-m-Y H:i:s");  
            // bind the values and prepare the statement
            $stmt = $db->prepare('INSERT INTO comments (user, comment, date, newsID,userID) VALUES (:user, :comment, :date,:newsid,:userid)');
            $stmt->bindValue(':user', $username, SQLITE3_TEXT);
            $stmt->bindValue(':newsid', $newsid, SQLITE3_TEXT);
            $stmt->bindValue(':userid',  $userid, SQLITE3_INTEGER);

            // get bad words from db and check if comment contains any of them, if so, replace with asterisks
            $badWords = $db->query('SELECT * FROM TextCheck');
            
            while ($row = $badWords->fetchArray()) {
                $comment = str_replace($row['badWords'], str_repeat('*', strlen($row['badWords'])), $comment);
            }
            
            $stmt->bindValue(':comment', $comment, SQLITE3_TEXT);
            $stmt->bindValue(':date', $date, SQLITE3_TEXT);
            
            // execute the statement
            $stmt->execute();
            
            // redirect to test.php
            header('Location: business.php');
            
            // set confirmation message
            $_SESSION['message'] = 'Comment posted!';
        }
        
        echo' <span ><div class="news-headline">' .$img['Title'].'</div></span> ';
        echo'<span><div style="float:left;  color:grey; display:flex; margin-top: 3px;"><strong style="margin-right: 7px; " >Upload Date:</strong>' .$img['upload_date'].'</div></span>';
        echo ' <img  class="image-size" src="conn/imageDir.php?id='.$img['image_name'].'" alt="Image not found" style="margin-bottom:25px;"' ;
        echo'<p>   <span>' .$img['newsContent'].'</span>  </p>'; 
        echo'</div>'; 
        
        // select comments from database
        $comments = $db->prepare("SELECT * FROM comments WHERE newsID = :newsid");
        $comments->bindParam(':newsid', $newsid, SQLITE3_TEXT);
        $comments_result = $comments->execute();

        echo'<form action="business.php" method="post" class="form-design-for-comment" >
        <label style="font-weight: bold;" for="lname">comment:</label>
        <input type="text" class="textDesign" name="comment" placeholder="Enter Comment..." required />
        <input type="submit" class="btn-comment"/>
        <div id="comment-section"> ';
      
        while ($row = $comments_result->fetchArray()) {
          echo' <div class="commentBlock">
          <div class="header">
          <div class="time">' . $row['date'] . '</div>
          <div> - </div>
          <div class="username">' . $row['user'] . '</div>
          </div>
          <div class="comment">' . $row['comment'] . '</div>';
          
          // if user is admin show delete button that posts to delete.php
          echo(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'Admin' ? 
              '<form action="inc/delete.php" method="post"><input type="hidden" name="businessid" value="' . $row['id'] .'" />
              <input type="submit" value="Delete" /></form>' : '');
                    
          echo'</div>';
          }
          echo'</div>
          
          </form>
          </div>';
        }
          include_once 'inc/footer.php';
          ?>
   

