<?php return array (
  'field' => 
  array (
    'ord_id' => 'is_string',
    'usr_id' => 'is_string',
    'ord_money' => 'is_string',
    'ord_ctime' => 'is_string',
    'ord_paytime' => 'is_string',
    'ord_state' => 'is_string',
    'ord_desc' => 'is_string',
    'ord_mtime' => 'is_string',
  ),
  'validator' => 
  array (
    'ord_money' => 
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
        'field' => 'ord_money',
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