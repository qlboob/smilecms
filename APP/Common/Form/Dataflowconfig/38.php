<?php return array (
  'field' => 
  array (
    'tcl_id' => 'is_string',
    'car_id' => 'is_string',
    'tc_id' => 'is_string',
    'tcl_starttime' => 'is_string',
    'tcl_endtime' => 'is_string',
    'ord_id' => 'is_string',
    'prd_id' => 'is_string',
    'tcl_ctime' => 'is_string',
    'usr_id' => 'is_string',
  ),
  'validator' => 
  array (
    'car_id' => 
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
        'field' => 'car_id',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'tc_id' => 
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
        'field' => 'tc_id',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'tcl_starttime' => 
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
        'field' => 'tcl_starttime',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'tcl_endtime' => 
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
        'field' => 'tcl_endtime',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'ord_id' => 
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
        'field' => 'ord_id',
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