 <?php
 //connect to mysql server
$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "cabsonline";
$DBConnect = @mysqli_connect($servername, $username, $password, $database)
                                 Or die ("<p>Unable to connect to the database server.</p>".
                                         "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";
?>
