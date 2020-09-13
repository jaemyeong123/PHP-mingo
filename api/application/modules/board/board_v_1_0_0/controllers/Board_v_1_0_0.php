<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2020-09-08
| Memo : 게시판
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

class Board_v_1_0_0 extends MY_Controller{

	/* 생성자 영역 */
	function __construct(){
		parent::__construct();

    $this->load->model('board_v_1_0_0/model_board');
	}

	//게시판 리스트
	public function board_list(){
		header('Content-Type: application/json');

	  $board_type = $this->_input_check('board_type',array("empty_msg" => "게시판 유형 키가 누락됐습니다."));
	  $contents_type = $this->_input_check('contents_type',array());
	  $title = $this->_input_check('title',array());
	  $page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['title'] = $title;
		$data['board_type'] = $board_type;
    $data['contents_type'] = $contents_type;
		$data['page_size'] = $page_size;
		$data['page_no']   = ($page_num-1)*$page_size;

		$result_list = $this->model_board->board_list($data);//게시판 리스트
		$result_list_count = $this->model_board->board_list_count($data);//게시판 리스트 총 개수

		$total_page = ceil($result_list_count/$page_size);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['board_idx']	= $row->board_idx;
			$data_array[$x]['board_type']	= $row->board_type;
			$data_array[$x]['title']	= $row->title;
			$data_array[$x]['board_img']	= $row->board_img;
			$data_array[$x]['board_img_width']	= (int)$this->global_function->get_images_width($row->board_img);
			$data_array[$x]['board_img_height']	= (int)$this->global_function->get_images_height($row->board_img);
			$data_array[$x]['contents_type']	= $row->contents_type;
			switch($row->contents_type){
        case "0": $contents_type_str = "정보"; break;
        case "1": $contents_type_str = "규제"; break;
        default: $contents_type_str = "";
      }
			$data_array[$x]['contents_type_str']	= $contents_type_str;
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

	public function board_detail(){
		header('Content-Type: application/json');

		$board_idx = $this->_input_check("board_idx",array());

		$data['board_idx']=$board_idx;

		$result=$this->model_board->board_detail($data);// board 상세

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

			$response->board_idx = $result->board_idx;
			$response->board_type = $result->board_type;
			$response->title = $result->title;
			$response->board_img = $result->board_img;
			$response->board_img_width = (int)$this->global_function->get_images_width($result->board_img);
			$response->board_img_height = (int)$this->global_function->get_images_height($result->board_img);
			$response->contents_type = $result->contents_type;
			switch($result->contents_type){
				case "0": $contents_type_str = "정보"; break;
				case "1": $contents_type_str = "규제"; break;
				default: $contents_type_str = "";
			}
			$response->contents_type_str = $contents_type_str;
			$response->contents = $result->contents;
			$response->ins_date =	$this->global_function->date_Ymd_hyphen($result->ins_date);

			echo json_encode($response);
			exit;
		}
	}

	public function main_contents_detail(){
		header('Content-Type: application/json');

		$board_type = $this->_input_check("board_type",array());

		$data['board_type']=$board_type;

		$result=$this->model_board->main_contents_detail($data);// board 상세

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

			$response->board_idx = $result->board_idx;
			$response->board_type = $result->board_type;
			$response->title = $result->title;
			$response->board_img = $result->board_img;
			$response->board_img_width = (int)$this->global_function->get_images_width($result->board_img);
			$response->board_img_height = (int)$this->global_function->get_images_height($result->board_img);
			$response->contents_type = $result->contents_type;
			switch($result->contents_type){
				case "0": $contents_type_str = "정보"; break;
				case "1": $contents_type_str = "규제"; break;
				default: $contents_type_str = "";
			}
			$response->contents_type_str = $contents_type_str;
			$response->ins_date =	$this->global_function->date_Ymd_hyphen($result->ins_date);

			echo json_encode($response);
			exit;
		}
	}



}
