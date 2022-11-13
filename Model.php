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

   /*function __construct(mysqli_result $res)
	{
        $usrdata = $res->fetch_row();
        $this->ID = $usrdata[0];
	    $this->login = $usrdata[1];
        $this->password = $usrdata[2];
        $this->name = $usrdata[3];
        $this->lastName = $usrdata[4];
   }*/
}
?>