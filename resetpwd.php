<head> 
  <title>Reset password</title> 
  </head> 
  <body>
  <H1>Reset password</H1>
  <form method="post" action ="resetpwd.php">
  <p>Please fill in your registered email.</p> 
  <table>
<tr>
	<td><label>Email:</label></td> <td><input type="text" name="email"  maxlength="30"></td><td><button type="submit" name="submit">Submit</button></td>
</tr>
  </table>
  </form>
  </body> 
<?php
 //connect to mysql server
include ('dbconnect.php');
//get password and e-mail passed from client
if (isset($_POST['submit'])) 
  {
  $email = strtolower($_POST['email']);
//check whether the user input the password and email
  if (empty($email)) {
  echo "Please fill in your email address.<br>";
    } 
//validate email
  elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
  //access date to database and search by email
  $SQLstring = "SELECT Email from customer where Email = '$email'";
  $queryResult = @mysqli_query($DBConnect, $SQLstring)
  Or die ("<p>Unable to query the table.</p>"."<p>Error code ".
  mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
      //$row= mysqli_fetch_row($queryResult);
      if (mysqli_num_rows($queryResult)) { // check email whether the member is exist
//create unique code and update database
      $activation = md5(uniqid(rand(), true));
      $updateString = "UPDATE `customer` SET Activation = '$activation' WHERE Email = '$email'";
      $updateResult = @mysqli_query($DBConnect, $updateString)
      Or die ("<p>Unable to query the table.</p>"."<p>Error code ".
      mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
//send out activation email with unique code  
            if (mysqli_affected_rows($DBConnect) > 0) {
            $email = strtolower($_POST['email']);
            $to = $email;
            $message = "You activation link is: ".'activate.php?email='.urlencode($to).'&key='.$activation;
            $subject = "Activation Link From Cabsonline";
            $header = "From booking@cabsonline.com.au";
            mail($to,$subject,$message,$header);
            echo "Please kindly check your email for the password reset instruction.<br>";
            } 
      } else {
      echo "The member is not existed. Please <a href='register.php'>register</a>.<br>";
      }
  } else { echo " Please input valid email address.<br>";
  }
mysqli_close($DBConnect); 
  }
?>
