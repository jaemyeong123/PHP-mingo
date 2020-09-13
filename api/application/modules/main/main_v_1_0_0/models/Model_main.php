<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : 공지사항
|------------------------------------------------------------------------
*/

class Model_main extends MY_Model{

  //공지사항 리스트
  public function main_list($data){

    $page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];

    $sql = "SELECT
              main_idx,
              title,
              contents,
              img,
              ins_date,
              CASE
								WHEN (DATE(ins_date) >= DATE(DATE_SUB(NOW(), INTERVAL +6 DAY))) THEN 'new'
								ELSE NULL
							END new_date
    				FROM
    					tbl_main
    				WHERE
    					del_yn = 'N'
              AND main_state = 'Y'
              ORDER BY ins_date DESC LIMIT ?, ?
            ";

      return $this->query_result($sql,
                                array(
                                $page_no,
                                $page_size
                                ),$data
                                );
  }

  //공지사항 리스트 총 카운트
  public function main_list_count(){

    $sql = "SELECT
              count(*) AS cnt
            FROM
              tbl_main
            WHERE
              del_yn = 'N'
              AND main_state = 'Y'
            ";

    return $this->query_cnt($sql,array());
  }
}
?>
