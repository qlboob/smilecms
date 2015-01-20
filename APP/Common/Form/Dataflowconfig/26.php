<?php return array (
  'field' => 
  array (
    'prc_id' => 'is_string',
    'ctp_id' => 'is_string',
    'prd_id' => 'is_string',
    'prc_money' => 'is_string',
  ),
  'validator' => 
  array (
    'ctp_id' => 
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
        'field' => 'ctp_id',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'prd_id' => 
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
        'field' => 'prd_id',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'prc_money' => 
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
        'field' => 'prc_money',
        'existValidate' => true,
        'target' => '',
      ),
    ),
  ),
  'convert' => 
  array (
    'prc_money' => 
    array (
      'function' => 
      array (
        'field' => 'prc_money',
        'content' => 'multi100',
        'param' => 
        array (
        ),
      ),
    ),
  ),
  'fill' => 
  array (
  ),
);