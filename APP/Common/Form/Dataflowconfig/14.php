<?php return array (
  'field' => 
  array (
    'usr_id' => 'is_string',
    'ugp_id' => 'is_string',
    'usr_name' => 'is_string',
  ),
  'validator' => 
  array (
    'ugp_id' => 
    array (
      'integer' => 
      array (
        'msg' => '{$value}不是整数',
        'target' => '^[\\-\\+]?([1-9]\\d*|0)+$',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'ugp_id',
        'existValidate' => true,
        'notEmptyValidate' => true,
      ),
    ),
    'usr_name' => 
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
        'field' => 'usr_name',
        'existValidate' => true,
        'target' => '',
      ),
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
  ),
  'convert' => 
  array (
  ),
  'fill' => 
  array (
  ),
);