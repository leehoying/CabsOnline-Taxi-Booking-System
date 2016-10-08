CREATE TABLE customer (
Name varchar(30) not null,
Password varchar(30) not null,
Email varchar(30) not null,
Phone int(12) not null,
PRIMARY KEY (Email)
);

CREATE TABLE booking (
bookingNo int(6) not null auto_increment,
email varchar(30) not null,
passName varchar(30) not null, 
passPhone int(12) not null, 
unitNo int(4),
streetNo int(3) not null, 
streetName varchar(20) not null, 
suburb varchar(20) not null, 
destination varchar(20) not null, 
PickupDateTime int(12) not null, 
SysDateTime timestamp not null DEFAULT current_timestamp, 
SystemStatus varchar(20) not null,
PRIMARY KEY (bookingNo),
FOREIGN KEY (email) REFERENCES customer (email)
); 
