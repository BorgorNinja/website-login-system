<!DOCTYPE html>
<html>
<title>Login Form Test</title>

<?php

if (isset($_POST['submit'])) {
    $servername = 'localhost';
    $serverusername = 'root';
    $serverpassword = '';
    $serverdatabase = 'websitedata';

    $conn = mysqli_connect($servername, $serverusername, $serverpassword, $serverdatabase);
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    $data = "Username: " . $username . " | Password: " . $password . "\n";
    //insert data into DB
    mysqli_query($conn, "update logindata set password='$password' where username='$username'");

  
    echo "Update successful. Redirecting to the login page.";
    header( "refresh:2;url=login.php" );
} else {
?>
    <form action="" method="post">
        To Update your password please enter your current username and your new password here.
        Current Username: <input type="text" name="username"><br><br>
        New Password: <input type="password" name="password"><br><br>
        <input type="submit" name="submit" value="Login">
    </form>
<?php
}
?>
</html>