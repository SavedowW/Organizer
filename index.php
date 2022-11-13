<?php
session_start();

$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_GET['reason']))
{
    switch ($_GET['reason'])
    {
        case 1:
            echo "<font size=\"5\"><u>Incorrect login and password</u></font><br>";
            break;
        case 2:
            echo "<font size=\"5\"><u>Session expired</u></font><br>";
            break;
        default:
            echo "<font size=\"5\"><u>Unknown problem, please relogin</u></font><br>";
            break;
    }
}
else
{
    echo "<font size=\"5\"><u>Came to the page naturally</u></font><br>";
}

?>

<img src="img/topnep.png" width="20%" align="left" hspace="20">
<form action="Sample.php" method="post">
 <p>Login: <input type="text" name="login" /></p>
 <p>Password: <input type="text" name="password" /></p>
 <p><input type="button" value="Login"/></p>
 <p><input type="button" value="register"/></p>
</form>

<script>
    const button = document.querySelector('input');
    const paragraph = document.querySelector('p');
    button.addEventListener('click', updateButton);
</script>