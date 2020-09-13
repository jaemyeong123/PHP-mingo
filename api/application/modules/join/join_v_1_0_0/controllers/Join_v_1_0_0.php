<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2020-09-04
| Memo : 회원가입
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

class Join_v_1_0_0 extends MY_Controller {

  /* 생성자 영역 */
  function __construct(){
    parent::__construct();

    $this->load->model('join_v_1_0_0/model_join');
  }

  // 회원 가입email
  public function member_reg_in(){
    header('Content-Type: application/json');
    $member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요.","regular_msg" => "아이디는 이메일 형식으로 입력해주세요.","type" => "email"));
    $member_pw = $this->_input_check("member_pw",array("empty_msg"=>"비밀번호를 입력해주세요.","regular_msg" => "비밀번호는 영어,숫자 조합으로 8자~15자내로 입력해주세요.","type" => "custom","custom" => "/^[a-zA-Z](?=.{0,15}[0-9])[0-9a-zA-Z]{8,15}$/"));
    $member_pw_confirm = $this->_input_check("member_pw_confirm",array("empty_msg"=>"비밀번호 확인을 입력해주세요."));
    $member_name = $this->_input_check("member_name",array("empty_msg"=>"이름을 입력해주세요."));
    $member_phone = $this->_input_check("member_phone",array("empty_msg"=>"휴대폰번호를 입력해주세요."));
    $member_birth = $this->_input_check("member_birth",array("empty_msg"=>"생년월일를 입력해주세요."));
    $member_gender = $this->_input_check("member_gender",array("empty_msg"=>"성별을 선택해주세요."));

    $response = new stdClass();

    # 비밀번호 체크
    if($member_pw != $member_pw_confirm){
      $response->code = "-1";
      $response->code_msg = "비밀번호와 비밀번호 확인이 일치 하지 않습니다. 다시 확인해 주세요.";

      echo json_encode($response);
      exit;
    }

		$data['member_id'] = $member_id;
		$data['member_pw'] = $member_pw;
		$data['member_name'] = $member_name;
		$data['member_phone'] = $member_phone;
		$data['member_birth'] = $member_birth;
		$data['member_gender'] = $member_gender;

    $member_id_check = $this->model_join->member_id_check($data);//아이디 중복 체크

    if($member_id_check > 0){
      $response->code = "-1";
			$response->code_msg = "이미 사용중인 아이디입니다.";

      echo json_encode($response);
      exit;
    }

    $member_info_check = $this->model_join->member_info_check($data); //이름, 전화번호, 생년월일이 같은 회원 중복 체크

    if($member_info_check > 0){
      $response->code = "-1";
      $response->code_msg = "이미 가입된 회원입니다. 아이디 찾기를 하여 서비스를 이용해주세요.";

      echo json_encode($response);
      exit;
    }

    $member_count = $this->model_join->member_count($data);
    $member_unique_num = "U".str_pad((int)$member_count,"5","0",STR_PAD_LEFT);
    $data['member_unique_num'] = $member_unique_num;

    $result = $this->model_join->member_reg_in($data);//회원 가입

    if($result < 0){
			$response->code = "-1";
			$response->code_msg = "정보를 불러오지 못했습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "회원 가입이 완료되었습니다. 로그인 후에 서비스를 이용하실 수 있습니다.";
		}

    echo json_encode($response);
    exit;
  }

