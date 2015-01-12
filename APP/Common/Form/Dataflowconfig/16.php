<?php return array (
  'field' => 
  array (
    'vlg_id' => 'is_string',
    'vlg_name' => 'is_string',
    'vlg_state' => 'is_string',
    'vlg_location' => 'is_string',
  ),
  'validator' => 
  array (
    'vlg_name' => 
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
        'field' => 'vlg_name',
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
        'field' => 'vlg_name',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '',
      ),
    ),
    'vlg_location' => 
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
        'field' => 'vlg_location',
        'existValidate' => true,
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