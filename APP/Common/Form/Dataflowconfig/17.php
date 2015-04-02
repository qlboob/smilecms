<?php return array (
  'field' => 
  array (
    'ord_id' => 'is_string',
    'usr_id' => 'is_string',
    'car_owner' => 'is_string',
    'car_tel' => 'is_string',
    'vlg_id' => 'is_string',
    'car_no' => 'is_string',
    'car_color' => 'is_string',
    'car_location' => 'is_string',
    'car_remark' => 'is_string',
    'ctp_id' => 'is_string',
    'prd_id' => 'is_string',
    'ord_ctime' => 'is_string',
    'ord_paytime' => 'is_string',
    'ord_state' => 'is_string',
    'ord_money' => 'is_string',
    'ord_mtime' => 'is_string',
    'ord_payee' => 'is_string',
    'tc_id' => 'is_string',
  ),
  'validator' => 
  array (
    'car_owner' => 
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
        'field' => 'car_owner',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'car_tel' => 
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
        'field' => 'car_tel',
        'existValidate' => true,
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
        'field' => 'car_tel',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '11',
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
        'field' => 'car_tel',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '11',
      ),
    ),
    'vlg_id' => 
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
        'field' => 'vlg_id',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'car_no' => 
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
        'field' => 'car_no',
        'existValidate' => true,
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
        'field' => 'car_no',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '7',
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
        'field' => 'car_no',
        'existValidate' => true,
        'notEmptyValidate' => true,
        'target' => '7',
      ),
    ),
    'car_location' => 
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
        'field' => 'car_location',
        'existValidate' => true,
        'target' => '',
      ),
    ),
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
    'ord_payee' => 
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
        'field' => 'ord_payee',
        'existValidate' => true,
        'notEmptyValidate' => true,
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
  ),
  'convert' => 
  array (
  ),
  'fill' => 
  array (
  ),
);