<?php

namespace Com\Qinjq\Wechat;

class SPay {
	private $appId;
	private $appSecret;//app密钥
	private $mchId;//商户号
	private $payKey;//支付密钥
	//证书路径
	private $sslCert;
	private $sslKey;
	
	private $curlTimeout=10;
	
	function __construct($config=array()) {
		foreach ($config as $k=>$v){
			$this->$k=$v;
		}
	}
	
	/**
	 * 生成随机字串
	 * @param number $length 长度，默认为16，最长为32字节
	 * @return string
	 */
	public function generateNonceStr($length=16){
		// 密码字符集，可任意添加你需要的字符
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for($i = 0; $i < $length; $i++)
		{
		$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return $str;
	}
	
	function arrayToXml($arr)
	{
		$xml = "<xml>";
		foreach ($arr as $key => $val) {
			$xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
		}
		$xml .= "</xml>";
		return $xml;
	}
	
	function xmlToArr($xml) {
		return (array)simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
	}
	
	public function postXML($url,$xml) {
		if (is_array($xml)) {
			$xml=$this->arrayToXml($xml);
		}
		$ch = curl_init($url);
		curl_setopt_array($ch, array(
			CURLOPT_SSL_VERIFYPEER=>FALSE,
			CURLOPT_SSL_VERIFYHOST=>FALSE,
			CURLOPT_HEADER=>FALSE,
			CURLOPT_RETURNTRANSFER=>TRUE,
			CURLOPT_POST=>TRUE,
			CURLOPT_POSTFIELDS=>$xml,
		));
		$resp= curl_exec($ch);
		$errno = curl_errno($ch);
		if ($errno) {
			\Log::write("fetch $url failed error[$errno], error msg :".curl_error($ch));
			$resp = FALSE;
		}
		curl_close($ch);
		return $resp;
	}
	
	/**
	 * 签名
	 * @param array $param
	 * @return string
	 */
	public function sign(array $param) {
		ksort($param);
		$param['key'] = $this->payKey;
		$arr = array();
		foreach ($param as $k=>$v){
			$arr[] = "$k=$v";
		}
		$str = implode('&',$arr);
		return strtoupper(md5($str));
	}
	
	/**
	 * 下单
	 * @param array $info 
	 * 参数 参考 http://mch.weixin.qq.com/wiki/doc/api/index.php?chapter=9_1
	 */
	function placeAnOrder($info) {
		$param = array_merge(array(
				'trade_type'=>'JSAPI',
				'spbill_create_ip'=>$_SERVER['REMOTE_ADDR'],
			),$info,array(
				'appid'=>$this->appId,
				'mch_id'=>$this->mchId,
				'nonce_str'=>$this->generateNonceStr(),
		));
		$param['sign'] = $this->sign($param);
		$resp = $this->postXML('https://api.mch.weixin.qq.com/pay/unifiedorder', $param);
		$array = (array)simplexml_load_string($resp, 'SimpleXMLElement', LIBXML_NOCDATA);
		return $array;
	}
	
	/**
	 * 得到js支付的参数
	 * @param array $param 
	 */
	function getJsPayParam($param) {
		$orderInfo = $this->placeAnOrder($param);
		if ('SUCCESS'==$orderInfo['return_code'] and 'SUCCESS'==$orderInfo['result_code']) {
			$jsParam = array(
				'appId'=>$this->appId,
				'timeStamp'=>time().'',
				'nonceStr'=>$this->generateNonceStr(),
				'package'=>"prepay_id={$orderInfo['prepay_id']}",
				'signType'=>'MD5',
			);
			$jsParam['paySign']=$this->sign($jsParam);
			return $jsParam;
		}else {
			return FALSE;
		}
	}
	
	/**
	 * 微信通知支付完成
	 * @return array|boolean
	 * 参考 http://mch.weixin.qq.com/wiki/doc/api/index.php?chapter=9_7
	 */
	function notify() {
		$content =file_get_contents("php://input");
		$array = $this->xmlToArr($content);
		$sign = $array['sign'];
		unset($array['sign']);
		if ($this->sign($array)==$sign) {
			return $array;
		}
		return FALSE;
	}
	
	/**
	 * 查询定单
	 * @param array|string $param 商户定单号或数组
	 * @see http://mch.weixin.qq.com/wiki/doc/api/index.php?chapter=9_2
	 * @return array|boolean
	 */
	function queryOrder($param) {
		if (!is_array($param)) {
			$param=array('out_trade_no'=>$param);
		}
		$param = array_merge($param,array(
			'appid'=>$this->appId,
			'mch_id'=>$this->mchId,
			'nonce_str'=>$this->generateNonceStr(),
		));
		$param['sign'] = $this->sign($param);
		$resp = $this->postXML('https://api.mch.weixin.qq.com/pay/orderquery', $param);
		if ($resp) {
			return $this->xmlToArr($resp);
		}
		return FALSE;
	}
}