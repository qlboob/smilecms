<?php return array (
  'field' => 
  array (
    'ifm_id' => 'is_string',
    'ifm_title' => 'is_string',
    'ifm_desc' => 'is_string',
    'ifm_tel' => 'is_string',
    'ifm_state' => 'is_string',
    'ifm_type' => 'is_string',
    'picList' => 'is_string',
    'ift_id' => 'is_string',
  ),
  'validator' => 
  array (
    'ifm_title' => 
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
        'field' => 'ifm_title',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'ifm_desc' => 
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
        'field' => 'ifm_desc',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'ifm_tel' => 
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
        'field' => 'ifm_tel',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'ifm_state' => 
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
        'field' => 'ifm_state',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'ifm_type' => 
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
        'field' => 'ifm_type',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'ift_id' => 
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
        'field' => 'ift_id',
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