  public function expert_reg_in(){
    header('Content-Type: application/json');
    $member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요.","regular_msg" => "아이디는 이메일 형식으로 입력해주세요.","type" => "email"));
    $member_pw = $this->_input_check("member_pw",array("empty_msg"=>"비밀번호를 입력해주세요.","regular_msg" => "비밀번호는 영어,숫자 조합으로 8자~15자내로 입력해주세요.","type" => "custom","custom" => "/^[a-zA-Z](?=.{0,15}[0-9])[0-9a-zA-Z]{8,15}$/"));
    $member_pw_confirm = $this->_input_check("member_pw_confirm",array("empty_msg"=>"비밀번호 확인을 입력해주세요."));
    $member_name = $this->_input_check("member_name",array("empty_msg"=>"이름을 입력해주세요."));
    $member_phone = $this->_input_check("member_phone",array("empty_msg"=>"휴대폰번호를 입력해주세요."));
    $member_birth = $this->_input_check("member_birth",array("empty_msg"=>"생년월일를 입력해주세요."));
    $member_gender = $this->_input_check("member_gender",array("empty_msg"=>"성별을 선택해주세요."));

    $registration_num = $this->_input_check("registration_num",array("empty_msg"=>"대출 모집인 등록번호를 입력하세요."));
    $member_img = $this->_input_check("member_img",array("empty_msg"=>"프로필 이미지를 업로드해주세요."));
    $calling_card_img = $this->_input_check("calling_card_img",array("empty_msg"=>"명함 이미지를 업로드해주세요."));
    $member_company = $this->_input_check("member_company",array("empty_msg"=>"소속을 선택해주세요."));
    if ($member_company != '19') {
      $member_other_company = null;
    } else {
      $member_other_company = $this->_input_check("member_other_company",array("empty_msg"=>"그 외 소속을 입력해주세요."));
    }
    $sigungu_1 = $this->_input_check("sigungu_1",array());
    $sigungu_2 = $this->_input_check("sigungu_2",array());
    $sigungu_3 = $this->_input_check("sigungu_3",array());

    $response = new stdClass();

    # 비밀번호 체크
    if($member_pw != $member_pw_confirm){
      $response->code = "-1";
      $response->code_msg = "비밀번호와 비밀번호 확인이 일치 하지 않습니다. 다시 확인해 주세요.";

      echo json_encode($response);
      exit;
    }

		$data['member_id'] = $member_id;
		$data['member_pw'] = $member_pw;
		$data['member_name'] = $member_name;
		$data['member_phone'] = $member_phone;
		$data['member_birth'] = $member_birth;
		$data['member_gender'] = $member_gender;

		$data['registration_num'] = $registration_num;
		$data['member_img'] = $member_img;
		$data['calling_card_img'] = $calling_card_img;
		$data['member_company'] = $member_company;
		$data['member_other_company'] = $member_other_company;
		$data['sigungu_1'] = $sigungu_1;
		$data['sigungu_2'] = $sigungu_2;
		$data['sigungu_3'] = $sigungu_3;

    $member_id_check = $this->model_join->member_id_check($data);//아이디 중복 체크

    if($member_id_check > 0){
      $response->code = "-1";
			$response->code_msg = "이미 사용중인 아이디입니다.";

      echo json_encode($response);
      exit;
    }

    $member_registration_num_check = $this->model_join->expert_registration_num_check($data);//아이디 중복 체크

    if($member_registration_num_check > 0){
      $response->code = "-1";
			$response->code_msg = "같은 대출 모집인 등록번호로 중복해서 가입이 불가합니다.";

      echo json_encode($response);
      exit;
    }

    $expert_info_check = $this->model_join->expert_info_check($data); //이름, 전화번호, 생년월일이 같은 회원 중복 체크

    if($expert_info_check > 0){
      $response->code = "-1";
      $response->code_msg = "이미 가입된 회원입니다. 아이디 찾기를 하여 서비스를 이용해주세요.";

      echo json_encode($response);
      exit;
    }

    $member_count = $this->model_join->expert_count($data);
    $member_unique_num = "T".str_pad((int)$member_count,"5","0",STR_PAD_LEFT);
    $data['member_unique_num'] = $member_unique_num;

    $result = $this->model_join->expert_reg_in($data);//회원 가입

    if($result < 0){
			$response->code = "-1";
			$response->code_msg = "정보를 불러오지 못했습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "회원 가입이 완료되었습니다. 로그인 후에 서비스를 이용하실 수 있습니다.";
		}

    echo json_encode($response);
    exit;
  }

} // 클래스의 끝
?>
