<?php

namespace Com\Qinjq\Form\Showconvert;

use Com\Qinjq\Form\Dataflow\SDataBase;
abstract class SShowconvert extends SDataBase{
	protected $element;
	protected $content;
	
	abstract function getContent();
}