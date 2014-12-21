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
	 * @var string 包裹表单的div的类
	 */
	protected $formOutDivClass='';
	
	/**
	 * @var string 表单增加的类
	 */
	protected $formClass='';
	
	/**
	 * @var string 表单内div的类
	 */
	protected $formInnerDivClass='';
	
	/**
	 * @var string 每一行div要增加的类
	 */
	protected $lineClass='';
	
	/**
	 * @var string label要增加的类
	 */
	protected $labelClass='';
	
	/**
	 * @var string 当label为空时label的类
	 */
	protected $emptyLabelClass='';
	
	/**
	 * @var string 包裹input元素的div要增加的类
	 */
	protected $inputDivClass='';
	
	/**
	 * @var string input元素要增加的类
	 */
	protected $inputClass='';
	
	protected $buttonClass='';
	
	
	public function getContent() {
		$ele = $this->element;
		if (!$ele->config('display')) {
			#不显示元素跳过
			return '';
		}
		$tag = $ele->config('tag');
		if ('form'==$tag) {
			if ($this->formOutDivClass) {
				$this->addOutPut('<div class="'.$this->formOutDivClass.'">','</div>');
			}
			$ele->addClass($this->formClass);
		}
		if ($ele->config('container')) {
			$this->addOutPut($ele->getInputHtml());
		}else {
			if ('hidden'==$ele->attr('type') or !$tag) {
				$this->addOutPut($ele->getInputHtml());
			}else {
				if ($ele->config('label')) {
					$ele->addLabelClass($this->labelClass);
				}else {
					$ele->addLabelClass($this->emptyLabelClass);
				}
				if ('button'==$tag and $this->buttonClass) {
					$ele->addClass($this->buttonClass);
				}else {
					$ele->addClass($this->inputClass);
				}
				$labelHtml = $ele->getLabelHtml();
				$inputHtml = $ele->getInputHtml();
				$this->addOutPut('<div class="'.$this->lineClass.'">'.$labelHtml,'</div>');
				if ($this->inputDivClass) {
					$this->addOutPut('<div class="'.$this->inputDivClass.'">','</div>');
				}
					$this->addOutPut($inputHtml);
			}
		}
		$ret = $this->output();
		if($this->formInnerDivClass and 'form'==$tag){
			$ret = preg_replace_callback('#(<form .+?)><#', array($this,'addFormInnerDiv'),$ret,1);
			str_replace('</form>', '</div></form>', $ret);
		}
		return trim($ret);
	}
	function addFormInnerDiv($matches) {
		return $matches[1].'><div class="'.$this->formInnerDivClass.'"><';
	}
}