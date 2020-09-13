<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-10
| Memo : paper_request
|------------------------------------------------------------------------
*/

Class Model_paper_request extends MY_Model {

	// paper_request 리스트
	public function paper_request_list($data){
		$member_idx=$data['member_idx'];
		$page_size=(int)$data['page_size'];
		$page_no=(int)$data['page_no'];

		$sql = "SELECT
							paper_request_idx,
							paper_request_state,
							cancel_type,
							etc,
							ins_date
						FROM
							tbl_paper_request
						WHERE
							del_yn='N'
							AND member_idx=?
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

	// paper_request 리스트 카운트
	public function paper_request_list_count($data){
		$member_idx=$data['member_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_paper_request
						WHERE
							del_yn='N'
							AND member_idx=?
		";

		return $this->query_cnt($sql,
														array(
														$member_idx,
														),
														$data
														);
	}

	// paper_request 상세 보기
  public function paper_request_detail($data){
    $paper_request_idx=$data['paper_request_idx'];

    $sql = "SELECT
							paper_request_idx,
							dong_code,
							request_state,
							collect_start_date,
							report_start_date,
							report_complete_date,
							business_type,
							main_service,
							email,
							etc,
							cancel_type,
							cancel_date,
							cancel_reason,
							del_yn,
							ins_date,
							upd_date
						FROM
							tbl_paper_request
						WHERE
							paper_request_idx=?
    ";

    return $this->query_row($sql,
														array(
														$paper_request_idx
														),
														$data
														);
  }

  //문의등록
  public function paper_request_reg_in($data){
    $member_idx = $data['member_idx'];
    $dong_code = $data['dong_code'];
    $business_type = $data['business_type'];
    $main_service = $data['main_service'];
    $email = $data['email'];
    $etc = $data['etc'];
		$pay_price = -1*$data['pay_price'];

    $this->db->trans_begin();

    $sql = "INSERT INTO
              tbl_paper_request
            (
							member_idx,
							dong_code,
							business_type,
							main_service,
							email,
							etc,
							del_yn,
              ins_date,
              upd_date
						)VALUES(
							?,
							?,
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
									$dong_code,
									$business_type,
									$main_service,
									$email,
									$etc,
								),
								$data
								);

			$sql = "INSERT INTO
               tbl_member_point
               (
                 member_idx,
                 point_type,
                 title,
                 point,
                 del_yn,
                 ins_date,
                 upd_date
               ) values (
                  ?,
                  1,
                  '리포트요청',
                  ?,
                 'N',
                 NOW(),
                 NOW()
               )
       ";

       $this->query($sql,
                   array(
                     $member_idx,
                     $pay_price,
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
  public function paper_request_del($data){
    $paper_request_idx = $data['paper_request_idx'];

    $this->db->trans_begin();

    $sql = "UPDATE
	            tbl_paper_request
						SET
							request_state='4',
							cancel_type='0',
							cancel_date==NOW(),
	            upd_date=NOW()
						WHERE
							paper_request_idx=?
    ";

    $this->query($sql,
								array(
								$paper_request_idx
								),
								$data
								);
		//이용권 환불처리




		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
  }

	//문의등록
	public function paper_request_cancel_mod_up($data){
		$paper_request_idx = $data['paper_request_idx'];
		$cancel_reason = $data['cancel_reason'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_paper_request
						SET
							cancel_type='0',
							cancel_reason=?,
							cancel_date=NOW(),
							upd_date=NOW()
						WHERE
							paper_request_idx=?
						";

		$this->query($sql,
								array(
								$cancel_reason,
								$paper_request_idx,
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
