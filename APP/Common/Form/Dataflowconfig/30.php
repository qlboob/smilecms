<?php return array (
  'field' => 
  array (
    'apl_id' => 'is_string',
    'usr_id' => 'is_string',
    'usr_company' => 'is_string',
    'usr_realname' => 'is_string',
    'usr_tel' => 'is_string',
    'usr_address' => 'is_string',
    'apl_type' => 'is_string',
  ),
  'validator' => 
  array (
    'usr_id' => 
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
        'field' => 'usr_id',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'usr_realname' => 
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
        'field' => 'usr_realname',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'usr_tel' => 
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
        'field' => 'usr_tel',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'usr_address' => 
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
        'field' => 'usr_address',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'apl_type' => 
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
        'field' => 'apl_type',
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