<?php

 function newsUpload($news_id,$target_dir,$new_img_name,$content_news,$message_news, $date, $status,$newsType, $userid)
  {
    $created = false;
    $db = new SQLite3('C:\xampp\htdocs\NewsApplication\data\News_Application.db');
    $sql = 'INSERT INTO news(newsID,newsContent,Title,image_url, image_name,news_type,status,upload_date,userID) VALUES ( :sid,:scontent,:stitle,:images, :simgName,:stype,:sStatus,:sdate,:suserid )';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':scontent', $message_news, SQLITE3_TEXT);
    $stmt->bindParam(':stitle', $content_news, SQLITE3_TEXT);
    $stmt->bindParam(':images', $target_dir, SQLITE3_TEXT);
    $stmt->bindParam(':simgName', $new_img_name, SQLITE3_TEXT);
    $stmt->bindParam(':sid', $news_id, SQLITE3_TEXT);
    $stmt->bindParam(':stype', $newsType, SQLITE3_TEXT);
    $stmt->bindParam(':sStatus', $status, SQLITE3_TEXT);
    $stmt->bindParam(':sdate',$date, SQLITE3_TEXT);
    $stmt->bindParam(':suserid',$userid, SQLITE3_INTEGER);
   

    $stmt->execute();

    if($stmt){
        $created = true;
    }

    return $created;

  }

?>
