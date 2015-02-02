<?php return array (
  'field' => 
  array (
    'car_id' => 'is_string',
    'car_owner' => 'is_string',
    'car_no' => 'is_string',
    'car_tel' => 'is_string',
    'vlg_id' => 'is_string',
    'car_color' => 'is_string',
    'car_model' => 'is_string',
    'car_location' => 'is_string',
    'car_remark' => 'is_string',
    'ctp_id' => 'is_string',
    'car_endtime' => 'is_string',
    'car_lastwashtime' => 'is_string',
    'tdl_id' => 'is_string',
    'tdl_ctime' => 'is_string',
    'tdl_state' => 'is_string',
    'apm_id' => 'is_string',
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
    'car_color' => 
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
        'field' => 'car_color',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'car_model' => 
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
        'field' => 'car_model',
        'existValidate' => true,
        'target' => '',
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
    'car_endtime' => 
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
        'field' => 'car_endtime',
        'existValidate' => true,
        'target' => '',
      ),
    ),
    'car_lastwashtime' => 
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
        'field' => 'car_lastwashtime',
        'existValidate' => true,
        'target' => '',
      ),
    ),
  ),
  'convert' => 
  array (
    'car_endtime' => 
    array (
      'function' => 
      array (
        'field' => 'car_endtime',
        'content' => 'strtotime',
        'param' => 
        array (
        ),
      ),
    ),
    'car_lastwashtime' => 
    array (
      'function' => 
      array (
        'field' => 'car_lastwashtime',
        'content' => 'strtotime',
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