<?php

namespace Com\Qinjq\Form\Element;

class SElement {
	
	/**
	 * 元素属性
	 * 普通属性：键为字符串=>值为字符串
	 * 条件属性：键为字符串=>值为数组（第一个元素为条件，第二个元素为值）
	 * @var array
	 */
	protected $attr	=	array();
	
	protected $additionAttr = array();
	
	/**
	 * label
	 * @var string
	 */
	protected $label;
	
	
	protected $labelAttr = array();
	
	
	/**
	 * weight
	 * @var integer
	 */
	protected $weight=0;
	
	/**
	 * form element
	 * @var SForm
	 */
	protected $form;
	
	/*
	 * children element
	* @var array
	*/
	protected $child=array();
	
	/**
	 * parentElement
	 * @var SElement
	*/
	protected $parent;
	
	/**
	 * the tag eg:input - <input />
	 * @var string
	 */
	protected $tag;
	
	/**
	 * whether the tag is self close;
	 * @var boolean
	 */
	protected $selfCloseTag = TRUE;
	
	/**
	 * @var boolean 是否是容器
	 */
	protected $container	=	FALSE;
	
	/**
	 * 元素自身的key
	 * @var string
	 */
	protected $key;
	
	/**
	 * validators
	 * @var array
	 */
	protected $validator	=	array();
	
	/**
	 * @var object 数据提交转换
	 */
	protected $postConvert;
	
	/**
	 * @var object 数据展示转换
	 */
	protected $showConvert;
	
	/**
	 * @var object 数据自动填充
	 */
	protected $fill;
	
	/**
	 * @var array 修饰器
	 */
	protected $decorator	=	array();
	
	/**
	 * the render object
	 * @var Object
	 */
	protected $render;
	
	/**
	 * @var object 默认渲染器
	 */
	protected $defaultRender;
	
	/**
	 * @var array 参数
	 */
	protected $param = array(
		//'defaultValue' => 0,
		//'echoVar'=>'',
		'filterFun'	=>	'htmlspecialchars',
		'preInput'	=>	array(),
		'endInput'	=>	array(),
		'preLine'	=>	array(),
		'endLine'	=>	array(),
	);
	
	protected $additionParam = array();

	/* 数据库里的主键 */
	protected $dbId;
	
	/**
	 * @var boolean 是否在表单中显示
	 */
	protected $display=TRUE;
	
	
	function __construct() {
		$this->attr($this->additionAttr);
		$this->param($this->additionParam);
	}
	
	/**
	 *
	 * set/get attr
	 * @param string|array $key
	 * @param string $value
	 */
	function attr($key,$value=NULL) {
		if (is_array($key)) {
			$this->attr	=	array_merge($this->attr,$key);
		}elseif ($value===NULL) {
			return isset($this->attr[$key])?$this->attr[$key]:NULL;
		}else {
			$this->attr[$key]	=	$value;
		}
	}
	
	function labelAttr($key,$value=NULL) {
		if (is_array($key)) {
			$this->labelAttr	=	array_merge($this->labelAttr,$key);
		}elseif ($value===NULL) {
			return isset($this->labelAttr[$key])?$this->labelAttr[$key]:NULL;
		}else {
			$this->labelAttr[$key]	=	$value;
		}
	}
	
	/**
	 * unset attribute
	 * @param string|array $key
	 */
	function unsetAttr($key) {
		$key	=	(array)$key;
		foreach ($key as $value) {
			if (isset($this->attr[$value])) {
				unset($this->attr[$value]);
			}
		}
	}
	
	/**
	 * build attribute
	 * @return string
	 */
	function buildAttr($attr=null) {
		$ret	=	'';
		if (null==$attr) {
			$attr	=	$this->attr;
			$id		=	$this->getId();
			if ($id) {
				//$attr['id']	=	$id;
			}
		}
		$noAttr	=	$this->param('noAttr');
		if ($noAttr and is_string($noAttr)) {
			$noAttr = explode(',', $noAttr);
		}
		foreach ($attr as $key => $value) {
			if ($key!=='' && $value!==''){
				if ($noAttr and in_array($key, $noAttr)) {
					continue;
				}
				if (is_array($value)) {
					//条件属性
					$ret .= sprintf(' <?php if(%s){?>%s="%s"<?php }?>',$value[0],$key,$this->buildAttrValue($value[1]));
				}else {
					$ret	.=	sprintf(' %s="%s"',$key,$this->buildAttrValue($value));
				}
			}
		}
		return $ret;
	}
	
