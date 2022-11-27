<?php
include("model.php");
include("SessionControl.php");
session_start();
checkSession();

$_SESSION['DBACCESS']->connect();

echo $_POST['user']."<br>";
echo $_POST['pass']."<br>";

//Check if login and password are correct
$userdata = $_SESSION['DBACCESS']->getLogPass($_POST['user'], $_POST['pass']);

if ($userdata->num_rows == 0) //Return to login if logpass are incorrect
{
	header('Location: index.php?reason=5');
	exit();
}

// Get sql data
$_SESSION['USER'] = User::fromSql($userdata);
$_SESSION['TASKS'] = Task::fromSql($_SESSION['DBACCESS']->getUserTasks($_SESSION['USER']->ID));
header('Location: index.php?reason=4');
exit();

?>

<?php
$obj = Task::fromSql($_SESSION['DBACCESS']->getUserTasks($user->ID));

echo json_encode($obj);

include "mainpage.php";

?>