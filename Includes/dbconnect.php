<?php
$DBHOST = 'localhost';
$DBUSERNAME = 'root';
$DBPASSWORD = '';
$DBNAME = 'Pharcourts';

//Connect and select the database
$dbconnect = new mysqli($DBHOST, $DBUSERNAME, $DBPASSWORD, $DBNAME);

//Test if database connects
if ($dbconnect->connect_error) {
  die("Connection failed: " . $dbconnect->connect_error);
}else{
  // echo "Database Connection SUCCESSFUL";
}
