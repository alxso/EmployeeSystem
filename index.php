<!DOCTYPE html>
<html>

<head>
	<title>Employee System</title>
	<meta http-equiv="Content-Type" content="text/html" ; charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style/main.css">

</head>

<!--NAVIGATION BAR-->
<nav>
	<ul>
		<li class="menu"><a href="index.php">Add</a></li>
		<li class="menu"><a href="employees.php">Employees</a></li>
	</ul>
</nav>

<!--PAGE CONTENT-->

<body>
	<h1>Add Employee</h1>
	<br>* Mandatory to fill.
	<form name="form" action="index.php" method="POST">
		<br><label for="fname">First Name: *</label><br>
		<input type="text" id="fname" name="fname" placeholder="Your First Name" required><br>
		<label for="mname">Middle Name:</label><br>
		<input type="text" id="mname" name="mname" placeholder="Your Middle Name"><br>
		<label for="lname">Last Name: *</label><br>
		<input type="text" id="lname" name="lname" placeholder="Your Last Name" required><br>
		<label for="email">Email: *</label><br>
		<input type="email" id="email" name="email" placeholder="e.g. issoys@ttu.ee" required><br>
		<label for="phone">Phone:</label><br>
		<input type="tel" id="phone" name="phone" placeholder="e.g. 372-530-9999" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"><br>
		<label for="hiredate">Hire Date: *</label><br>
		<input type="date" id="hiredate" name="hiredate" required><br><br>
		<input type="submit" name="submitbutton" value="Submit">
	</form><br>

	<!--MYSQL Connection and Update-->
	<?php
	/*
		MYSQL DB in localhost
		username:root
		password:null
		port:3305

		Queries:

			CREATE database employee_db;

			USE employee_db;

			CREATE TABLE persons (
			id int UNSIGNED  PRIMARY KEY AUTO_INCREMENT,
			fname VARCHAR(30) NOT NULL,
			mname VARCHAR(30),
			lname VARCHAR(30) NOT NULL,
			email VARCHAR(50) NOT NULL,
			phone VARCHAR(50),
			hiredate VARCHAR(50) NOT NULL
			)AUTO_INCREMENT=1000;

			LOAD DATA INFILE 'data.csv' 
			INTO TABLE persons 
			FIELDS TERMINATED BY ',' 
			ENCLOSED BY '"'
			LINES TERMINATED BY '\n'
			IGNORE 1 ROWS;

		*/
	if (isset($_POST["submitbutton"])) {
		$link = mysqli_connect("localhost", "root", "", "employee_db", 3305);

		if ($link === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		$fname = mysqli_real_escape_string($link, $_REQUEST['fname']);
		$mname = mysqli_real_escape_string($link, $_REQUEST['mname']);
		$lname = mysqli_real_escape_string($link, $_REQUEST['lname']);
		$email = mysqli_real_escape_string($link, $_REQUEST['email']);
		$phone = mysqli_real_escape_string($link, $_REQUEST['phone']);
		$hiredate = mysqli_real_escape_string($link, $_REQUEST['hiredate']);

		if ((strtotime($hiredate) ? true : false) and (explode("/", $hiredate)[0] <= 2099 ? true : false)
			and (preg_match("/^[- '\p{L}]+$/u", $fname) == 1 ? true : false)
			and ($mname != "" ? (preg_match("/^[- '\p{L}]+$/u", $mname) == 1 ? true : false) : true)
			and (preg_match("/^[- '\p{L}]+$/u", $lname) == 1 ? true : false)
		) {

			$sql = "INSERT INTO persons (fname, mname, lname, email, phone, hiredate) VALUES ('$fname', '$mname','$lname','$email','$phone','$hiredate')";

			if (mysqli_query($link, $sql)) {
				echo "Records added successfully.";
			} else {
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			}
		} else {
			print("Enter the parameters correctly");
		}
		mysqli_close($link);
	}
	?>
</body>

</html>