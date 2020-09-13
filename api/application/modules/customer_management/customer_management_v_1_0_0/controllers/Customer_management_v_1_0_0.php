<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-10
| Memo : customer_management
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

class customer_management_v_1_0_0 extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('customer_management_v_1_0_0/model_customer_management');
  }

	//customer_management 리스트
	public function customer_management_list(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size=PAGESIZE;

		$data['member_idx']=$member_idx;
		$data['page_size']=$page_size;
		$data['page_no']=($page_num-1)*$page_size;

		$result_list=$this->model_customer_management->customer_management_list($data);// customer_management 리스트
		$result_list_count=$this->model_customer_management->customer_management_list_count($data);// customer_management 리스트 카운트

		$total_page=ceil($result_list_count/$page_size);
		$x=0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['customer_management_idx']	= $row->customer_management_idx;
			$data_array[$x]['loan_product']	= $row->loan_product;
			$data_array[$x]['consult_name']	= $row->consult_name;
			$data_array[$x]['loan_amount']	= $row->loan_amount;
			$data_array[$x]['consult_date']	= $this->global_function->date_Ymd_hyphen($row->consult_date);
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

	//customer_management 상세
	public function customer_management_detail(){
		header('Content-Type: application/json');

		$customer_management_idx = $this->_input_check("customer_management_idx",array());

		$data['customer_management_idx']=$customer_management_idx;

		$result=$this->model_customer_management->customer_management_detail($data);// customer_management 상세

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

			$response->customer_management_idx =	$result->customer_management_idx;
			$response->consult_date =	$result->consult_date;
			$response->consult_name =	$result->consult_name;
			$response->annual_income =	$result->annual_income;
			$response->loan_product =	$result->loan_product;
			$response->interest_rate =	$result->interest_rate;
			$response->loan_amount =	$result->loan_amount;
			$response->job_group =	$result->job_group;
			$response->etc_job =	$result->etc_job;
			$response->gender =	$result->gender;
			$response->maturity_date =	$result->maturity_date;
			$response->memo =	$result->memo;
			$response->ins_date =	$this->global_function->date_Ymd_hyphen($result->ins_date);

			echo json_encode($response);
			exit;
		}
	}

  //문의등록
	public function customer_management_reg_in(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array());
    $consult_date = $this->_input_check("consult_date",array());
    $consult_name = $this->_input_check("consult_name",array());
    $annual_income = $this->_input_check("annual_income",array());
    $loan_product = $this->_input_check("loan_product",array());
    $loan_amount = $this->_input_check("loan_amount",array());
    $interest_rate = $this->_input_check("interest_rate",array());
    $job_group = $this->_input_check("job_group",array());
    $etc_job = $this->_input_check("etc_job",array());
    $gender = $this->_input_check("gender",array());
    $maturity_date = $this->_input_check("maturity_date",array());
    $memo = $this->_input_check("memo",array());

		$data['member_idx'] = $member_idx;
		$data['consult_date'] = $consult_date;
		$data['consult_name'] = $consult_name;
		$data['annual_income'] = $annual_income;
		$data['loan_product'] = $loan_product;
		$data['interest_rate'] = $interest_rate;
		$data['loan_amount'] = $loan_amount;
		$data['job_group'] = $job_group;
		$data['etc_job'] = $etc_job;
		$data['gender'] = $gender;
		$data['maturity_date'] = $maturity_date;
		$data['memo'] = $memo;

		$result = $this->model_customer_management->customer_management_reg_in($data);//문의등록

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


  //문의등록
	public function customer_management_mod_up(){
		header('Content-Type: application/json');
    $customer_management_idx = $this->_input_check("customer_management_idx",array())
    $member_idx = $this->_input_check("member_idx",array());
    $consult_date = $this->_input_check("consult_date",array());
    $consult_name = $this->_input_check("consult_name",array());
    $annual_income = $this->_input_check("annual_income",array());
    $loan_product = $this->_input_check("loan_product",array());
    $loan_amount = $this->_input_check("loan_amount",array());
    $interest_rate = $this->_input_check("interest_rate",array());
    $job_group = $this->_input_check("job_group",array());
    $etc_job = $this->_input_check("etc_job",array());
    $gender = $this->_input_check("gender",array());
    $maturity_date = $this->_input_check("maturity_date",array());
    $memo = $this->_input_check("memo",array());

		$data['customer_management_idx'] = $customer_management_idx;
		$data['consult_date'] = $consult_date;
		$data['consult_name'] = $consult_name;
		$data['annual_income'] = $annual_income;
		$data['loan_product'] = $loan_product;
		$data['interest_rate'] = $interest_rate;
		$data['loan_amount'] = $loan_amount;
		$data['job_group'] = $job_group;
		$data['etc_job'] = $etc_job;
		$data['gender'] = $gender;
		$data['maturity_date'] = $maturity_date;
		$data['memo'] = $memo;

		$result = $this->model_customer_management->customer_management_mod_up($data);//문의등록

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
	public function customer_management_del(){
		header('Content-Type: application/json');

		$customer_management_idx = $this->_input_check("customer_management_idx",array());

		$data['customer_management_idx'] = $customer_management_idx;

		$result = $this->model_customer_management->customer_management_del($data);//문의등록

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
