<?php 
    include_once 'inc/header.php'; 
?>
<body>
    <?php
        $db = new SQLite3('C:\xampp\htdocs\NewsApplication\data\News_Application.db');
        $sql = "SELECT * FROM news WHERE status = 'pending' ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':imageID',$contentID , SQLITE3_TEXT);
        $stmt->bindParam(':tileID',$titleID , SQLITE3_TEXT);
        $stmt->bindParam(':imageID',$newsContentID , SQLITE3_TEXT);
       $result = $stmt->execute();
       $fileName = [];

    while($row=$result->fetchArray()){
        $fileName [] = $row;
        $_SESSION['news'] =  $fileName [0];
        $_SESSION['newsID'] =  $fileName [0]['newsID'];
    }
?>

<div>
    <?php
    //query all the new uploads from the database
        if ($fileName  != 0) {
            foreach ($fileName as &$img) {
                if ($img['status'] == 'approved') {
                    continue;
                }
                echo'<div class="post-request-container">';
                    echo'<div class ="uploaded-image">';
                        echo '<img  src="conn/imageDir.php?id='.$img['image_name'].'" alt="Image not found"  />';
                    echo'</div>';

                    echo'<div class ="upload-type-date">';
                        echo'<h3>News Type:</h3><div class ="uploaded-news-type">';
                        echo $img['news_type']; 
                        echo'</div>';
                        echo'<h3 >Upload Date:</h3><div class ="date-of-upload">';
                        echo $img['upload_date']; 
                        echo'</div>';
                    echo'</div>';

                    echo'<h2 >Headline</h2><div class ="uploaded-headline">';
                        echo $img['Title'];
                    echo'</div>';

                    echo'<h2>News Content</h2><div class ="uploaded-content">';
                        echo $img['newsContent'];
                    echo'</div>';

                    echo '
                    <div class="action-btn-style">
                        '.
                            // if user is admin show approve and deny buttons that post to approve.php and deny.php if post does not have status of approved
                            
                            ($img['status'] != 'approved' ? '<form action="inc/approve.php"
                            method="post" ><input type="hidden"  name="id" value="' . $img['newsID'] .
                            '" /><input type="submit" id="accept" value="Approve" /></form><form action="inc/deny.php" method="post"><input type="hidden" name="id" value="'
                            . $img['newsID'] . '" /><input type="submit"  id="decline" value="Deny" /></form>' : '')
                        .'
                    </div>
                ';
                                
                echo' </div>';
            }
            
        }
        if ($fileName = 0){ 
            echo'<p class="no-request"> No new post found</p>';
        } 
    ?>    
</div>

<?php  
    include_once 'inc/footer.php';
?>
</body>