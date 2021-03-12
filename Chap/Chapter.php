<?php 

namespace Chap;

use Chap\DB;

class Chapter
{

	public function createDB()
	{

		$parsed = explode(';', file_get_contents('parse_file'));

		DB::insertIntoDB($parsed);
		
	}

	public function getResult(){

		$to_obj = array_unique((new DB)->getToObjectFromDB(), SORT_REGULAR);

		if (empty($to_obj)) 
			return;

		foreach ($to_obj as $obj)
		{
			$active_dates[$obj['TO_OBJECT']] = (new DB)->getActiveDateFromDB($obj['TO_OBJECT']);
		}

		foreach($active_dates as $date)
		{
			$generator = $this->getTime($date);
				foreach ($generator as $gen)
				{
					$result = $gen;	
				}
				$val[] = $result;
		}


		$keys = array_keys($active_dates); 

		$final = array_combine($keys, $val);

		return $final;
	
	}

	private function getTime($date)
	{
	
	foreach ($date as $d){

		$val = (strtotime($time ?? 0) < strtotime($d['ACTIVATION_DATE']));

		if ($val){
			$new_time = $d['ACTIVATION_DATE'];
		} else {
			$new_time = $time;
		} 			

		$time = date("Y-m-d H:i:s", strtotime($new_time . " + 60 days")); 	

		yield $time;
	}
}    


}