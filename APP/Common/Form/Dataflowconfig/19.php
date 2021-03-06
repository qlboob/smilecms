<?php return array (
  'field' => 
  array (
    'prd_id' => 'is_string',
    'prd_name' => 'is_string',
    'prd_state' => 'is_string',
    'prd_day' => 'is_string',
  ),
  'validator' => 
  array (
    'prd_name' => 
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
        'field' => 'prd_name',
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
        'field' => 'prd_name',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '',
      ),
    ),
    'prd_day' => 
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
        'field' => 'prd_day',
        'existValidate' => true,
        'target' => '',
      ),
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
        'field' => 'prd_day',
        'existValidate' => true,
        'notEmptyValidate' => true,
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