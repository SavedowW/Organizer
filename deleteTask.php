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

    $taskID = (int)$data->ID;

    // Загружаем данные в БД
    $_SESSION['DBACCESS']->connect();

    $ownerID = $_SESSION['DBACCESS']->getTaskOwner($taskID);
    if ($ownerID != $_SESSION['USER']->ID)
    {
        // Пользователь пытается удалить не свою или не сохраненную задачу
        echo 3;
    }
    else if ($_SESSION['DBACCESS']->deleteTask($data->ID))
    {
        // успех, отправляем в ответ строку с подтверждением
        echo 1;
    }
    else
    {
        // неудача, отправляем в ответ строку с подтверждением
        echo 4;
    }

    
}
?>