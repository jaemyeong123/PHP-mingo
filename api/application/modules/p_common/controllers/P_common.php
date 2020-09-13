<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_common extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('p_common/model_p_common');
  }

  //시도리스트
  public function city_list(){
    header('Content-Type: application/json');

    $result_list = $this->model_p_common->city_list();

    $x = 0;
    $data_array = array();

    foreach($result_list as $row){
      $data_array[$x]['city_code']	= $row->city_code;
      $data_array[$x]['city_name']	= $row->city_name;
      $x++;
    }

    $response = new stdClass();

    if($x==0){
      $response->code = "2000";
      $response->code_msg = $this->global_msg->code_msg('2000');
      $response->list_cnt = $x;
      $response->data_array = $data_array;
    }else{
      $response->code = "1000";
      $response->code_msg = $this->global_msg->code_msg('1000');
      $response->list_cnt = $x;
      $response->data_array = $data_array;
    }
    echo json_encode($response);
    exit;
  }

  //시도리스트
  public function region_list(){
    header('Content-Type: application/json');
    $city_code = $this->_input_check("city_code",array("empty_msg"=>"시도코드가 누락되었습니다."));

    $data['city_code']=$city_code;
    $result_list = $this->model_p_common->region_list($data);//공지사항 리스트

    $x = 0;
    $data_array = array();

    foreach($result_list as $row){
      $data_array[$x]['region_code']	= $row->region_code;
      $data_array[$x]['region_name']	= $row->region_name;
      $x++;
    }

    $response = new stdClass();

    if($x==0){
      $response->code = "2000";
      $response->code_msg = $this->global_msg->code_msg('2000');
      $response->list_cnt = $x;
      $response->data_array = $data_array;
    }else{
      $response->code = "1000";
      $response->code_msg = $this->global_msg->code_msg('1000');
      $response->list_cnt = $x;
      $response->data_array = $data_array;
    }
    echo json_encode($response);
    exit;
  }


  //시도리스트
  public function dong_list(){
    header('Content-Type: application/json');
    $region_code = $this->_input_check("region_code",array("empty_msg"=>"구/군코드가 누락되었습니다."));

    $data['region_code']=$region_code;
    $result_list = $this->model_p_common->dong_list($data);//공지사항 리스트

    $x = 0;
    $data_array = array();

    foreach($result_list as $row){
      $data_array[$x]['dong_idx']	= $row->dong_idx;
      $data_array[$x]['full_name']	= $row->full_name;
      $data_array[$x]['dong_code']	= $row->dong_code;
      $data_array[$x]['dong_name']	= $row->dong_name;
      $data_array[$x]['lat']	= $row->lat;
      $data_array[$x]['lng']	= $row->lng;
      $x++;
    }

    $response = new stdClass();

    if($x==0){
      $response->code = "2000";
      $response->code_msg = $this->global_msg->code_msg('2000');
      $response->list_cnt = $x;
      $response->data_array = $data_array;
    }else{
      $response->code = "1000";
      $response->code_msg = $this->global_msg->code_msg('1000');
      $response->list_cnt = $x;
      $response->data_array = $data_array;
    }
    echo json_encode($response);
    exit;
  }

  //동 지역 좌료들
  public function region_coordinates(){
    header('Content-Type: application/json');
    $dong_idx = $this->_input_check("dong_idx",array("empty_msg"=>"동키가 누락되었습니다."));

    $data['dong_idx']=$dong_idx;
    $result = $this->model_p_common->region_coordinates($data);//공지사항 리스트
    $x = 0;
    $data_array = array();

    $response = new stdClass();

    if(count($result)==0){
      $response->code = "2000";
      $response->code_msg = $this->global_msg->code_msg('2000');
      $response->list_cnt = $x;
      $response->data_array = $data_array;

    }else{
      $response->code = "1000";
      $response->code_msg = $this->global_msg->code_msg('1000');

      $data_arr =json_decode($result->region_coordinates);

      foreach($data_arr as $row){
        $data_array[$x]['lat']	= $row->lat;
        $data_array[$x]['lag']	= $row->lag;

        $x++;
      }
      $response->list_cnt = $x;
      $response->data_array = $data_array;
    }
    echo json_encode($response);
    exit;
  }


}
?>
