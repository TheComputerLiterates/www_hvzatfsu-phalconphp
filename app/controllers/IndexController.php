<?php

class IndexController extends ControllerBase {
	public function initialize() {
		$this->tag->setTitle('Home');
		parent::initialize();
	}
	public function indexAction() {
/*		//handle assets
		$this->assets
			->addCss('css/custom.css');*/

		//$result = CustomSQL::prep_selectRoleByName('Human',$this->getDI()->get('db'));
		$result = CustomSQL::prep_selectRoleById(1,$this->getDI()->get('db'));
		$this->view->setVar('result', $result);	
		
		$resultData = $this->getActionData('index');
		$this->view->setVar('resultData', $resultData);	
		
	}
}

?>

