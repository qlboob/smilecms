<?php return array (
  'field' => 
  array (
    'mdl_id' => 'is_string',
    'sit_id' => 'is_string',
    'mdl_name' => 'is_string',
    'mdl_table' => 'is_string',
    'mdl_description' => 'is_string',
    'mdl_parent' => 'is_string',
    'frm_id' => 'is_string',
    'mdf_name' => 'is_string',
  ),
  'validator' => 
  array (
    'sit_id' => 
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
        'field' => 'sit_id',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'mdl_table' => 
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
        'field' => 'mdl_table',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'mdf_name' => 
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
        'field' => 'mdf_name',
        'existValidate' => true,
        'target' => '',
      ),
      'regular' => 
      array (
        'msg' => '请输入正确的{$title}格式',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'mdf_name',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '^[a-z]\\w*$',
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