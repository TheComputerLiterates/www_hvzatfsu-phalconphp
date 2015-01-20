<?php

use Phalcon\Events\Event, 
		Phalcon\Mvc\User\Plugin,
		Phalcon\Mvc\Dispatcher,
		Phalcon\Acl;


/**
 * Security
 * 
 * This plugin controlls that users only have access to the 
 * modules they're assigned to.
 */
class Security extends Plugin {
	public function beforeDispatch(Event $event, Dispatcher $dispatcher) {
		//check whether the 'auth' variable exists in session (if logged in)
		$auth = $this->session->get('auth');
		if(!$auth) {
			//not logged in
			$role = 'Guests';
		} else {
			//logged in TODO: make dynamic
			switch($auth['role']) {
				case 'Z':	//zombie
					$role = 'Zombies';
					break;
				case 'H':	//human
					$role = 'Humans';
					break;
				case 'M':	//mod
					$role = 'Mods';
					break;
				case 'O':	//oz
					$role = 'OZs';
					break;
				case 'S':	//spectator
				default :
					$role = 'Spectators';
					break;
			}
		}
		
		//take the active controller/action from the dispatcher
		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();
		
		//obtain the ACL list
		$acl = $this->getAcl(false);
		
		//check if the role has access to the controller (resource)
		$allowed = $acl->isAllowed($role,$controller,$action);
		if($allowed != Acl::ALLOW) {
			//does not have access to the controller, fwd to index
			$this->flashSession->error("$role don't have access to this page!");
			$dispatcher->forward(array(
				'controller' => 'index',
				'action' => 'index'
				));
			
			//return false to tell dispatcher to stop current operation
			return false;
		} else {
			//user is allowed in (do nothing)
			if($controller == 'admin' && $action == 'updateAcl') {
				//update acl
				$acl = $this->getAcl(true);
			}
		}
	}
	
	/**
	 * Creates ACL (Access Control List) if not already created
	 */
	public function getACL($isRefresh) {
		if($isRefresh || !isset($this->persistent->acl)) {
			//not yet created, make it 
			$acl = new Phalcon\Acl\Adapter\Memory();
			$acl->setDefaultAction(Phalcon\Acl::DENY);
			
			//register roles (TODO: add status functionality)
			$roles = array(
				'guests' => new Phalcon\Acl\Role('Guests'),
				'zombies' => new Phalcon\Acl\Role('Zombies'),
				'humans' => new Phalcon\Acl\Role('Humans'),
				'mods' => new Phalcon\Acl\Role('Mods'),
				'ozs' => new Phalcon\Acl\Role('OZs'),
				'spectators' => new Phalcon\Acl\Role('Spectators')
			);
			foreach($roles as $role) {
				$acl->addRole($role);
			}
						
			//Private area resources (the controller then actions)
			$privateResources = array(
				'profile' => array('index'),
				'session' => array('logout')
			);
			foreach($privateResources as $resource => $actions) {
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);				
			}
			
			//Public area resources
			$publicResources = array(
				'index' => array('index'),
				'session' => array('index',"login",'nosession','register'),
				'admin' => array('index','updateAcl','editData'),
				'modtools' => array('index', 'users')
			);
			foreach($publicResources as $resource => $actions) {
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}
			
			//Grant access to public areas to both users and guests
			foreach($roles as $role) {
				foreach($publicResources as $resource => $actions) {
					foreach($actions as $action) {
						$acl->allow($role->getName(),$resource,$action);
					}
				}
			}
			
			//Grant access to private area only to those logged in
			foreach($privateResources as $resource => $actions) {
				foreach ($actions as $action) {
					$acl->allow('Zombies',$resource,$action);
					$acl->allow('Humans',$resource,$action);
					$acl->allow('Mods',$resource,$action);
					$acl->allow('OZs',$resource,$action);
					$acl->allow('Spectators',$resource,$action);
				}
			}
			
			//store new ACL
			$this->persistent->acl = $acl;
		}
		
		return $this->persistent->acl;
	}
}


?>