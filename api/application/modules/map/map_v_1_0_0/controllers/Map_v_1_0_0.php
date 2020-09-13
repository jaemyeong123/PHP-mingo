<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김용덕
| Create-Date : 2020-08-28
| Memo : 맵
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

class Map_v_1_0_0 extends MY_Controller{

	/* 생성자 영역 */
	function __construct(){
		parent::__construct();

    $this->load->model('map_v_1_0_0/model_map');
	}

	//리스트
	public function map_list(){
    header('Content-Type: application/json');

		$result_list = $this->model_map->map_list();

		$x = 0;
		$data_array = array();
		foreach($result_list as $row){
			$data_array[$x]['dong_idx']	= $row->dong_idx;
			$data_array[$x]['dong_code']	= $row->dong_code;
			$data_array[$x]['dong_name']	= $row->dong_name;
			$data_array[$x]['full_name']	= $row->full_name;
			$data_array[$x]['full_name']	= $row->full_name;
			$data_array[$x]['display_yn']	= $row->display_yn;
			$data_array[$x]['sum_cnt']	= $row->sum_cnt;
			$data_array[$x]['lat']	= $row->lat;
			$data_array[$x]['lng']	= $row->lng;
		  $x++;
		}

		$response = new stdClass();

		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->data_array = $data_array;
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->data_array = $data_array;
		}
		echo json_encode($response);
		exit;
	}


	//동지역표시하기
	public function dong_coordinates_detail(){
		header('Content-Type: application/json');

		$dong_idx = $this->_input_check("dong_idx",array());

		$data['dong_idx']=$dong_idx;

		$result= $this->model_map->dong_detail($data);

		$response = new stdClass();

		if(count($result)==0){
			$response->code = "-2";
			$response->code_msg = $this->global_msg->code_msg('-2');

		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			$response->display_yn = $result->display_yn;
			$response->dong_code = $result->dong_code;
			$response->dong_name = $result->dong_name;
			$response->full_name = $result->full_name;

			$result_list =json_decode($result->coordinates);
			$response->list_cnt = count($result_list);
			$response->data_array = $result_list;
		}
		echo json_encode($response);
		exit;
	}



	//간략보기
	public function dong_summary(){
		header('Content-Type: application/json');

		$dong_code = $this->_input_check("dong_code",array());
		$data['dong_code']=$dong_code;

		$result= $this->model_map->dong_summary($data);

		$response = new stdClass();

		if(count($result)==0){
			$response->code = "-2";
			$response->code_msg = $this->global_msg->code_msg('-2');

		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			$response->sum_data_cnt =	$result->sum_data_cnt;

			$sum_total=$result->sum_total;
			$response->sum_income_4 =	$result->sum_income_4;
			$response->sum_income_4_rate =	round($result->sum_income_4*100/$sum_total,1);
			$response->sum_income_6 =	$result->sum_income_6;
			$response->sum_income_6_rate =	round($result->sum_income_6*100/$sum_total,1);
			$response->sum_income_8 =	$result->sum_income_8;
			$response->sum_income_8_rate =	round($result->sum_income_8*100/$sum_total,1);
			$response->sum_income_10 =	$result->sum_income_10;
			$response->sum_income_10_rate =	round($result->sum_income_10*100/$sum_total,1);
			$response->sum_income_20 =	$result->sum_income_20;
			$response->sum_income_20_rate =	round($result->sum_income_20*100/$sum_total,1);
			$response->sum_income_21 =	$result->sum_income_21;
			$response->sum_income_21_rate =	round($result->sum_income_21*100/$sum_total,1);
			$response->sum_income_total =	$result->$sum_total;

		}
		echo json_encode($response);
		exit;
	}


	//최근3개월상세보기
	public function dong_recently_statistics(){
		header('Content-Type: application/json');

		$dong_code = $this->_input_check("dong_code",array());
		$data['dong_code']=$dong_code;

		$result= $this->model_map->dong_recently_summary($data);
		$result_list= $this->model_map->dong_recently_list($data);

		$response = new stdClass();

		if(count($result)==0){
			$response->code = "-2";
			$response->code_msg = $this->global_msg->code_msg('-2');

		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			$response->sum_data_cnt =	$result->sum_data_cnt;

			//소득별
			$sum_total=$result->sum_income_total;
			$response->sum_income_4 =	$result->sum_income_4;
			$response->sum_income_4_rate =	round($result->sum_income_4*100/$sum_total,1);
			$response->sum_income_6 =	$result->sum_income_6;
			$response->sum_income_6_rate =	round($result->sum_income_6*100/$sum_total,1);
			$response->sum_income_8 =	$result->sum_income_8;
			$response->sum_income_8_rate =	round($result->sum_income_8*100/$sum_total,1);
			$response->sum_income_10 =	$result->sum_income_10;
			$response->sum_income_10_rate =	round($result->sum_income_10*100/$sum_total,1);
			$response->sum_income_20 =	$result->sum_income_20;
			$response->sum_income_20_rate =	round($result->sum_income_20*100/$sum_total,1);
			$response->sum_income_21 =	$result->sum_income_21;
			$response->sum_income_21_rate =	round($result->sum_income_21*100/$sum_total,1);
			$response->sum_income_total =	$sum_total;

			$x = 0;
			$data_array = array();
			foreach($result_list as $row){
				$data_array[$x]['st_ym']	= $row->st_ym;
				$data_array[$x]['income_4']	= $row->income_4;
				$data_array[$x]['income_6']	= $row->income_6;
				$data_array[$x]['income_8']	= $row->income_8;
				$data_array[$x]['income_10']	= $row->income_10;
				$data_array[$x]['income_20']	= $row->income_20;
				$data_array[$x]['income_21']	= $row->income_21;
				$x++;
			}
			$response->income_list_cnt = $x;
			$response->income_data_array = $data_array;


			//소비별
			$sum_total=$result->sum_month_consume_total;
			$response->sum_month_consume_250 =	$result->sum_month_consume_250;
			$response->sum_month_consume_250_rate =	round($result->sum_month_consume_250*100/$sum_total,1);
			$response->sum_month_consume_350 =	$result->sum_month_consume_350;
			$response->sum_month_consume_350_rate =	round($result->sum_month_consume_350*100/$sum_total,1);
			$response->sum_month_consume_450 =	$result->sum_month_consume_450;
			$response->sum_month_consume_450_rate =	round($result->sum_month_consume_450*100/$sum_total,1);
			$response->sum_month_consume_550 =	$result->sum_month_consume_550;
			$response->sum_month_consume_550_rate =	round($result->sum_month_consume_550*100/$sum_total,1);
			$response->sum_month_consume_650 =	$result->sum_month_consume_650;
			$response->sum_month_consume_650_rate =	round($result->sum_month_consume_650*100/$sum_total,1);
			$response->sum_month_consume_651 =	$result->sum_month_consume_651;
			$response->sum_month_consume_651_rate =	round($result->sum_month_consume_651*100/$sum_total,1);
			$response->sum_income_total =	$sum_total;

			$x = 0;
			$data_array = array();
			foreach($result_list as $row){
				$data_array[$x]['st_ym']	= $row->st_ym;
				$data_array[$x]['month_consume_250']	= $row->month_consume_250;
				$data_array[$x]['month_consume_350']	= $row->month_consume_350;
				$data_array[$x]['month_consume_450']	= $row->month_consume_450;
				$data_array[$x]['month_consume_550']	= $row->month_consume_550;
				$data_array[$x]['month_consume_650']	= $row->month_consume_650;
				$data_array[$x]['month_consume_651']	= $row->month_consume_651;

				$x++;
			}
			$response->month_consume_list_cnt = $x;
			$response->month_consume_data_array = $data_array;


			//나이대별
			$sum_total=$result->sum_age_total;
			$response->sum_age_20 =	$result->sum_age_20;
			$response->sum_age_20_rate =	round($result->sum_age_20*100/$sum_total,1);
			$response->sum_age_21 =	$result->sum_age_21;
			$response->sum_age_21_rate =	round($result->sum_age_21*100/$sum_total,1);
			$response->sum_age_30 =	$result->sum_age_30;
			$response->sum_age_30_rate =	round($result->sum_age_30*100/$sum_total,1);
			$response->sum_age_31 =	$result->sum_age_31;
			$response->sum_age_31_rate =	round($result->sum_age_31*100/$sum_total,1);
			$response->sum_age_40 =	$result->sum_age_40;
			$response->sum_age_40_rate =	round($result->sum_age_40*100/$sum_total,1);
			$response->sum_age_41 =	$result->sum_age_41;
			$response->sum_age_41_rate =	round($result->sum_age_41*100/$sum_total,1);
			$response->sum_age_50 =	$result->sum_age_50;
			$response->sum_age_50_rate =	round($result->sum_age_50*100/$sum_total,1);
			$response->sum_age_51 =	$result->sum_age_51;
			$response->sum_age_51_rate =	round($result->sum_age_51*100/$sum_total,1);
			$response->sum_age_total =	$sum_total;

			$x = 0;
			$data_array = array();
			foreach($result_list as $row){
				$data_array[$x]['st_ym']	= $row->st_ym;
				$data_array[$x]['age_20']	= $row->age_20;
				$data_array[$x]['age_21']	= $row->age_21;
				$data_array[$x]['age_30']	= $row->age_30;
				$data_array[$x]['age_31']	= $row->age_31;
				$data_array[$x]['age_40']	= $row->age_40;
				$data_array[$x]['age_41']	= $row->age_41;
				$data_array[$x]['age_50']	= $row->age_50;
				$data_array[$x]['age_51']	= $row->age_51;
				$x++;
			}
			$response->age_list_cnt = $x;
			$response->age_data_array = $data_array;


			//성별
			$sum_total=$result->sum_gender_total;
			$response->sum_gender_01 =	$result->sum_gender_01;
			$response->sum_gender_01_rate =	round($result->sum_gender_01*100/$sum_total,1);
			$response->sum_gender_02 =	$result->sum_gender_02;
			$response->sum_gender_02_rate =	round($result->sum_gender_02*100/$sum_total,1);
			$response->sum_gender_11 =	$result->sum_gender_11;
			$response->sum_gender_11_rate =	round($result->sum_gender_11*100/$sum_total,1);
			$response->sum_gender_12 =	$result->sum_gender_12;
			$response->sum_gender_12_rate =	round($result->sum_gender_12*100/$sum_total,1);
			$response->sum_gender_total =	$sum_total;

			$x = 0;
			$data_array = array();
			foreach($result_list as $row){
				$data_array[$x]['st_ym']	= $row->st_ym;
				$data_array[$x]['gender_01']	= $row->gender_01;
				$data_array[$x]['gender_02']	= $row->gender_02;
				$data_array[$x]['gender_11']	= $row->gender_11;
				$data_array[$x]['gender_12']	= $row->gender_12;

				$x++;
			}
			$response->gender_list_cnt = $x;
			$response->gender_data_array = $data_array;


			//직업별
			$sum_total=$result->sum_job_total;
			$response->sum_job_0 =	$result->sum_job_0;
			$response->sum_job_1 =	$result->sum_job_1;
			$response->sum_job_2 =	$result->sum_job_2;
			$response->sum_job_3 =	$result->sum_job_3;
			$response->sum_job_4 =	$result->sum_job_4;
			$response->sum_job_5 =	$result->sum_job_5;
			$response->sum_job_6 =	$result->sum_job_6;
			$response->sum_job_0_rate =	round($result->sum_job_0*100/$sum_total,1);
			$response->sum_job_1_rate =	round($result->sum_job_1*100/$sum_total,1);
			$response->sum_job_2_rate =	round($result->sum_job_2*100/$sum_total,1);
			$response->sum_job_3_rate =	round($result->sum_job_3*100/$sum_total,1);
			$response->sum_job_4_rate =	round($result->sum_job_4*100/$sum_total,1);
			$response->sum_job_5_rate =	round($result->sum_job_5*100/$sum_total,1);
			$response->sum_job_6_rate =	round($result->sum_job_6*100/$sum_total,1);
			$response->sum_job_total =	$sum_total;

			$x = 0;
			$data_array = array();
			foreach($result_list as $row){
				$data_array[$x]['st_ym']	= $row->st_ym;
				$data_array[$x]['job_0']	= $row->job_0;
				$data_array[$x]['job_1']	= $row->job_1;
				$data_array[$x]['job_2']	= $row->job_2;
				$data_array[$x]['job_3']	= $row->job_3;
				$data_array[$x]['job_4']	= $row->job_4;
				$data_array[$x]['job_5']	= $row->job_5;
				$data_array[$x]['job_6']	= $row->job_6;

				$x++;
			}
			$response->job_list_cnt = $x;
			$response->job_data_array = $data_array;

		}
		echo json_encode($response);
		exit;
	}
}
