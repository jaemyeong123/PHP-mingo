<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	최재명
| Create-Date : 2020-09-08
| Memo : 공지사항
|------------------------------------------------------------------------
*/

class Model_notice extends MY_Model{

  //공지사항 리스트
  public function notice_list($data){

    $notice_type = $data['notice_type'];
    $page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];

    $sql = "SELECT
              notice_idx,
              title,
              ins_date
    				FROM
    					tbl_notice
    				WHERE
    					del_yn = 'N'
              AND notice_type = ?
              ORDER BY ins_date DESC LIMIT ?, ?
            ";

      return $this->query_result($sql,
                                array(
                                $notice_type,
                                $page_no,
                                $page_size
                                ),$data
                                );
  }

  //공지사항 리스트 총 카운트
  public function notice_list_count($data){

    $notice_type = $data['notice_type'];

    $sql = "SELECT
              count(*) AS cnt
            FROM
              tbl_notice
            WHERE
              del_yn = 'N'
              AND notice_type = ?
            ";

    return $this->query_cnt($sql,array($notice_type),$data);
  }

  public function notice_detail($data){
    $notice_idx=$data['notice_idx'];

    $sql = "SELECT
							notice_idx,
							title,
							img,
							contents,
							ins_date
						FROM
							tbl_notice
						WHERE
							notice_idx=?
            ";

    return $this->query_row($sql,
														array(
														$notice_idx
														),
														$data
														);
  }

}
?>
