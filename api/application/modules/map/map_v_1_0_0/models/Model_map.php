<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : 공지사항
|------------------------------------------------------------------------
*/

class Model_map extends MY_Model{

  //  동리스트
  public function map_list(){

    $sql = "SELECT
              ta.dong_idx,
              ta.dong_code,
              ta.dong_name,
              ta.full_name,
              ta.lat,
              ta.lng,
              ta.display_yn,
              tb.sum_cnt
            FROM
              tbl_dong as ta
              left join (
                 select
                   dong_code,
                   sum(data_cnt) as sum_cnt
                  from tbl_dong_info
                  where del_yn='N'
                  group by  dong_code
              )as tb on tb.dong_code=ta.dong_code
            WHERE lat>0
    ";

     return $this->query_result($sql,array(

                            )
                            );
  }



  //동 지역표시하기
  public function dong_detail($data){
    $dong_idx=$data['dong_idx'];

    $sql = "SELECT
              dong_idx,
              dong_code,
              dong_name,
              full_name,
              lat,
              lng,
              display_yn,
              coordinates
						FROM
							tbl_dong
						WHERE
							dong_idx=?
    ";

    return $this->query_row($sql,
														array(
														$dong_idx
														),
														$data
														);
  }

  //동 지역표시하기
  public function dong_summary($data){
    $dong_code=$data['dong_code'];

    $sql = "SELECT
              SUM(data_cnt) AS sum_data_cnt,
              SUM(income_4) AS sum_income_4,
              SUM(income_6) AS sum_income_6,
              SUM(income_8) AS sum_income_8,
              SUM(income_10) AS sum_income_10,
              SUM(income_20) AS sum_income_20,
              SUM(income_21) AS sum_income_21,
              SUM(income_4+income_6+income_8+income_10+income_20+income_21) AS sum_total
            FROM tbl_dong_info
            WHERE del_yn='N' and dong_code=?
    ";

    return $this->query_row($sql,
														array(
														$dong_code
														),
														$data
														);
  }


  //동 지역표시하기
  public function dong_recently_summary($data){
    $dong_code=$data['dong_code'];

    $sql = "SELECT
              SUM(data_cnt) AS sum_data_cnt,
              SUM(income_4) AS sum_income_4,
              SUM(income_6) AS sum_income_6,
              SUM(income_8) AS sum_income_8,
              SUM(income_10) AS sum_income_10,
              SUM(income_20) AS sum_income_20,
              SUM(income_21) AS sum_income_21,
              SUM(income_4+income_6+income_8+income_10+income_20+income_21) AS sum_income_total,
              SUM(month_consume_250) AS sum_month_consume_250,
              SUM(month_consume_350) AS sum_month_consume_350,
              SUM(month_consume_450) AS sum_month_consume_450,
              SUM(month_consume_550) AS sum_month_consume_550,
              SUM(month_consume_650) AS sum_month_consume_650,
              SUM(month_consume_651) AS sum_month_consume_651,
              SUM(month_consume_250+month_consume_350+month_consume_450+month_consume_550+month_consume_650+month_consume_651) AS sum_month_consume_total,
              SUM(age_20) AS sum_age_20,
              SUM(age_21) AS sum_age_21,
              SUM(age_30) AS sum_age_30,
              SUM(age_31) AS sum_age_31,
              SUM(age_40) AS sum_age_40,
              SUM(age_41) AS sum_age_41,
              SUM(age_50) AS sum_age_50,
              SUM(age_51) AS sum_age_51,
              SUM(age_20+age_21+age_30+age_31+age_40+age_41+age_50+age_51) AS sum_age_total,
              SUM(gender_01) AS sum_gender_01,
              SUM(gender_02) AS sum_gender_02,
              SUM(gender_11) AS sum_gender_11,
              SUM(gender_12) AS sum_gender_12,
              SUM(gender_01+gender_02+gender_11+gender_12) AS sum_gender_total,
              SUM(job_0) AS sum_job_0,
              SUM(job_1) AS sum_job_1,
              SUM(job_2) AS sum_job_2,
              SUM(job_3) AS sum_job_3,
              SUM(job_4) AS sum_job_4,
              SUM(job_5) AS sum_job_5,
              SUM(job_6) AS sum_job_6,
              SUM(job_0+job_1+job_2+job_3+job_4+job_5+job_6) AS sum_job_total
            FROM tbl_dong_info
            WHERE del_yn='N'
            and dong_code=?
            order by st_date desc limit 3
    ";

    return $this->query_row($sql,
                            array(
                            $dong_code
                            ),
                            $data
                            );
  }


  //동 지역표시하기
  public function dong_recently_summary($data){
    $dong_code=$data['dong_code'];

    $sql = "SELECT
              st_ym,
              data_cnt,
              dong_code,
              income_4,
              income_6,
              income_8,
              income_10,
              income_20,
              income_21,
              month_consume_250,
              month_consume_350,
              month_consume_450,
              month_consume_550,
              month_consume_650,
              month_consume_651,
              age_20,
              age_21,
              age_30,
              age_31,
              age_40,
              age_41,
              age_50,
              age_51,
              gender_01,
              gender_02,
              gender_11,
              gender_12,
              job_0,
              job_1,
              job_2,
              job_3,
              job_4,
              job_5,
              job_6 
            FROM tbl_dong_info
            WHERE del_yn='N'
            and dong_code=?
            order by st_date desc limit 3
    ";

    return $this->query_result($sql,
                            array(
                            $dong_code
                            ),
                            $data
                            );
  }





}
?>
