<?php
// на какие данные рассчитан этот скрипт
header("Content-Type: application/json");

if (!isset($_GET['USER']))
{
    echo 2;
}
else
{
    // разбираем JSON-строку на составляющие встроенной командой
    $data = json_decode(file_get_contents("php://input"));

    // Загружаем данные в БД
    $_SESSION['DBACCESS']->connect();
    $_SESSION['DBACCESS']->addTask(new Task(-1, $_SESSION['USER']->ID, $data->name, $data->description, $data->priority, $data->creationDate, $data->startDate, $data->deadline));

    // отправляем в ответ строку с подтверждением
    echo 1;
}
?>