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

   public static function fromSql(mysqli_result $res)
   {
        $usrdata = $res->fetch_row();
        return new User($usrdata[0], $usrdata[1], $usrdata[2], $usrdata[3], $usrdata[4]);
   }

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
    public $name = "";
    public $lastName = "";

    function __construct(int $nID, string $nLogin, string $nPassword,
        string $nName, string $nLastName)
	{
        $this->ID = $nID;
	    $this->login = $nLogin;
        $this->password = $nPassword;
        $this->name = $nName;
        $this->lastName = $nLastName;
   }

   public static function fromSql(mysqli_result $res)
   {
        $usrdata = $res->fetch_row();
        return new User($usrdata[0], $usrdata[1], $usrdata[2], $usrdata[3], $usrdata[4]);
   }

}

class DBAccess
{
    private $mysqli;
    public function connect()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "organizer");
        
    }

    public function getLogPass(string $login, string $password)
    {
        $req = $this->mysqli->prepare("SELECT ID, Login, Password, Name, LastName FROM user WHERE login=? AND password=?;");

        $req->bind_param("ss", $login, $password);
        $req->execute();
        return $req->get_result();
    }

    public function countUsers(string $login)
    {
        $req = $this->mysqli->prepare("SELECT count(ID) FROM user WHERE login=?;");

        $req->bind_param("s", $login);
        $req->execute();
        return (int)$req->get_result()->fetch_row()[0];
    }

    public function addUser(string $nLogin, string $nPassword,
        string $nName, string $nLastName)
    {
        $req = $this->mysqli->prepare("Insert into `user` (Login, Password, Name, LastName, RightsID) values (?, ?, ?, ?, 1);");

        $req->bind_param("ssss", $nLogin, $nPassword, $nName, $nLastName);
        $req->execute();
    }
}
?>