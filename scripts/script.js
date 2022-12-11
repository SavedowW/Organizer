function closeOpenAdminMenu() {
  let el = document.getElementById('fancybox-wrap');
  el.style.display === 'none' ? el.style.display = 'block' : el.style.display = 'none';
  el = document.getElementById('overlay');
  el.style.display === 'none' ? el.style.display = 'block' : el.style.display = 'none';
  }

  document.getElementById('regBut').onclick = function() {
    let el = document.getElementById('auth');
    el.style.display = 'none';
    el = document.getElementById('reg');
    el.style.display = 'block';
  }

  document.getElementById('authBut').onclick = function() {
    let el = document.getElementById('auth');
    el.style.display = 'block';
    el = document.getElementById('reg');
    el.style.display = 'none';
  }

  document.getElementById('taskBut').onclick = function() {
    let el = document.getElementById('tabs-tasks').style.display = 'grid';
    el = document.getElementById('tabsmain').style.gridTemplateRows = '600px 0px 0px';
    el = document.getElementById('tabs-priorities').style.display = 'none';
    el = document.getElementById('tabs-urgensy').style.display = 'none';
  }

  document.getElementById('priorBut').onclick = function() {
    let el = document.getElementById('tabsmain').style.gridTemplateRows = '0px 600px 0px';
    el = document.getElementById('tabs-tasks').style.display = 'none';
    el = document.getElementById('tabs-priorities').style.display = 'grid';
    el = document.getElementById('tabs-urgensy').style.display = 'none';
  }

  document.getElementById('urgBut').onclick = function() {
    let el = document.getElementById('tabsmain').style.gridTemplateRows = '0px 0px 600px';
    el = document.getElementById('tabs-tasks').style.display = 'none';
    el = document.getElementById('tabs-priorities').style.display = 'none';
    el = document.getElementById('tabs-urgensy').style.display = 'grid';
  }

  //Добавление задачи
  document.getElementById('addNewTaskBtn').onclick = function() {
    const taskName = document.getElementById('newTaskName').value;
    createTask(taskName);
  }

  //Отображение задач пользователя
  function displayTasks(tasksJSON) {
    tasksJSON = JSON.parse(tasksJSON);

    let i = 0;
    let count = Object.keys(tasksJSON).length;
    do {
      let currentTask = tasksJSON[i];
      
      createTask(currentTask['name'], currentTask['priority'], currentTask['startDate'], currentTask['deadline'], currentTask['ID']);

      i++;
    } while (i < count);
  }

  //Создание задачи
  function createTask(taskName, priority, startDate, endDate, idTask) {
    if (taskName != undefined && taskName != '') {
      const ul = document.getElementById('tasksList');
      document.getElementById('newTaskName').value = "";
      const li = document.getElementById('task item').cloneNode(true);
      li.style.display = 'block';
      li.firstElementChild.rows[0].cells[1].firstElementChild.innerText = taskName;

      if (typeof priority != 'undefined') {
        if (priority == '1') {
          priority = 'Низкий';
        } else if (priority == '2') {
          priority = 'Средний';
        } else if (priority == '3') {
          priority = 'Высокий';
        } else {
          priority = 'Неизвестный приоритет';
        }

        li.firstElementChild.rows[0].cells[4].innerText = priority;
        li.firstElementChild.rows[0].cells[4].style.display = 'block';
      }

      if (typeof startDate != 'undefined') {
        li.firstElementChild.rows[0].cells[2].firstElementChild.innerText = startDate;
        li.firstElementChild.rows[0].cells[2].firstElementChild.style.display = 'block';
      }

      if (typeof endDate != 'undefined') {
        li.firstElementChild.rows[0].cells[3].firstElementChild.innerText = endDate;
        li.firstElementChild.rows[0].cells[3].firstElementChild.style.display = 'block';
      }

      if (typeof idTask != 'undefined') {
        li.firstElementChild.rows[0].cells[7].innerHTML = idTask;
      }

      ul.appendChild(li);
    } else
      alert('Неверное название дела');
  }

  //Отправка данных нового дела (вроде как)
  document.getElementById('saveSettingsBtn').onclick = function() {
    let xhr = new XMLHttpRequest(); // Объект для запроса
    let prior = 0; // Объект для поля "Приоритет"

    switch(document.getElementById('prioritySettings').value){
      case 'low' :
        prior = 1;
      case 'medium':
        prior = 2;
      case 'high':
        prior = 3;
    }

    let url = "sendTask.php"; // Адрес куда отправить
    let result = document.querySelector('.receivedData'); // Поле, куда вставлять результат
    xhr.open("POST", url, true); // Открываем запрос
    xhr.setRequestHeader("Content-Type", "application/json"); // Хэдер для json'а
    const data = JSON.stringify({
      "name": document.getElementById('taskNameSet').innerHTML,
      "priority": prior, 
      "startDate": document.getElementById('startTask').value,
      "deadline": document.getElementById('endTask').value
    }); // Запихиваем данные в json

    xhr.send(data); // Отправляем запрос

    // Колбек-функция для ответа на запрос
    xhr.onreadystatechange = function () {
      // Если все прошло нормально
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Вставляем эти данные для примера
        if (Number(this.responseText) >= 1)
        {
          alert("Everything went fine");
          // Новый ID - Number(this.responseText)
        }
        else if (Number(this.responseText) == -1)
          alert("Please log in");
        else
          alert("Something unexpected happened, error: " + this.responseText);
      }
    };
  }

  // удалить задачу
  document.getElementById('deleteSettingsBtn').onclick = function() {
    let xhr = new XMLHttpRequest(); // Объект для запроса
    url = "deleteTask.php"; // Адрес куда отправить
    let result = document.querySelector('.receivedData'); // Поле, куда вставлять результат
    xhr.open("POST", url, true); // Открываем запрос
    xhr.setRequestHeader("Content-Type", "application/json"); // Хэдер для json'а
    var data = JSON.stringify({ "ID": document.getElementById('idTaskSetting').innerText }); // Запихиваем данные в json

    // Колбек-функция для ответа на запрос
    xhr.onreadystatechange = function () {
      // Если все прошло нормально
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Вставляем эти данные для примера
        if (this.responseText == 1)
          alert("Everything went fine");
        else if (this.responseText == 2)
          alert("Please log in");
        else if (this.responseText == 3)
          alert("This task is not saved or does not belong to you");
        else
          alert("Something unexpected happened, server answer: " + this.responseText);
      }
    };

    xhr.send(data); // Отправляем запрос
    location.reload();
  }

  function settingsBtn(el) {
    const nameTask = el.parentElement.parentElement.children[1].firstElementChild.innerText;
    const namePanel = document.getElementById('taskNameSet');
    namePanel.innerText = nameTask;

    const idTask = el.parentElement.parentElement.children[7].innerHTML;
    document.getElementById('idTaskSetting').innerText = idTask;
  }