	function buildAttrValue($value) {
		if ('$'==substr($value, 0,1)) {
			return sprintf('<?php if(isset(%s))echo %s;?>',$value,$value);
		}/* elseif(FALSE!==strpos($value, "\n")){
			$value = preg_replace('#\r?\n#', '&#13;', $value);
		} */
		return $value;
	}
	
	/**
	 * 设置/得到 参数
	 * @param array|string $key
	 * @param string $value
	 * @return Ambigous <NULL, multitype:>
	 */
	function param($key,$value=NULL) {
		if (is_array($key)) {
			foreach ($key as $k => $v) {
				$this->param($k,$v);
			}
		}elseif (NULL === $value) {
			return isset($this->param[$key])?$this->param[$key]:NULL;
		}else {
			if (in_array($key, array('preLine','endLine','preInput','endInput'))) {
				$this->param[$key][]=$value;
			}else{
				$this->param[$key] = $value;
			}
		}
	}
	
	function config($key,$value=NULL) {
		if (is_array($key)) {
			foreach ($key as $k=>$v){
				$this->config($k,$v);
			}
		}elseif ($value===NULL) {
			return $this->$key;
		}else{
			$this->$key = $value;
		}
	}
	
	
	/**
	 * get attribute id
	 * @return string
	 */
	function getId() {
		if ($attrId	=	$this->attr('id')) {
			return $attrId;
		}
		if ($attrName	=	$this->attr('name')) {
			return str_replace(array('[',']'), array('_',''), $attrName);
		}
		return NULL;
	}
	
	
	/**
	 * get echo variable
	 * @return NULL|string
	 */
	function getEchoVar() {
		$echoVar = $this->param('echoVar');
		if ($echoVar===''){
			return NULL;
		}
		if ($echoVar) {
			return $echoVar;
		}
		if ($attrName	=	$this->attr('name')) {
			$ret	=	 str_replace(array('[',']'), array("['","']"), $attrName);
			return str_replace("['']", '',$ret);
		}
		return NULL;
	}
	
	/**
	 * add class for element
	 * @param string $cls
	 */
	function addClass($cls) {
		$attrClass	=	$this->attr('class');
		$attrClass	=	$attrClass?$attrClass:'';
		$this->attr('class',trim($attrClass.' '.$cls));
	}
	
	function removeClass($cls) {
		$attrClass	=	$this->attr('class');
		$attrClass	=	$attrClass?$attrClass:'';
		$attrClass	=	explode(' ', $attrClass);
		if (is_string($cls)) {
			$cls	=	explode(' ', $cls);
		}
		$left	=	array_diff($attrClass, $cls);
		$this->attr('class',implode(' ', $left));
	}
	function addLabelClass($cls) {
		$existClass = empty($this->labelAttr['class'])?'':$this->labelAttr['class'];
		$arrClass = explode(' ', $existClass);
		$arrAddclass = explode(' ', $cls);
		foreach ($arrAddclass as $v){
			if (!in_array($v, $arrClass)) {
				$arrClass[] = $v;
			}
		}
		$this->labelAttr['class'] = implode(' ', $arrClass);
	}
	
	function renderInput() {
		$ret	=	'';
		if ($this->tag) {
			$ret	=	"<{$this->tag}".$this->buildAttr();
		}
		$phpVar	=	$this->getValuePHP();
		if (!$this->container && $this->selfCloseTag){
			if ($phpVar){
				$ret	.=	' value="'.$phpVar.'"';
			}
			$ret	.=	' />';
		}else {
			if ($this->tag) {
				$ret	.=	'>';
			}
			if ($this->container) {
				$ret	.=	$this->renderChild();
			}elseif ($phpVar) {
				$ret	.=	$phpVar;
			}
			if ($this->tag) {
				$ret	.=	"</{$this->tag}>";
			}
		}
		return $ret;
	}
	/**
	 * 得到input的代码
	 * @return string
	 */
	function getInputHtml() {
		$showConvertHtml = $this->getShowConvertHtml();
		$ret = $this->renderInput();
		return $showConvertHtml.implode('', $this->param['preInput']).$ret.implode('', $this->param['endInput']);
	}
	
