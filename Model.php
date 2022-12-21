<?php
class Task
{
	public $ID = 0;
	public $userID = 0;
	public $name = "";
	public $description = "";
	public $priority = 0;
	public $creationDate = "2000-01-01"; //YYYY-MM-DD
	public $startDate = "2000-01-01";
	public $deadline = "2000-01-01";

	function __construct(int $nID, int $nUserID, string $nName, string $nDescription, int $nPriority,
		string $nCreationDate, string $nStartDate, string $nDeadline)
	{
        $this->ID = $nID;
	    $this->userID = $nUserID;
	    $this->name = $nName;
	    $this->description = $nDescription;
	    $this->priority = $nPriority;
	    $this->creationDate = $nCreationDate;
	    $this->startDate = $nStartDate;
	    $this->deadline = $nDeadline;
   }

   // PHP has no constructor overload
   public static function fromSql(mysqli_result $res)
   {
        $tasksdata = array();
        $i = 0;
        while ($taskdata = $res->fetch_row())
        {
            $tasksdata[$i] = new Task($taskdata[0], $taskdata[1], $taskdata[2],
            $taskdata[3], $taskdata[4], $taskdata[5], $taskdata[6], $taskdata[7]);
            $i++;
        }
        return $tasksdata;
   }

   // For json_encode
   public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}

class User
{
    public $ID = 0;
    public $login = "";
    public $password = "";

    function __construct(int $nID, string $nLogin, string $nPassword)
	{
        $this->ID = $nID;
	    $this->login = $nLogin;
        $this->password = $nPassword;
   }

   // PHP has no constructor overload
   public static function fromSql(mysqli_result $res)
   {
        $usrdata = $res->fetch_row();
        return new User($usrdata[0], $usrdata[1], $usrdata[2]);
   }

}

class DBAccess
{
    private $mysqli;

    // Initializes connection
    public function connect()
    {
        //$this->mysqli = new mysqli("localhost", "root", "", "organizer");
        $this->mysqli = new mysqli("localhost", "root", "1234", "organizer");
    }

    // Get user with this login-password pair
    public function getLogPass(string $login, string $password)
    {
        $req = $this->mysqli->prepare("SELECT ID, Login, Password FROM user WHERE login=? AND password=?;");

        $req->bind_param("ss", $login, $password);
        $req->execute();
        return $req->get_result();
    }

    // Count users with this login
    public function countUsers(string $login)
    {
        $req = $this->mysqli->prepare("SELECT count(ID) FROM user WHERE login=?;");

        $req->bind_param("s", $login);
        $req->execute();
        return (int)$req->get_result()->fetch_row()[0];
    }

    // Add user
    public function addUser(string $nLogin, string $nPassword)
    {
        $req = $this->mysqli->prepare("Insert into `user` (Login, Password, RightsID) values (?, ?, 1);");

        $req->bind_param("ss", $nLogin, $nPassword);
        $req->execute();
    }

    // Get tasks by userID
    public function getUserTasks(int $userID)
    {
        $req = $this->mysqli->prepare("SELECT ID, UserID, Name, Description, Priority, CreationDate, StartDate, Deadline from task where UserID = ?;");

        $req->bind_param("i", $userID);
        $req->execute();
        return $req->get_result();
    }

    // Add task
    public function addTask(Task $task)
    {
        $req = $this->mysqli->prepare("INSERT INTO `task` (UserID, Name, Description, CreationDate, Deadline, Priority, StartDate) VALUES (?, ?, ?, ?, ?, ?, ?);");

        $req->bind_param("issssis", $task->userID, $task->name, $task->description, $task->creationDate, $task->deadline, $task->priority, $task->startDate);
        if ($req->execute()) {
            return $this->mysqli->insert_id;
        } else {
            return -1;
        }
    }

    // Add task
    public function deleteTask(int $ID)
    {
        $req = $this->mysqli->prepare("DELETE FROM `task` WHERE `task`.`ID` = ?");

        $req->bind_param("i", $ID);
        return $req->execute();
    }

    // Get owner of the task
    public function getTaskOwner(int $ID)
    {
        $req = $this->mysqli->prepare("SELECT `UserID` FROM `task` WHERE `task`.`ID` = ?");

        $req->bind_param("i", $ID);
        $req->execute();
        $res = $req->get_result()->fetch_row();
        if (!$res)
            return -1;
        else
            return (int)$res[0];
    }

    // Update task
    public function updateTask(Task $task)
    {
        $req = $this->mysqli->prepare("UPDATE task SET Name = ?, StartDate = ?, Deadline = ?, Priority = ? WHERE ID=?; ");

        $req->bind_param("sssii", $task->name, $task->startDate, $task->deadline, $task->priority, $task->ID);
        return $req->execute();
    }
}
?>