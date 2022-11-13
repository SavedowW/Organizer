<?php
session_start();

include("model.php");
include("SessionControl.php");

checkSession();

//Connect to bd
$mysqli = new mysqli("localhost", "root", "", "organizer");

//Check if login and password are correct
$userdata = getLogPass($mysqli, $_POST['login'], $_POST['password']);

if ($userdata->num_rows == 0) //Return to login if logpass are incorrect
{
	header('Location: index.php?reason=1');
}

//Parse sql result to user object
$user = User::fromSql($userdata);
?>

Greetings, <?php echo htmlspecialchars($user->name); ?>:<?php echo htmlspecialchars($user->lastName); ?>.<br><br>

<?php

$obj = array(new Task(0, 0, "Do work", "Please dont", 45, "2022-10-29", "2022-10-31", "2022-11-01"),
	new Task(1, 0, "Run", "Run. Now.", 100, "2022-11-01", "2022-11-01", "2022-11-03"),
	new Task(3, 0, "Fix stuff", "Not fixed an issue yet", 80, "2022-10-25", "2022-10-27", "2022-11-07"));

echo json_encode($obj);

include "mainpage.php";

?>