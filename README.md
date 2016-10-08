# CabsOnline-Taxi-Booking-System
Web Application Development using embedded PHP and MySQL only

The assignment is to develop a web-based taxi booking system called CabsOnline. CabsOnline allows passengers to book taxi services from any of their internet connected computing devices. Three major components are customer registration/login, online booking and administration.


dbconnect.php - configure username and password connecting to MySQL database.

mysql.sql- import file for creating tables.

register.php – verifying whether the users’ input data matching to the requirements.  Email is the primary key to check whether the user is existing in database. After registration, client will be directed to login page.

login.php - verifying whether the users’ input data matching to the requirements. The data will then be checked whether it is matching in the database. After that, client will be directed to booking page.

resetpwd.php – Once the input email is matched in the database, the system will create an unique code and update database.  An activation email with unique code link will be sent to the required email. 

activate.php – verifying whether email and unique code are matching in the database. Once the data is matched, the unique code will be erased in the database and new password input page will be loaded. 

newpwd.php – New password will be double confirmed and then stored in the database. The login page is then loaded.

booking.php - verifying whether the users’ input data matching to the requirements. The data will then be recorded in the database unless the booking is 1 hour before the pick-up time. In the meantime, a confirmation email with system generated booking number is sent to the user’s registered email. 
(bootstrap datepicker css and javascript are suggested to use in the booking form, but the files are not included here.)

admin.php – The administrator logs into the system through login page. The role will be recognised through the database backend configuration. The administration page is loaded once the administrator logins successfully. 
Two functions are available: 
1.	A button to search for all unassigned booking requests with a pick-up time within 2 hours.
2.	An update button with a booking reference number input to update the system that the booking is being assigned.

logout.php -  To clear user’s email in the session and go back to the login page.



