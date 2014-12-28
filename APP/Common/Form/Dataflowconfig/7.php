<?php return array (
  'field' => 
  array (
    'fff_id' => 'is_string',
    'fff_title' => 'is_string',
    'ffd_id' => 'is_string',
    'fff_type' => 'is_string',
    'fff_content' => 'is_string',
  ),
  'validator' => 
  array (
    'fff_title' => 
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
        'field' => 'fff_title',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'fff_type' => 
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
        'field' => 'fff_type',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'fff_content' => 
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
        'field' => 'fff_content',
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