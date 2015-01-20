<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller {
	protected function initialize() {
		$this->tag->prependTitle('HvZ | ');
    $this->view->setTemplateAfter('main');
	}
	
	/**
	 * Makes it easier to use the sql call
	 */
	protected function getActionData($action) {
		$controller = $this->dispatcher->getControllerName();
		return CustomSQL::getActionDataFormatted($controller,$action,$this->getDB());
	}
	
	protected function setActionData($action, $title, $data) {
		$controller = $this->dispatcher->getControllerName();
		return CustomSQL::prep_setActionData($controller,$action,$title,
			$data,$this->getDB());
	}
	
	/**
	 * Easier to put in sql functions
	 */
	protected function getDB() {
		return $this->getDI()->get('db');
	}
}
