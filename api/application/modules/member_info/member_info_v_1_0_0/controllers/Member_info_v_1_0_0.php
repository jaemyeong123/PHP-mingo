<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2018-02-11
| Memo : 회원 정보
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

class Member_info_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

    $this->load->model('member_info_v_1_0_0/model_member_info');
	}

//회원 정보 상세 보기
  public function member_info_detail(){
		header('Content-Type: application/json');

		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));

		$data['member_idx']=$member_idx;

		$result=$this->model_member_info->member_info_detail($data);//회원 정보 상세 보기

		$response = new stdClass;

		if(count($result)==0){
			$response = new stdClass;
			$response->code = "-2"; //조회된 값이 없음
			$response->code_msg = $this->global_msg->code_msg('-2');

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			$response->member_idx = $result->member_idx;
			$response->member_id = $result->member_id;
			$response->member_name = $result->member_name;
			$response->member_phone = $result->member_phone;
			$response->member_birth = $result->member_birth;
			$response->member_gender = $result->member_gender;

			echo json_encode($response);
			exit;
		}
  }

//회원 정보 수정
  public function member_info_mod_up(){
		header('Content-Type: application/json');
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
		$member_name = $this->_input_check("member_name",array());
    $member_phone = $this->_input_check("member_phone",array("empty_msg"=>"핸드폰번호를 입력해주세요."));

		$data['member_idx']=$member_idx;
		$data['member_name'] = $member_name;
		$data['member_phone'] = $member_phone;

		$result=$this->model_member_info->member_info_mod_up($data); //회원 정보 수정

		if($result =='0'){
			$response = new stdClass;
			$response->code = "-1"; //변경에 실패 하였습니다.
			$response->code_msg = $this->global_msg->code_msg('-1');

			echo json_encode($response);
			exit;
		}else if( $result =='1'){
			$response = new stdClass;
			$response->code = "1000"; //성공
			$response->code_msg = $this->global_msg->code_msg('1000');

			echo json_encode($response);
			exit;
		}
  }

  public function expert_info_detail(){
		header('Content-Type: application/json');

		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));

		$data['member_idx']=$member_idx;

		$result=$this->model_member_info->expert_info_detail($data);//회원 정보 상세 보기

		$response = new stdClass;

		if(count($result)==0){
			$response = new stdClass;
			$response->code = "-2"; //조회된 값이 없음
			$response->code_msg = $this->global_msg->code_msg('-2');

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			$response->member_idx = $result->member_idx;
			$response->member_id = $result->member_id;
			$response->member_name = $result->member_name;
			$response->member_phone = $result->member_phone;
			$response->member_birth = $result->member_birth;
			$response->member_gender = $result->member_gender;
			$response->del_yn = $result->del_yn;
			if ($result->member_company == '19') {
				$response->member_company = $result->member_other_company;
			} else {
				$response->member_company = $this->global_function->get_member_company($result->member_company);
			}
			$response->registration_num = $result->registration_num;
			$response->member_img = $result->member_img;
			$response->member_img_width =	(int)$this->global_function->get_images_width($result->member_img);
			$response->member_img_height =	(int)$this->global_function->get_images_height($result->member_img);
			$response->calling_card_img = $result->calling_card_img;
			$response->calling_card_img_width =	(int)$this->global_function->get_images_width($result->calling_card_img);
			$response->calling_card_img_height =	(int)$this->global_function->get_images_height($result->calling_card_img);
			$response->loan_expert_type = $result->loan_expert_type;
			$response->member_intro = $result->member_intro;
			$response->contactable_time = $result->contactable_time;
			$response->city_1 = $result->city_1;
			$response->city_2 = $result->city_2;
			$response->city_3 = $result->city_3;
			$response->sigungu_1 = $result->sigungu_1;
			$response->sigungu_2 = $result->sigungu_2;
			$response->sigungu_3 = $result->sigungu_3;

			echo json_encode($response);
			exit;
		}
  }

