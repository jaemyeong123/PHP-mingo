<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-10
| Memo : member_auth
|------------------------------------------------------------------------
*/

Class Model_member_auth extends MY_Model {

	// member_auth 리스트
	public function member_auth_list($data){
		$page_size=(int)$data['page_size'];
		$page_no=(int)$data['page_no'];

		$member_idx=$data['member_idx'];
    $auth_state=$data['auth_state'];

		$sql = "SELECT
							member_auth_idx,
							member_idx,
							img_paths,
							auth_state,
							reject_reason,
							processing_date,
							ins_date
						FROM
							tbl_member_auth
						WHERE
							del_yn='N'
							AND member_idx=?
		";
		if($auth_state !=""){
			$sql .=" AND auth_state ='$auth_state' ";
		}

		$sql.=" ORDER BY member_auth_idx DESC limit ?,?";


		return $this->query_result($sql,
															array(
															$member_idx,
															$page_no,
															$page_size
															),
															$data
															);
	}

	// member_auth 리스트 카운트
	public function member_auth_list_count($data){
		$member_idx=$data['member_idx'];
		$auth_state=$data['auth_state'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member_auth
						WHERE
							del_yn='N'
							AND member_idx=?
		";

		if($auth_state !=""){
			$sql .=" AND auth_state ='$auth_state' ";
		}

		return $this->query_cnt($sql,
														array(
														$member_idx,
														),
														$data
														);
	}

	// member_auth 상세 보기
  public function member_auth_detail($data){
    $member_auth_idx=$data['member_auth_idx'];

    $sql = "SELECT
							member_auth_idx,
							member_idx,
							affiliat,
							registration_number,
							img_paths,
							auth_state,
							reject_reason,
							processing_date,
							ins_date
						FROM
							tbl_member_auth as a
						WHERE
							member_auth_idx=?
    ";

    return $this->query_row($sql,
														array(
														$member_auth_idx
														),
														$data
														);
  }


	// 요청중인건 체크
	public function member_auth_check($data){
		$member_idx=$data['member_idx'];

		$sql = "SELECT
							member_auth_idx
						FROM
							tbl_member_auth
						WHERE
							del_yn='N'
							AND auth_state='0'
							AND member_idx=?
		";

		return $this->query_row($sql, array($member_idx),$data);
	}

  //등록
  public function member_auth_reg_in($data){
    $member_idx = $data['member_idx'];
    $affiliat = $data['affiliat'];
    $registration_number = $data['registration_number'];
    $img_paths = $data['img_paths'];

    $this->db->trans_begin();

    $sql = "INSERT INTO
              tbl_member_auth
            (
							member_idx,
							affiliat,
							registration_number,
							img_paths,
              del_yn,
              ins_date,
              upd_date
						)VALUES(
							?,
							?,
							?,
							?,
							'N',
							NOW(),
							NOW()
						)
            ";

    $this->query($sql,
								array(
									$member_idx,
                  $affiliat,
                  $registration_number,
									$img_paths,
								),
								$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
  }


}
?>
