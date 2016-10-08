<?php
 //connect to mysql server
include ('dbconnect.php');

$email = $_GET['email'];
$key = $_GET['key'];

//access date to database and search by email
	$SQLstring = "SELECT * from customer where Email = '$email'";
	$queryResult = @mysqli_query($DBConnect, $SQLstring)
	Or die ("<p>Unable to query the table.</p>"."<p>Error code ".
	mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
			$row= mysqli_fetch_row($queryResult);
			if ($email !== $row[2]) { // check email whether the member is exist
			echo "The member is not existed. Please register.<br>";
			}
			elseif ($key == $row[4]) { //check whether the password is matched 
				      $updateString = "UPDATE `customer` SET Activation = NULL WHERE Email = '$email'";
				      $updateResult = @mysqli_query($DBConnect, $updateString)
				      Or die ("<p>Unable to query the table.</p>"."<p>Error code ".
				      mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
			echo "The vertification is success. You will be directed to the reset password page shortly."; 
			sleep(3);
			//store session data
			ob_start();
			session_start();
			$_SESSION ['useremail'] =  $email;
			session_write_close();	

			$URL="newpwd.php";  
			header ("Location: $URL"); 
			exit; 
			} else {
			echo " Sorry. The vertification is not success. Please go back to <a href='resetpwd.php'>reset password</a> and try again.";
			}
mysqli_close($DBConnect); 

?>

