<!DOCTYPE html>
<html>

<?php
if (isset($_POST['submit'])) {
    $servername = 'localhost';
    $serverusername = 'root';
    $serverpassword = '';
    $serverdatabase = 'websitedata';
    $servertable = 'logindata';
    $conn = mysqli_connect($servername, $serverusername, $serverpassword, $serverdatabase);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT username, password FROM $servertable WHERE username=? AND password=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    
    if ($count > 0) {
        echo "Database check Validated! Welcome $username!";
        header("Location: upload.html");
    } else {
        echo "Error: Your credentials could not be found in the database.";
    }
} else {
?>
<head>
    <p> Upload a File Here </p>
</head>
<body>
    <form action="dashboard.php" method="post">
        Username: <input type="text" name="username"><br><br>
        Password: <input type="password" name="password"><br><br>
        <input type="submit" name="submit" value="Login">
    </form>
</body>
<?php
}
?>
</html>
