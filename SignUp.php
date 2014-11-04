<!DOCTYPE html>
<html>

<head>
<title>Sign Up</title>
</head>

<body>

<?php

//Variables passed as arguments to connect to the MySQL database
$uname = "dcsp08";
$pword = "ab1234";
$hostname = "pluto.cse.msstate.edu:3306";	
$con = mysqli_connect($hostname,$uname,$pword,$uname);

// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

//Variables received from HTML form
$netID = $_POST['StudentNetID'];
$password = $_POST['StudentPassword'];
$firstname = $_POST['StudentFirstName'];
$lastname = $_POST['StudentLastName'];


//Verify that the corresponding text fields contained information when submitted
//Provides a link to the HTML form if the text field was left blank
if($netID == "")
{
	echo "<p> Please input a netID! </p>";
	echo "<a href='SignUp.html'>Go back</a>";
	
}

if($password == "")
{
	echo "<p> Please input a password! </p>";
	echo "<a href='SignUp.html'>Go back</a>";

}

if($firstname == "")
{
	echo "<p> Please input a first name!</p>";
	echo "<a href='SignUp.html'>Go back</a>";

}

if($lastname == "")
{
	echo "<p> Please input a last name!</p>";
	echo "<a href='SignUp.html'>Go back</a>";

}

//Create email variable from netID
$email = ($netID . "@msstate.edu");


//Query the database to receive all the usernames currently in the User table
$result = mysqli_query($con, "SELECT Email FROM User");

//Parse the results from the query
while($row = mysqli_fetch_array($result))
{
	//Test whether the username provided by the user is already in use
	if($row['Email'] == $netID)
	{
		echo "<p> That netID is already associated with an account.  A netID may be associated with only one account </p>";
		echo "<a href='SignUp.html'>Go back</a>";

	}
	
}

//Create query used to add user and required information to database
$query = "INSERT INTO User (email, password, firstname, lastname) VALUES ('" . $email . "', '" . MD5($password) . "', '" . $firstname . "' '" . $lastname . "')";

//Send the add user query
mysqli_query($con, $query);

//Close the connection
mysqli_close($con);



?>

</body>

</html>
