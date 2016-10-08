<?php
session_start();
unset($_SESSION ['useremail']);
session_destroy();
$URL="login.php";  
header ("Location: $URL"); 
exit; 
?>
