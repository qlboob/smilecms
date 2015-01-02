<?php return array (
  'field' => 
  array (
    'fsc_id' => 'is_string',
    'fsc_title' => 'is_string',
    'fsc_type' => 'is_string',
    'fsc_content' => 'is_string',
  ),
  'validator' => 
  array (
    'fsc_title' => 
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
        'field' => 'fsc_title',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'fsc_type' => 
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
        'field' => 'fsc_type',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'fsc_content' => 
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
        'field' => 'fsc_content',
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