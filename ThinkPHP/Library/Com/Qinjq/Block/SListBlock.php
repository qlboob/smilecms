<?php

namespace Com\Qinjq\Block;

use Com\Qinjq\Block\SBlock;
class SListBlock extends SBlock{
	
	/**
	 * where 查询条件
	 * @var array
	 */
	protected $where		=	array();
	
	/**
	 * 记录是否执行
	 * @var array
	*/
	protected $init			=	array();
	
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
			$this->assign('list',$list);
			$this->assign('page',$this->page->show());
		}
	
		$this->assign('cnt',$cnt);
	}
	
	/**
	 * 得到select的字段
	 * @return string
	 */
	protected function getField() {
		if (empty($this->blk_param['field'])) {
			return '*';
		}
		return trim(trim($this->blk_param['field'],' '),',');
	}
	
	/**
	 * 得到排序
	 */
	protected function getOrder(){
		$ret	=	'';
		if($this->blk_param['order']){ // 如果用户设定了排序方式，用设定的方式
			$orders	=	explode(',',$this->blk_param['order']);
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
			$field		=	M($firstTab['table'])->getPk();
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
			import ( "ORG.Util.Page" );
			if(isset($_REQUEST['_pagesize'])){
				$size	=	$_REQUEST['_pagesize'];
			}else{
				$size	=	'';
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
			$fields	=	M($tab['table'])->getDbFields();
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
		$whereFields	=	$this->blk_param['wherefield'];
		if ($whereFields) {
			$whereFields	=	explode(',', $whereFields);
			array_walk($whereFields,'trim');
			$whereFields	=	array_filter($whereFields,'strlen');
		}else {
			$whereFields	=	$this->getAllField();
		}
		$whereFields		=	array_intersect($whereFields, array_keys($_REQUEST));
		foreach ($whereFields as $whereField){
			if ($_REQUEST[$whereField]!=='') {
				$this->_addWhere($this->where,$whereField, $_REQUEST[$whereField]);
			}
		}
	
		//可搜索字段
		if (isset($_REQUEST['_searchkey']) && $_REQUEST['_searchkey']!==''
				&& isset($_REQUEST['_searchvalue']) && $_REQUEST['_searchvalue']!=='') {
					$searchFields	=	$this->blk_param['searchfield'];
					if ($searchFields) {
						$searchFields	=	explode(',', $searchFields);
						array_walk($searchFields, 'trim');
						$searchFields	=	array_filter($searchFields,'strlen');
					}else {
						$searchFields	=	$this->getAllField();
					}
					if (in_array($_REQUEST['_searchkey'], $searchFields)) {
						$this->_addWhere($this->where,$_REQUEST['_searchkey'],$_REQUEST['_searchvalue'],'like');
					}
				}
	
				//附加查询
				if (!empty($this->blk_param['additionwhere'])) {
					if (isset($this->where['_string'])) {
						$this->where['_string']	.=	" AND {$this->blk_param['additionwhere']}";
					}else {
						$this->where['_string']	=	$this->blk_param['additionwhere'];
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
			$ret	=	M($table['table'])->getTableName();
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
		if(empty($this->param('tables'))){ //对没有填表名，自动加上表名
			$this->init['gettableinfo']	=	array(
					array('table'=>strtolower(CONTROLLER_NAME)),
			);
		}
		$this->blk_param['tables']	=	trim($this->blk_param['tables']);
		if(strpos($this->blk_param['tables'],',')){ //这里是多表联合查询 inner join 方式
			$tables	=	explode(',',$this->blk_param['tables']);
			array_walk($tables,'trim');
			foreach($tables as $tab){
				$oneTab	=	explode(' ',$tab);
				$oneTabInfo=	array();
				$oneTabInfo['table']=	array_shift($oneTab);
				if(count($oneTab)>1){
					$oneTabInfo['as']	=	array_pop($oneTab);
				}
				$this->init['gettableinfo'][] = $oneTabInfo;
			}
		}elseif(strpos($this->blk_param['tables'],' ')){
			$tables	=	preg_split('/\s+join\s+/i',$this->blk_param['tables'],-1, PREG_SPLIT_NO_EMPTY);
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
			$this->init['gettableinfo'][]	=	array('table'=>trim($this->blk_param['tables']));
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
			$fields	=	array_merge($fields,M($tab['table'])->getDbFields());
		}
		unset($fields['_pk'],$fields['_type']);
		$this->init['getallfield']	=	 array_unique($fields);
		return $this->init['getallfield'];
	}
	
	protected function getGroup() {
		if (isset($this->init['getgroup']))return $this->init['getgroup'];
		if (empty($this->blk_param['group'])){
			$this->init['getgroup']	=	'';
		}else {
			$field	=	sexplode($this->blk_param['group']);
			array_walk($field,array($this,'getAsField'));
			$this->init['getgroup']	=	implode(',', $field);
		}
		return $this->init['getgroup'];
	}
	
	protected function getHaving() {
		if (isset($this->init['gethavine']))return $this->init['gethavine'];
		if (empty($this->blk_param['having'])){
			$this->init['gethaving']	=	'';
		}else {
			$this->init['gethaving']	=	$this->blk_param['having'];
		}
		return $this->init['gethaving'];
	}
	
	protected function getModel() {
		$tables	=	$this->getTableInfo();
		$mainTable=	array_shift($tables);
		$model	=	M($mainTable['table']);
		if(isset($mainTable['as'])){
			$model->alias($mainTable['as']);
		}
		$lastTable	=	$mainTable;
		foreach($tables as $tab){
			$joinModel	=	M($tab['table']);
			$joinAs		=	isset($tab['as'])?$tab['as']:'';
			$joinType	=	isset($tab['type'])?$tab['type']:'INNER JOIN';
			if(isset($tab['on'])){
				$onTab	=	$tab['on'];
			}else{
				$lastModel=	M($lastTable['table']);
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

}