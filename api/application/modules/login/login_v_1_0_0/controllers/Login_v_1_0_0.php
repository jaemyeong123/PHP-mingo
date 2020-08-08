<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	최재명
| Create-Date : 2020-07-29
| Memo : login관리
|------------------------------------------------------------------------

_input_check 가이드
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

class Login_v_1_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

    $this->load->model(mapping('login').'/model_login');
  }

  //인덱스
  public function index() {
    $this->login_detail();
  }

  //메인 화면
  public function login_detail(){
    $return_url= $this->_input_check("return_url",array());

    $response = new stdClass();
    $response->return_url = $return_url;
		$response->agent = $this->user_agent();

		$this->_view_login(mapping('login').'/view_login_detail',$response);
  }

  // 공인중개사 로그인
	public function login_action_member(){
		$member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요.","focus_id"=>"member_id"));
		$member_pw = $this->_input_check("member_pw",array("empty_msg"=>"패스워드를 입력해주세요.","focus_id"=>"member_pw"));
		$auto_login_yn= $this->_input_check("auto_login_yn",array());

		$data['member_id'] = $member_id;
		$data['member_pw'] = $member_pw;

		$response = new stdClass();

		$check = $this->model_login->join_check_member($data);
		if($check == 0){
			$response->code = "0";
			$response->code_msg = "아이디를 다시 확인해주세요.";

			echo json_encode($response);
			exit;
		}

		$result = $this->model_login->login_action_member($data);
		if(!empty($result)){
			# 탈퇴한 회원 체크
			if($result->del_yn == "Y"){
		  	$response->code = "0";
				$response->code_msg = "이미 탈퇴된 회원입니다.";

				echo json_encode($response);
				exit;
			}

			# 승인대기중
			if($result->del_yn == "R"){
				$response->code = "0";
				$response->code_msg = "승인 대기중입니다. 승인 완료 후 이용이 가능합니다";

				echo json_encode($response);
				exit;
			}

			$response->code = "1000";
			$response->code_msg = "로그인되었습니다.";
			$response->member_idx =  $result->member_idx;
			$response->member_name = $result->member_name;

			$member_data = array(
				"user_idx" => $result->member_idx,
				"user_type" => "0",
				"user_id" => $result->member_id,
				"user_name" =>  $result->member_name,
				"member_idx" => $result->member_idx,
				"corp_idx" => 0,
				"investor_idx" => 0,
			);
			$this->session->set_userdata($member_data);

			// if(get_cookie('device_os') !=""){
			// 	$data['member_idx'] = $result->member_idx;
			// 	$data['gcm_key']    = get_cookie('gcm_key');
			// 	$data['device_os']  = get_cookie('device_os');
			//
			// 	$this->model_login->member_gcm_device_up($data);//gcm_key, device_os 업데이트
			// }

		}else{
			$response->code = "0";
			$response->code_msg = "비밀번호를 다시 확인해주세요.";
		}

		echo json_encode($response);
		exit;
  }

	// 펀드매니저 로그인
	public function login_action_corp(){
		$corp_id = $this->_input_check("corp_id",array("empty_msg"=>"아이디를 입력해주세요.","focus_id"=>"corp_id"));
		$corp_pw = $this->_input_check("corp_pw",array("empty_msg"=>"패스워드를 입력해주세요.","focus_id"=>"corp_pw"));
		$auto_login_yn= $this->_input_check("auto_login_yn",array());

		$data['corp_id'] = $corp_id;
		$data['corp_pw'] = $corp_pw;

		// $data['corp_id'] = "ydkman@naver.com";
		// $data['corp_pw'] = "rocat1234";
    // $auto_login_yn="";
		$response = new stdClass();

		$check = $this->model_login->join_check_corp($data);
		if($check == 0){
			$response->code = "0";
			$response->code_msg = "아이디를 다시 확인해주세요.";

			echo json_encode($response);
			exit;
		}

		$result = $this->model_login->login_action_corp($data);
		if(!empty($result)){
			# 탈퇴한 회원 체크
			if($result->del_yn == "Y"){
		  	$response->code = "0";
				$response->code_msg = "이미 탈퇴된 회원입니다.";

				echo json_encode($response);
				exit;
			}

			# 승인대기중
			if($result->del_yn == "R"){
				$response->code = "0";
				$response->code_msg = "승인 대기중입니다. 승인 완료 후 이용이 가능합니다";

				echo json_encode($response);
				exit;
			}

			$response->code = "1000";
			$response->code_msg = "로그인되었습니다.";
			$response->corp_idx =  $result->corp_idx;
			$response->corp_name = $result->corp_name;

			$corp_data = array(
				"user_idx" => $result->corp_idx,
				"user_type" => "1",
				"user_id" => $result->corp_id,
				"user_name" =>  $result->corp_name,
				"member_idx" => 0,
				"corp_idx" => $result->corp_idx,
				"investor_idx" => 0,
			);
			$this->session->set_userdata($corp_data);

			$notice = $this->model_login->notice_list($data);

			$notice_data = array(
				"notice_idx" => $notice->notice_idx,
				"title" => $notice->title,
			);

			$this->session->set_userdata($notice_data);

			// if(get_cookie('device_os') !=""){
			// 	$data['corp_idx'] = $result->corp_idx;
			// 	$data['gcm_key']    = get_cookie('gcm_key');
			// 	$data['device_os']  = get_cookie('device_os');
			//
			// 	$this->model_login->corp_gcm_device_up($data);//gcm_key, device_os 업데이트
			// }

		}else{
			$response->code = "0";
			$response->code_msg = "비밀번호를 다시 확인해주세요.";
		}

		echo json_encode($response);
		exit;
  }

  // 투자자 로그인
	public function login_action_investor(){
		$investor_id = $this->_input_check("investor_id",array("empty_msg"=>"아이디를 입력해주세요.","focus_id"=>"investor_id"));
		$investor_pw = $this->_input_check("investor_pw",array("empty_msg"=>"패스워드를 입력해주세요.","focus_id"=>"investor_pw"));
		$auto_login_yn= $this->_input_check("auto_login_yn",array());

		$data['investor_id'] = $investor_id;
		$data['investor_pw'] = $investor_pw;

		// $data['investor_id'] = "ydkman@naver.com";
		// $data['investor_pw'] = "rocat1234";
    // $auto_login_yn="";
		$response = new stdClass();

		$check = $this->model_login->join_check_investor($data);
		if($check == 0){
			$response->code = "0";
			$response->code_msg = "아이디를 다시 확인해주세요.";

			echo json_encode($response);
			exit;
		}

		$result = $this->model_login->login_action_investor($data);
		if(!empty($result)){
			# 탈퇴한 회원 체크
			if($result->del_yn == "Y"){
		  	$response->code = "0";
				$response->code_msg = "이미 탈퇴된 회원입니다.";

				echo json_encode($response);
				exit;
			}

			# 승인대기중
			if($result->del_yn == "R"){
				$response->code = "0";
				$response->code_msg = "승인 대기중입니다. 승인 완료 후 이용이 가능합니다";

				echo json_encode($response);
				exit;
			}

			$response->code = "1000";
			$response->code_msg = "로그인되었습니다.";
			$response->investor_idx =  $result->investor_idx;
			$response->investor_name = $result->investor_name;

			$investor_data = array(
				"user_idx" => $result->investor_idx,
				"user_type" => "2",
				"user_id" => $result->investor_id,
				"user_name" =>  $result->investor_name,
				"investor_idx" => $result->investor_idx,
				"member_idx" => 0,
				"corp_idx" => 0,
			);
			$this->session->set_userdata($investor_data);

			// if(get_cookie('device_os') !=""){
			// 	$data['investor_idx'] = $result->investor_idx;
			// 	$data['gcm_key']    = get_cookie('gcm_key');
			// 	$data['device_os']  = get_cookie('device_os');
			//
			// 	$this->model_login->investor_gcm_device_up($data);//gcm_key, device_os 업데이트
			// }

		}else{
			$response->code = "0";
			$response->code_msg = "비밀번호를 다시 확인해주세요.";
		}

		echo json_encode($response);
		exit;
  }

}// 클래스의 끝
?>
