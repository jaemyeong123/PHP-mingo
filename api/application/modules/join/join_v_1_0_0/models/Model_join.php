<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2020-09-04
| Memo : 회원가입
|------------------------------------------------------------------------
*/

Class Model_join extends MY_Model {

	// 아이디 중복 체크
	public function member_id_check($data){

		$member_id = $data['member_id'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_id = FN_AES_ENCRYPT(?)
						";

		return $this->query_cnt($sql,array($member_id));
	}

  // 회원정보 중복 체크
	public function member_info_check($data){

		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];
		$member_birth = $data['member_birth'];
		$member_gender = $data['member_gender'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_name = FN_AES_ENCRYPT(?)
							AND member_phone = FN_AES_ENCRYPT(?)
							AND member_birth = FN_AES_ENCRYPT(?)
							AND member_gender = ?
							AND del_yn != 'Y'
							AND member_type = '0'
						";

		return $this->query_cnt($sql,array(
														$member_name,
														$member_phone,
														$member_birth,
														$member_gender
														));
	}

	public function member_count(){

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_type = '0'
						";

		return $this->query_cnt($sql,array());
	}

	// 회원 가입
	public function member_reg_in($data){

    $member_id = $data['member_id'];
		$member_pw = $data['member_pw'];
		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];
		$member_gender = $data['member_gender'];
		$member_birth = $data['member_birth'];
		$member_unique_num = $data['member_unique_num'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_member
							(
								member_id,
								member_pw,
								member_name,
								member_phone,
                member_birth,
								member_gender,
								member_unique_num,
								member_type,
								del_yn,
								ins_date,
								upd_date
							)
							SELECT
								FN_AES_ENCRYPT(?),
								SHA2(?, 512),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								?,
								?,
								'0',
								'N',
								NOW(),
								NOW()
						";

		$this->query($sql,array(
								 $member_id,
							 	 $member_pw,
								 $member_name,
								 $member_phone,
							 	 $member_birth,
                 $member_gender,
                 $member_unique_num
							   ),$data
							 );

	  $sql = "INSERT INTO tbl_statistics
					 (
					 st_date,
					 member_0,
					 del_yn,
					 ins_date,
					 upd_date
					 )
					 VALUES
					 (
					 DATE_FORMAT(NOW(),'%Y-%m-01'),
					 member_0+1,
					 'N',
					 NOW(),
					 NOW()
					 )
					 ON DUPLICATE KEY UPDATE st_date=DATE_FORMAT(NOW(),'%Y-%m-01'),member_0=member_0+1,upd_date=NOW()
		";

		$this->query($sql,array());

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
  		$member_idx = $this->db->insert_id();
			$this->db->trans_commit();
			return "1000";
		}
	}

	//통계::일반회원 등록시
	public function statistics_reg_in(){
		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_statistics
					 (
					 st_date,
					 member_0,
					 del_yn,
					 ins_date,
					 upd_date
					 )
					 VALUES
					 (
					 DATE_FORMAT(NOW(),'%Y-%m-01'),
					 member_0+1,
					 'N',
					 NOW(),
					 NOW()
					 )
					 ON DUPLICATE KEY UPDATE st_date=DATE_FORMAT(NOW(),'%Y-%m-01'),member_0=member_0+1,upd_date=NOW()
		";

		$this->query($sql,array());

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
	   	return "1";
		}
	}

	//------------------------------------------------------------------------
	// 대출모집인
	//------------------------------------------------------------------------


	// 대출 모집인 등록번호 check
	public function expert_registration_num_check($data){

		$registration_num = $data['registration_num'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							registration_num = ?
						";

		return $this->query_cnt($sql,array($registration_num));
	}

	// 회원정보 중복 체크
	public function expert_info_check($data){

		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];
		$member_birth = $data['member_birth'];
		$member_gender = $data['member_gender'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_name = FN_AES_ENCRYPT(?)
							AND member_phone = FN_AES_ENCRYPT(?)
							AND member_birth = FN_AES_ENCRYPT(?)
							AND member_gender = ?
							AND del_yn != 'Y'
							AND member_type = '1'
						";

		return $this->query_cnt($sql,array(
														$member_name,
														$member_phone,
														$member_birth,
														$member_gender
														));
	}

	public function expert_count(){

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_type = '1'
						";

		return $this->query_cnt($sql,array());
	}

	// 회원 가입
	public function expert_reg_in($data){

    $member_id = $data['member_id'];
		$member_pw = $data['member_pw'];
		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];
		$member_gender = $data['member_gender'];
		$member_birth = $data['member_birth'];
		$member_unique_num = $data['member_unique_num'];

		$registration_num = $data['registration_num'];
		$member_img = $data['member_img'];
		$calling_card_img = $data['calling_card_img'];
		$member_company = $data['member_company'];
		$member_other_company = $data['member_other_company'];
		$sigungu_1 = $data['sigungu_1'];
		$sigungu_2 = $data['sigungu_2'];
		$sigungu_3 = $data['sigungu_3'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_member
							(
								member_id,
								member_pw,
								member_name,
								member_phone,
                member_birth,
								member_gender,
								registration_num,
								member_img,
								calling_card_img,
								member_company,
								member_other_company,
								sigungu_1,
								sigungu_2,
								sigungu_3,
								member_unique_num,
								member_type,
								del_yn,
								ins_date,
								upd_date
							)
							SELECT
								FN_AES_ENCRYPT(?),
								SHA2(?, 512),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								?,
								?,
								?,
								?,
								?,
								?,
								?,
								?,
								?,
								?,
								'1',
								'N',
								NOW(),
								NOW()
						";

		$this->query($sql,array(
								 $member_id,
							 	 $member_pw,
								 $member_name,
								 $member_phone,
							 	 $member_birth,
                 $member_gender,
                 $registration_num,
                 $member_img,
                 $calling_card_img,
                 $member_company,
                 $member_other_company,
                 $sigungu_1,
                 $sigungu_2,
                 $sigungu_3,
                 $member_unique_num
							   ),$data
							 );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
  		$member_idx = $this->db->insert_id();
			$this->db->trans_commit();
			return "1000";
		}
	}

}	// 클래스의 끝
?>
