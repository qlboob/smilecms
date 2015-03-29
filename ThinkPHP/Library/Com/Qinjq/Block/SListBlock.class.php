<?php

namespace Com\Qinjq\Block;

use Com\Qinjq\Block\SBlock;
use Think\Page;
class SListBlock extends SBlock{
	
	/**
	 * where 查询条件
	 * @var array
	 */
	protected $where		=	array();
	
	protected $page;
	
	/**
	 * 记录是否执行
	 * @var array
	*/
	protected $init			=	array();
	
	protected $vars = array();
	
	function getData(){
		//总记录数
		$model		=	$this->getModel();
		$group		=	$this->getGroup();
		if ($group) {
			$model->group($group);
			if ($this->getHaving()) {
				$model->havine($this->getHaving());
			}
		}
		$cnt		=	$model->where($this->getWhere())->count();
		$cloneModel	=	$this->getModel();
		if($cnt){
			//显示范围
			$cloneModel->limit($this->getLimit($cnt));
				
			foreach (array('field','order','where') as $item) {
				$method	=	'get'.ucfirst($item);
				$cloneModel->$item($this->$method());
			}
				
			if ($group) {
				$cloneModel->group($group);
				if ($this->getHaving()) {
					$cloneModel->havine($this->getHaving());
				}
			}
	
			//排序
			/*$order	=	$this->getOrder();
				if($order){
			$cloneModel->order($order);
			}*/
			$list	=	$cloneModel->select();
			$this->assign('lists',$list);
			$this->assign('page',$this->page->show());
		}
	
		$this->assign('cnt',$cnt);
	}
	
	/**
	 * 得到select的字段
	 * @return string
	 */
	protected function getField() {
		$field = $this->param('field');
		if (empty($field)) {
			return '*';
		}
		return trim(trim($field,' '),',');
	}
	
	/**
	 * 得到排序
	 */
	protected function getOrder(){
		$ret	=	'';
		$order	=	$this->param('order');
		if($order){ // 如果用户设定了排序方式，用设定的方式
			$orders	=	explode(',',$order);
			$arr_order=	array();
			foreach($orders as $order){
				$oneOrder	=	explode(' ',$order);
				$orderField	=	array_shift($oneOrder);
				$asField	=	strpos($orderField,'.')?$orderField:$this->getAsField($orderField);
				if($asField){
					$arr_order[]=	$asField.' '. array_shift($oneOrder);
				}
			}
			$ret	=	implode(',',$arr_order);
		}elseif(isset($_REQUEST['_order'])){ // 参数的指定排序方式的时候，用指定方式
			$field	=	$_REQUEST['_order'];
		}else{ //默认以主表的主键，倒序排列
			$tableInfo	=	$this->getTableInfo();
			$firstTab	=	array_shift($tableInfo);
			$field		=	D($firstTab['table'])->getPk();
		}
	
		if($field){
			$sortby		=	array($field=>$this->getSort()=='DESC'?0:1);
			$this->assign('sortby',$sortby);
			$asField = $this->getAsField($field);
			$ret	=	"$asField ".$this->getSort();
		}
		return $ret;
	}
	
	protected function getSort(){
		return isset($_REQUEST['_sort'])&&$_REQUEST['_sort']?'ASC':'DESC';
	}
	
	/**
	 * get limit sql
	 * @param integer $cnt 记录总数
	 */
	protected function getLimit($cnt=0) {
		if (!$this->page) {
			if(isset($_REQUEST['_pagesize'])){
				$size	=	$_REQUEST['_pagesize'];
			}else{
				$size	=	20;
			}
			$this->page	=	new Page($cnt,$size);
		}
		return $this->page->firstRow.','.$this->page->listRows;
	}
	
	/**
	 * 得到在where或是在order中的列名
	 */
	function getAsField($field){
		$tables	=	$this->getTableInfo();
		foreach($tables as $tab){
			$fields	=	D($tab['table'])->getDbFields();
			if(in_array($field,$fields,true)){
				return $this->getJoinAs($tab).'.'.$field;
			}
		}
		return NULL;
	}
	
