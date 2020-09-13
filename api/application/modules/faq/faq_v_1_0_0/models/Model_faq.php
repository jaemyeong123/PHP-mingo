<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	최재명
| Create-Date : 2020-09-08
| Memo : faq
|------------------------------------------------------------------------
*/

Class Model_faq extends MY_Model {

  //faq 리스트
  public function faq_list($data){
    $faq_type=$data['faq_type'];
    $page_size = (int)$data['page_size'];
    $page_no = (int)$data['page_no'];

    $sql = "SELECT
              faq_idx,
              title,
              contents
            FROM
              tbl_faq
            WHERE
              del_yn = 'N'
              AND faq_type=?
            ORDER BY ins_date DESC LIMIT ?, ? ";

    return $this->query_result($sql,
                              array(
                              $faq_type,
                              $page_no,
                              $page_size
                              ),$data
                              );

  }

  //faq 리스트 총 카운트
  public function faq_list_count($data){

    $faq_type=$data['faq_type'];

    $sql = "SELECT
              COUNT(*) AS cnt
            FROM
              tbl_faq
            WHERE
              del_yn = 'N'
              AND faq_type=?
            ";

    return $this->query_cnt($sql,array($faq_type),$data);
  }

} // 클래스의 끝
?>
