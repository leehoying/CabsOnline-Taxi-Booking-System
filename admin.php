  <head> 
  <title>Admin page</title> 
  </head> 
  <body>
  <H1>Admin page of CabsOnline</H1>

  <form action ="admin.php" method="post">

<p><b>1. Click below button to search for all unassigned booking requests with a pick-up time within 2 hours</b><br></p>
	   <input type="submit" name="listall"  value="List all"><br>
  
<?php 
 //connect to mysql server
include ('dbconnect.php');
  session_start();
  if (isset($_SESSION['useremail'])) {
   $email = $_SESSION['useremail'];
  } else {
  echo "Sorry that we could not find your infomation. You will be direct to the <a href='login.php'>Log In</a> page soon."; 
  sleep(3);
  $URL="login.php";  
  header ("Location: $URL");
  }
  
//access the database
if (isset($_POST['listall'])) 
	{
	$SQLstring = "SELECT booking.bookingno, customer.Name, booking.passname, booking.passphone, booking.unitno, booking.streetno, booking.streetname, booking.suburb, 
	booking.destination, booking.PickupDateTime, booking.Systemstatus from booking join customer on booking.email = customer.email 
	where (booking.Systemstatus = 'unassigned' and timestampdiff(Hour ,CURRENT_TIMESTAMP, `PickupDateTime`)<=2 )"; 
    	$queryResult = @mysqli_query($DBConnect, $SQLstring)
                    Or  die("<p>Unable to query the inventory table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
    
    echo "<table width='100%' border='1'>";
    echo "<th>reference#</th><th>customer name</th><th>passenger name</th><th>passenger contact phone</th><th>pick-up address</th><th>destination suburb</th><th>pick-time</th>";
            $row = mysqli_fetch_row($queryResult);
            
            while ($row)
            {	  echo "<tr><td>{$row[0]}</td>";
                echo "<td>{$row[1]}</td>";
                echo "<td>{$row[2]}</td>";
                echo "<td>{$row[3]}</td>";
                echo "<td>{$row[4]}/{$row[5]} {$row[6]}, {$row[7]}</td>";
 		  echo "<td>{$row[8]}</td>";
		  echo "<td>".date('d M H:i', strtotime($row[9]));
			echo"</td></tr>";
                $row = mysqli_fetch_row($queryResult); 
            }
        echo "</table>";

        // close the connection
        mysqli_close($DBConnect);
	
}
?>

<p><b>2. Input a reference number below and click "update" button to assign a taxi to that request</b><br><br></p>
<p>Reference number : <input type="text" name="refno"></p>
<input type="submit" name="update"  value="update"><br>

<?php
//access the database
if (isset($_POST['update'])) 
	{
	$ref = $_POST['refno'];
	$SQL = "UPDATE booking set systemstatus = 'assigned' where (bookingno = '$ref' and systemstatus = 'unassigned')";
	$queryResult = @mysqli_query($DBConnect, $SQL);
		if (mysqli_affected_rows($DBConnect) == 1){
		echo "The booking request ".$ref." has been properly assigned.";
		} else {
		echo "No unassigned booking request is found.";
		}        

// close the connection
        mysqli_close($DBConnect);
}
?>	
  
  </form>
    <a href="logout.php">Log Out</a><br><br>
  </body>
