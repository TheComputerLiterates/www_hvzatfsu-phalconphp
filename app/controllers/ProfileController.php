<?php

class ProfileController extends ControllerBase {
	public function initialize() {
		$this->tag->setTitle('Profile');
		parent::initialize();
	}
	public function indexAction() {		
		//get session info
		$auth = $this->session->get('auth');
		$userId = $auth['userId'];
		$username = $auth['username'];
		
		//get other user information from db
		$user = User::findFirstByUserId($userId);
		if($user) {
			//user found, get rest of info
			$this->view->setVar("userId", $userId);
			$this->view->setVar("username", $username);
			$this->view->setVar("firstname", $user->getFirstName());
			$this->view->setVar("lastname", $user->getLastName());
			$this->view->setVar("email", $user->getEmail());
			$this->view->setVar("kills", $user->getKills());
			$this->view->setVar("createdAt", $user->getCreatedAt());
			$this->view->setVar("active", $user->getActive());
			$this->view->setVar("playerStatus", $user->getRoleId());
			
			$this->view->setVar("message", $user->getFirstName() . "'s Profile");
			
		} else {
			//user not found, set all to null
			$this->view->setVar("userId", $userId);
			$this->view->setVar("username", "ERROR");
			$this->view->setVar("firstname", "ERROR");
			$this->view->setVar("lastname", "ERROR");
			$this->view->setVar("email", "ERROR");
			$this->view->setVar("kills", "ERROR");
			$this->view->setVar("createdAt", "ERROR");
			$this->view->setVar("active", "ERROR");
			$this->view->setVar("playerStatus", "ERROR");
			
			$this->view->setVar("message","Error: User not found!");
		}
		
		
	}
	
}

?>