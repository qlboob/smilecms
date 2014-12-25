<?php
namespace Dev\Controller;
use Dev\Controller\DevController;

class FormController extends DevController{
	

	function test() {
		$formList = D('Form')->field('frm_id')->select();
		if ($formList) {
			foreach ($formList as $v){
				$form = \Com\Qinjq\Form\Element\SForm::create($v['frm_id']);
				$generator = new \Com\Qinjq\Form\Dataflow\Generator($form);
				$data = $generator->run();
				$writeStr = sprintf('<?php return %s;',var_export($data,TRUE));
				echo $writeStr;
				break;
			}
		}
	}
}