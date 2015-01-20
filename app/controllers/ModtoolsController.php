<?php

class ModtoolsController extends ControllerBase {
	public function initialize() {
		$this->tag->setTitle('Mod Tools');
		parent::initialize();
	}
	public function indexAction() {
			
	}
	
	/**
	 * Page used to edit user accounts.
	 * Mods can:
	 * 	Delete users
	 * 	Change user roles
	 * 	Search by username/firstname/lastname
	 * 	Activate/Deactivate users
	 * 	Sort by active/username/firstname/lastname
	 * NOTE: All of these things need to be seemless with javascript and allow
	 * 		for more than one thing to happen at once. Like with a save
	 * 		all changes btn; 
	 * 
	 * @param currPage
	 *        Current page of the table
	 *        Total amount determined the LIMIT size		
	 * 
	 * @param showOptions
	 *        Each digit corresponds to a column (in the order in getAllUsers)
	 *        If 1, the column is displayed
	 *        
	 * @param sortOption
	 *        Corresponds to column, left to right
	 */
	public function usersAction($currPage=0, $showOptions="111111111",$sortOption=0) {
		$userList = $this->getAllUsers("ORDER BY role,id LIMIT 50");
		
		//pass needed vars to view
		$this->view->setVar('userList', $userList);
		$this->view->setVar('showOptions', $showOptions);
		$this->view->setVar('currPage', $currPage);
		$this->view->setVar('sortOption', $sortOption);
	}
	
	
	/**
	 * Returns all users. The sql can be modified with the given param
	 * The selection is everything (*), but it is all listed here for reference.
	 */
	private function getAllUsers($extraSql="LIMIT 10") {
		$sql = "SELECT role,id,username,first_name,last_name,email,created_at,kills,active
					FROM user_with_role $extraSql";
		$userList = CustomSQL::querySQL($sql, $this->getDB());
		
		return $userList;
	}

}

