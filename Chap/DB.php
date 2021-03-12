<?php 

namespace Chap;

class DB
{
	private static $instance;

	static public function getInstance() :\PDO

	{
		try{
			$db = new \PDO("sqlite:chapter.db");  
			$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

			static::$instance = $db;

			$db->exec("CREATE TABLE IF NOT EXISTS LICENSE_ACTIVATIONS (
		                    USER_LICENSE_ID INTEGER NOT NULL, 
		                    ACTIVATION_DATE timestamp default CURRENT_TIMESTAMP, 
		                    TYPE INTEGER,
		                    TO_OBJECT INTEGER,
		                    PARAM TEXT
		                )");
			}
		catch (\PDOException $e){
			echo $e->getMessage();
		}

		return static::$instance ?? (static::$instance = new static());
	}

			public static function insertIntoDB($query){
				foreach($query as $q){
					if (!empty($q))
						static::$instance->exec($q.';');
				}
		}

		public function getActiveDateFromDB($val){
			$stmt = static::$instance->prepare('SELECT ACTIVATION_DATE from  LICENSE_ACTIVATIONS WHERE TO_OBJECT = :val');	
			$stmt->execute([':val' => $val]); 

			$res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			 return $res;
		}

		public function getToObjectFromDB(){
	
			$stmt = static::$instance->prepare('SELECT TO_OBJECT from  LICENSE_ACTIVATIONS');
			$stmt->execute(); 
			$res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			 
			 return $res;

		}



}