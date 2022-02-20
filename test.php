<?php

$num1 = 500.67;
$num2 = 489;
$total = $num1 + $num2;

	//var_dump($total);
 //echo "Total : ".$total;

 //Array

 //$names = ["Isuru", "Shafra", "Amna", 50.5];
 $names = array("Isuru", "Shafra", "Amna", 50.5);
 $student = ["name"=>"Prabalini", "gender"=>"female", "age"=>23];

$cars = array();
$cars[0] = "Toyota";

 //var_dump($names);

 for($i=0; $i<count($names); $i++){


	echo "<p>Name : ".$names[$i]."</p>";

 }

$students = [
		["name"=>"Prabalini", "gender"=>"female", "age"=>23],
		["name"=>"Nadheer", "gender"=>"male", "age"=>23],
		["name"=>"Reeza", "gender"=>"male", "age"=>21]
	];

	foreach($students as $student){
		echo $student["name"]."</br>";
	}

?>