<?php
/*
    Обновление таска

    Нужен json data, содержащий:
    ID (задачи)
    name
    priority
    startDate
    deadline

    Возвращает:
    1 - все прошло успешно
    2 - не залогинен
    3 - пользователь пытается обновить не свою задачу
    4 - что-то пошло не так
*/

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


    $ownerID = $_SESSION['DBACCESS']->getTaskOwner($taskID);
    if ($ownerID != $_SESSION['USER']->ID)
    {
        // Пользователь пытается удалить не свою или не сохраненную задачу
        echo 3;
    }

    // Загружаем данные в БД
    $_SESSION['DBACCESS']->connect();
    if ($_SESSION['DBACCESS']->updateTask(new Task($data->ID, 0, $data->name, "", $data->priority, date("Y-m-d"), $data->startDate, $data->deadline))) {
        return 1;
    } else {
        return 4;
    }
    
}
?>