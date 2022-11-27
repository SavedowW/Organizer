<!DOCTYPE html>
<html lang="en">


<?php
include("model.php");
include("SessionControl.php");
session_start();

$_SESSION['LAST_ACTIVITY'] = time();

$_SESSION['DBACCESS'] = new DBAccess(); 
$_SESSION['DBACCESS']->connect();

if (isset($_GET['reason']))
{
    echo "reason ".$_GET['reason']."<br>";
}

?>

<div id="dom-tasks" style="display: none;">
    <?php
        if (isset($_GET['reason']) && $_GET['reason'] == 4)
        {
            $output = json_encode($_SESSION['TASKS']);
            echo htmlspecialchars($output);
        }
    ?>
</div>
<div id="dom-user" style="display: none;">
    <?php
        if (isset($_GET['reason']) && $_GET['reason'] == 4)
        {
            $output = json_encode($_SESSION['USER']);
            echo htmlspecialchars($output);
        }
    ?>
</div>

<script>
    var div = document.getElementById("dom-target");
    var myData = div.textContent;
</script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.b ootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/styles.css">
    <title>Органайзер</title>
</head>
<body>
    <div class="service-content">
        <header id="serviceHeader">
            <nav class="primary nav-main">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div class="logo-block"></div>
                                <h1>Онлайн органайзер</h1>
                            </td>
                            <td>
                                <a href="#" id="admin-menu" class="admin-menu">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </nav>
        </header>
        <div class="fullscreen">
            <div id="personalgoalsframe">
                <table>
                    <tbody>
                        <tr>
                            <td width = "100%">
                                <div id="tabsmain">
                                    <ul class="ui-tabs">
                                        <li class="ui-state-default">
                                            <a href="#" id="taskBut">
                                                <div class="icon" title="Дела"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bibi-card-list" viewBox="0 0 16 16">
                                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                                  </svg> Дела</div>
                                                    
                                            </a>
                                        </li>
                                        <li class="ui-state-default">
                                            <a href="#" id="priorBut">
                                                <div class="icon" title="Приоритеты"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bibi-bar-chart-line" viewBox="0 0 16 16">
                                                    <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"/>
                                                  </svg> Приоритеты</div>
                                                 
                                            </a>
                                        </li>
                                        <li class="ui-state-default">
                                            <a href="#" id="urgBut">
                                                <div class="icon" title="Важно-Срочно"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bibi-border-all" viewBox="0 0 16 16">
                                                    <path d="M0 0h16v16H0V0zm1 1v6.5h6.5V1H1zm7.5 0v6.5H15V1H8.5zM15 8.5H8.5V15H15V8.5zM7.5 15V8.5H1V15h6.5z"/></svg> Важно-Срочно</div>
                                                 
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="tabs-tasks" class="ui-tabs-panel" style="display: grid;">
                                        <div id="tasks" item-name="Дело" >
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="w100">
                                                            <p class="new-user-help">Составьте список дел, которые вам нужно выполнить</p>
                                                            <table class="newTask new-item">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <input class="newTaskName" id="newTaskName" x-webkit-speech speech title="Название нового дела" placeholder="Введите название нового дела" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"> 
                                                                        </td>
                                                                        <td>
                                                                            <button class="addNewtaskbtn" id="addNewTaskBtn">Добавить дело</button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div id="item-conteiner">
                                                                <ul id="tasksList" class="tasksList">
                                                                    <li class="taskItem" id="task item" style="display: none;">
                                                                        <table class="taskLine">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="selection" style="display: none;">
                                                                                        <input type="checkbox">
                                                                                    </td>
                                                                                    <td class="td-name-cell">
                                                                                        <p id="taskName"></p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p id="taskBegin" style="display: none;"></p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p id="taskDeadLine" style="display: none;"></p>
                                                                                    </td>
                                                                                    <td id="taskPriority" style="display: none;">0</td>
                                                                                    <td>
                                                                                        <div id="state-done" title="Отметить дело, как выполненое"></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href="#" id="taskSettingsBtn" onclick="settingsBtn(this);">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                                                                <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                                                              </svg>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td style="position: absolute;">
                                                            <div class="taskSettingsContainer">
                                                                <div id="taskSettingsPanel" style="display: block;">
                                                                    <p style="font-size: 24px;">Настройки выбранного дела</p>
                                                                    <table style="margin-top: 30px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><p>Название дела</p></td>
                                                                                <td><p id="taskNameSet"></p></td>
                                                                            </tr>
                                                                            <tr style="height: 50px;">
                                                                                <td>От</td>
                                                                                <td><input type="date" name="Начало" id="startTask"> до</td>
                                                                                <td><input type="date" name="Конец" id="endTask"></td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr style="height: 50px;">
                                                                                <td style="padding-top: 15px;"><p>Приоритет</p></td>
                                                                                <td><select name="Приоритет" id="prioritySettings">
                                                                                    <option value="low">Низкий</option>
                                                                                    <option value="medium">Средний</option>
                                                                                    <option value="hight">Высокий</option>
                                                                                </select></td>
                                                                            </tr>
                                                                            <tr style="height: 100px;">
                                                                                <td><button id="saveSettingsBtn">Сохранить</button></td>
                                                                                <td><button id="deleteSettingsBtn">Удалить</button></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="tabs-priorities" class="ui-tabs-panel" style="display:none;">
                                        <div id="priorities" >
                                            <div class="emptyform" style="display: block;">
                                                <h3>Нет дел для приоритизации</h3>
                                                <p>Добавьте их на вкладке дела</p>
                                            </div>
                                            <div class="form" style="display: none;">
                                                <div class="comparers">

                                                </div>
                                                <table class="priority-tasks">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="task-material-item">
                                                                    <div class="scroll-container" style="display: none;">
                                                                        <table>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tabs-urgensy" class="ui-tabs-panel" style="display: none;">
                                        <div id="urgency" >
                                            <div id="urgency-box" class="scroll-container">
                                                <table class="urgency-table">
                                                    <colgroup>
                                                        <col span="1" style="width: 7.7%;">
                                                        <col span="1" style="width: 7.7%;">
                                                        <col span="1" style="width: 7.7%;">
                                                        <col span="1" style="width: 7.7%;">
                                                        <col span="1" style="width: 7.7%;">
                                                        <col span="1" style="width: 7.7%;">
                                                        <col span="1" style="width: 7.7%;">
                                                        <col span="1" style="width: 7.7%; background-color: rgba(104, 104, 104, 0.747);">
                                                        <col span="1" style="width: 7.7%;">
                                                        <col span="1" style="width: 7.7%;">
                                                        <col span="1" style="width: 7.7%;">
                                                        <col span="1" style="width: 7.7%;">
                                                        <col span="1" style="width: 7.7%;">
                                                     </colgroup>
                                                    <tbody>
                                                        <tr>
                                                            <td rowspan="12">В<br>а<br>ж<br>н<br>о<br>с<br>т<br>ь</td>
                                                            <td>10</td>
                                                            <td c-i="10" c-u="0"></td>
                                                            <td c-i="10" c-u="1"></td>
                                                            <td c-i="10" c-u="2"></td>
                                                            <td c-i="10" c-u="3"></td>
                                                            <td c-i="10" c-u="4"></td>
                                                            <td c-i="10" c-u="5"></td>
                                                            <td c-i="10" c-u="6"></td>
                                                            <td c-i="10" c-u="7"></td>
                                                            <td c-i="10" c-u="8"></td>
                                                            <td c-i="10" c-u="9"></td>
                                                            <td c-i="10" c-u="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>9</td>
                                                            <td c-i="9" c-u="0"></td>
                                                            <td c-i="9" c-u="1"></td>
                                                            <td c-i="9" c-u="2"></td>
                                                            <td c-i="9" c-u="3"></td>
                                                            <td c-i="9" c-u="4"></td>
                                                            <td c-i="9" c-u="5"></td>
                                                            <td c-i="9" c-u="6"></td>
                                                            <td c-i="9" c-u="7"></td>
                                                            <td c-i="9" c-u="8"></td>
                                                            <td c-i="9" c-u="9"></td>
                                                            <td c-i="9" c-u="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>8</td>
                                                            <td c-i="8" c-u="0"></td>
                                                            <td c-i="8" c-u="1"></td>
                                                            <td c-i="8" c-u="2"></td>
                                                            <td c-i="8" c-u="3"></td>
                                                            <td c-i="8" c-u="4"></td>
                                                            <td c-i="8" c-u="5"></td>
                                                            <td c-i="8" c-u="6"></td>
                                                            <td c-i="8" c-u="7"></td>
                                                            <td c-i="8" c-u="8"></td>
                                                            <td c-i="8" c-u="9"></td>
                                                            <td c-i="8" c-u="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>7</td>
                                                            <td c-i="7" c-u="0"></td>
                                                            <td c-i="7" c-u="1"></td>
                                                            <td c-i="7" c-u="2"></td>
                                                            <td c-i="7" c-u="3"></td>
                                                            <td c-i="7" c-u="4"></td>
                                                            <td c-i="7" c-u="5"></td>
                                                            <td c-i="7" c-u="6"></td>
                                                            <td c-i="7" c-u="7"></td>
                                                            <td c-i="7" c-u="8"></td>
                                                            <td c-i="7" c-u="9"></td>
                                                            <td c-i="7" c-u="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>6</td>
                                                            <td c-i="6" c-u="0"></td>
                                                            <td c-i="6" c-u="1"></td>
                                                            <td c-i="6" c-u="2"></td>
                                                            <td c-i="6" c-u="3"></td>
                                                            <td c-i="6" c-u="4"></td>
                                                            <td c-i="6" c-u="5"></td>
                                                            <td c-i="6" c-u="6"></td>
                                                            <td c-i="6" c-u="7"></td>
                                                            <td c-i="6" c-u="8"></td>
                                                            <td c-i="6" c-u="9"></td>
                                                            <td c-i="6" c-u="10"></td>
                                                        </tr>
                                                        <tr style=" background-color: rgba(104, 104, 104, 0.747);">
                                                            <td>5</td>
                                                            <td c-i="5" c-u="0"></td>
                                                            <td c-i="5" c-u="1"></td>
                                                            <td c-i="5" c-u="2"></td>
                                                            <td c-i="5" c-u="3"></td>
                                                            <td c-i="5" c-u="4"></td>
                                                            <td c-i="5" c-u="5"></td>
                                                            <td c-i="5" c-u="6"></td>
                                                            <td c-i="5" c-u="7"></td>
                                                            <td c-i="5" c-u="8"></td>
                                                            <td c-i="5" c-u="9"></td>
                                                            <td c-i="5" c-u="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td c-i="4" c-u="0"></td>
                                                            <td c-i="4" c-u="1"></td>
                                                            <td c-i="4" c-u="2"></td>
                                                            <td c-i="4" c-u="3"></td>
                                                            <td c-i="4" c-u="4"></td>
                                                            <td c-i="4" c-u="5"></td>
                                                            <td c-i="4" c-u="6"></td>
                                                            <td c-i="4" c-u="7"></td>
                                                            <td c-i="4" c-u="8"></td>
                                                            <td c-i="4" c-u="9"></td>
                                                            <td c-i="4" c-u="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td c-i="3" c-u="0"></td>
                                                            <td c-i="3" c-u="1"></td>
                                                            <td c-i="3" c-u="2"></td>
                                                            <td c-i="3" c-u="3"></td>
                                                            <td c-i="3" c-u="4"></td>
                                                            <td c-i="3" c-u="5"></td>
                                                            <td c-i="3" c-u="6"></td>
                                                            <td c-i="3" c-u="7"></td>
                                                            <td c-i="3" c-u="8"></td>
                                                            <td c-i="3" c-u="9"></td>
                                                            <td c-i="3" c-u="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td c-i="2" c-u="0"></td>
                                                            <td c-i="2" c-u="1"></td>
                                                            <td c-i="2" c-u="2"></td>
                                                            <td c-i="2" c-u="3"></td>
                                                            <td c-i="2" c-u="4"></td>
                                                            <td c-i="2" c-u="5"></td>
                                                            <td c-i="2" c-u="6"></td>
                                                            <td c-i="2" c-u="7"></td>
                                                            <td c-i="2" c-u="8"></td>
                                                            <td c-i="2" c-u="9"></td>
                                                            <td c-i="2" c-u="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td c-i="1" c-u="0"></td>
                                                            <td c-i="1" c-u="1"></td>
                                                            <td c-i="1" c-u="2"></td>
                                                            <td c-i="1" c-u="3"></td>
                                                            <td c-i="1" c-u="4"></td>
                                                            <td c-i="1" c-u="5"></td>
                                                            <td c-i="1" c-u="6"></td>
                                                            <td c-i="1" c-u="7"></td>
                                                            <td c-i="1" c-u="8"></td>
                                                            <td c-i="1" c-u="9"></td>
                                                            <td c-i="1" c-u="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>0</td>
                                                            <td c-i="0" c-u="0"></td>
                                                            <td c-i="0" c-u="1"></td>
                                                            <td c-i="0" c-u="2"></td>
                                                            <td c-i="0" c-u="3"></td>
                                                            <td c-i="0" c-u="4"></td>
                                                            <td c-i="0" c-u="5"></td>
                                                            <td c-i="0" c-u="6"></td>
                                                            <td c-i="0" c-u="7"></td>
                                                            <td c-i="0" c-u="8"></td>
                                                            <td c-i="0" c-u="9"></td>
                                                            <td c-i="0" c-u="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>0</td>
                                                            <td>1</td>
                                                            <td>2</td>
                                                            <td>3</td>
                                                            <td>4</td>
                                                            <td>5</td>
                                                            <td>6</td>
                                                            <td>7</td>
                                                            <td>8</td>
                                                            <td>9</td>
                                                            <td>10</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td colspan="12">Срочность</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="overlay" style="display: none;"></div>
    <span id="fancybox-wrap" style="display: none; background-color: rgb(143, 143, 143);">
        <div id="fancybox-outer">
            <div id="fancybox-content">
                <ul class="ui-tabs-nav">
                    <li class="login">
                        <a href="#" id="authBut">Войти</a>
                    </li>
                    <li class="registration">
                        <a href="#" id="regBut">Регистрация</a>
                    </li>
                    <li class="close">
                        <a href="" title="Закрыть">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                              </svg>
                        </a>
                    </li>
                </ul>
                <div id="auth" style="display: block;">
                    <form action="Login.php" method="post" id="authForm">
                        <div>
                            <input type="email" name="user" autofocus="on" id="idAuthUser" placeholder="Введите ваш e-mail">
                        </div>
                        <div>
                            <input type="password" name="pass" id="idAuthPass" placeholder="Введите ваш пароль">
                        </div>
                        <div class="authBtnForm">
                            <button type="submit" id="authSubmit" class="authButton">Войти</button>
                        </div>
                    </form>
                </div>
                <div id="reg" style="display: none;">
                    <form action="Register.php" method="post" id="regForm">
                        <div>
                            <input type="email" name="regEmail" id="idRegEmail" placeholder="Введите ваш e-mail">
                        </div>
                        <div>
                            <input type="password" name="regPass1" id="idRegPass" placeholder="Введите пароль">
                        </div>
                        <div>
                            <input type="password" name="regPass2" id="idRegPassConf" placeholder="Введите ваш пароль еще раз">
                        </div>
                        <div class="regDtnForm">
                            <button type="submit" id="regSubmit" class="regButton" >Регистрация</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </span>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="/scripts/script.js"></script>
</body>
</html>