<?php

class AdminController extends ControllerBase {
	public function initialize() {
		$this->tag->setTitle('Admin');
		parent::initialize();
	}
	public function indexAction() {
		if($this->request->isPost() && $this->security->checkToken()) {
			$this->response->redirect("admin/updateAcl");
			$this->view->disable();
		}
		
		$actionData = $this->getActionData('index');
		$this->view->setVar('body', $actionData['body']);
	}
	public function updateAclAction() {
		$this->flashSession->success("Updated ACL");
		$this->response->redirect("admin/index");
		$this->view->disable();
	}
	
	/**
	 * Used in the testing of the normal ckeditor
	 */
	public function editDataAction($title) {
		//$this->asset->addJs('ckeditor/ckeditor.js');
		$this->view->setVar('title', $title);
		
		if($this->request->isPost() && $this->security->checkToken()) {
			//edit data
			$data = $this->request->getPost('data');
			
			if($this->setActionData('index',$title,$data)) {
				//successful, go back to index
				$this->flashSession->success("Updated $title");
				$this->response->redirect("admin/index");
				$this->view->disable();
			} else {
				//failed, go back to this page
				$this->flashSession->success("Error: Failed to save $title");
				$this->response->redirect("admin/editData/$title");
				$this->view->disable();
			}
			
		} else {
			//fill edit box with current data
			$actionData = $this->getActionData('index');
			$this->view->setVar('currData', $actionData[$title]);
		}
		
		
	}

}

