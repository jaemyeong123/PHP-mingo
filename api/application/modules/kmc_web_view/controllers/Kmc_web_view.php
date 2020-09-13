<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : Kmc 본인인증 web_view
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

class Kmc_web_view extends MY_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('kmc_web_view/model_kmc_web_view');

	}

	public function index(){
		$this->member_auth();
	}

//본인인증폼
 public function member_auth(){

   $data['CurTime'] = date('YmdHis');
   $data['RandNo'] = rand(100000, 999999);

   //요청 번호 생성
   $data['reqNum'] = $data['CurTime'].$data['RandNo'];

   //결과수신url
   $data['tr_url'] = THIS_DOMAIN.'/kmc_web_view/member_auth_apply';

   //모듈호출데이터
   $data['certMet'] = 'M'; // 본인확인 방법 'M': 휴대폰 본인확인, 'P': 공인인증서
   $data['cpId'] = 'NNKM1001'; // 회원사 ID
   $data['urlCode'] = '001001'; // 서비스 호출 웹 페이지마다 등록된 코드 정보, 등록 된 URL CODE만 서비스 호출이 가능

   $this->_view('kmc_web_view/view_member_auth',array("data"=>$data));

 }

 //본인인증
 public function member_auth_apply(){
	header("Content-type: text/html; charset=utf-8");

	// KMC 본인인증 범용서비스 샘플소스 STEP04:: start

	// Parameter 수신
	$rec_cert       = $_REQUEST['rec_cert'];
	$cookieCertNum  = $_REQUEST['certNum']; // certNum값을 쿠키 또는 Session을 생성하지 않았을때 certNum 수신처리

	$iv = $cookieCertNum;  // certNum값을 쿠키 또는 Session을 생성하지 않았을때 수신한 certNum을 복호화키에 세팅

	//암호화모듈 호출
	if (extension_loaded('ICERTSecu')) {

	//01.인증결과 1차 복호화
	$rec_cert = ICertSeed(2,0,$iv,$rec_cert);

	//02.복호화 데이터 Split (rec_cert 1차암호화데이터 / 위변조 검증값 / 암복화확장변수)
	$decStr_Split = explode("/", $rec_cert);

	$encPara  = $decStr_Split[0];		//rec_cert 1차 암호화데이터
	$encMsg   = $decStr_Split[1];		//위변조 검증값

	//03.인증결과 2차 복호화
	$rec_cert = ICertSeed(2,0,$iv,$encPara);

	//04. 복호화 된 결과자료 "/"로 Split 하기
	$decStr_Split = explode("/", $rec_cert);

	$certNum    = $decStr_Split[0];
	$date       = $decStr_Split[1];
	$CI         = $decStr_Split[2];
	$phoneNo    = $decStr_Split[3];
	$phoneCorp  = $decStr_Split[4];
	$birthDay   = $decStr_Split[5];
	$gender     = $decStr_Split[6];
	$nation     = $decStr_Split[7];
	$name       = iconv("euc-kr","utf-8",$decStr_Split[8]);
	$result     = $decStr_Split[9];
	$certMet    = $decStr_Split[10];
	$ip         = $decStr_Split[11];
	$M_name     = $decStr_Split[12];
	$M_birthDay = $decStr_Split[13];
	$M_Gender   = $decStr_Split[14];
	$M_nation   = $decStr_Split[15];
	$plusInfo   = $decStr_Split[16];
	$DI         = $decStr_Split[17];

	//05. CI,DI 복호화
	if(strlen($CI) > 0){
		$CI = ICertSeed(2,0,$iv,$CI);
	}
	if(strlen($DI) > 0){
		$DI = ICertSeed(2,0,$iv,$DI);
	}

	}else{
	 echo("암호화모듈 호출 실패!!!");
	 return;
	}

	/** 수신내역 유효성 검증 ******************************************************************/
	//	1-1-1) date 값 검증

	//	현재 서버 시각 구하기
	$end_date = date("YmdHis");
	$start_date = $date;

	//mktime()을 만들기 위해 각 시간 단위로 분할
	$yy = substr($end_date, 0, 4);
	$mm = substr($end_date, 4, 2);
	$dd = substr($end_date, 6, 2);
	$hh = substr($end_date, 8, 2);
	$ii = substr($end_date, 10, 2);
	$ss = substr($end_date, 12, 2);

	//mktime()을 만들기 위해 DB에서 불러온 datetime 값을 시간 단위로 분할
	$yy_start = substr($start_date, 0, 4);
	$mm_start = substr($start_date, 4, 2);
	$dd_start = substr($start_date, 6, 2);
	$hh_start = substr($start_date, 8, 2);
	$ii_start = substr($start_date, 10, 2);
	$ss_start = substr($start_date, 12, 2);

	$toDate = mktime($hh, $ii, $ss, $mm, $dd, $yy);
	$fromDate = mktime($hh_start, $ii_start, $ss_start, $mm_start, $dd_start, $yy_start);
	$timediff = intval(($toDate - $fromDate) / 60);		// 분

	if ( $timediff < -30 || 30 < $timediff  ){
		echo("비정상적인 접근입니다. (요청시간경과)");
		return;
	}

	//	1-1-2) ip 값 검증
	// 사용자IP 구하기
	$client_ip = "";
	if (isset($_SERVER)) {

	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
		$client_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];

	if (isset($_SERVER["HTTP_CLIENT_IP"]))
		$client_ip = $_SERVER["HTTP_CLIENT_IP"];

	$client_ip = $_SERVER["REMOTE_ADDR"];
	}

	if (getenv('HTTP_X_FORWARDED_FOR'))
	$client_ip = getenv('HTTP_X_FORWARDED_FOR');

	if (getenv('HTTP_CLIENT_IP'))
	$client_ip = getenv('HTTP_CLIENT_IP');

	if( $client_ip == "" )
	$client_ip = getenv('REMOTE_ADDR');

	$client_ip_list = explode(",",$client_ip);
	$client_ip = $client_ip_list[0];

	if( $client_ip != $ip ){
		echo("비정상적인 접근입니다. (IP불일치)");
		return;
	}
	/******************************************************************************************/
	$phoneNo    = $decStr_Split[3];
	$birthDay   = $decStr_Split[5];
	$gender     = $decStr_Split[6];
	$name       = iconv("euc-kr","utf-8",$decStr_Split[8]);
  // KMC 본인인증 범용서비스 샘플소스 STEP04:: end


	$response = new stdClass();
  $auth_code =0; //정상
	// 연령체크 060531 3188774

	$member_birth =$birthDay;
	//
	// $member_birth_ch =substr($birthDay,0,4);
	//
  // $diff = date("Y") -(int)$member_birth_ch +1;
	// if($gender =="1"){
  // 	if($diff<21 ||$diff>45){
	// 		$auth_code="3";
	// 	}
	// }else{
	// 	if($diff<21 ||$diff>50){
	// 		$auth_code="3";
	// 	}
	// }

	$data['member_name'] = $name;
	$data['member_phone'] = $phoneNo;
	$data['member_birth'] = $member_birth;
	$data['member_gender'] = $gender;
  //가입여부 체크
	$check = $this->model_kmc_web_view->member_join_check($data);//회원가입 체크
	if(count($check)>0){
		if($check->del_yn =="N" || $check->del_yn =="P"){
			$auth_code="1";
		}
		if($check->del_yn =="Y" ){
			$auth_code="2";
		}

		// if($check->del_yn =="Y" && $check->day_diff <16){
		// 	$auth_code="2";
		// }
	}

	$agent=$this->_user_agent();

  $response->member_name=$name;
  $response->member_phone=$phoneNo;
  $response->member_birth=$member_birth;
  $response->member_gender=$gender;
  $response->gender=$gender;
  $response->auth_code=$auth_code;//0:정상,1:이미가입된회원.2:탈퇴회원,3:연령제한
  $response->agent=$agent;

	$this->_view('kmc_web_view/view_member_auth_apply',$response);

 }


} // end Controller
