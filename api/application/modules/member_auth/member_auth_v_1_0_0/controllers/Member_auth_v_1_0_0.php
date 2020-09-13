<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-10
| Memo : member_auth
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
|              false를 요청하는 경우-> (ex. 장 글 작성 시 false)
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

class Member_auth_v_1_0_0 extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('member_auth_v_1_0_0/model_member_auth');
  }

	//member_auth 리스트
	public function member_auth_list(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size=PAGESIZE;

		$data['member_idx']=$member_idx;
		$data['auth_state']='2';
		$data['page_size']=$page_size;
		$data['page_no']=($page_num-1)*$page_size;

		$result_list=$this->model_member_auth->member_auth_list($data);// member_auth 리스트
		$result_list_count=$this->model_member_auth->member_auth_list_count($data);// member_auth 리스트 카운트

		$total_page=ceil($result_list_count/$page_size);
		$x=0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['member_auth_idx']	= $row->member_auth_idx;
			$data_array[$x]['reject_reason']	= $row->reject_reason;
			$data_array[$x]['processing_date']	= $this->global_function->date_Ymd_hyphen($row->processing_date);
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

	//member_auth 상세
	public function member_auth_detail(){
		header('Content-Type: application/json');

		$member_auth_idx = $this->_input_check("member_auth_idx",array());

		$data['member_auth_idx']=$member_auth_idx;

		$result=$this->model_member_auth->member_auth_detail($data);// member_auth 상세

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

			$response->member_auth_idx =	$result->member_auth_idx;
      switch($result->auth_state){
        case "0": $auth_state = "승인요청"; break;
        case "1": $auth_state = "승인"; break;
        case "2": $auth_state = "승인거절"; break;
        default: $auth_state = "";
      }
			$response->auth_state_str =	$auth_state;
			$response->auth_state =$result->auth_state;
			$response->affiliat =$result->affiliat;
			$response->img_paths =$result->img_paths;
			$response->img_width =	(int)$this->global_function->get_images_width($result->img_paths);
			$response->img_height =	(int)$this->global_function->get_images_height($result->img_paths);
			$response->registration_number =$result->registration_number;
			$response->reject_reason =	$result->reject_reason;
			$response->processing_date =	$this->global_function->date_Ymd_hyphen($result->processing_date);
			$response->ins_date =	$this->global_function->date_Ymd_hyphen($result->ins_date);

			echo json_encode($response);
			exit;
		}
	}


  //등록
	public function member_auth_reg_in(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원키를 입력해주세요."));
    $affiliat = $this->_input_check("affiliat",array("empty_msg"=>"소속을 입력해주세요."));
    $registration_number = $this->_input_check("registration_number",array("empty_msg"=>"대출 모집인 등록 번호을 입력해주세요."));
    $img_paths = $this->_input_check("img_paths",array("empty_msg"=>"이미지를 입력해주세요."));

		$data['member_idx'] = $member_idx;
		$data['affiliat'] = $affiliat;
		$data['registration_number'] = $registration_number;
		$data['img_paths'] = $img_paths;

    $check = $this->model_member_auth->member_auth_check($data);//등록
    if(count($check)>0){
      $response = new stdClass;
      $response->code = "-1";
			$response->code_msg = "아직 관리자가 인증 내역을 확인하고 있어요.";
      echo json_encode($response);
      exit;
    }

    // if($auth_type !="0"){
    //   $reg_check = $this->model_member_auth->member_auth_reg_check($data);//등록
    //   if(count($check)>0){
    //     $response = new stdClass;
    //     $response->code = "-1";
    //     $response->code_msg = " 삭제후 등록이 가능합니다.";
    //     echo json_encode($response);
    //     exit;
    //   }
    // }

		$result = $this->model_member_auth->member_auth_reg_in($data);//등록

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
