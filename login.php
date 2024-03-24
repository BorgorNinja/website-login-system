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

    //insert data into DB
    mysqli_query($conn, "insert into logindata(username,password) values ('$username','$password')");

    echo "Registered Successful";
    header("Location: db_check.php");
} else {
?>
    <form action="" method="post">
        Username: <input type="text" name="username"><br><br>
        Password: <input type="password" name="password"><br><br>
        <input type="submit" name="submit" value="Register">
    </form>
    <a href="update.php"><p>Update your password here</p></a>

    <p>Already Registered? Go to the <a href="dashboard.php">Dashboard!</a> </p>
<?php
}
?>
</html>