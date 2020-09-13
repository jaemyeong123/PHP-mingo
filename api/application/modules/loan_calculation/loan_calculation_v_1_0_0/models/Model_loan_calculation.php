<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : 공지사항
|------------------------------------------------------------------------
*/

class Model_loan_calculation extends MY_Model{

  //공지사항 리스트
  public function calculation_search($data){

    $page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];

    $sql = "SELECT
              loan_calculation_idx,
              title,
              contents,
              img,
              ins_date,
              CASE
								WHEN (DATE(ins_date) >= DATE(DATE_SUB(NOW(), INTERVAL +6 DAY))) THEN 'new'
								ELSE NULL
							END new_date
    				FROM
    					tbl_loan_calculation
    				WHERE
    					del_yn = 'N'
              AND loan_calculation_state = 'Y'
              ORDER BY ins_date DESC LIMIT ?, ?
            ";

      return $this->query_result($sql,
                                array(
                                $page_no,
                                $page_size
                                ),$data
                                );
  }


  // QA 상세 보기
  public function expert_detail($data){
    $member_idx=$data['expert_idx'];

    $sql = "SELECT
							qa_idx,
							qa_title,
							qa_contents,
							reply_yn,
							reply_contents,
							reply_date,
							ins_date
						FROM
							tbl_qa
						WHERE
							qa_idx=?
            ";

    return $this->query_row($sql,
														array(
														$qa_idx
														),
														$data
														);
  }

}
?>
