<?php
function checkSession()
{
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
        header('Location: index.php?reason=2');
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp    
}

function getLogPass(mysqli &$mysqli, string $login, string $password)
{
    $req = $mysqli->prepare("SELECT ID, Login, Password, Name, LastName FROM user WHERE login=? AND password=?;");

    $req->bind_param("ss", $login, $password);
    $req->execute();
    return $req->get_result();
}

function countUsers(mysqli &$mysqli, string $login)
{
    $req = $mysqli->prepare("SELECT count(ID) FROM user WHERE login=?;");

    $req->bind_param("s", $login);
    $req->execute();
    return (int)$req->get_result()->fetch_row()[0];
}

function addUser(mysqli &$mysqli, string $nLogin, string $nPassword,
    string $nName, string $nLastName)
{
    $req = $mysqli->prepare("Insert into `user` (Login, Password, Name, LastName, RightsID) values (?, ?, ?, ?, 1);");

    $req->bind_param("ssss", $nLogin, $nPassword, $nName, $nLastName);
    $req->execute();
}
?>