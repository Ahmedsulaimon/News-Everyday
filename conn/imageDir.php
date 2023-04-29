<?php

$file = 'C:\\xampp\\images\\' . $_GET['id'] . '.jpg';

// HERE YOU CHECK IF THE USER HAS ACCESS TO THIS FILE
// FOR EXAMPLE
// if (userId == $_GET[id])..... you can see the picture, etc.

if (file_exists($file)) {
    // if you know how the file is, you should use the headers also, to tell the browser how is this file
    // With headers you can also make others things like force download, instead of browsing, etc.

    // I'm going to suppose that you are always using png files:
    // Other 'Content-Type': https://www.geeksforgeeks.org/http-headers-content-type/
    header('Content-Type: image/jpeg');

    // Tell the browser the lenght of the file:
    header('Content-Length: ' . filesize($file));

    // Or tell the browser a 'fake' name for this file (so if the user downloads this file, this will be its name)
    //header('Content-Disposition: inline; filename="'.basename($file).'"');
    header('Content-Disposition: attachment; filename="image.jpg"'); //inline is used to open into another tab
    //header('Content-Disposition: inline; filename="studentPic.jpg"'); //inline is used to open into another tab
    // with Content-Disposition: attachment; --> browser will download the file instead of showing

    readfile($file);
    exit;
}
?>

