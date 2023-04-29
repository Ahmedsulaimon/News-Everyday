<?php 
    include_once 'inc/header.php';
?>

<!-- the code for the sticky social bar was gotten from w3school -->
<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_sticky_social_bar -->
<div class="icon-bar">
    <a href="https://en-gb.facebook.com/" class="facebook"><i class="fa fa-facebook"></i></a> 
    <a href="https://twitter.com/home?lang=en-gb" class="twitter"><i class="fa fa-twitter"></i></a> 
    <a href="https://www.google.co.uk/" class="google"><i class="fa fa-google"></i></a> 
    <a href="https://gb.linkedin.com/" class="linkedin"><i class="fa fa-linkedin"></i></a>
    <a href="https://www.youtube.com/" class="youtube"><i class="fa fa-youtube"></i></a> 
</div>

<?php
    $db = new SQLite3('C:\xampp\htdocs\NewsApplication\data\News_Application.db');
    $sql = "SELECT * FROM news WHERE status = 'approved' ORDER BY  upload_date  DESC ";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':imageID', $contentID, SQLITE3_TEXT); 
    $result = $stmt->execute();
    $row = $result->fetchArray();
?>

<?php
    echo '<div class="main-image">';
    echo ' <img src="conn/imageDir.php?id='.$row['image_name'].'" alt="Image not found" /> ';
    echo '</div>';
?>

<?php  
    $db = new SQLite3('C:\xampp\htdocs\NewsApplication\data\News_Application.db');
    $sql = "SELECT * FROM news WHERE status = 'approved' ORDER BY  upload_date  DESC LIMIT 6 ";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':imageID',$contentID , SQLITE3_TEXT);
    $stmt->bindParam(':tileID',$titleID , SQLITE3_TEXT);
    $stmt->bindParam(':imageID',$newsContentID , SQLITE3_TEXT);
    $result = $stmt->execute();
    $fileName = [];
    while($row = $result->fetchArray()) {
        $fileName [] = $row;
    }
?>

<!-- displaying the latest news -->
<div  style="font-size:xx-large; font-weight:bold; text-align:center; margin-top:45px;">
    <b> News Flash</b>
</div>

<?php
    echo '<div class="content-styling">';
    foreach ($fileName as &$img) {
        echo '<div class="news-container"> ';
        echo ' <img  class="wrap" src="conn/imageDir.php?id='.$img['image_name'].'" alt="Image not found" style="width:310px; height:240px;" /> ';
        echo '<a href="contentDetail.php?newsID='.$img['newsID'].'">'.$img['Title'].'</a>';
        echo '</div>';
    }
    echo '</div>';
?>

<!-- news categories -->
<div  style="font-size:xx-large; font-weight:bold; text-align:center; margin-top:120px;">
    <b> Category</b>
</div>

<div class="flex-container">
    <div class="left-float">
        <a href="business.php" aria-label="business page">
            <img src="images/image 2.png" alt="image addressing business(s)" />
        </a>
        <div class="test-design"> <strong>Business News</strong></div>
    </div>
      
    <div class="left-float">
  <a href="sport.php" aria-label="sport page">
    <img src="images/image 3.jpg" alt="sport image" />
  </a>
  <div class="test-design">
    <strong>Sport News</strong>
  </div>
</div>
<div class="left-float">
  <a href="politics.php" aria-label="about politics">
    <img src="images/image 1.jpg" alt="about politics" />
  </a>
  <div class="test-design">
    <strong>Politics</strong>
  </div>
</div>
<div class="left-float">
  <a href="events.php" aria-label="events page">
    <img src="images/image 3.jpg" alt="image of events" />
  </a>
  <div class="test-design">
    <strong>Events</strong>
  </div>
 </div>
</div>
<!-- contact form -->
<div style="display:flex; flex-direction:column; align-items:center; margin-bottom:55px;">
  <h1>CONTACT</h1>
  <p>Got a question? Drop a message</p>
</div>
<div class="contact-container">
  <div class="company-info">
    <div class="location">
      <i class="fa fa-twitter"></i>
      <p style="margin-left:7px;">Sheffield, UK</p>
    </div>
    <div class="phone-no">
      <i class="fa fa-twitter"></i>
      <p style="margin-left:7px;">Phone:+44 342345</p>
    </div>
    <div class="email">
      <i class="fa fa-twitter"></i>
      <p style="margin-left:7px;">Email:newseveryday@mail.com</p>
    </div>
  </div>
  <form method="post" action="index.php" id="myForm" class="contact-form-container">
    <div class="contact-form">
      <div>
        <input type="text" name="name" placeholder="Name" required />
      </div>
      <div>
        <input type="text" name="email" placeholder="Email" required />
      </div>
    </div>
    <div class="contact-form-message-field">
      <input type="text" style="width:600px; height:70px; font-size:large; font-weight:bold; margin-left:7px; margin-right:2px;" name="message" placeholder="Message" required />
    </div>
    <div>
      <button type="submit" id="submit" style="display:flex; float:right; margin-top:5px; color:white; background:black; width:100px; height:40px; text-align:center; font-size:large;" value="Reset form">Submit</button>
    </div>
  </form>
</div>
<?php
if (!isset($_SESSION["users"])) {
  echo '
  <div class="container">
  <div class="bg-text">
    <h2>sign up as a Moderator</h2>
    <h1 style="font-size:50px">To upload News Today</h1>
    <a href="registration.php" class="button">Sign Up!</a>
  </div>
  </div>';
}
?>
<?php include_once 'inc/footer.php'; ?>