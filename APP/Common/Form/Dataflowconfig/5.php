<?php return array (
  'field' => 
  array (
    'ffd_name' => 'is_string',
    'ffd_label' => 'is_string',
    'ffd_type' => 'is_string',
    'ffd_weight' => 'is_string',
    'frm_id' => 'is_string',
    'param[options]' => 'is_string',
    'validator[required]' => 'is_string',
    'validator[maxlength]' => 'is_string',
    'validator[minlength]' => 'is_string',
    'validator[min]' => 'is_string',
    'validator[max]' => 'is_string',
    'validator[reg]' => 'is_string',
    'ffd_id' => 'is_string',
    'validator[unique]' => 'is_string',
    'validator[regular]' => 'is_string',
    'param[defaultValue]' => 'is_string',
    'ffd_display' => 'is_string',
    'mdf_id' => 'is_string',
    'mdl_id' => 'is_string',
    'mdf_listtitle' => 'is_string',
    'mdf_weight' => 'is_string',
    'mdl_datatype' => 'is_string',
  ),
  'validator' => 
  array (
    'ffd_name' => 
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
        'field' => 'ffd_name',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'mdf_weight' => 
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
        'field' => 'mdf_weight',
        'existValidate' => true,
        'notEmptyValidate' => true,
      ),
    ),
    'mdl_datatype' => 
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
        'field' => 'mdl_datatype',
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