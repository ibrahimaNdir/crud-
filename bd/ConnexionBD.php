<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tdetudiantdevopscrud";

try {

  $db = new PDO("mysql: host=$servername;dbname=$dbname", $username, $password);
    
  // set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //echo "<br>Connected successfully<br>";
} catch (PDOException $e) {
  echo "<br>Connection failed:<br>" . $e->getMessage();
  include_once 'pages/erreurConnexion.php';
}
//echo "<br>Continue vers la site";
