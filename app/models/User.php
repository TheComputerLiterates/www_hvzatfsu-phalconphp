<?php
use \Phalcon\Security;

class User extends \Phalcon\Mvc\Model {
	protected $user_id;			//int(10) --- Primary key, auto increment
	protected $username;			//string(32)
	protected $password;			//string(60) -- For hash, pw can be string(40)
	protected $first_name;		//string(35)
	protected $last_name;		//string(35)
	protected $email;				//string(70)
	protected $kills;				//int(2) --- Default 0
	protected $created_at;		//datetime
	protected $active;			//boolean --- Default 0
	protected $role_id;			//char(1) == (Z/H/M/S/O)
	
	//TODO: add mission stuff
	
	public static function findFirstByUserId($userId) {
		return User::findFirst(array(
			"user_id = :userId:",
			"bind" => array('userId' => $userId)
		));
	}
	public static function findFirstByUsername($username) {
		return User::findFirst(array(
			"username = :username:",
			"bind" => array('username' => $username)
		));
	}
	public static function findFirstByEmail($email) {
		return User::findFirst(array(
			"email = :email:",
			"bind" => array('email' => $email)
		));
	}
	
	public function activate() {
		$this->active = 1;
	}
	public function deactivate() {
		$this->active = 0;
	}
	
	//GETTERS
	public function getUserId() {return $this->user_id;}
	public function getUsername() {return $this->username;}
	public function getPasswordHash() {return $this->password;}
	public function getFirstname() {return $this->first_name;}
	public function getLastname() {return $this->last_name;}
	public function getEmail() {return $this->email;}
	public function getKills() {return $this->kills;}
	public function getCreatedAt() {return $this->created_at;}
	public function getActive() {return $this->active;}
	public function getRoleId() {return $this->role_id;}
	
	//SETTERS
	public function setUsername($username) {
		$length = strlen($username);
		if($length < 3 || $length > 32) {
			return "Username must be between 3 and 32 characters long";
		} else if(preg_match('/[^A-Za-z0-9]/', $username)) {
			return "Username can only contain letters and numbers";
		} else {
			$this->username = $username;
			return "success";
		}
		
	}
	public function setPassword($password,$hash) {
		$length = strlen($password);
		if($length < 8 || $length > 100) {
			return "Password must be between 8 and 100 characters long";
		} else {
			//Note: hash is 60 characters
			$this->password = $hash;
			return "success";
		}
	}
	public function setFirstname($firstname) {
		$length = strlen($firstname);
		if($length < 1 || $length > 35) {
			return "Firstname must be between 1 and 35 characters long";
		} else if(preg_match('/[^A-Za-z]/', $firstname)) {
			return "Firstname can only contain letters";
		} else {
			//make only first letter captial
			$firstname = ucfirst(strtolower($firstname));
			$this->first_name = $firstname;
			return "success";
		}
	}
	public function setLastname($lastname) {
		$length = strlen($lastname);
		if($length < 1 || $length > 35) {
			return "Lastname must be between 1 and 35 characters long";
		} else if(preg_match('/[^A-Za-z]/', $lastname)) {
			return "Lastname can only contain letters";
		} else {
			//make only first letter captial
			$lastname = ucfirst(strtolower($lastname));
			$this->last_name = $lastname;
			return "success";
		}
	}
	public function setEmail($email) {
		$length = strlen($email);
		if($length < 1 || $length > 70) {
			return "Max email length is 70 characters";
		} else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			return "Email format invalid at '" . $email . "'";
		} else {
			$email = strtolower($email);
			$this->email = $email;
			return "success";
		}
	}
	public function setKills($kills) {
		if($kills < 0) {
			return "Kills must be positive";
		} else {
			$this->kills = $kills;
			return "success";
		}
		
	}
	public function setCreatedAt() {
		date_default_timezone_set('America/New_York');
		$date = date("Y-m-d H:i:s");
		$this->created_at = $date;
	}
	
	/**
	 * default setters
	 */
	public function setDefaultRoleId() {
		$this->role_id = 1;
	}
	
	public function generateUserId() {
		//key is a 9 digit int
		$this->user_id = mt_rand(0, 999999999);
	}
	public static function userIdToString($id, $withHypens=false) {
		$str = strval($id);
		
		//padd 0s to make a 9 digit string
		while(strlen($str) < 9)
			$str = "0".$str;
		
		//add hyphens
		if($withHypens)
			$str = $str[0].$str[1].$str[2]."-".
						$str[3].$str[4].$str[5]."-".
						$str[6].$str[7].$str[8];
		
		return $str;
	}

	//OUTDATED, default = 1
	// public function setPlayerStatus($playerStatus) {
	// 	if((gettype($playerStatus) != "string") && (strlen($playerStatus) == 1)) {
	// 		return "Player status may only be a char";
	// 	} else {
	// 		$playerStatus = ucfirst($playerStatus);
	// 		switch($playerStatus[0]) {
	// 			case 'Z':	//zombie
	// 			case 'H':	//human
	// 			case 'M':	//mod
	// 			case 'O':	//oz
	// 			case 'S':	//spectator
	// 				$this->playerStatus = $playerStatus;
	// 				return "success";
	// 				break;
	// 			default:
	// 				return "Player status must be (Z)ombie, (H)uman, (M)od, (O)z, (S)pectator";
	// 				break;
	// 		}
	// 	}
	// }
	
}

?>