	/**
	 * get where condition
	 */
	protected function getWhere() {
		if (isset($this->init['getwhere']))return $this->where;
		//可限定的字段
		$whereFields	=	$this->param('wherefield');
		if ($whereFields) {
			$whereFields	=	explode(',', $whereFields);
			array_walk($whereFields,'trim');
			$whereFields	=	array_filter($whereFields,'strlen');
		}else {
			$whereFields	=	$this->getAllField();
		}
// 		$whereFields		=	array_intersect($whereFields, array_keys($_REQUEST));
		foreach ($_REQUEST as $k =>$v){
			if (''===$v or empty($k)) {
				continue;
			}
			if ('_'==substr($k, -1)) {
				#以“_”结尾的特殊处理
				if (preg_match('#(.+)_(\w+)_#', $k,$matches)) {
					if (in_array($matches[1], $whereFields)) {
						$this->_addWhere($this->where, $matches[1],$v, $matches[2]);
					}
				}
			}else {
				if (in_array($k, $whereFields)) {
					$this->_addWhere($this->where, $k, $v);
				}
			}
		}
		/*foreach ($whereFields as $whereField){
			if ($_REQUEST[$whereField]!=='') {
				$this->_addWhere($this->where,$whereField, $_REQUEST[$whereField]);
			}
		}*/
	
		$searchFields	=	$this->param('searchfield');
		$searchStr		=	I('get.searchStr');
		if ($searchFields) {
			$searchFields = sexplode($searchFields);
		}else {
			$tableInfo = $this->getTableInfo();
			$searchFields = array();
			foreach ($tableInfo as $table){
				$fields = D($table['table'])->db()->getFields(D($table['table'])->getTableName());
				foreach ($fields as $field=>$fieldInfo){
					if (FALSE!==stripos($fieldInfo['type'], 'char') or FALSE!==stripos($fieldInfo['type'], 'text')) {
						$searchFields[]=$field;
					}
				}
			}
			empty($searchFields) && $searchFields = $this->getAllField();
		}
		if ($searchStr) {
			$condition = array(
				'_logic'	=>	'OR',
			);
			foreach ($searchFields as $field){
				$condition[$field] = array('LIKE','%'.$searchStr.'%');
			}
			$this->where['_complex']	=	$condition;
		}elseif (isset($_REQUEST['_searchkey']) && $_REQUEST['_searchkey']!==''
				&& isset($_REQUEST['_searchvalue']) && $_REQUEST['_searchvalue']!=='') {
			//可搜索字段
			if ($searchFields) {
				$searchFields	=	sexplode($searchFields);
				$searchFields	=	array_filter($searchFields,'strlen');
			}else {
				$searchFields	=	$this->getAllField();
			}
			if (in_array($_REQUEST['_searchkey'], $searchFields)) {
				$this->_addWhere($this->where,$_REQUEST['_searchkey'],$_REQUEST['_searchvalue'],'like');
			}
		}
	
		//附加查询
		$additionWhere = $this->param('additionwhere');
		if (!empty($additionWhere)) {
			if (isset($this->where['_string'])) {
				$this->where['_string']	.=	" AND {$additionWhere}";
			}else {
				$this->where['_string']	=	$additionWhere;
			}
		}

		$this->init['getwhere'] = 1;
		return $this->where;
	}
	
	protected function _addWhere(&$where,$field,$value,$opt='eq') {
		//对于like 特别处理
		if (in_array(strtolower($opt), array('like','notlike'))) {
			$value	=	mysql_escape_string($value);
			$value	=	"%$value%";
		}
		//字段加上别名
		if (!strpos($field, '.'))
			$field		=	$this->getAsField($field);
	
		if (isset($where[$field])) {
			if (is_array ( $where [$field] )) {
				if (is_string ( $where [$field] [0] )) {
					$where [$field] = array ($where [$field], array ($opt, $value ) );
				} else {
					array_unshift ( $where [$field], array ($opt, $value ) );
				}
			} else {
				$where [$field] = array (array ('eq', $where [$field] ), array ($opt, $value ) );
			}
		}else {
			$where[$field]	=	array($opt,$value);
		}
	}
	
	/**
	 * 得到查询表的as字段.
	 */
	protected function getJoinAs($table){
		$ret	=	null;
		if(isset($table['as'])){
			$ret	=	$table['as'];
		}else{
			$ret	=	D($table['table'])->getTableName();
		}
		return $ret;
	}
	
