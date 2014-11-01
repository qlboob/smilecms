<?php

namespace Com\Qinjq\Form\Render;
use Com\Qinjq\Form\Render\SRender;

/**
 * div渲染器
 * 最终效果是使用div来包裹单中各个元素
 * @author lukeqin
 *
 */
class SDivRender extends SRender {
	
	/**
	 * @var string 表单增加的类
	 */
	protected $formClass='';
	
	/**
	 * @var string label要增加的类
	 */
	protected $labelClass='';
	
	/**
	 * @var string 包裹input元素的div要增加的类
	 */
	protected $inputDivClass='';
	
	/**
	 * @var string input元素要增加的类
	 */
	protected $inputClass='';
	
	/**
	 * @var string 每一行div要增加的类
	 */
	protected $lineClass='';
	
	public function getContent() {
		$ret = '';
		$ele = $this->element;
		$tag = $ele->config('tag');
		if ('form'==$tag) {
			$ele->addClass($this->formClass);
		}
		if ($ele->config('container')) {
			$ret = $ele->getInputHtml();
		}else {
			$ele->addLabelClass($this->labelClass);
			$ele->addClass($this->inputClass);
			$labelHtml = $ele->getLabelHtml();
			$inputHtml = $ele->getInputHtml();
			$ret = <<<EOF
<div class="{$this->lineClass}">
	{$labelHtml}
	<div class="{$this->inputDivClass}">
		{$inputHtml}
	</div>
</div>
EOF;
		}
		return trim($ret);
	}
}