<?php
include("model.php");
include("SessionControl.php");
session_start();
checkSession();

$_SESSION['DBACCESS']->connect();

if (strlen($_POST['regEmail']) == 0 ||
	strlen($_POST['regPass1']) == 0 ||
	strlen($_POST['regPass2']) == 0 )
{
	// Some fields are empty
	header('Location: index.php?reason=1');
	exit();
}

if ($_POST['regPass1'] != $_POST['regPass2'])
{
	// Passwords are different
	header('Location: index.php?reason=2');
	exit();
}

//Check if login and password are correct
$userdata = $_SESSION['DBACCESS']->countUsers($_POST['regEmail']);

if ($userdata > 0) // Return to login with result code
{
	//User already exist
	header('Location: index.php?reason=3');
} else {
	//Success
	$_SESSION['DBACCESS']->addUser($_POST['regEmail'], $_POST['regPass1']);
	header('Location: index.php?reason=6');
}
?>