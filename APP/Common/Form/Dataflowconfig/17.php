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
    'car_type' => 'is_string',
    'prd_id' => 'is_string',
    'ord_ctime' => 'is_string',
    'ord_paytime' => 'is_string',
    'ord_state' => 'is_string',
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
    'car_type' => 
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
        'field' => 'car_type',
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
  ),
  'convert' => 
  array (
  ),
  'fill' => 
  array (
  ),
);