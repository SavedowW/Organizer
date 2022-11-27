<?php
// на какие данные рассчитан этот скрипт
header("Content-Type: application/json");
include("model.php");
include("SessionControl.php");
session_start();
checkSession();

if (!isset($_SESSION['USER']))
{
    echo 2;
}
else
{
    // разбираем JSON-строку на составляющие встроенной командой
    $data = json_decode(file_get_contents("php://input"));

    // Загружаем данные в БД
    $_SESSION['DBACCESS']->connect();
    if ($_SESSION['DBACCESS']->addTask(new Task(-1, $_SESSION['USER']->ID, $data->name, "", $data->priority, date("Y-m-d"), $data->startDate, $data->deadline)))
    {
        // успех, отправляем в ответ строку с подтверждением
        echo 1;
    }
    else
    {
        // неудача, отправляем в ответ строку с подтверждением
        echo 3;
    }

    
}
?>