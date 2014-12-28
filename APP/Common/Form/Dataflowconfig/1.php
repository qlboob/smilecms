<?php return array (
  'field' => 
  array (
    'frm_title' => 'is_string',
    'frm_id' => 'is_string',
    'frm_table' => 'is_string',
    'frm_parent' => 'is_string',
    'sit_id' => 'is_string',
  ),
  'validator' => 
  array (
    'frm_title' => 
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
        'field' => 'frm_title',
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