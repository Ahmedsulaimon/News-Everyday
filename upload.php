<?php
include_once 'inc/header.php';
include_once "conn/newsUpload.php";

$message = "";
$check = "yes";

// Check if image file is a actual image or fake image
if (isset($_POST["submit"]) && isset($_FILES['file'])) {
	$img_size = $_FILES['file']['size'];
	$error = $_FILES['file']['error'];

	//$target_dir = 'images/';
	// Remove the line below, as it overwrites the previous line
     $target_dir = 'C:\\xampp\\web-images\\'; //to specify the directory 
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    // Use the file extension to check if the file is an image
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	
    $check = getimagesize($_FILES["file"]["tmp_name"]);

    if ($check !== false) {
        $message = "File is an image - " . $_FILES["file"]["type"] . ". ";
        $uploadOk = 1;
    } else {
        $message = "File is not an image.";
        $uploadOk = 0;
    }
    if ($error === 0) {
		if ($img_size > 1250000) {
			$message = "Sorry, your file is too large.";
			// Add a parameter to the URL to display the error message
			header("Location: upload.php?error=$message");
			exit(); // Exit the script after redirecting
        }
    } else {
        $message = "Sorry, there was an error uploading your file.";
		// Add a parameter to the URL to display the error message
		header("Location: upload.php?error=$message");
		exit(); // Exit the script after redirecting
    }
    // Check the file extension
    $allowed_exs = array("jpg", "jpeg"); 
    if (!in_array($imageFileType, $allowed_exs)) {
        $message = "You can't upload files of this type";
		// Add a parameter to the URL to display the error message
		header("Location: upload.php?error=$message");
		exit(); // Exit the script after redirecting
    }

    if ($uploadOk == 1) {
        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($extension);

        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $fileName = $new_img_name . '.' . $extension;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $fileName)) {
            $message = "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    }
}

// Only execute the code below if the form has been submitted successfully
if (isset($_POST["submit"]) && $uploadOk == 1) {
    $my_date = date("Ymd");
    $rand_number = mt_rand(0,1000000);
     $news_id = $my_date."_".  $rand_number;
    $content_news = $_POST["title"];
    $message_news = $_POST["message"];
    $newsType = $_POST["newsType"];
    $date = date("Y/m/d");
    $status = "pending";
    $userid = $_SESSION['userID'];
        
    $inserted = newsUpload($news_id,$target_dir,$new_img_name,$content_news,$message_news, $date, $status,$newsType, $userid); //calling this function to insert the file  into db

    if (!$inserted) { //if this is false
        echo "File was not inserted into database!";
    }
    
    if ($inserted != null) {
        $_SESSION['news'] = $inserted[0];
        $_SESSION['newsID'] = $inserted[0]['newsID'];
        $_SESSION['username'] = $_POST["usrname"];
        header("Location: upload.php");   
    }
}


    ?>
    
    <body>
    <div style="font-weight: bold;font-size:x-large; margin-top:20px;margin-bottom:50px; color: red; text-align: center;">
        <?php if (isset($_GET['error'])): ?>
            <p><?php echo $_GET['error']; ?></p>
        <?php endif ?>
        </div>
        <div style=" background: #afaeae; margin-inline:50px; margin-top:30px; margin-bottom:30px;">
            <button type="button" class="collapsible">Click to View Upload Guideline</button>
            <div class="guideline">
                <ul>
                    <li>*Image must be JPG or JPEG</li>
                    <li>*content must be 450 words or less</li>
                    <li>*headline must be 100 words or less</li>
                    <li>*Content of any sexual nature won't be approved</li>
                </ul>
            </div>
            <form method="post" enctype="multipart/form-data" class="upload-content">
                <label style="font-weight: bold;font-size:x-large; margin-top:20px;">News Type</label>
                <select required name="newsType" type="text" class="textDesign" style="font-family: arial; color: black;"> 
                    <option value="" selected="selected">Select news type</option>
                    <option value="Sport news">Sport news</option>
                    <option value="politics">politics</option>
                    <option value="Business">Business</option>
                    <option value="events">Events</option>
                </select>
                <label style="font-weight: bold; font-size:x-large; margin-top:40px;"for="fname">Headline:</label>
                <div> Words:<span class="word-count-for-headline">0</span></div>
                <textarea name="title"  onkeyup="countWordsForHeadline(this)";  class="headline-textarea" aria-labelledby="messageBox"  required></textarea>
                <label for="messageBox" style="font-weight: bold;font-size:x-large; margin-top:20px;margin-bottom:5px;">Add Content below:</label>
                <div> Words:<span class="word-count">0</span></div>
                <textarea name="message"   onkeyup="countWords(this);"   class="text-area-size" aria-labelledby="messageBox" required></textarea>
                <label for="messageBox" style="font-weight: bold;font-size:x-large; margin-top:20px;margin-bottom:12px; border:2px solid white">Add an image</label>
                <input type="file" name="file"  style="font-weight: bold;font-size:x-large;">
                <input type="submit" id="upload-content-btn" name="submit" value="Upload">
            </form>
        </div>
    <?php  include_once 'inc/footer.php'; ?>