//회원 정보 수정
  public function expert_info_mod_up(){
		header('Content-Type: application/json');
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
		$member_name = $this->_input_check("member_name",array());
    $member_phone = $this->_input_check("member_phone",array("empty_msg"=>"핸드폰번호를 입력해주세요."));
		$member_intro = $this->_input_check("member_intro",array());
		$contactable_time = $this->_input_check("contactable_time",array());


		$data['member_idx']=$member_idx;
		$data['member_name'] = $member_name;
		$data['member_phone'] = $member_phone;
		$data['member_intro'] = $member_intro;
		$data['contactable_time'] = $contactable_time;

		$result=$this->model_member_info->expert_info_mod_up($data); //회원 정보 수정

		if($result =='0'){
			$response = new stdClass;
			$response->code = "-1"; //변경에 실패 하였습니다.
			$response->code_msg = $this->global_msg->code_msg('-1');

			echo json_encode($response);
			exit;
		}else if( $result =='1'){
			$response = new stdClass;
			$response->code = "1000"; //성공
			$response->code_msg = $this->global_msg->code_msg('1000');

			echo json_encode($response);
			exit;
		}
  }



	//회원 정보 수정
  public function member_img_mod_up(){
		header('Content-Type: application/json');
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
		$member_img = $this->_input_check("member_img",array());

		$data['member_idx']=$member_idx;
		$data['member_img']=$member_img;

		$result=$this->model_member_info->member_img_mod_up($data); //회원 정보 수정

		if($result =='0'){
			$response = new stdClass;
			$response->code = "-1"; //변경에 실패 하였습니다.
			$response->code_msg = $this->global_msg->code_msg('-1');

			echo json_encode($response);
			exit;
		}else if( $result =='1'){
			$response = new stdClass;
			$response->code = "1000"; //성공
			$response->code_msg = $this->global_msg->code_msg('1000');

			echo json_encode($response);
			exit;
		}
  }
	//
	// // 반려이력 목록
	// public function member_auth_list(){
	//
	// 	header('Content-Type: application/json');
	//
	// 	$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
	// 	$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
	// 	$page_size=PAGESIZE;
	//
	// 	$data['member_idx']=$member_idx;
	// 	$data['page_size']=$page_size;
	// 	$data['page_no']=($page_num-1)*$page_size;
	//
	// 	$result_list=$this->model_member_info->member_auth_list($data); //회원 정보 수정
	// 	$result_list_count=$this->model_member_info->member_auth_list_count($data);// QA 리스트 카운트
	//
	// 	$total_page=ceil($result_list_count/$page_size);
	// 	$x=0;
	// 	$data_array = array();
	//
	// 	foreach($result_list as $row){
	// 		$data_array[$x]['member_auth_idx']	= $row->member_auth_idx;
	// 		$data_array[$x]['ins_date']	= $row->ins_date;
	// 		$data_array[$x]['upd_date']	= $row->upd_date;
	// 		$x++;
	// 	}
	//
	// 	if($x==0){
	// 		$response = new stdClass;
	// 		$response->code = "2000";
	// 		$response->code_msg = $this->global_msg->code_msg('2000');
	// 		$response->list_cnt = $x;
	// 		$response->page_num = (int)$page_num;
	// 		$response->total_page =	$total_page;
  //     $response->data_array = $data_array;
	//
	// 		echo json_encode($response);
	// 		exit;
	// 	}else{
	// 		$response = new stdClass;
	// 		$response->code = "1000";
	// 		$response->code_msg = $this->global_msg->code_msg('1000');
	// 		$response->list_cnt = $x;
	// 		$response->page_num = (int)$page_num;
	// 		$response->total_page =	$total_page;
	// 		$response->data_array = $data_array;
	//
	// 		echo json_encode($response);
	// 		exit;
	// 	}
  // }
	//
	// // 반려이력 상세
	// public function member_auth_detail(){
	// 	header('Content-Type: application/json');
	// 	$member_auth_idx = $this->_input_check("member_auth_idx",array("empty_msg"=>"키가 누락되었습니다."));
	//
	// 	$data['member_auth_idx']=$member_auth_idx;
	//
	// 	$result=$this->model_member_info->member_auth_detail($data); //회원 정보 수정
	//
	// 	if(count($result)==0){
	// 		$response = new stdClass;
	// 		$response->code = "-1"; //변경에 실패 하였습니다.
	// 		$response->code_msg = $this->global_msg->code_msg('-1');
	//
	// 		echo json_encode($response);
	// 		exit;
	// 	}else{
	// 		$response = new stdClass;
	// 		$response->code = "1000"; //성공
	// 		$response->code_msg = $this->global_msg->code_msg('1000');
	//
	// 		$response->member_auth_idx = $result->member_auth_idx;
	// 		$response->ins_date = $result->ins_date;
	// 		$response->upd_date = $result->upd_date;
	// 		$response->registration_number = $result->registration_number;
	// 		$response->affiliat = $result->affiliat;
	// 		$response->calling_card_img = $result->img_paths;
	// 		$response->reject_reason = $result->reject_reason;
	//
	// 		echo json_encode($response);
	// 		exit;
	// 	}
  // }

}
