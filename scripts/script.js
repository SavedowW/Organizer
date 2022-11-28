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
    const ul = document.getElementById('tasksList');
    const taskName = document.getElementById('newTaskName').value;
    if (taskName.value) {
      document.getElementById('newTaskName').value = "";
      const li = document.getElementById('task item').cloneNode(true);
      li.style.display = 'block';
      li.firstElementChild.rows[0].cells[1].firstElementChild.innerText = taskName;
      //li.firstElementChild.rows[0].cells[6].firstElementChild.setAttribute("script", "taskSettingsBtn" + ul.childElementCount);
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
      "priority": prior, "startDate": document.getElementById('startTask').value,
      "deadline": document.getElementById('endTask').value
    }); // Запихиваем данные в json

    xhr.send(data); // Отправляем запрос

    // Колбек-функция для ответа на запрос
    xhr.onreadystatechange = function () {
      // Если все прошло нормально
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Вставляем эти данные для примера
        if (this.responseText == "1")
          alert("Everything went fine");
        else if (this.responseText == "2")
          alert("Please log in");
        else
          alert("Something unexpected happened, code: " + this.responseText);
      }
    };
  }

  function settingsBtn(el) {
    const nameTask = el.parentElement.parentElement.children[1].firstElementChild.innerText;
    const namePanel = document.getElementById('taskNameSet');
    namePanel.innerText = nameTask;
  }

document.getElementById('closeAdminMenu').onclick = function () {
  closeOpenAdminMenu();
  deleteReasonFromURL();
}

function deleteReasonFromURL() {
  const url = new URL(document.location);
  const searchParams = url.searchParams;
  searchParams.delete("reason"); // удалить параметр "test"
  window.history.pushState({}, '', url.toString());
}

function showLogin(strJSON) {
  strJSON = JSON.parse(strJSON);
  document.getElementById('loginLabel').innerText = strJSON['login'];
}

function hideLogin() {
  document.getElementById('loginLabel').innerText = '';
}