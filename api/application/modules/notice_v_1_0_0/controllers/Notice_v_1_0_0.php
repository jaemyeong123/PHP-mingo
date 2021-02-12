<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	최재명
| Create-Date : 2020-09-08
| Memo : 공지사항
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

class Notice_v_1_0_0 extends MY_Controller{

	/* 생성자 영역 */
	function __construct(){
		parent::__construct();

    $this->load->model('notice_v_1_0_0/model_notice');
	}

	public function index() {
		$this->notice_list();
	}

	//공지사항 리스트
	public function notice_list(){
		header('Content-Type: application/json');

		$notice_type = $this->_input_check("notice_type",array("empty_msg"=>"공지사항 유형이 누락되었습니다."));
	  $page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size = 10;

		$data['notice_type'] = $notice_type;
		$data['page_size'] = $page_size;
		$data['page_no']   = ($page_num-1)*$page_size;

		$result_list = $this->model_notice->notice_list($data);//공지사항 리스트
		$result_list_count = $this->model_notice->notice_list_count($data);//공지사항 리스트 총 개수

		$total_page = ceil($result_list_count/$page_size);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['notice_idx']	= $row->notice_idx;
			$data_array[$x]['title']	= $row->title;
      $data_array[$x]['ins_date'] = $this->global_function->date_ymd_comma($row->ins_date);
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

	public function notice_detail(){
		header('Content-Type: application/json');

		$notice_idx = $this->_input_check("notice_idx",array());

		$data['notice_idx']=$notice_idx;

		$result=$this->model_notice->notice_detail($data);// notice 상세

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

			$response->notice_idx =	$result->notice_idx;
			$response->title =	$result->title;
			$response->img =	$result->img;
			$response->img_width =	(int)$this->global_function->get_images_width($result->img);
			$response->img_height =	(int)$this->global_function->get_images_height($result->img);
			$response->contents =	$result->contents;
			$response->ins_date =	$this->global_function->date_Ymd_hyphen($result->ins_date);

			echo json_encode($response);
			exit;
		}
	}
}