document.getElementById('closeAdminMenu').onclick = function () {
  closeOpenAdminMenu();
  deleteReasonFromURL();
}

function deleteReasonFromURL() {
  const url = new URL(document.location);
  const searchParams = url.searchParams;
  searchParams.delete("reason"); // удалить параметр "reason"
  window.history.pushState({}, '', url.toString());
}

function showLogin(strJSON) {
  if (strJSON != '\n    ') {
  strJSON = JSON.parse(strJSON);
  document.getElementById('loginLabel').innerText = strJSON['login'];

  let el = document.getElementById('admin-menu');
  el.style.display === 'none' ? el.style.display = 'block' : el.style.display = 'none';
  el = document.getElementById('admin-menu-exit');
  el.style.display === 'none' ? el.style.display = 'block' : el.style.display = 'none';
  }
}

function exitUser() {
  document.getElementById('loginLabel').innerText = '';
  document.getElementById('dom-tasks').innerText = '';
  document.getElementById('dom-user').innerText = '';
  const li = document.getElementById('task item').cloneNode(true);
  let ul = document.getElementById('tasksList');
  $(ul).empty();
  ul.append(li);

  let el = document.getElementById('admin-menu-exit');
  el.style.display === 'none' ? el.style.display = 'block' : el.style.display = 'none';
  el = document.getElementById('admin-menu');
  el.style.display === 'none' ? el.style.display = 'block' : el.style.display = 'none';
}

function testCurrentTaskID() {
  const ul = document.getElementById('tasksList');

  let i = 1;
  let j = 2;
  let isDuplicated = false;

  while(ul.childNodes[i] != undefined && !isDuplicated) {
    let currentID = ul.childNodes[i].firstChild.rows[0].cells[1].lastChild.innerText;

    if (currentID != '' || currentID != undefined) {
      while (ul.childNodes[j] != undefined && !isDuplicated) {
        if (currentID === ul.childNodes[j].firstChild.rows[0].cells[1].lastChild.innerText) {
          alert('ID is duplicated');
          isDuplicated = true;
        }

        j++;
      }  
    }

    i++;
    j = i + 1;
  }

  return isDuplicated;
}