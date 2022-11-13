<?php
include("model.php");
include("SessionControl.php");
session_start();
checkSession();

$_SESSION['DBACCESS']->connect();

if (strlen($_POST['login']) == 0 ||
	strlen($_POST['password']) == 0 ||
	strlen($_POST['name']) == 0 || 
	strlen($_POST['lastname']) == 0)
{
	header('Location: index.php?reason=5');
	exit();
}

//Check if login and password are correct
$userdata = $_SESSION['DBACCESS']->countUsers($_POST['login']);

if ($userdata > 0) // Return to login with result code
{
	//User already exist
	header('Location: index.php?reason=3');
} else {
	//Success
	$_SESSION['DBACCESS']->addUser($_POST['login'], $_POST['password'], $_POST['name'], $_POST['lastname']);
	header('Location: index.php?reason=4');
}
?>