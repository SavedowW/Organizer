<?php
include("model.php");
include("SessionControl.php");
session_start();

$_SESSION['LAST_ACTIVITY'] = time();

$_SESSION['DBACCESS'] = new DBAccess(); 
$_SESSION['DBACCESS']->connect();

$regerror = "";
$logerror = "";

if (isset($_GET['reason']))
{
    switch ($_GET['reason'])
    {
        case 1:
            $logerror = "<font color=\"red\"><u>Incorrect login and password</u></font><br>";
            break;
        case 2:
            $logerror = "<font color=\"red\"><u>Session expired</u></font><br>";
            break;
        case 3:
            $regerror = "<font color=\"red\"><u>Registration impossible: login is already used</u></font><br>";
            break;
        case 4:
            $regerror = "<font color=\"green\"><u>Registration successful</u></font><br>";
            break;
        case 5:
            $regerror = "<font color=\"red\"><u>You should fill all registration fields</u></font><br>";
            break;
        default:
            $logerror = "<font color=\"red\"><u>Unknown problem, please relogin</u></font><br>";
            break;
    }
}

echo "<font size=\"7\"><u>Organizer</u></font><br>";

?>

<body>

<img src="img/topnep.png" width="20%" align="left" hspace="20">
<table cellspacing="50" align="left">
    <tr align="right">
        <td align="right">
            <?php echo $logerror ?>
            <form action="Sample.php" method="post">
            <p>Login: <input type="text" name="login" /></p>
            <p>Password: <input type="text" name="password" /></p>
            <p><input type="submit" value="Login"/></p>
            </form>
        </td>
        <td align="right">
            <?php echo $regerror ?>
            <form action="Register.php" method="post">
            <p>Login: <input type="text" name="login" /></p>
            <p>Password: <input type="text" name="password" /></p>
            <p>Name: <input type="text" name="name" /></p>
            <p>Last name: <input type="text" name="lastname" /></p>
            <p><input type="submit" value="Register"/></p>
            </form>
        </td>
</table>

</body>