<?php
    include_once 'inc/header.php';
    require_once("conn/selectUser.php");
    $invalidMesg = "";

    if (isset($_POST["usrname"])) {

        if ($_POST['usrname'] != null && $_POST["password"] != null) { //only if these 2 fields have input the following will be processed.

            $array_user = verifyUsers($_POST['usrname'], $_POST["password"]); //verify user and get their username

            if ($array_user != null) {

                $_SESSION['users'] = $array_user[0];
                $_SESSION['userRole'] = $array_user[0]['userRole'];
                $_SESSION['userID'] = $array_user[0]['userID'];
                $_SESSION['username'] = $_POST["usrname"];

                header("Location: index.php");

            } else {
                $invalidMesg = "Invalid username and password!";
            }

        }
    }
?>
<form method="post" action="LoginPortal.php" class="loginDesign">
    <div class="signIn">
        <h1>SIGN IN</h1>
    </div>

<span style="color:red; font-size:large; font-weight:bold;"><?php echo $invalidMesg; ?></span>

<div class="formDesign">
    <label for="username">Username:</label>
    <input type="text" name="usrname" required/>
</div>

<div class="formDesign">
    <label for="pwd">Password:</label>
    <input type="password" name="password" required/>
</div>

<div class="formDesign">
    <button type="submit" class="Submit"> Login</button>
</div>

<div style="margin-bottom:5px; font-size:large"><strong>Don't have an account?</strong></div>
<a href="registration.php" style=" font-size:large; font-weight:bold;" aria-label="link to registration page">create an account</a>
</form>
<?php include_once 'inc/footer.php';?>