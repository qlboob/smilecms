<?php return array (
  'field' => 
  array (
    'fpc_id' => 'is_string',
    'ffd_id' => 'is_string',
    'fpc_title' => 'is_string',
    'fpc_type' => 'is_string',
    'fpc_content' => 'is_string',
  ),
  'validator' => 
  array (
    'fpc_title' => 
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
        'field' => 'fpc_title',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'fpc_type' => 
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
        'field' => 'fpc_type',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'fpc_content' => 
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
        'field' => 'fpc_content',
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