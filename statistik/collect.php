<?php
	$servername = "wp365.webpack.hosteurope.de";
	$username = "db11022769-lbsta";
	$password = "V5kEmzK34GRgPrjm";
	$dbname = "db11022769-loxberrystats";
	$tablename = "lbusage";
	// CREATE SCHEMA `lbstatistic` DEFAULT CHARACTER SET utf8 ;
	// CREATE TABLE `lbstatistic`.`lbusage` ( `currtime` DATETIME NOT NULL, `uid` VARCHAR(130) NOT NULL, `version` VARCHAR(10) NULL, PRIMARY KEY (`currtime`, `uid`));
	// POST or GET. GET is easier to test.
	// $data = $_POST;
	$data = $_GET;
	$uid = htmlspecialchars(trim($data['id']));
	$version = htmlspecialchars(trim($data['version']));
	$ver_major = htmlspecialchars(trim($data['ver_major']));
	$ver_minor = htmlspecialchars(trim($data['ver_minor']));
	$ver_sub = htmlspecialchars(trim($data['ver_sub']));

	if (empty($uid)) {
		echo ("No UID received.<br>");
		exit (1);
	}
	echo "Values: UID: $uid Version: $version<br>";

	// DB Connection
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    echo ("Connection failed: " . $conn->connect_error);
	    exit (1);
	}
	$sql = "INSERT INTO $tablename (currtime, uid, version, ver_major, ver_minor, ver_sub) VALUES (NOW(), '$uid', '$version', '$ver_major', '$ver_minor', '$ver_sub');";
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully<br>";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
	    exit(1);
	}
	$conn->close();
?>
