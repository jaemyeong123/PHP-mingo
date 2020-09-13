<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2020-04-13
| Memo : 보석
|------------------------------------------------------------------------
*/

class Model_member_point extends MY_Model{

  //  포인트현황
  public function member_point_cnt($data){

    $member_idx = $data['member_idx'];

    $sql = "SELECT
              ifnull(SUM(point),0) AS cnt
            FROM
              tbl_member_point
            WHERE del_yn='N'
            AND   member_idx =?

  ";

  return $this->query_cnt($sql,array(
                            $member_idx
                            ),$data
                            );
  }


  //리스트
  public function member_point_list($data){
    $page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];

    $member_idx = $data['member_idx'];
    $point_type = $data['point_type'];

    $sql = "SELECT
              member_point_idx,
              title,
              point_type,
              point,
              ins_date
            FROM
              tbl_member_point
            WHERE del_yn='N'
            and   member_idx = ?
            and   point_type = ?
      ";

      $sql.=" order by member_point_idx desc 	limit ?,? ";

      return $this->query_result($sql,
                                array(
                                $member_idx,
                                $point_type,
                                $page_no,
                                $page_size
                                ),$data
                                );
  }

  //리스트 총 카운트
  public function member_point_list_count($data){
    $member_idx = $data['member_idx'];
    $point_type = $data['point_type'];

    $sql = "SELECT
              count(*) AS cnt
          FROM
            tbl_member_point
          WHERE del_yn='N'
          and   member_idx = ?
          and   point_type = ?
    ";

    return $this->query_cnt($sql,array($member_idx,$point_type));
  }




} // 클래스의 끝
?>
