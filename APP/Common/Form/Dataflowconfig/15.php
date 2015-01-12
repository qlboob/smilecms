<?php return array (
  'field' => 
  array (
    'ugp_id' => 'is_string',
    'ugp_name' => 'is_string',
  ),
  'validator' => 
  array (
    'ugp_name' => 
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
        'field' => 'ugp_name',
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
        'field' => 'ugp_name',
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