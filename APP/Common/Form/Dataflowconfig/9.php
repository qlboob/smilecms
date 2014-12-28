<?php return array (
  'field' => 
  array (
    'tst_id' => 'is_string',
    'tst_name' => 'is_string',
    'tst_age' => 'is_string',
    'tst_datetime' => 'is_string',
    'tst_extra[birth]' => 'is_string',
    'tst_extra[int]' => 'is_string',
  ),
  'validator' => 
  array (
    'tst_name' => 
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
        'field' => 'tst_name',
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
        'field' => 'tst_name',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '',
      ),
      'maxlength' => 
      array (
        'msg' => '{$title}的最大长度是{$target}',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'tst_name',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '8',
      ),
      'minlength' => 
      array (
        'msg' => '{$title}的最小长度是{$target}',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'tst_name',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '2',
      ),
    ),
    'tst_age' => 
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
        'field' => 'tst_age',
        'existValidate' => true,
        'target' => '',
      ),
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
        'field' => 'tst_age',
        'existValidate' => true,
        'notEmptyValidate' => true,
      ),
      'minlength' => 
      array (
        'msg' => '{$title}的最小长度是{$target}',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'tst_age',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '2',
      ),
      'max' => 
      array (
        'msg' => '{$title}的最大值是{$target}',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'tst_age',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '150',
      ),
      'min' => 
      array (
        'msg' => '{$title}的最小值是{$target}',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'tst_age',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '10',
      ),
    ),
    'tst_datetime' => 
    array (
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
        'field' => 'tst_datetime',
        'existValidate' => true,
        'notEmptyValidate' => true,
      ),
    ),
    'tst_extra[birth]' => 
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
        'field' => 'tst_extra[birth]',
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
        'field' => 'tst_extra[birth]',
        'existValidate' => true,
        'notEmptyValidate' => true,
      ),
    ),
    'tst_extra[int]' => 
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
        'field' => 'tst_extra[int]',
        'existValidate' => true,
        'target' => '',
      ),
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
        'field' => 'tst_extra[int]',
        'existValidate' => true,
        'notEmptyValidate' => true,
      ),
      'maxlength' => 
      array (
        'msg' => '{$title}的最大长度是{$target}',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'tst_extra[int]',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '2',
      ),
      'minlength' => 
      array (
        'msg' => '{$title}的最小长度是{$target}',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'tst_extra[int]',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '1',
      ),
      'min' => 
      array (
        'msg' => '{$title}的最小值是{$target}',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'tst_extra[int]',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '2',
      ),
      'max' => 
      array (
        'msg' => '{$title}的最大值是{$target}',
        'title' => NULL,
        'value' => NULL,
        'data' => NULL,
        'param' => 
        array (
        ),
        'field' => 'tst_extra[int]',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '10',
      ),
    ),
  ),
  'convert' => 
  array (
    'tst_datetime' => 
    array (
      'function' => 
      array (
        'field' => 'tst_datetime',
        'content' => 'strtotime',
        'param' => 
        array (
        ),
      ),
    ),
    'tst_extra[birth]' => 
    array (
      'function' => 
      array (
        'field' => 'tst_extra[birth]',
        'content' => 'strtotime',
        'param' => 
        array (
        ),
      ),
    ),
    'tst_extra' => 
    array (
      'function' => 
      array (
        'field' => 'tst_extra',
        'content' => 'serialize',
        'param' => 
        array (
        ),
      ),
    ),
  ),
  'fill' => 
  array (
    'tst_lastupdate' => 
    array (
      'function' => 
      array (
        'field' => 'tst_lastupdate',
        'content' => 'time',
        'param' => 
        array (
        ),
      ),
    ),
    'tst_extra[fill]' => 
    array (
      'function' => 
      array (
        'field' => 'tst_extra[fill]',
        'content' => 'time',
        'param' => 
        array (
        ),
      ),
    ),
  ),
);