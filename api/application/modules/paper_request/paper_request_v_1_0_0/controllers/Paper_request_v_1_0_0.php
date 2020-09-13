<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-10
| Memo : paper_request
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

class paper_request_v_1_0_0 extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('paper_request_v_1_0_0/model_paper_request');
  }

	//paper_request 리스트
	public function paper_request_list(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size=PAGESIZE;

		$data['member_idx']=$member_idx;
		$data['page_size']=$page_size;
		$data['page_no']=($page_num-1)*$page_size;

		$result_list=$this->model_paper_request->paper_request_list($data);// paper_request 리스트
		$result_list_count=$this->model_paper_request->paper_request_list_count($data);// paper_request 리스트 카운트

		$total_page=ceil($result_list_count/$page_size);
		$x=0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['paper_request_idx']	= $row->paper_request_idx;
			$data_array[$x]['paper_request_state']	= $row->paper_request_state;
			$data_array[$x]['paper_request_state_str']	= $this->global_function->get_paper_request_state($row->paper_request_state);
      $data_array[$x]['cancel_type']	= ($row->cancel_type =="1")? "관리자취소":"";
			$data_array[$x]['etc']	= $row->etc;
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

	//paper_request 상세
	public function paper_request_detail(){
		header('Content-Type: application/json');

		$paper_request_idx = $this->_input_check("paper_request_idx",array());

		$data['paper_request_idx']=$paper_request_idx;

		$result=$this->model_paper_request->paper_request_detail($data);// paper_request 상세

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

			$response->paper_request_idx =	$result->paper_request_idx;
			$response->request_state =	$this->global_function->get_paper_request_state($result->request_state);
			$response->business_type =	$result->business_type;
			$response->main_service =	$result->main_service;
			$response->email =	$result->email;
			$response->etc =	$result->etc;
			$response->cancel_type =	($result->cancel_type =="1")? "관리자취소":"";

			if (!empty($result->cancel_date)) {
				$response->cancel_date =	$this->global_function->date_Ymd_hyphen($result->cancel_date);
			}else {
				$response->cancel_date =	"";
			}
			$response->ins_date =	$this->global_function->date_Ymd_hyphen($result->ins_date);

			echo json_encode($response);
			exit;
		}
	}

  //문의등록
	public function paper_request_reg_in(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원키을 입력해주세요.","focus_id"=>"member_idx"));
    $dong_code = $this->_input_check("dong_code",array("empty_msg"=>"동코드을 입력해주세요.","focus_id"=>"dong_code"));
    $business_type = $this->_input_check("business_type",array("empty_msg"=>"업종을 입력해주세요.","focus_id"=>"business_type"));
    $main_service = $this->_input_check("main_service",array("empty_msg"=>"주요서비스을 입력해주세요.","focus_id"=>"title"));
    $email = $this->_input_check("email",array("empty_msg"=>"이메일을 입력해주세요.","regular_msg" => "이메일이 올바르지 않습니다.","type" => "email"));
    $etc = $this->_input_check("etc",array());

    $pay_price=1;
		$data['member_idx'] = $member_idx;
		$data['dong_code'] = $dong_code;
		$data['business_type'] = $business_type;
		$data['main_service'] = $main_service;
		$data['email'] = $email;
		$data['etc'] = $etc;
		$data['pay_price'] = $pay_price;

    //회원 가지고 있는 이용권 체크
    $check =$this->model_p_common->member_point_cnt($data);
    if($check<$pay_price){
      $response->code = "2000";
      $response->code_msg = "이용권이 부족합니다.";
      $response->having_point = $check;
      echo json_encode($response);
      exit;
    }

		$result = $this->model_paper_request->paper_request_reg_in($data);//문의등록

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

  //문의삭제
	public function paper_request_del(){
		header('Content-Type: application/json');

		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원키을 입력해주세요.","focus_id"=>"member_idx"));

		$data['paper_request_idx'] = $paper_request_idx;

		$result = $this->model_paper_request->paper_request_del($data);//문의등록

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


  //문의삭제
  public function paper_request_del(){
    header('Content-Type: application/json');

    $paper_request_idx = $this->_input_check("paper_request_idx",array());
    $cancel_reason = $this->_input_check("cancel_reason",array());

    $data['paper_request_idx'] = $paper_request_idx;
    $data['cancel_reason'] = $cancel_reason;

    $result = $this->model_paper_request->paper_request_del($data);//문의등록

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
