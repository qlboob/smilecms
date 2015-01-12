<?php return array (
  'field' => 
  array (
    'sit_id' => 'is_string',
    'thm_id' => 'is_string',
    'sit_name' => 'is_string',
    'sit_domain' => 'is_string',
    'sit_table_pre' => 'is_string',
  ),
  'validator' => 
  array (
    'sit_name' => 
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
        'field' => 'sit_name',
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
        'field' => 'sit_name',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '',
      ),
      'minlength' => 
      array (
        'msg' => '{$title}的最小长度是{$target}',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'sit_name',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '2',
      ),
    ),
    'sit_table_pre' => 
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
        'field' => 'sit_table_pre',
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