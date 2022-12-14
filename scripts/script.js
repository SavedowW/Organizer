const currentDate = new Date();
document.getElementById('startTask').value = currentDate.toISOString().split('T')[0];
let newDate = new Date();
newDate.setDate(newDate.getDate() + 10);
document.getElementById('endTask').value = newDate.toISOString().split('T')[0];

function plusDate(elementDate, countDays, countMonth, countYears) {
  let date = new Date(elementDate.value);

  if (typeof countDays != 'undefined' && countDays !== 0) {
    date.setDate(date.getDate() + countDays);
  } else if (typeof countMonth != 'undefined' && countMonth !== 0) {
    date.setMonth(date.getMonth() + countMonth);
  } else if (typeof countYears != 'undefined' && countYears !== 0) {
    date.setFullYear(date.getFullYear() + countYears);
  }

  elementDate.value = date.toISOString().split('T')[0];
}

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

  //???????????????????? ????????????
  document.getElementById('addNewTaskBtn').onclick = function() {
    const taskName = document.getElementById('newTaskName').value;
    createTask(taskName);
  }

  //?????????????????????? ?????????? ????????????????????????
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

  //???????????????? ????????????
  function createTask(taskName, priority, startDate, endDate, idTask) {
    if (taskName !== undefined && taskName !== '') {
      const ul = document.getElementById('tasksList');
      document.getElementById('newTaskName').value = "";
      const li = document.getElementById('task item').cloneNode(true);
      li.style.display = 'block';
      li.firstElementChild.rows[0].cells[1].firstElementChild.innerText = taskName;

      if (typeof priority != 'undefined') {
        if (priority === 1) {
          priority = '????????????';
        } else if (priority === 2) {
          priority = '??????????????';
        } else if (priority === 3) {
          priority = '??????????????';
        } else {
          priority = '?????????????????????? ??????????????????';
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
      alert('???????????????? ???????????????? ????????');
  }

  //???????????????? ???????????? ???????????? ???????? (?????????? ??????)
  document.getElementById('saveSettingsBtn').onclick = function() {
    let xhr = new XMLHttpRequest(); // ???????????? ?????? ??????????????
    let prior = 0; // ???????????? ?????? ???????? "??????????????????"
    const idTask = document.getElementById('idTaskSetting').innerText;
    const priorityValue = document.getElementById('prioritySettings').value;
    const taskName = document.getElementById('taskNameSet').innerHTML;
    const isCurrentDate = document.getElementById('startTask').value < document.getElementById('endTask').value;

    if (!(taskName === '' || typeof taskName === 'undefined') && isCurrentDate) {

      switch (priorityValue) {
        case 'low' :
          prior = 1;
          break;
        case 'medium':
          prior = 2;
          break;
        case 'hight':
          prior = 3;
          break;
        case 'unknown':
          prior = 4;
          break;
      }

      const isIdTask = typeof idTask === 'undefined' || idTask === '';
      let url;
      if (isIdTask) {
        url = "sendTask.php"; // ?????????? ???????? ??????????????????
      } else {
        url = 'updateTask.php';
      }
      let result = document.querySelector('.receivedData'); // ????????, ???????? ?????????????????? ??????????????????
      xhr.open("POST", url, true); // ?????????????????? ????????????
      xhr.setRequestHeader("Content-Type", "application/json"); // ?????????? ?????? json'??
      const data = JSON.stringify({
        "name": taskName,
        "priority": prior,
        "startDate": document.getElementById('startTask').value,
        "deadline": document.getElementById('endTask').value,
        "ID": idTask
      }); // ???????????????????? ???????????? ?? json

      xhr.send(data); // ???????????????????? ????????????

      // ????????????-?????????????? ?????? ???????????? ???? ????????????
      xhr.onreadystatechange = function () {
        // ???????? ?????? ???????????? ??????????????????
        if (xhr.readyState === 4 && xhr.status === 200) {
          // ?????????????????? ?????? ???????????? ?????? ??????????????
          if (Number(this.responseText) >= 1) {
            alert("Everything went fine");
            setTimeout('location.reload()', 500);
            // ?????????? ID - Number(this.responseText)
          } else if (Number(this.responseText) === -1)
            alert("Please log in");
          else
            alert("Something unexpected happened, error: " + this.responseText);
        }
      };
    }else if (!isCurrentDate) {
      alert('Date is incorrect');
    }
  }

  // ?????????????? ????????????
  document.getElementById('deleteSettingsBtn').onclick = function() {
    let xhr = new XMLHttpRequest(); // ???????????? ?????? ??????????????
    let url = "deleteTask.php"; // ?????????? ???????? ??????????????????
    let result = document.querySelector('.receivedData'); // ????????, ???????? ?????????????????? ??????????????????
    xhr.open("POST", url, true); // ?????????????????? ????????????
    xhr.setRequestHeader("Content-Type", "application/json"); // ?????????? ?????? json'??
    var data = JSON.stringify({ "ID": document.getElementById('idTaskSetting').innerText }); // ???????????????????? ???????????? ?? json

    // ????????????-?????????????? ?????? ???????????? ???? ????????????
    xhr.onreadystatechange = function () {
      // ???????? ?????? ???????????? ??????????????????
      if (xhr.readyState === 4 && xhr.status === 200) {
        // ?????????????????? ?????? ???????????? ?????? ??????????????
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

    xhr.send(data); // ???????????????????? ????????????
    location.reload();
  }

  function settingsBtn(el) {
    const nameTask = el.parentElement.parentElement.children[1].firstElementChild.innerText;
    const startDate = el.parentElement.parentElement.children[2].firstElementChild.innerText;
    const endDate = el.parentElement.parentElement.children[3].firstElementChild.innerText;
    let priority = el.parentElement.parentElement.children[4].innerText;
    switch (priority) {
      case '????????????':
        priority = 'low';
        break;
      case '??????????????':
        priority = 'medium';
        break;
      case '??????????????':
        priority = 'hight';
        break;
      case '?????????????????????? ??????????????????':
        priority = 'unknown';
        break;
    }
    const namePanel = document.getElementById('taskNameSet');
    namePanel.innerText = nameTask;
    if (startDate !== '') {
      document.getElementById('startTask').value = startDate;
    } else {
      document.getElementById('startTask').value = currentDate.toISOString().split('T')[0];
    }

    if (endDate !== '') {
    document.getElementById('endTask').value = endDate;
    } else {
      document.getElementById('endTask').value = newDate.toISOString().split('T')[0];
    }
    
    document.getElementById('prioritySettings').value = priority;

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
  searchParams.delete("reason"); // ?????????????? ???????????????? "reason"
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

//?????????????????????? ?????????? ???????????????????????? ?? ?????????????? ??????????????????????
function displayTasksByPriority(tasksJSON) {
  tasksJSON = JSON.parse(tasksJSON);

  let i = 0;
  let count = Object.keys(tasksJSON).length;

  if (count != 0) {
    document.getElementById('formPriority').style.display = 'block';
    document.getElementById('emptyForm').style.display = 'none';
    while (i < count) {
      let currentTask = tasksJSON[i];
    
      createTaskByPriority(currentTask['name'], currentTask['priority'], currentTask['startDate'], currentTask['deadline'], currentTask['ID']);

      i++;
    }
  }
}

//?????????????????????????? ???????????? ???? ???????????????????? 
function createTaskByPriority(taskName, priority, startDate, endDate, idTask) {
  if (taskName != undefined && taskName != '') {
    let ul = document.getElementById('tasksList');
    document.getElementById('newTaskName').value = "";
    const li = document.getElementById('task item').cloneNode(true);
    li.style.display = 'block';
    li.firstElementChild.rows[0].cells[1].firstElementChild.innerText = taskName;

    if (typeof priority != 'undefined') {
      if (priority == '1') {
        //priority = '????????????';
        ul = document.getElementById('lowTaskContainer');
      } else if (priority == '2') {
        //priority = '??????????????';
        ul = document.getElementById('mediumTaskContainer');
      } else if (priority == '3') {
        //priority = '??????????????';
        ul = document.getElementById('hightTaskContainer');
      } else {
        //priority = '?????????????????????? ??????????????????';
        ul = document.getElementById('unknownTaskContainer');
      }

      //li.firstElementChild.rows[0].cells[4].innerText = priority;
      //li.firstElementChild.rows[0].cells[4].style.display = 'block';
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

    li.firstElementChild.rows[0].cells[6].firstElementChild.style.display = 'none';

    ul.appendChild(li);
  } else
    alert('???????????????? ???????????????? ????????');
}

//?????????????????????? ?????????? ???????????????????????? ?? ?????????????? ??????????????????????
function displayTasksInEizenTable(tasksJSON) {
  tasksJSON = JSON.parse(tasksJSON);

  let i = 0;
  let count = Object.keys(tasksJSON).length;

  if (count != 0) {
    while (i < count) {
      let currentTask = tasksJSON[i];
    
      createTaskInEizenTable(currentTask['name'], currentTask['priority'], currentTask['startDate'], currentTask['deadline'], currentTask['ID']);

      i++;
    }
  }
}

//?????????????????????????? ???????????? ???? ?????????????? ??????????????????????
function createTaskInEizenTable(taskName, priority, startDate, endDate, idTask) {
  if (taskName != undefined && taskName != '' && typeof startDate != 'undefined' && typeof endDate != 'undefined') {
    let ul;
    const li = document.getElementById('task item').cloneNode(true);
    li.style.display = 'block';
    li.firstElementChild.rows[0].cells[1].firstElementChild.innerText = taskName;

    startDate = new Date(startDate);
    endDate = new Date(endDate);

    const diff = (endDate - currentDate)/1000/60/60/24;

    if (typeof priority != 'undefined' && diff > 0) {
      if (priority == 3 && diff < 10) {
        ul = document.getElementById('importantUrgentCont');
      } else if (priority !== 3 && diff < 10) {
        ul = document.getElementById('notImportantUrgentCont');
      } else if (priority === 3 && diff > 10) {
        ul = document.getElementById('importantNotUrgentCont');
      } else if (priority !== 3 && diff > 10) {
        ul = document.getElementById('notImportantNotUrgentCont');
      }
    
      li.firstElementChild.rows[0].cells[2].firstElementChild.innerText = startDate.toISOString().split('T')[0];
      li.firstElementChild.rows[0].cells[2].firstElementChild.style.display = 'block';

      li.firstElementChild.rows[0].cells[3].firstElementChild.innerText = endDate.toISOString().split('T')[0];
      li.firstElementChild.rows[0].cells[3].firstElementChild.style.display = 'block';

    if (typeof idTask != 'undefined') {
      li.firstElementChild.rows[0].cells[7].innerHTML = idTask;
    }

    li.firstElementChild.rows[0].cells[6].style.display = 'none';
    li.firstElementChild.rows[0].cells[4].style.display = 'none';
    li.firstElementChild.rows[0].cells[5].style.display = 'none';
    li.style.height = '58px'

    ul.appendChild(li);
  }
  }
}