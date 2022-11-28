<?php
include("model.php");
include("SessionControl.php");
session_start();
checkSession();

session_unset();
header('Location: index.php');

?>