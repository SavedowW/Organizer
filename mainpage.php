<h1>Welcome to the Internet!<br></h1>
<h3>Please follow me</h3>

<script>
	//Парсинг массива Task
	var js_data = '<?php echo json_encode($obj); ?>';
	var jstruct = JSON.parse(js_data, function(key, value) {
		if (key == "creationDate" || key == "startDate" || key == "deadline") return new Date(value);
		return value;
	});

	//Количество элементов в массиве
	var tasksCount = Object.keys(jstruct).length;

	//Вывод инфы
	document.write("[" + tasksCount + "]<br>");
	for (let i = 0; i < tasksCount; ++i)
	{
		document.write(jstruct[i].name + " (" + jstruct[i].ID + ", user " + jstruct[i].userID + ")<br>");
		document.write(jstruct[i].description + "<br>");
		document.write("Priority: " + jstruct[i].priority + "<br>");
		document.write("Creation date: " + jstruct[i].creationDate + "<br>");
		document.write("Start date: " + jstruct[i].startDate + "<br>");
		document.write("Deadline: " + jstruct[i].deadline + "<br><br>");
	}
</script>