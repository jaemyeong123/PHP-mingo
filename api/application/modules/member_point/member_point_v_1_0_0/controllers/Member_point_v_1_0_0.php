<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2020-04-13
| Memo : 회원 상태 체크
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

class Member_point_v_1_0_0 extends MY_Controller {

  /* 생성자 영역 */
  function __construct(){
    parent::__construct();

    $this->load->model('member_point_v_1_0_0/model_member_point');
  }
  // 회원 상태 체크
	public function member_point_cnt(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array(""));

    $data['member_idx']  = $member_idx;

		$response = new stdClass;

		$result = $this->model_member_point->member_point_cnt($data);//회원 상태 체크


    if($result==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');

			$response->total = $result;

		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			$response->total = $result;
		}

    echo json_encode($response);
    exit;


	}


  //리스트
	public function member_point_list(){
    header('Content-Type: application/json');
	  $page_num = $this->_input_check('page_num',array("ternary"=>'1'));
    $member_idx = $this->_input_check("member_idx",array(""));
    $point_type = $this->_input_check("point_type",array(""));
		$page_size = PAGESIZE;

		$data['member_idx'] = $member_idx;
		$data['point_type'] = $point_type;
    $data['page_size'] = $page_size;
		$data['page_no']   = ($page_num-1)*$page_size;

		$result_list = $this->model_member_point->member_point_list($data);//공지사항 리스트
		$result_list_count = $this->model_member_point->member_point_list_count($data);//공지사항 리스트 총 개수
		$total_page = ceil($result_list_count/$page_size);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['point']	= $row->point;
			$data_array[$x]['title']	= $row->title;
      $data_array[$x]['ins_date'] = $this->global_function->date_YmdHi_comma($row->ins_date);
		  $x++;
		}

		$response = new stdClass();

		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}
		echo json_encode($response);
		exit;
	}


  // 사용하기
  public function member_point_use_reg_in(){
    header('Content-Type: application/json');
    $member_idx = $this->_input_check('member_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));
    $member_gender = $this->_input_check('member_gender',array("empty_msg"=>"성별를 입력해주세요.","focus_id"=>"member_gender"));
    $request_type = $this->_input_check('request_type',array("empty_msg"=>"타입를 입력해주세요.","focus_id"=>"request_type"));
    $point = $this->_input_check('point',array("empty_msg"=>"보석갯수를 입력해주세요.","focus_id"=>"point"));

    $st_point_0=0;
    $st_point_1=0;
    switch ($request_type) {
      case '0' : $title='일대일 대화열기'; $st_point_0=5;$st_point_1=3; break;
      case '1' : $title='회원정보 확인'; $st_point_0=1;$st_point_1=0;break;
      case '2' : $title='벙개 프로필 확인';$st_point_0=1;$st_point_1=1; break;
      case '3' : $title='벙개 참석 신청'; $st_point_0=4;$st_point_1=2;break;
      case '4' : $title='벙개 신청자 선택'; $st_point_0=4;$st_point_1=2;break;
      case '5' : $title='닉네임 변경';$st_point_0=12;$st_point_1=12; break;
      default : $title=''; break;
    }
    $st_point =($member_gender ==0)? $st_point_0 : $st_point_1;
    $data['title'] = $title;
    $data['member_idx'] = $member_idx;
    $data['member_gender'] = $member_gender;
    $data['request_type'] = $request_type;
    $data['point'] = $point;

    $response = new stdClass();

    if($st_point ==0){
      $response->code = "-1";
      $response->code_msg = "잘못된 경로입니다.";
      echo json_encode($response);
      exit;
    }

    if($st_point !=$point){
      $response->code = "-1";
      $response->code_msg = "수량을 잘못 요청하셨습니다.";
      echo json_encode($response);
      exit;
    }

    $check = $this->model_member_point->member_point_cnt($data);
    if($check<1){
      $response->code = "-1";
      $response->code_msg = "보석이 부족합니다.";
      $response->point = $st_point;
      echo json_encode($response);
      exit;
    }
    if($check <$point){
      $response->code = "-1";
      $response->code_msg = "보석이 부족합니다.";
      $response->point = (int)($point-$check);
      echo json_encode($response);
      exit;
    }
    $data['title'] = $title;
    $result = $this->model_member_point->member_point_use_reg_in($data);
    if($result < 0){
      $response->code = "-1";
      $response->code_msg = $this->global_msg->code_msg('-1');
    }else{
      $response->code = "1000";
     $response->code_msg = $this->global_msg->code_msg('1000');
     $response->member_point_idx = $result;
    }

    echo json_encode($response);
    exit;
  }
}	// 클래스의 끝
?>
