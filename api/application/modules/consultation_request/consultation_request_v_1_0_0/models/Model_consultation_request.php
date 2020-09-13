<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-10
| Memo : consultation_request
|------------------------------------------------------------------------
*/

Class Model_consultation_request extends MY_Model {

	// consultation_request 리스트
	public function consultation_request_list($data){
		$page_size=(int)$data['page_size'];
		$page_no=(int)$data['page_no'];

		$member_idx=$data['member_idx'];

		$sql = "SELECT
							consultation_request_idx,
							a.member_idx,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							FN_AES_DECRYPT(b.member_phone) AS member_phone,
							a.ins_date
						FROM
							tbl_consultation_request as a
							join tbl_member as b on b.member_idx=a.member_idx and b.del_yn='N'
						WHERE
							a.del_yn='N'
							AND a.expert_idx=?
		";

		$sql.=" ORDER BY ins_date DESC";

		$sql.="	limit ?,? ";

		return $this->query_result($sql,
															array(
															$member_idx,
															$page_no,
															$page_size
															),
															$data
															);
	}

	// consultation_request 리스트 카운트
	public function consultation_request_list_count($data){
		$member_idx=$data['member_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_consultation_request as a
							join tbl_member as b on b.member_idx=a.member_idx and b.del_yn='N'
						WHERE
							a.del_yn='N'
							AND a.expert_idx=?
		";

		return $this->query_cnt($sql,
														array(
														$member_idx,
														),
														$data
														);
	}

	// consultation_request 상세 보기
  public function consultation_request_detail($data){
    $consultation_request_idx=$data['consultation_request_idx'];

    $sql = "SELECT
							consultation_request_idx,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							FN_AES_DECRYPT(b.member_phone) AS member_phone,
							ins_date
						from	tbl_consultation_request as a
							join tbl_member as b on b.member_idx=a.member_idx and b.del_yn='N'
						WHERE
							a.del_yn='N'
							AND 	consultation_request_idx=?
    ";

    return $this->query_row($sql,
														array(
														$consultation_request_idx
														),
														$data
														);
  }

  //문의등록
  public function consultation_request_reg_in($data){
    $member_idx = $data['member_idx'];
    $expert_idx = $data['expert_idx'];

    $this->db->trans_begin();

    $sql = "INSERT INTO
              tbl_consultation_request
            (
							member_idx,
							expert_idx,
							del_yn,
              ins_date,
              upd_date
						)VALUES(
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
								$expert_idx,
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

  //문의등록
  public function consultation_request_del($data){
    $consultation_request_idx = $data['consultation_request_idx'];

    $this->db->trans_begin();

    $sql = "UPDATE
	            tbl_consultation_request
						SET
							del_yn='Y',
	            upd_date=NOW()
						WHERE
							consultation_request_idx=?
    ";

    $this->query($sql,
								array(
								$consultation_request_idx
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
