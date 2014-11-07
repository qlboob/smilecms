<?php

namespace Com\Qinjq\Block;
use Com\Qinjq\Block\SListBlock;
/**
 * @author Lukeqin
 * @eg
 *
 */
class SAdminListBlock extends SListBlock{
	
	private function getTable($table='') {
		$table||$table	=	parse_name(CONTROLLER_NAME);
		$ret	=	array($table);
		while ($parentId=D('Model')->where("mdl_table='$table'")->getField('mdl_parent')) {
			$table	=	D('Smodel')->where("mdl_id=$parentId")->getField('mdl_table');
			array_unshift($ret,$table);
		}
		return $ret;
	}
	
	function render() {
		$showCol=	array();
		$ths 	=	array(); // 表头显示数据
		$tds	=	array(); // 内容显示数据
		$table	=	$this->getTable();
		$modelM	=	D('Model');
		$using	=	$modelM->getPk();
		$where	=	array(
				'mdl_table'	=>	array('IN',$table),
				'F.mdf_listtitle'=>array('NEQ',''),
		);
		$data	=	$modelM->join('NATURE JOIN '.D('Modelfield')->getTableName(). " F USING($using)")
		->where($where)
		->order('mdf_weight ASC ,mdf_id ASC')
		->field('mdf_listtitle,mdf_id,mdf_name')
		->select();
		$pk = D(parse_name($table[0],1))->getPk();
		$actionList	=	array();
		foreach ($data as $v) {
			if ($v['mdf_name']==$pk && $v['mdf_listtitle']) {
				/**
				 * 是主键的情况，作为actionlist
				 * 第一行为第一列显示的标题（thead-tr-td）
				 * 第二行为第一列显示的内容(tbody-tr-td)
				 * 第三行为最后一列显示的标题
				 * 第四行为最后一列显示的内容
				 */
				$lines	=	preg_split("/\r?\n/", $v['mdf_listtitle'],4);
				$pkTitle=	array_shift($lines);
				if ($pkTitle) {
					array_unshift($ths, $pkTitle);
					array_unshift($ths, array_shift($lines));
				}
				foreach ($lines as $line) {
					$actionList[] = $this->dealTd($pk, $line);
				}
			}else {
				list($th,$td)	=	preg_split("/\r?\n/", $v['mdf_listtitle']."\r\n",2);
				$ths[]	=	$th;
				$tds[]	=	$this->dealTd($v['mdf_name'], $td);
			}
		}
		$tds[] = implode('', $actionList);
		$this->assign('pk',$pk);
		$this->assign('param_show',$showCol);
		$this->assign('param_action',$actionList);
		
		$tableClass = $this->param('tableClass');
		$thTrStr	=	'';
		foreach ($ths as $v){
			$thTrStr	.=	"<td>$v</td>";
		}
		$tdTrStr	=	'';
		foreach ($tds as $v){
			$tdTrStr.=	"<td>$v</td>";
		}
		$tpl = <<<EOF
<table class="$tableClass"><thead><tr>$thTrStr</tr></thead><tbody><?php foreach(\$lists as \$v){?><tr>$tdTrStr</tr><?php }?></tbody></table>
EOF;
		$tpl = trim($tpl);
		return $this->toHtml($tpl);
		
	}
	
	function toHtml($tpl) {
		ob_start();
		extract($this->vars);
		eval('?>'.$tpl);
		return ob_get_clean();
	}
	
	/**
	 * @param string $field 字段名
	 * @param string $td
	 * @return string
	 */
	private function dealTd($field,$td){
		$td	=	trim($td);
		if (empty($td)) {
			#什么都不写，直接显示值
			return "<?php echo \$v['$field'];?>";
		}elseif ('|'==$td) {
			#“|”使用htmlspecialchars函数
			return "<?php echo htmlspecialchars(\$v['$field']);?>";
		}elseif (preg_match('#^\w+$#', $td)){
			#使用函数
			return "<?php echo $td(\$v['$field']);?>";
		}elseif (FALSE !== strpos($td, '###')){
			return sprintf('<?php echo %s;?>',str_replace( '###', "\$v['$field']",$td));
		}
		else {
			return $td;
		}
	}
}