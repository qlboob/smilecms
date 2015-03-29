<?php return array (
  'field' => 
  array (
    'prd_id' => 'is_string',
    'prd_title' => 'is_string',
    'prd_desc' => 'is_string',
    'usr_id' => 'is_string',
    'ugp_id' => 'is_string',
    'prd_ctime' => 'is_string',
  ),
  'validator' => 
  array (
    'prd_title' => 
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
        'field' => 'prd_title',
        'existValidate' => true,
        'target' => '',
      ),
      'maxlength' => 
      array (
        'msg' => '{$title}的最大长度是{$target}',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'prd_title',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '40',
      ),
    ),
    'prd_desc' => 
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
        'field' => 'prd_desc',
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