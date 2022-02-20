<?php

	//require_once("dbconn.php");
	

	if($_SERVER["REQUEST_METHOD"] == "GET"){
		getUserData();
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		addUser();
	}
	
	if($_SERVER["REQUEST_METHOD"] == "PUT"){
		echo "put request :) ";
	}

	if($_SERVER["REQUEST_METHOD"] == "DELETE"){
		echo "delete request :) ";
	}

	//Add user to the database.
	function addUser(){
		//$id = $_POST["uid"];
		$username = $_POST["u_user"];
		$email = $_POST["u_email"];
		$pass = $_POST["u_pass"];
		$age = $_POST["u_age"];
		$mobile = $_POST["u_mobile"];
		$gender = $_POST["u_gender"];

		require_once("dbconn.php");
		$sql = "INSERT INTO `tbl_user`(`username`, `email`, `password`, `age`, `mobile`, `gender`) VALUES (?,?,?,?,?,?)";
		$stmt = mysqli_prepare($conn,$sql);
		mysqli_stmt_bind_param($stmt, "sssiss", $username, $email, $pass, $age, $mobile, $gender);
		$res = mysqli_stmt_execute($stmt);
		if($res){

			$num_rows = mysqli_stmt_affected_rows($stmt);
			if($num_rows > 0){
				$errMsg = array("Success"=>"Sucessfully added user!");
				ob_start();
				header("Content-Type:application/json");
				echo json_encode($errMsg);
				ob_end_flush();
			} else {
				$errMsg = array("Error"=>"Please check the values");
				ob_start();
				header("Content-Type:application/json");
				echo json_encode($errMsg);
				ob_end_flush();
			}
		} else {
			$errMsg = array("Error"=>"SQL Execution error");
			ob_start();
			header("Content-Type:application/json");
			echo json_encode($errMsg);
			ob_end_flush();
		}
		mysqli_close($conn);
	}

	//Fetch tbl_user data from database.
	function getUserData(){
		require_once("dbconn.php");
		
		$sql = "SELECT * FROM `tbl_user`";

		$stmt = mysqli_prepare($conn, $sql);

		$res = mysqli_stmt_execute($stmt);

		if($res){
			mysqli_stmt_store_result($stmt);	
			$num_rows = mysqli_stmt_affected_rows($stmt);	
			if($num_rows > 0){
				mysqli_stmt_bind_result($stmt,$id,$username,$email,$pass,$age,$mobile,$gender);

				$usersArr = array();
				while(mysqli_stmt_fetch($stmt)){
					$row = array();
					$row["id"] = $id;
					$row["username"] = $username;
					$row["email"] = $email;
					$row["password"] = $pass;
					$row["age"] = $age;
					$row["mobile"] = $mobile;
					$row["gender"] = $gender;

					array_push($usersArr,$row);
				}
				//var_dump($usersArr);

				ob_start();
				header("Content-Type:application/json");
				echo json_encode($usersArr, JSON_PRETTY_PRINT);
				ob_end_flush();

			} else {
				$errMsg = array("Error"=>"No records yet!");
				ob_start();
				header("Content-Type:application/json");
				echo json_encode($errMsg);
				ob_end_flush();
			}
			
		} else {
			$errMsg = array("Error"=>"SQL Execution error");
			ob_start();
			header("Content-Type:application/json");
			echo json_encode($errMsg);
			ob_end_flush();
		}
		mysqli_close($conn);
	}
?>