<?php

namespace Ptadmin\Model;

use Think\Model;

class UserModel extends Model{
	
	
	
	
	function login($name,$password) {
		$scret = $this->encrypt($password);
		return $this->where(array('usr_name'=>$name,'usr_pw'=>$scret))->find();
	}
	
	function encrypt($str) {
		return md5(md5($str).'!m@q___2');
	}
	
}