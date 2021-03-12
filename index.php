<?php 

error_reporting(E_ALL);
ini_set('display_errors', 'On'); 

require_once 'autoload.php';

use Chap\Chapter;



$task = new Chapter();

if (!$task->getResult())
	{
		$task->createDB();	
	}

print_r($task->getResult());


?>