	/**
	 * 得到所要查询表的信息
	 */
	protected function getTableInfo(){
		if(isset($this->init['gettableinfo'])){
			return $this->init['gettableinfo'];
		}
		$this->init['gettableinfo']	=	array();
		$paramTables = $this->param('tables');
		if(empty($paramTables)){ //对没有填表名，自动加上表名
			$this->init['gettableinfo']	=	array(
					array('table'=>strtolower(CONTROLLER_NAME)),
			);
		}elseif(FALSE !== strpos($paramTables,',')){ //这里是多表联合查询 inner join 方式
			$tables	=	sexplode($paramTables);
			foreach($tables as $tab){
				$oneTab	=	explode(' ',$tab);
				$oneTabInfo=	array();
				$oneTabInfo['table']=	array_shift($oneTab);
				if(count($oneTab)>1){
					$oneTabInfo['as']	=	array_pop($oneTab);
				}
				$this->init['gettableinfo'][] = $oneTabInfo;
			}
		}elseif(FALSE !== strpos($paramTables,' ')){
			$tables	=	preg_split('/\s+join\s+/i',$paramTables,-1, PREG_SPLIT_NO_EMPTY);
			foreach($tables as $tab){
				$oneTab	=	explode(' ',$tab);
				$oneTabInfo=	array();
				$oneTabInfo['table']	=	array_shift($oneTab);
				if(isset($nextType)){
					$oneTabInfo['type'] = $nextType;
				}
				$lastEle		=	array_pop($oneTab);
	
				//下一个表的连接类型
				if(in_array(strtolower($lastEle),array('left','inner','right'))){
					$nextType	=	"$lastEle JOIN";
				}else {
					if($lastEle!==NULL)
						array_push($oneTab,$lastEle);
					if(isset($nextType) ) unset($nextType);
				}
				//on条件
				$oneTabLower	=	array_map('strtoupper',$oneTab);
				$pos		=	array_keys($oneTabLower,'on');
				if($pos){
					$pos	=	array_shift($pos);
					$onCond	=	array_splice($oneTab,$pos);
					$oneTabInfo['on']=implode(' ',$onCond);
				}
	
				if(count($oneTab)>0){
					$oneTabInfo['as']	=	array_pop($oneTab);
				}
				$this->init['gettableinfo'][]	=	$oneTabInfo;
	
			}
		}else{ //只填了一个表名
			$this->init['gettableinfo'][]	=	array('table'=>trim($paramTables));
		}
		return $this->init['gettableinfo'];
	}
	
	/**
	 * 得到所有表中的字段
	 * return array
	 */
	protected function getAllField() {
		if (isset($this->init['getallfield'])) {
			return $this->init['getallfield'];
		}
		$tableInfo	=	$this->getTableInfo();
		$fields		=	array();
		foreach ($tableInfo as $tab) {
			$fields	=	array_merge($fields,D($tab['table'])->getDbFields());
		}
		unset($fields['_pk'],$fields['_type']);
		$this->init['getallfield']	=	 array_unique($fields);
		return $this->init['getallfield'];
	}
	
	protected function getGroup() {
		if (isset($this->init['getgroup']))return $this->init['getgroup'];
		$paramGroup = $this->param('gruop');
		if (empty($paramGroup)){
			$this->init['getgroup']	=	'';
		}else {
			$field	=	sexplode($paramGroup);
			array_walk($field,array($this,'getAsField'));
			$this->init['getgroup']	=	implode(',', $field);
		}
		return $this->init['getgroup'];
	}
	
	protected function getHaving() {
		if (isset($this->init['gethavine']))return $this->init['gethavine'];
		$paramHaving = $this->param('having');
		if (empty($paramHaving)){
			$this->init['gethaving']	=	'';
		}else {
			$this->init['gethaving']	=	$paramHaving;
		}
		return $this->init['gethaving'];
	}
	
	protected function getModel() {
		$tables	=	$this->getTableInfo();
		$mainTable=	array_shift($tables);
		$model	=	D($mainTable['table']);
		if(isset($mainTable['as'])){
			$model->alias($mainTable['as']);
		}
		$lastTable	=	$mainTable;
		foreach($tables as $tab){
			$joinModel	=	D($tab['table']);
			$joinAs		=	isset($tab['as'])?$tab['as']:'';
			$joinType	=	isset($tab['type'])?$tab['type']:'INNER JOIN';
			if(isset($tab['on'])){
				$onTab	=	$tab['on'];
			}else{
				$lastModel=	D($lastTable['table']);
				$lastFields=	$lastModel->getDbFields();
				$joinFields=	$joinModel->getDbFields();
				unset($lastFields['_autoinc'],
						$lastFields['_pk'],
						$lastFields['_type'],
						$joinFields['_autoinc']
						,$joinFields['_pk'],
						$joinFields['_type']);
				$interFields=	array_intersect($lastFields,$joinFields);
				$onTab	=	'';
				$lastAs	=	$this->getJoinAs($lastTable);
				$joinAS	=	$this->getJoinAs($tab);
				foreach($interFields as $field){
					$onTab	.=	"$lastAs.$field=$joinAS.$field";
				}
			}
			$model->join("$joinType ".$joinModel->getTableName()." $joinAs ON $onTab");
			$lastTable	=	$tab;
		}
		return $model;
	}
	
	public function render() {
		
	}

	function assign($name, $val = NULL) {
		if (is_string($name)) {
			if (NULL===$val) {
				return $this->vars[$name];
			}
			$this->vars[$name]	=	$val;
		}else {
			$this->vars	=	array_merge($this->tpVar,$name);
		}
	}
}