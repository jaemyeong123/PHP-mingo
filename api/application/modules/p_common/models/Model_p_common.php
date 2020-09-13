<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 채종윤
| Create-Date : 2016-08-08
| Memo : p_common
|------------------------------------------------------------------------
*/

Class Model_p_common extends MY_Model {


  //  시도리스트
  public function city_list(){

    $sql = "SELECT
              city_code,
              city_name
            FROM tbl_city
            WHERE del_yn='N'
            ORDER BY order_no ASC
  ";

  return $this->query_result($sql,array(

                            )
                            );
  }


  //  시,구군 리스트
  public function region_list($data){
    $city_code = $data['city_code'];

    $sql = "SELECT
              region_code,
              region_name
            FROM tbl_region
            WHERE del_yn='N'
            AND city_code='$city_code'
            ORDER BY region_name ASC
  ";

  return $this->query_result($sql,array(

                            )
                            );
  }


  //  동리스트
  public function dong_list($data){
    $region_code = $data['region_code'];

    $sql = "SELECT
              dong_idx,
              full_name,
              dong_code,
              dong_name,
              lat,
              lng
            FROM tbl_dong
            WHERE del_yn='N'
            AND region_code='$region_code'
            ORDER BY dong_name ASC
    ";

  return $this->query_result($sql,array(

                            )
                            );
  }

  //  동지역좌표들
  public function region_coordinates($data){
    $dong_idx = $data['dong_idx'];

    $sql = "SELECT
              dong_idx,
              region_coordinates
            FROM tbl_dong
            WHERE del_yn='N'
            AND dong_idx='$dong_idx'

    ";

    return $this->query_row($sql,array(

                            )
                            );
  }



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




}
?>
