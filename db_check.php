<!DOCTYPE html>
<html>
<head>
    
<?php
    $servername = 'localhost';
    $serverusername = 'root';
    $serverpassword = '';
    $serverdatabase = 'websitedata';
    $servertable = 'logindata';
    $conn = mysqli_connect($servername, $serverusername, $serverpassword, $serverdatabase);
    $result = mysqli_query($conn, 'SELECT * from logindata');
    $tabledata = mysqli_fetch_all($result);

?>
<p>Database</p>
<table border="1">
        <tr>
            <?php foreach ($tabledata as $row): ?>
       <td> <?= $row[0]; ?></td>
       <td> <?= $row[1]; ?></td>

</tr>
<?php endforeach ?>
            </table>


</head>
<p> Don't see your credentials in here? <a href="login.php"> Register Now!</a> </p>
</html>