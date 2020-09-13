<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김용덕
| Create-Date : 2020-08-28
| Memo : 메인
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

class Loan_calculation_v_1_0_0 extends MY_Controller{

	/* 생성자 영역 */
	function __construct(){
		parent::__construct();

    $this->load->model('loan_calculation_v_1_0_0/model_loan_calculation');
	}

	//회원리스트
	public function calculation_search(){

	  $page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['page_size'] = $page_size;
		$data['page_no']   = ($page_num-1)*$page_size;

		$result_list = $this->model_loan_calculation->loan_calculation_list($data);//공지사항 리스트
		$result_list_count = $this->model_loan_calculation->loan_calculation_list_count();//공지사항 리스트 총 개수

		$total_page = ceil($result_list_count/$page_size);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['loan_calculation_idx']	= $row->loan_calculation_idx;
			$data_array[$x]['title']	= $row->title;
			$data_array[$x]['img_path']	= $row->img;
			$data_array[$x]['img_width']	= $this->global_function->get_images_width($row->img);
			$data_array[$x]['img_height']	= $this->global_function->get_images_height($row->img);
			$data_array[$x]['contents']	= $row->contents;
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

	//QA 상세
	public function expert_detail(){
		header('Content-Type: application/json');

		$expert_idx = $this->_input_check("expert_idx",array());

		$data['expert_idx']=$expert_idx;

		$result=$this->model_loan_calculation->expert_detail($data);// QA 상세

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
			$response->qa_idx =	$result->qa_idx;
			$response->qa_title =	$result->qa_title;
			$response->qa_contents =	$result->qa_contents;
			$response->reply_yn =	$result->reply_yn;
			$response->reply_contents =	$result->reply_contents;

			if (!empty($result->reply_date)) {
				$response->reply_date =	$this->global_function->date_Ymd_hyphen($result->reply_date);
			}else {
				$response->reply_date =	"";
			}
			$response->ins_date =	$this->global_function->date_Ymd_hyphen($result->ins_date);

			echo json_encode($response);
			exit;
		}
	}

}
