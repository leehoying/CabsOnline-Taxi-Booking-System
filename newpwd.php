<head> 
  <title>Reset password</title> 
  </head> 
  <body>
  <H1>Reset password</H1>
  <form action ="newpwd.php" method="post">
  <p>Please fill in your new password.</p> 
   <table>
<tr>
 	   <td><label>Password:</label></td> <td><input type="text" name="pwd"  maxlength="30"></td>
</tr><tr>
	   <td><label>Confirm password:</label></td> <td><input type="text" name="Cpwd"  maxlength="30"></td>
</tr><tr>
	   <td></td><td><button type="reset" value="Reset">Reset</button><button type="submit" name="submit">Submit</button></td>
</tr>
  </table>
  </form>
  </body> 
<?php
 //connect to mysql server
include ('dbconnect.php');
//retrieve session data
 session_start();
if (isset($_SESSION['useremail'])) {
   $email = $_SESSION['useremail'];
//get password and e-mail passed from client
if (isset($_POST['submit'])) 
  {
  $Cpwd = $_POST['Cpwd'];
  $pwd = $_POST['pwd'];
//validate password
  if (empty($pwd)) {
  echo "Please fill in your password.<br>";
    } elseif (empty($Cpwd)) {
  echo "Please enter a confirmation password.<br>";
  } elseif ($pwd !== $Cpwd) {
  echo "The passwords do not match. Please enter again.<br>";
  } else {
    $pwd = $_POST['Cpwd'];
//create unqiue code and update database
    $updateString = "UPDATE `customer` SET Password = '$pwd' WHERE Email = '$email'";
    $updateResult = @mysqli_query($DBConnect, $updateString)
    Or die ("<p>Unable to query the table.</p>"."<p>Error code ".
    mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
//send out activation email with unqiue code  
        if (mysqli_affected_rows($DBConnect) > 0) {
        echo "Thank you. The password has been changed. You may now <a href='login.php'>Log In</a> here."; 
        } else {
        echo " Sorry. The vertification is not success. Please go back to <a href='resetpwd.php'>reset password</a> and try again.";
        }
    mysqli_close($DBConnect);       
    } 
  }
}
?>