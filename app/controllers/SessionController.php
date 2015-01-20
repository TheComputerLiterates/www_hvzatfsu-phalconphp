<?php

use Phalcon\Mvc\Dispatcher;

class SessionController extends ControllerBase {
	public function initialize() {
		$this->tag->setTitle('Session Setup');
		parent::initialize();
	}
	
	public function indexAction() {
		//go to login by default
		$this->response->redirect("session/login");
		$this->view->disable();
	}
	
	private function _registerSession($user) {
		$this->session->set('auth',array(
				'userId' 		=> $user->getUserId(),
				'username' 	=> $user->getUsername(),
				'role' 			=> $user->getRoleId(),
				'firstName' => $user->getFirstname(),
			));
	}
	private function _unregisterSession() {
		$this->session->remove('auth');
	}
	
	
	/**
	 * This action recieves input from login page
	 */
	public function loginAction() {
		$this->tag->setTitle('Login');
		if ($this->request->isPost() && $this->security->checkToken()) {
			//recieving POST
			$emailUsername = $this->request->getPost('emailUsername');
			$password = $this->request->getPost('password');
			
			//Determine if email is email or username
			if(filter_var($emailUsername,FILTER_VALIDATE_EMAIL)) {
				//is email
				//find the user in the database
				$user = User::findFirst(array(
						"email = :email: AND active = '1'",
						"bind" => array('email' => $emailUsername)
					));
				$user = User::findFirstByEmail($emailUsername);
			} else {
				//is username or a failed email (doesnt matter)
				$user = User::findFirstByUsername($emailUsername);
				$user = User::findFirst(array(
						"username = :username: AND active = '1'",
						"bind" => array('username' => $emailUsername)
					));
			}			
			if($user && $this->security->checkHash($password,$user->getPasswordHash())) {

				$this->flashSession->success("Login successful!");
				//user found and password correct (using bcrypt)
				$this->_registerSession($user);
				
				//Login successful, forward to the post-login controller
				$this->response->redirect("profile/index");
				$this->view->disable();
			} else {
				$password = "";
				
				//active user not found or password incorrect
				$this->flashSession->error('Wrong email/password');
				
				//Login failed, foward to the login form again
				$this->response->redirect("session/login");
				$this->view->disable();
			}
			
		} 
		
	}
	
	/**
	 * Pages will redirect here if user is not logged in, and needs to be
	 */
	public function nosessionAction() {
		$this->tag->setTitle('Restricted Access');
	}
	
	/**
	 * Logout page
	 */
	public function logoutAction() {
		$this->_unregisterSession();
	}
	
	/**
	 * Registration
	 */
	public function registerAction() {
		$this->tag->setTitle('Register');
		$request = $this->request;
		if($request->isPost() && $this->security->checkToken()) {
			//retrieve POST
			$email 					= $this->request->getPost('email');
			$emailRetype 		= $this->request->getPost('emailRetype');
      $password 			= $this->request->getPost('password');
      $passwordRetype = $this->request->getPost('passwordRetype');
      $username 			= $this->request->getPost('username');
      $firstname 			= $this->request->getPost('firstname');
      $lastname 			= $this->request->getPost('lastname');
			
			if($password != $passwordRetype) {
				//Registration failed, foward to the register form again
				$this->flashSession->error("Passwords do not match");
				$this->response->redirect("session/register");
				$this->view->disable();
			} else if ($email != $emailRetype) {
				//Registration failed, foward to the register form again
				$this->flashSession->error("Emails do not match");
				$this->response->redirect("session/register");
				$this->view->disable();
			}
			
			//attempt to create user
			//NOTE: try/catch blocks dont work with PhalconPHP, so i did this
			$user = new User();
			$try = $user->setFirstname($firstname);
			if($try == "success") $try = $user->setLastname($lastname);
			if($try == "success") $try = $user->setUsername($username);
			if($try == "success") $try = $user->setEmail($email);
			if($try == "success") $try = $user->setPassword($password,$this->security->hash($password));
			if($try == "success") $try = $user->setKills(0);
			
			if($try == "success") {
				$user->generateUserId();
				$user->activate();
				$user->setCreatedAt();
				$user->setDefaultRoleId();
				if($user->create()) {
					//Registration successful, send to login
					$this->flashSession->success("Registration Successful!");
					$this->response->redirect("session/login");
					$this->view->disable();
				} else {
					foreach($user->getMessages() as $message) {
						$this->flashSession->error($message);
					}
					$this->response->redirect("session/register");
					$this->view->disable();
				}
			} else {
				//Registration failed, foward to the register form again
				$this->flashSession->error($try);
				$this->response->redirect("session/register");
				$this->view->disable();
			}
			
			
			
			
		}
	}

}

?>