<?php
// на какие данные рассчитан этот скрипт
header("Content-Type: application/json");
include("model.php");
include("SessionControl.php");
session_start();
checkSession();

if (!isset($_SESSION['USER']))
{
    echo -2;
}
else
{
    // разбираем JSON-строку на составляющие встроенной командой
    $data = json_decode(file_get_contents("php://input"));

    // Загружаем данные в БД
    $_SESSION['DBACCESS']->connect();
    $res = $_SESSION['DBACCESS']->addTask(new Task($data->ID, 0, $data->name, "", $data->priority, date("Y-m-d"), $data->startDate, $data->deadline));
    echo $res;
}
?>