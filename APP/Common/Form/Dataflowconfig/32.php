<?php return array (
  'field' => 
  array (
    'cst_id' => 'is_string',
    'cst_name' => 'is_string',
    'cst_company' => 'is_string',
    'cst_tel' => 'is_string',
    'cst_address' => 'is_string',
  ),
  'validator' => 
  array (
    'cst_name' => 
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
        'field' => 'cst_name',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'cst_company' => 
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
        'field' => 'cst_company',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'cst_tel' => 
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
        'field' => 'cst_tel',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'cst_address' => 
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
        'field' => 'cst_address',
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