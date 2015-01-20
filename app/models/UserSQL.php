<?php
/**
 * functions used with user
 */

use Phalcon\Db\Adapter\Pdo\Mysql as PDO;

class UserSQL extends CustomSQL {
	// //access name = database item name
	// static $tbl = "user";
	// static $username = "username";
	// static $password = "password";
	// static $id = "user_id";
	
	
	public static function getIdByUsername($username, PDO $db) {
		$sql = "SELECT user_id AS id FROM user WHERE username = ".$username;
		return self::querySQL($sql,$db);
	}
	
	public static function getIdByEmail($email, PDO $db) {
		$sql = "SELECT user_id AS id FROM user WHERE email = ".$email;
		return self::querySQL($sql,$db);
	}
	
	/**
	 * Does NOT check for duplicates, do that before calling this
	 */
	public static function createUser($username, $password, $first_name, $last_name, $email, PDO $db) {
		//base sql
		$sql = "INSERT INTO user ";
		$sql .= "(username, password, first_name, last_name, email, created_at) VALUES ";
		$sql .= "(:username, :password, :first_name, :last_name, :email, NOW())";
		//$sql .= "('$username', '$password', '$first_name', '$last_name', '$email', NOW())";
		
		//bind vars & execute
		$statement = $db->prepare($sql);
		return $db->executePrepared($statement,array(
			'username' => $username,
			'password' => $password,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email
			));
			
		//return self::executeSQL($sql,$db);
	}
	
}

?>