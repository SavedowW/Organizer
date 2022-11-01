Greetings, <?php echo htmlspecialchars($_POST['login']); ?>:<?php echo htmlspecialchars($_POST['password']); ?>.<br><br>
<?php

session_start();

function test()
{
	$_SESSION['pagecount']++;
	echo "I'll do something one day<br>";
	echo (int) $_SESSION['pagecount'], " visits<br><br>";
}

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

test();

$obj = array(new Task(0, 0, "Do work", "Please dont", 45, "2022-10-29", "2022-10-31", "2022-11-01"),
	new Task(1, 0, "Run", "Run. Now.", 100, "2022-11-01", "2022-11-01", "2022-11-03"),
	new Task(3, 0, "Fix stuff", "Not fixed an issue yet", 80, "2022-10-25", "2022-10-27", "2022-11-07"));

echo json_encode($obj);

include "mainpage.php";

?>