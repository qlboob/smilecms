<?php
namespace Ptadmin\Controller;

include_once MODULE_PATH.'Conf/common.php';
class DevController extends \Dev\Controller\DevController {
	function _initialize() {
		if (empty($_SESSION['uid'])) {
			$this->redirect(MODULE_NAME.'/Login/index');
			exit;
		}
	}
	function _before_add() {
		$this->template='add';
	}
	function _before_edit() {
		$this->template='edit';
	}
	function _before_index() {
		$this->template='index';
	}
}