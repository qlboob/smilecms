<?php return array (
  'field' => 
  array (
    'atl_id' => 'is_string',
    'car_id' => 'is_string',
    'ord_id' => 'is_string',
    'prd_id' => 'is_string',
    'atl_oldendtime' => 'is_string',
    'atl_newendtime' => 'is_string',
    'atl_ctime' => 'is_string',
  ),
  'validator' => 
  array (
    'ord_id' => 
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
        'field' => 'ord_id',
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