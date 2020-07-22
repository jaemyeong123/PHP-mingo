<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/* 생성자 영역 */
	function __construct() {
		parent::__construct();

		header('P3P: CP="CAO DSP CURa ADMa TAIa PSAa OUR LAW STP PHY ONL UNI PUR FIN COM NAV INT DEM STA PRE"');

		/* Helper */
		$this->load->helper('url');
		$this->load->helper('version_mapping');
		$this->load->helper('empty_message');

		/* Library */
		$this->load->library('session');
		$this->load->library('global_function');
		//$this->load->library('GCMPushMessage');

		/* Model */
		$this->load->model('gcm/model_gcm');


		//$this->load->model('gcm/model_gcm');
		if($this->uri->segment(1) != "work_check") {
			if(!$this->session->userdata('admin_idx') ){
			 	if($this->uri->segment(1) == "" || $this->uri->segment(1) != "login" ){
			 	 	redirect("/login");
			 	 	exit;
			 	}
			}
		}

		$this->admin_id=$this->session->userdata('admin_id');
		$this->admin_idx=$this->session->userdata('admin_idx');
		$this->admin_name=$this->session->userdata('admin_name');
		$this->admin_right=$this->session->userdata('admin_right');

		//$this->keyword_list=$this->session->userdata('keyword_list');
	}

	function _view($view, $array=""){

		$this->load->view("common/inc/header");
		$this->load->view("work_check_api/work_check");
		$this->load->view("common/inc/left");
		$this->load->view($view, $array);
		$this->load->view("common/inc/footer");

	}

	function _list_view($view, $array=""){

		$this->load->view($view, $array);

	}

	function _popup_view($view, $array=""){

		$this->load->view("common/inc/header");
		$this->load->view("work_check_api/work_check");
		$this->load->view($view, $array);

	}

	function statistics_log(){

		$log = $this->uri->uri_string().'^^'.$this->admin_id;

		return $log;

	}

	function _escstr($str) {

    $str=str_replace("\r\n","",$str);

    return trim($str);

  }


	// 알림 등록
	function _alarm_action($member_idx,$index,$alarm_data) {
	 $sgcm = new GCMPushMessage();
	 $sgcm->setApiKey(GCM_KEY_1);

	 $data['member_idx']=$member_idx;
	 $data['corp_idx']=$corp_idx;
	 $data['index']=$index;
	 $data['product_name']=$alarm_data['product_name'];

	 switch($index){
		 case "101" : $rt ="[".$data['product_name']."]을 Nuri가 추천 하였습니다. 확인 하여 주세요.";break;
		 case "102" : $rt ="[".$data['product_name']."]에 대해서 펀드매니져가 매도인 재확인 요청을 하였습니다.";break;
		 case "103" : $rt ="[".$data['product_name']."]을 Nuri가 최종 보고서를 제출 하였습니다.";break;
		 case "104" : $rt ="[".$data['product_name']."]을 Nuri가 최종 보고서를 제출 하였습니다.";break;
		 case "105" : $rt ="[".$data['product_name']."]을 펀드매니져가 자산 매입 요청을 하였습니다. 매매 계약서를 작성해 주세요.";break;
		 case "106" : $rt ="[".$data['product_name']."]의 매매 계약서를 공인 중개사가 작성 하였습니다. 매매 계약서를 확인하여 주세요";break;
		 case "107" : $rt ="[".$data['product_name']."]의 매매 계약서를 공인 중개사가 작성 하였습니다. 매매 계약서를 확인하여 주세요";break;
		 case "108" : $rt ="[".$data['product_name']."]의 매매 계약서에 펀드매니져가 날인 하였습니다. 계약이 체결 되었습니다.";break;
		 case "109" : $rt ="[".$data['product_name']."]의 잔금이 입금 완료 되었습니다.";break;
		 case "110" : $rt ="[".$data['product_name']."]의 잔금이 입금 완료 되었습니다.";break;
		 case "111" : $rt ="[".$data['product_name']."]의 수수료가 지급 되었습니다. 수수료 내역을 확인하여 주세요.";break;
	 }

	 switch($index){
		case "101" : $rt1 ="[".$data['product_name']."]<br> Nuri가 추천 하였습니다.<br> 확인 하여 주세요.";break;
		case "102" : $rt1 ="[".$data['product_name']."]<br> 대해서 펀드매니져가 매도인 재확인 요청을 하였습니다.";break;
		case "103" : $rt1 ="[".$data['product_name']."]<br> Nuri가 최종 보고서를 제출 하였습니다.";break;
		case "104" : $rt1 ="[".$data['product_name']."]<br> Nuri가 최종 보고서를 제출 하였습니다.";break;
		case "105" : $rt1 ="[".$data['product_name']."]<br> 펀드매니져가 자산 매입 요청을 하였습니다.<br> 매매 계약서를 작성해 주세요.";break;
		case "106" : $rt1 ="[".$data['product_name']."]<br> 매매 계약서를 공인 중개사가 작성 하였습니다.<br> 매매 계약서를 확인하여 주세요";break;
		case "107" : $rt1 ="[".$data['product_name']."]<br> 매매 계약서를 공인 중개사가 작성 하였습니다.<br> 매매 계약서를 확인하여 주세요";break;
		case "108" : $rt1 ="[".$data['product_name']."]<br> 매매 계약서에 펀드매니져가 날인 하였습니다.<br> 계약이 체결 되었습니다.";break;
		case "109" : $rt1 ="[".$data['product_name']."]<br> 잔금이 입금 완료 되었습니다.";break;
		case "110" : $rt1 ="[".$data['product_name']."]<br> 잔금이 입금 완료 되었습니다.";break;
		case "111" : $rt1 ="[".$data['product_name']."]<br> 수수료가 지급 되었습니다.<br> 수수료 내역을 확인하여 주세요.";break;
	 }

	 $data['title']=$rt;
	 $data['web_title']=$rt1;

	 $member_search  = $this->model_gcm->member_search($data);//회원정보 가져오기

	 foreach($member_search as $row){
		 $data['member_idx'] = $row->member_idx;
		 $data['corp_idx'] = $row->corp_idx;
		 $data['gcm_key'] = $row->gcm_key;
		 $data['device_os'] = $row->device_os;
		 $data['msg']=  $data['title'];
		 $data["index"] =$index;
		 $body_loc_key = $index;
		 $body_loc_args =[""];

		 $this->model_gcm->member_gcm_in($data); //회원 gcm 입력

		 if($data['gcm_key']){
			 if($row->alarm_yn=="Y"){
				 $sgcm->setDevices($data['gcm_key']);
				 $response = $sgcm->send($data['msg'],$data['device_os'],$data,"",$body_loc_key,$body_loc_args,"");
			 }
		 }
	 }
	}


	// 웹뷰에서 메일 보내기
  function _web_sendmail($to,$subject,$message,$from_email="",$from_name=""){

    $config = array();
    $config['useragent'] = 'CodeIgniter';
    $config['mailpath']  = '/usr/sbin/sendmail';
    $config['protocol']  = 'smtp';
    $config['smtp_host'] = SMTP_HOST;
    $config['smtp_user'] = SMTP_USER;
    $config['smtp_pass'] = SMTP_PASS;
    $config['smtp_port'] = SMTP_PORT;
    $config['smtp_crypto'] = 'ssl';
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['wordwrap'] = TRUE;

    $this->email->initialize($config);
    $this->email->clear(TRUE);
    if($from_email ==""){
      $this->email->from(FROM_EMAIL, FROM_NAME);
    }else{
      $this->email->from($from_email, $from_name);
    }
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($message);

    $result=$this->email->send();

    return $result;
  }

  //카카오알림톡 발송
	function _kakao_alarm_action($alarm_data,$template_code) {
		$this->model_kakao_alarm->SendATS_one($alarm_data,$template_code);
	}

	// method 타입 자동 구별
	/*	function _input_check($data, $msg=["빈값체크 메세지", "정규표현식 메세지"], $esc=true, $empty=false, $type="default", $custom = ""){ */
	function _input_check($key,$data){

		/*
		.  ____  .    ____________________________
		|/      \|   | 유효성검사를 응원합니다.         |
	 [| ♥    ♥ |]  | ver 0.1                    |
		|___==___|  /          written by JAZZ.   |
								 |____________________________|
			 ---------------------------------------------------------------------------------
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
			|_________________________________________________________________________________|
		*/

		// 빈값 메시지
		if(array_key_exists('empty_msg',$data)){
			$empty_msg = $data['empty_msg'];
			$empty = TRUE;
		}else{
			$empty_msg = "";
			$empty = FALSE;
		}
		// 포커스 ID
		if(array_key_exists('focus_id',$data)){
			$focus_id = $data['focus_id'];
		}else{
			$focus_id = "";
		}
		// 정규식 메시지
		if(array_key_exists('regular_msg',$data)){
			$regular_msg = $data['regular_msg'];
		}else{
			$regular_msg = "";
		}
		// 개행 문자 체크
		if(array_key_exists('esc',$data)){
			$esc = $data['esc'];
		}else{
			$esc = TRUE;
		}
		//정규식 타입
		if(array_key_exists('type',$data)){
			$type = $data['type'];
		}else{
			$type = "default";
		}
		// 정규식 커스텀 체크
		if(array_key_exists('custom',$data)){
			$custom = $data['custom'];
		}else{
			$custom = "custom";
		}
		// 삼항 연산자 체크
		if(array_key_exists('ternary',$data)){
			$ternary = $data['ternary'];
		} else{
			$ternary = "";
		}
	//	$key = $key;

		# method 확인
		$key = trim($key);

		# 1. post 타입인가?
		$method = "post";
		$var = $this->input->post($key, true) ? $this->input->post($key, true) : $ternary;

		if($var == ""){
			$var = array_key_exists($key,$_POST)? $_POST[$key] : "";
		}

		# 2. get 타입인가?
		if($var == ""){
			$method = "get";
			$var = $this->input->get($key, true) ? $this->input->get($key, true) : $ternary;

			if($var == ""){
				$var = array_key_exists($key,$_GET)? $_GET[$key] : "";
			}
		}



		/* 보류

		# 3. 다른 타입인가?
		if($var == ""){
			$method = $_SERVER['REQUEST_METHOD'];
			$method = strtolower($method);

			$var2 = parse_str(file_get_contents('php://input'), $put);
			var_dump($var2);
			exit;


			$var = array_key_exists($key,$_PUT)? $_PUT[$key] : "";

			vardump($_PUT);
		}
		*/
		/* 삼항 연산자 체크 */

		# -. 모두 찾을수 없는가?
		if($method == ""){
			$method = "not found";
			$message = "요청한 method type을 확인하세요.";
			$var = "찾을수 없습니다.";
			goto input_echo;
		}

		# 개행문자 제거 요청일 시
		if($esc){
			$var = str_replace("/\r|\n/","", $var);
			if(!is_array($var)){
				$var = trim($var);
			}
		}

		# 빈값 체크를 할 경우
		if($empty == true){
			if($var == ""){
				$message = $empty_msg;
				goto input_echo;
			}
		}else{
			if(is_array($var) == true){
				$x = 0;
				$var_arr = array();

				foreach ($var as $row) {
					if($row ==""){
						$var_arr[$x] = NULL;
					}else{
						$var_arr[$x] = $row;
					}
					$x++;
				}

				$var = $var_arr;
			}else{
				if($var == ""){
					$var = NULL;
				}
			}
		}

		# 유효성검사 타입 확인
		$validate_check = true;

		$type = strtolower($type);
		switch($type){
			# 숫자 유효성 검사
			case "number" :
				// if(!preg_match("/^\d+$/", $var)){
				if(!is_numeric($var)){
					$validate_check = false;
				}
				break;

			# 이메일 양식 유효성 검사
			case "email" :
				if(!preg_match("/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $var)){
					$validate_check = false;
				}
				break;

			# 비밀번호 양식 유효성 검사
			case "password" :
				if(!preg_match("/^.*(?=.{6,12})(?=.*[0-9])(?=.*[a-zA-Z]).*$/", $var)){
					$validate_check = false;
				}
				break;

			# 전화번호 양식1 : (- 미포함)
			case "tel1" :
				break;

			# 전화번호 양식2 : (- 포함)
			case "tel2" :
				break;

			case "phone":
				if(!preg_match("/^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/", $var)){
				$validate_check = false;
				}
				break;

			# custom 요청 일 시.
			case "custom" :
				if(!preg_match($custom, $var)){
					$validate_check = false;
				}
				break;

			case "default" :
			default :
				break;

		}

		if(!$validate_check){
			$message = $regular_msg;
			goto input_echo;
		}

		# 모두 통과
		return $var;

		# input 검사 실패 시 나오는 메세지. label
		input_echo:

		$response['code'] = "-1";
		$response['code_msg'] = $message;
		$response['method'] = $method;
		$response['focus_id'] = $focus_id;
		$response[$key] = $var;

		echo json_encode($response);
		exit;

	} // end input check

}
?>
