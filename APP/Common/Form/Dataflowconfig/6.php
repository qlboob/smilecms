<?php return array (
  'field' => 
  array (
    'blk_id' => 'is_string',
    'sit_id' => 'is_string',
    'blk_type' => 'is_string',
    'blk_title' => 'is_string',
    'blk_status' => 'is_string',
    'blk_weight' => 'is_string',
    'blk_identify' => 'is_string',
  ),
  'validator' => 
  array (
    'blk_identify' => 
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
        'field' => 'blk_identify',
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
        'field' => 'blk_identify',
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