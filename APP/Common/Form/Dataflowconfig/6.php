<?php return array (
  'field' => 
  array (
    'blk_id' => 'is_string',
    'sit_id' => 'is_string',
    'blk_type' => 'is_string',
    'blk_title' => 'is_string',
    'blk_status' => 'is_string',
    'blk_weight' => 'is_string',
    'blk_identify' => 'is_string',
    'blk_region' => 'is_string',
    'blk_visibility' => 'is_string',
    'blk_page' => 'is_string',
    'blk_cachetime' => 'is_string',
    'blk_dependence' => 'is_string',
    'blk_param[path]' => 'is_string',
  ),
  'validator' => 
  array (
    'blk_type' => 
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
        'field' => 'blk_type',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'blk_identify' => 
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
        'field' => 'blk_identify',
        'existValidate' => true,
        'target' => '',
      ),
      'unique' => 
      array (
        'message' => '{$title} {$value}已经存在',
        'msg' => '',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'blk_identify',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '',
      ),
    ),
    'blk_region' => 
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
        'field' => 'blk_region',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'blk_visibility' => 
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
        'field' => 'blk_visibility',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'blk_cachetime' => 
    array (
      'integer' => 
      array (
        'msg' => '{$value}不是整数',
        'target' => '^[\\-\\+]?([1-9]\\d*|0)+$',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'blk_cachetime',
        'existValidate' => true,
        'notEmptyValidate' => true,
      ),
    ),
  ),
  'convert' => 
  array (
    'blk_param' => 
    array (
      'function' => 
      array (
        'field' => 'blk_param',
        'content' => 'serialize',
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