<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	최재명
| Create-Date : 2020-07-29
| Memo : login관리
|------------------------------------------------------------------------
*/

class Model_login extends MY_Model{


	// ================== 공인중개사 ==================== //
	public function login_action_member($data) {

	  $member_id=$data['member_id'];
		$member_pw=$data['member_pw'];

		$sql = "SELECT
							member_idx,
							FN_AES_DECRYPT(member_id) AS member_id,
							FN_AES_DECRYPT(member_name) AS member_name,
							del_yn
						FROM
							tbl_member
						WHERE
							FN_AES_DECRYPT(member_id) = ?
							AND member_pw = SHA2(?,512)

		";

		return $this->query_row($sql, array($member_id, $member_pw));
	}

	//
  public function join_check_member($data) {

    $member_id=$data['member_id'];

    $sql = "SELECT
              COUNT(*) as cnt
            FROM
              tbl_member
            WHERE
              member_id = FN_AES_ENCRYPT(?)
    ";

    return $this->query_cnt($sql, array($member_id));
  }



	// gcm_key,device_os 업데이트
	public function member_gcm_device_up($data) {
	 $member_idx=$data['member_idx'];
	 $gcm_key=$data['gcm_key'];
	 $device_os=$data['device_os'];

	 $this->db->trans_begin();

	 $sql="UPDATE
					 tbl_member
				 SET
					 gcm_key = ?,
					 device_os = ?,
					 upd_date = NOW()
				 WHERE
					 member_idx = ?
	 ";

	 $this->query($sql,
							 array(
							 $gcm_key,
							 $device_os,
							 $member_idx
							 ),
							 $data);

	 if($this->db->trans_status() === FALSE){
		 $this->db->trans_rollback();
		 return "0";
	 }else{
		 $this->db->trans_commit();
		 return "1";
	 }
	}


	// ================== 펀드매니저 ==================== //
	public function login_action_corp($data) {

	  $corp_id=$data['corp_id'];
	  $corp_pw=$data['corp_pw'];

	  $sql = "SELECT
	            corp_idx,
	            FN_AES_DECRYPT(corp_id) AS corp_id,
	           	corp_name,
	            del_yn
	          FROM
	            tbl_corp
	          WHERE
	            FN_AES_DECRYPT(corp_id) = ?
	            AND corp_pw = SHA2(?,512)

	  ";

	  return $this->query_row($sql, array($corp_id, $corp_pw));
	}

	//
	public function join_check_corp($data) {

	  $corp_id=$data['corp_id'];

	  $sql = "SELECT
	            COUNT(*) as cnt
	          FROM
	            tbl_corp
	          WHERE
	            corp_id = FN_AES_ENCRYPT(?)
	  ";

	  return $this->query_cnt($sql, array($corp_id));
	}



	// gcm_key,device_os 업데이트
	public function corp_gcm_device_up($data) {
	 $corp_idx=$data['corp_idx'];
	 $gcm_key=$data['gcm_key'];
	 $device_os=$data['device_os'];

	 $this->db->trans_begin();

	 $sql="UPDATE
	         tbl_corp
	       SET
	         gcm_key = ?,
	         device_os = ?,
	         upd_date = NOW()
	       WHERE
	         corp_idx = ?
	 ";

	 $this->query($sql,
	             array(
	             $gcm_key,
	             $device_os,
	             $corp_idx
	             ),
	             $data);

	 if($this->db->trans_status() === FALSE){
	   $this->db->trans_rollback();
	   return "0";
	 }else{
	   $this->db->trans_commit();
	   return "1";
	 }
	}

	// 공지사항 리스트
	public function notice_list(){

		$sql = "SELECT
							notice_idx,
							title,
							del_yn,
							DATE_FORMAT(ins_date,'%Y.%m.%d') as  ins_date,
							DATE_FORMAT(upd_date,'%Y.%m.%d') as  upd_date
						FROM
							tbl_notice
						WHERE
							del_yn = 'N'
							AND notice_type = $this->user_type
						ORDER BY ins_date DESC LIMIT 1
						";

		return $this->query_row($sql,array());
	}


	// ================== 투자자 ==================== //
	public function login_action_investor($data) {

	  $investor_id=$data['investor_id'];
	  $investor_pw=$data['investor_pw'];

	  $sql = "SELECT
	            investor_idx,
	            FN_AES_DECRYPT(investor_id) AS investor_id,
	            investor_name AS investor_name,
	            del_yn
	          FROM
	            tbl_investor
	          WHERE
	            FN_AES_DECRYPT(investor_id) = ?
	            AND investor_pw = SHA2(?,512)

	  ";

	  return $this->query_row($sql, array($investor_id, $investor_pw));
	}

	//
	public function join_check_investor($data) {

	  $investor_id=$data['investor_id'];

	  $sql = "SELECT
	            COUNT(*) as cnt
	          FROM
	            tbl_investor
	          WHERE
	            investor_id = FN_AES_ENCRYPT(?)
	  ";

	  return $this->query_cnt($sql, array($investor_id));
	}



	// gcm_key,device_os 업데이트
	public function investor_gcm_device_up($data) {
	 $investor_idx=$data['investor_idx'];
	 $gcm_key=$data['gcm_key'];
	 $device_os=$data['device_os'];

	 $this->db->trans_begin();

	 $sql="UPDATE
	         tbl_investor
	       SET
	         gcm_key = ?,
	         device_os = ?,
	         upd_date = NOW()
	       WHERE
	         investor_idx = ?
	 ";

	 $this->query($sql,
	             array(
	             $gcm_key,
	             $device_os,
	             $investor_idx
	             ),
	             $data);

	 if($this->db->trans_status() === FALSE){
	   $this->db->trans_rollback();
	   return "0";
	 }else{
	   $this->db->trans_commit();
	   return "1";
	 }
	}

} // 클래스의 끝
?>
