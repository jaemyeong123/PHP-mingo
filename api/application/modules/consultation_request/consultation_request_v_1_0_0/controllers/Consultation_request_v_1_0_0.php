<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-10
| Memo : consultation_request
|------------------------------------------------------------------------

input_check 가이드
_________________________________________________________________________________
|  !!. 변수설명
| $key       : 파라미터로 받을 변수명
| $empty_msg : 유효성검사 실패 시 전송할 메세지,
|              ("empty_msg" => "유효성검사 메세지") 로 구분하며 list 타입임.
| $focus_id  : 유효성검사 실패 시 foucus 이동 ID,
|              ("focus_id" => "foucus 대상 ID")
| $ternary  : 삼항 연산자 받을 변수명
|              ("ternary" => "1")
| $esc       : 개행문자 제거 요청시 true, 아닐시 false
|              false를 요청하는 경우-> (ex. 장문의 글 작성 시 false)
|           	 값이 array 형태일 경우 false로 적용
| $regular_msg : 정규표현식 검사 실패 시 전송할 메세지,
|              ("regular_msg" => "정규표현식 메세지","type" => "number")
| $type    	: 유효성검사할 타입
|           	 number   : 숫자검사
|            	email    : 이메일 양식 검사
|            	password : 비밀번호 양식 검사
|            	tel1     : 전화번호 양식 검사 (- 미포함)
|            	tel2     : 전화번호 양식 검사 (- 포함)
|            	custom   : 커스텀 양식, $custom의 양식으로 검사함
|            	default  : default, 검사를 안합니다.
| $custom 	: 유효성검사 custom으로 진행 시 받을 값 (정규표현식)
|
|  !!!. 값이 array형태로 들어올 경우
| $this->input_chkecu("파라미터로 받을 변수명[]");
| 형태로 받는다.
|_________________________________________________________________________________
*/

class Consultation_request_v_1_0_0 extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('consultation_request_v_1_0_0/model_consultation_request');
  }

	//consultation_request 리스트
	public function consultation_request_list(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size=PAGESIZE;

		$data['member_idx']=$member_idx;
		$data['page_size']=$page_size;
		$data['page_no']=($page_num-1)*$page_size;

		$result_list=$this->model_consultation_request->consultation_request_list($data);// consultation_request 리스트
		$result_list_count=$this->model_consultation_request->consultation_request_list_count($data);// consultation_request 리스트 카운트

		$total_page=ceil($result_list_count/$page_size);
		$x=0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['consultation_request_idx']	= $row->consultation_request_idx;
			$data_array[$x]['member_name']	= $row->member_name;
			$data_array[$x]['member_phone']	= $row->member_phone;
			$data_array[$x]['ins_date']	= $this->global_function->date_Ymd_hyphen($row->ins_date);
		$x++;
		}

		if($x==0){
			$response = new stdClass;
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
      $response->data_array = $data_array;

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;

			echo json_encode($response);
			exit;
		}
	}

	//consultation_request 상세
	public function consultation_request_detail(){
		header('Content-Type: application/json');

		$consultation_request_idx = $this->_input_check("consultation_request_idx",array());

		$data['consultation_request_idx']=$consultation_request_idx;

		$result=$this->model_consultation_request->consultation_request_detail($data);// consultation_request 상세

		if(count($result)==0){
			$response = new stdClass;
			$response->code = "-2";
			$response->code_msg = $this->global_msg->code_msg('-2');

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			$response->consultation_request_idx =	$result->consultation_request_idx;
			$response->member_name =	$result->member_name;
			$response->member_phone =	$result->member_phone;
			$response->ins_date =	$this->global_function->date_Ymd_hyphen($result->ins_date);

			echo json_encode($response);
			exit;
		}
	}

  //문의등록
	public function consultation_request_reg_in(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원키을 입력해주세요.","focus_id"=>"member_idx"));
    $expert_idx = $this->_input_check("expert_idx",array("empty_msg"=>"상담사키을 입력해주세요.","focus_id"=>"expert_idx"));

		$data['member_idx'] = $member_idx;
		$data['expert_idx'] = $expert_idx;


		$result = $this->model_consultation_request->consultation_request_reg_in($data);//문의등록

		if($result != "0"){
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

      $index="104";
      $alarm_data['title'] = "";
      $member_idx = $expert_idx;
      $this->_alarm_action($member_idx,$index, $alarm_data);

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');

			echo json_encode($response);
			exit;
		}
	}

  //문의삭제
	public function consultation_request_del(){
		header('Content-Type: application/json');

		$consultation_request_idx = $this->_input_check("consultation_request_idx",array());

		$data['consultation_request_idx'] = $consultation_request_idx;

		$result = $this->model_consultation_request->consultation_request_del($data);//문의등록

		if($result != "0"){
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			echo json_encode($response);
			exit;

		}else{
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');

			echo json_encode($response);
			exit;
		}
	}
}
