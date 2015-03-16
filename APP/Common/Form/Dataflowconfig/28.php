<?php return array (
  'field' => 
  array (
    'usr_id' => 'is_string',
    'usr_name' => 'is_string',
    'ugp_id' => 'is_string',
    'usr_realname' => 'is_string',
    'usr_tel' => 'is_string',
    'usr_company' => 'is_string',
    'usr_address' => 'is_string',
    'usr_state' => 'is_string',
    'usr_pay' => 'is_string',
    'usr_timeout' => 'is_string',
  ),
  'validator' => 
  array (
    'usr_name' => 
    array (
      'unique' => 
      array (
        'message' => '{$title} {$value}已经存在',
        'msg' => '',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'usr_name',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '',
      ),
    ),
    'ugp_id' => 
    array (
      'required' => 
      array (
        'notEmptyValidate' => false,
        'msg' => '{$title}必须填写',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'ugp_id',
        'existValidate' => true,
        'target' => '',
      ),
    ),
  ),
  'convert' => 
  array (
    'usr_timeout' => 
    array (
      'function' => 
      array (
        'field' => 'usr_timeout',
        'content' => 'strtotime',
        'param' => 
        array (
        ),
      ),
    ),
  ),
  'fill' => 
  array (
  ),
);