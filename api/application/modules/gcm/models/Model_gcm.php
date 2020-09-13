<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2016-06-23
| Memo : GCM
|------------------------------------------------------------------------
*/

Class Model_gcm extends MY_Model {

  //회원정보 가져오기
  public function member_search($data){
    $index=$data['index'];
    $member_idx=$data['member_idx'];

    if($index =="101" || $index =="102"|| $index =="103"|| $index =="104"|| $index =="105"){
      $sql = "SELECT
                a.member_idx,
                FN_AES_DECRYPT(a.member_name) AS member_name,
                a.all_alarm_yn as alarm_yn,
                a.device_os,
                a.gcm_key
              FROM
                tbl_member a
              WHERE
                member_idx  ='$member_idx'
      ";

    }

    if($index =="106" || $index =="108"){
      $sql = "SELECT
                a.member_idx,
                FN_AES_DECRYPT(a.member_name) AS member_name,
                a.all_alarm_yn as alarm_yn,
                a.device_os,
                a.gcm_key
              FROM
                tbl_member a
              WHERE
                member_type  ='0'
      ";

    }

    if($index =="107" || $index =="109"){
      $sql = "SELECT
                a.member_idx,
                FN_AES_DECRYPT(a.member_name) AS member_name,
                a.all_alarm_yn as alarm_yn,
                a.device_os,
                a.gcm_key
              FROM
                tbl_member a
              WHERE
                member_type  ='1'
      ";
    }



    return $this->query_result($sql,
                            array(

                            ),$data
                            );
  }



  //회원 gcm 입력
  public function member_gcm_in($data) {
    $member_idx=$data['member_idx'];
    $msg=$data['msg'];
    $index=$data['index'];
    $device_os=$data['device_os'];
    $gcm_key=$data['gcm_key'];
    $alarm_yn=$data['alarm_yn'];

    $this->db->trans_begin();

    $sql = "INSERT INTO
              tbl_alarm
            (
              member_idx,
              `data`,
              msg,
              `index`,
              device_os,
              gcm_key,
              alarm_yn,
              send_yn,
              read_yn,
              del_yn,
              ins_date,
              upd_date
            )VALUES (
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              'N',
              'N',
              'N',
              NOW(),
              NOW()
            )
    ";

    $this->query($sql,
                array(
                $member_idx,
                json_encode($data),
                $msg,
                $index,
                $device_os,
                $gcm_key,
                $alarm_yn,
                ),$data
                );

    $alarm_idx = $this->db-> insert_id() ;

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "0";
    }else{
      $this->db->trans_commit();
      return $alarm_idx;
    }
  }

}

?>
