<?php

define("HOST","localhost");
define("USER","root");
define("PASSWORD","root");
define("DATABASE","gamesdb");

$conn = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or 
		die("Couldnt connect to the database");
?>