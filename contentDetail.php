<?php
    include_once 'inc/header.php';
    $db = new SQLite3('C:\xampp\htdocs\NewsApplication\data\News_Application.db');
    $getnewsID = $_GET["newsID"];
    $stmt = $db->prepare("SELECT * FROM news WHERE newsID = :id ");
    $stmt->bindParam(':id', $getnewsID, SQLITE3_TEXT);
    $result=$stmt->execute();
    //$result = $stmt->get_result();
    $obj = $result->fetchArray();
?>

<?php
    if(!isset($_SESSION["users"])){
        header('Location: LoginPortal.php');
    } 

    $_SESSION['username'];
    $_SESSION['userRole'];
    include 'conn/db.php';
?>

<body>
    <?php
        // display the fully content of any selected news from latest news section
        echo'<div class="content-style">';
        echo' <div class="content-container">';
        echo' <span ><div class="news-headline">' .$obj['Title'].'</div></span> ';
        echo'<span><div style="float:left;  color:grey; display:flex; margin-top: 3px;"><strong style="margin-right: 7px; " >Upload Date:</strong>' .$obj['upload_date'].'</div></span>';
        echo ' <img  class="image-size" src="conn/imageDir.php?id='.$obj['image_name'].'" alt="Image not found" style="margin-bottom:25px;"' ;
        echo'<p>   <span>' .$obj['newsContent'].'</span>  </p>'; 
        echo'</div>';

        $newsid = $obj['newsID'];
        $comments = $db->prepare("SELECT * FROM comments WHERE newsID = :newsid");
        $comments->bindParam(':newsid', $newsid, SQLITE3_TEXT);
        $comments_result = $comments->execute();

        // addition of comment section to news
        echo'<form  method="post" class="form-design-for-comment" >';
        echo' <label style="font-weight: bold;"for="lname">Comments</label>';
        echo'<div id="comment-section"> ';

        while ($row =  $comments_result->fetchArray()) {
            echo' <div class="commentBlock">
                    <div class="header">
                        <div class="time">' . $row['date'] . '</div>
                        <div> - </div>
                        <div class="username">' . $row['user'] . '</div>
                    </div>
                    <div class="comment">' . $row['comment'] . '</div>
                </div>';
        }  

        echo'</div>';
        echo'</form>';
        echo'</div>'; 

        include_once 'inc/footer.php';
    ?>
</body>
