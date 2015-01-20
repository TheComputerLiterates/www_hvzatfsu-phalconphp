<?php
/**
 * Base class to be used to run SQL commands to the server, given the di
 * 
 * Idea from: https://groups.google.com/forum/#!msg/phalcon/wWJSAu5fRR8/5uVSqC5jJooJ
 * Docs: 
 * 
 * 
 * You can do more with just $di->get('db') because it is the MySql adapter
 * Phalcon\Db\Adapter\Pdo\Mysql
 * http://docs.phalconphp.com/en/latest/api/Phalcon_Db_Adapter_Pdo_Mysql.html
 * 
 * The point of this class is to add custom functions and make them
 * easy to call using the adapter. Also to have them static.
 * 
 * I MAY have removed the sql injection protection...
 * http://docs.phalconphp.com/en/latest/reference/models.html#avoiding-sql-injections
 * 
 */

use Phalcon\Db\Adapter\Pdo\Mysql as MPDO;
use Phalcon\Db\Column as COL;

class CustomSQL {
	/**
	 * This will run the SQL on the database and return the result ARRAY
	 * To access return (r) from this function:
	 * 
	 * foreach(r as ObjectName) {
	 * 	//access with ObjectName['selectionName']
	 * }
	 * 
	 * This will be empty if no results were returned
	 * 
	 * HOW IT WORKS
	 * get('di') returns Phalcon\Db\Adapter\Pdo\Mysql
	 * http://docs.phalconphp.com/en/latest/api/Phalcon_Db_Adapter_Pdo_Mysql.html
	 * 
	 * query returns Phalcon\Db\ResultInterface 
	 * http://docs.phalconphp.com/en/latest/api/Phalcon_Db_ResultInterface.html
	 * 
	 * fetchAll() returns an array of row arrays of columns
	 * 
	 * Will be used for SELECTs
	 */
	public static function querySQL($sql, MPDO $db) {
		return $db->query($sql)->fetchAll();
	}
	
	/**
	 * Returns success state of an execution (like an UPDATE, INSERT, DELETE)
	 */
	public static function executeSQL($sql, MPDO $db) {
		return $db->execute($sql);
	}
	
	
	
	/**
	 * prep_task function template/guide
	 * This is an example  is a selectRoleByName task
	 */
	/*
	public static function prep_task($arg..., MPDO $db[, $lim = 1]) {
		//write sql, with binding. add a ":" before each key to bind
		$sql = "SELECT name, role_id FROM role WHERE name = :name LIMIT :lim";
		$statement = $db->prepare($sql);
		
		//first array is binding the keys in sql to variables
		//second array is binding keys in sql to expected datatypes
		//Datatypes => http://php.net/manual/en/pdo.constants.php
		$statement = $db->executePrepared($statement, 
			array(
			 	'id' => $id,
			 	'lim' => $lim
		 	),
		 	array(
		 		'id' => PDO::PARAM_INT,
		 		'lim' => PDO::PARAM_INT
		 	)
		 );
		
		//this can be modified to a different PODStatement function
		//PODStatement => http://php.net/manual/en/class.pdostatement.php
		return $statement->fetchAll();
	}
	*/
	
	private static $pageNameSize = 45; //controller, action, data title max
	
	
	public static function getAllRoles(MPDO $db) {
		$sql = "SELECT name FROM role ORDER BY role_id DESC";
		
		return self::querySQL($sql, $db);
	}
	
	
	
	public static function selectRoleByName($name, MPDO $db, $limit = 1) {
		$sql = "SELECT name, role_id FROM role WHERE name = ".$name." LIMIT ".$limit;
		return self::querySQL($sql,$db);
	}
	public static function prep_selectRoleByName($name, MPDO $db, $limit = 1) {
		$sql = "SELECT name, role_id FROM role WHERE role_id = :id LIMIT :lim";
		$statement = $db->prepare($sql);
		$statement = $db->executePrepared($statement, 
			array(
			 	'name' => $name
		 	),
		 	array(
		 		'name' => PDO::PARAM_STR
		 	)
		 );		
		return $statement->fetchAll();
			
	}
	public static function selectRoleById($id, MPDO $db, $limit = 1) {
		$sql = "SELECT name, role_id FROM role WHERE role_id = ".$id." LIMIT ".$limit;
		return self::querySQL($sql,$db);
	}
	public static function prep_selectRoleById($id, MPDO $db, $lim = 1) {
		$sql = "SELECT name, role_id FROM role WHERE role_id = :id LIMIT :lim";
		$statement = $db->prepare($sql);
		$statement = $db->executePrepared($statement, 
			array(
			 	'id' => $id,
			 	'lim' => $lim
		 	),
		 	array(
		 		'id' => PDO::PARAM_INT,
		 		'lim' => PDO::PARAM_INT
		 	)
		 );		
		return $statement->fetchAll();
	}
	
	
	/**
	 * Grabs all data associated with a given action
	 */
	public static function getActionData($controllerName, $actionName, MPDO $db) {
		$sql = "SELECT title, data
					FROM action_data_by_action_by_controller
					WHERE controller = '$controllerName'
						AND action = '$actionName'";
		return self::querySQL($sql,$db);
	}
	
	/**
	 * Grabs all data for the given action, then formats into an array
	 * with key=title value=data
	 */
	public static function getActionDataFormatted($controllerName, $actionName, MPDO $db) {
		$result = array();	//result array
		$actionData = self::getActionData($controllerName, $actionName, $db);
		
		//go through each row and grab the title and data
		foreach($actionData as $row) {
			$result[$row['title']] = $row['data'];
		}
		
		return $result;
	}
	
	/**
	 * Sets the action data d, given the title t, action a, and controller c
	 * result = 1 if successful, 0 if not.
	 */
	public static function setActionData($c, $a, $t, $d, MPDO $db) {
		$sql = "SELECT setActionData($c, $a, $t, $d) AS result";
		return self::querySQL($sql,$db);
	}
	public static function prep_setActionData($c, $a, $t, $d, MPDO $db) {
		$sql = "SELECT setActionData(:c, :a, :t, :d) AS result";
		$statement = $db->prepare($sql);
		$statement = $db->executePrepared($statement, 
			array(
			 	'c' => $c,
			 	'a' => $a,
			 	't' => $t,
			 	'd' => $d
		 	),
		 	array(
		 		'c' => PDO::PARAM_STR,
		 		'a' => PDO::PARAM_STR,
		 		't' => PDO::PARAM_STR,
		 		'd' => PDO::PARAM_STR
		 	)
		 );		
		return $statement->fetchAll();
	}
	
}

?>