	function getPreLineHtml() {
		$preLine = $this->param('preLine');
		return implode(' ', $preLine);
	}
	function getEndLineHtml() {
		$endLine = $this->param('endLine');
		return implode(' ', $endLine);
	}
	
	function getShowConvertHtml() {
		if ($this->showConvert) {
			return $this->showConvert->getContent();
		}
		return '';
	}
	
	
	
	
	
	/**
	 * 得到label代码
	 * @return string|NULL 
	 */
	function getLabelHtml() {
		$arrAttr = $this->labelAttr;
		/*$id = $this->getId();
		if ($id and !isset($arrAttr['for'])) {
			$arrAttr['for'] = $id;
		}*/
		$attrStr = $this->buildAttr($arrAttr);
		return "<label $attrStr>{$this->label}</label>";
	}
	
	/**
	 * 得到输出的变量PHP代码
	 * @return string
	 */
	function getValuePHP() {
		$value = $this->attr('value');
		if (NULL !== $value) {
			return $value;
		}
		$defaultValue = $this->param('defaultValue');
		$echoVar = $this->getEchoVar();
		$filterFun = $this->param('filterFun');
		if (NULL !== $defaultValue) {
			if (substr($defaultValue, 0,1)!='$'){
				$defaultValue	=	addcslashes($defaultValue, "'");
				$defaultValue	=	"'{$defaultValue}'";
			}
			return sprintf('<?php echo %s(isset($%s)?$%s:%s) ?>',$filterFun,$echoVar,$echoVar,$defaultValue);
		}
		return sprintf('<?php if(isset($%s))echo %s($%s) ?>',$echoVar,$filterFun,$echoVar);
	}
	
	
	
	function setRender($render,$config=array()) {
		$className = 'Com\Qinjq\Form\Render\S'.ucfirst($render).'Render';
		$render = new $className($config);
		$render->setElement($this);
		$this->render = $render;
	}
	
	function setDefaultRender($render,$config=array()) {
		$className = 'Com\Qinjq\Form\Render\S'.ucfirst($render).'Render';
		$render = new $className($config);
		$render->setElement($this);
		$this->defaultRender= $render;
	}
	
	function render() {
		$render = $this->render;
		$render = $render?$render:$this->defaultRender;
		if ($render) {
			return (string)$render;
		}
	}
	
	function addDecorator($type,$param=array()) {
		$className = 'Com\Qinjq\Form\Decorator\S'.ucfirst($type).'Decorator';
		$decorator = new $className();
		$decorator->param($param);
		$this->decorator[] = $decorator;
	}
	
	function decorate() {
		foreach ($this->decorator as $decorator){
			$decorator->run($this);
		}
		if ($this->child) {
			foreach ($this->child as $v){
				$v->decorate();
			}
		}
	}
	
	function addValidator($type,$config,$param) {
		$className = 'Com\Qinjq\Form\Validator\S'.ucfirst($type).'Validator';
		$validator = new $className();
		$validator->config($config);
		if ($param) {
			$validator->param($param);
		}
		$this->validator[] = $validator;
	}
	
	function addFill($type,$config) {
		$className = 'Com\Qinjq\Form\Fill\S'.ucfirst($type).'Fill';
		$obj = new $className();
		$obj->config($config);
		$this->fill= $obj;
	}
	function addPostConvert($type,$config) {
		$className = 'Com\Qinjq\Form\Postconvert\S'.ucfirst($type).'Postconvert';
		$postconvert = new $className();
		$postconvert->config($config);
		$this->postConvert = $postconvert;
	}
	function addShowConvert($type,$config) {
		$className = 'Com\Qinjq\Form\Showconvert\S'.ucfirst($type).'Showconvert';
		$showObj = new $className();
		$config['element'] = $this;
		$showObj->config($config);
		$this->showConvert = $showObj;
	}
}
