<?php
session_start();

include("model.php");
include("SessionControl.php");

checkSession();

if (strlen($_POST['login']) == 0 ||
	strlen($_POST['password']) == 0 ||
	strlen($_POST['name']) == 0 || 
	strlen($_POST['lastname']) == 0)
{
	header('Location: index.php?reason=5');
	exit();
}

//Connect to bd
$mysqli = new mysqli("localhost", "root", "", "organizer");

//Check if login and password are correct
$userdata = countUsers($mysqli, $_POST['login']);

if ($userdata > 0) // Return to login with result code
{
	//User already exist
	header('Location: index.php?reason=3');
} else {
	//Success
	addUser($mysqli, $_POST['login'], $_POST['password'], $_POST['name'], $_POST['lastname']);
	header('Location: index.php?reason=4');
}
?>