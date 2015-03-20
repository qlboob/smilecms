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
    'ifm_ctime' => 'is_string',
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
    'ifm_ctime' => 
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
        'field' => 'ifm_ctime',
        'existValidate' => true,
        'target' => '',
      ),
      'datetime' => 
      array (
        'msg' => '请输入正确的日期时间格式',
        'target' => '^\\d{4}[\\/\\-](0?[1-9]|1[012])[\\/\\-](0?[1-9]|[12][0-9]|3[01])\\s+([01]\\d|2[0-3]):[0-5]\\d:[0-5]\\d$',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'ifm_ctime',
        'existValidate' => true,
        'notEmptyValidate' => true,
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