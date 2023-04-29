<?php
include_once 'inc/header.php';
require_once("conn/connection.php");
$invalidMesg = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['pwd'];
    $passwordConfirm = $_POST['passwordConfirm'];
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $DOB = $_POST['birthday'];
    $role = $_POST['userRole'];

    if ($password !== $passwordConfirm) {
        $invalidMesg = 'Passwords do not match';
    } else {
        $createUser = createUser();
        if ($createUser) {
            header('Location: LoginPortal.php?status=success');
            exit();
        } else {
            $invalidMesg = 'Username or email already exists';
        }
    }
    
    
}
?>
<section>
    <form method="POST" class="registration" >
        <div class="title">
            <h1>Registration form</h1>
        </div>
        <span style="color:red; font-size:large; font-weight:bold;"><?php echo $invalidMesg; ?></span>
        <div class="formDesign">
            <label for="fname">First name:</label>
            <input type="text" name="fname" placeholder="first name">
        </div>
        <div class="formDesign">
            <label for="lname">Last name:</label>
            <input type="text" name="lname" placeholder="last name">
        </div>
        <div class="formDesign">
            <label for="email">Enter your email:</label>
            <input type="email" name="email" placeholder="email">
        </div>
        <div class="formDesign">
            <label for="birthday">Birthday:</label>
            <input type="date" name="birthday">
        </div>
        <div class="formDesign">
            <label>Role</label>
            <select required name="userRole" type="text" style="font-family: arial; color: black;"> 
                <option value="" selected="selected">Select Role</option>
                <option value="Ordinary User">Ordinary User</option>
                <option value="Moderator">Moderator</option>
                <option value="Admin">Admin</option>
            </select>
        </div>
        <div class="formDesign">
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="username">
        </div>
        <div class="formDesign">
            <label for="pwd">Password:</label>
            <input type="password" name="pwd" placeholder="password">
        </div>
        <div class="formDesign">
            <label for="passwordConfirm">Password Confirm</label>
            <input type="password" id="passwordConfirm" placeholder="confirm password" name="passwordConfirm">
        </div>
        <div>
            <button type="submit" class="Submit-btn" name="submit">Submit </button>
        </div>
    </form>
</section>
