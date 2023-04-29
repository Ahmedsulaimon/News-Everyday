<?PHP
session_start();
if(!isset($_SESSION["users"])){
  echo ''; 
  echo '';
  echo '';
  echo '';
  
} 
?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=7.0, user-scalable=yes" />
  <title>NEWS EVERYDAY</title>
  <script src="JS/index.js" defer></script>
  <link rel="stylesheet" media="only screen and (min-width : 720px)" href="css/desktop.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="heading">
    <h1>NEWS EVERYDAY</h1>
  </div>
  <nav>
    <ul>
      <?php   
        if(isset($_SESSION["users"])){
          echo"<li> <a href='index.php' aria-label='home page'>Home</a></li>";
          echo'<div class="dropdown">';
          echo" <li><a class='dropbtn'  aria-label='setting'>Settings</a></li>";
          echo' <div class="dropdown-content">';
          echo" <a href='inc/signout.php' aria-label='sign out'>sign out</a>";
          echo" <form action='' method='post'>
                 <input onClick='javascript: return confirm(\"Are you sure you want to delete your account?\");' class='delete-account' type='submit' name ='delete' value='Delete Account'>
                </form>";
          echo'</div>';
          echo' </div>';
          echo" <li class='tooltip'><a href='index.php' aria-label='contact us'>contact us</a>
                <span class='tooltiptext'>See Home-page for form</span>
              </li>";
          echo" <li><a href='about us.php' aria-label='about us'>about us</a></li>";
          if($_SESSION["userRole"] == "Moderator"){
            echo" <li><a href='upload.php' aria-label='upload page'>Upload</a></li>";
          }else if($_SESSION["userRole"] == "Admin"){
            echo"<li><a href='postRequest.php' aria-label='post request'>Post Request</a></li>"; 
          }
        }else{
          echo"<li> <a href='index.php' aria-label='home page'>Home</a></li>";
          echo" <li class='tooltip'><a href='index.php' aria-label='contact us'>contact us</a>
                  <span class='tooltiptext'>See Home-page for form</span>
                </li>";
          echo"<li> <a  href='LoginPortal.php' aria-label='log in page'>Sign in</a></li>";
          echo" <li><a href='about us.php' aria-label='about us'>about us</a></li>";  
        }
        if(isset($_POST['delete'])) {
          $id = $_SESSION['userID']; // retrieve the user ID from the session or form submission
          $db = new SQLite3('C:\xampp\htdocs\NewsApplication\data\News_Application.db');
          // Prepare and execute the SQL query to delete the account record
          $query = "DELETE FROM users WHERE userID = :id";
          $stmt = $db->prepare($query);
          $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
          $stmt->execute();
          echo '<script>alert("Your account has being deleted")</script>';
          session_start();
          session_destroy();
          header('Location:index.php');
        exit;
         
        }

      ?>
     </ul>
   </nav> 
  </header>
<main>