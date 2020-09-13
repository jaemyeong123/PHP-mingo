<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-10
| Memo : customer_management
|------------------------------------------------------------------------
*/

Class Model_customer_management extends MY_Model {

	// customer_management 리스트
	public function customer_management_list($data){
		$page_size=(int)$data['page_size'];
		$page_no=(int)$data['page_no'];

		$member_idx=$data['member_idx'];

		$sql = "SELECT
							customer_management_idx,
							member_idx,
							consult_date,
							consult_name,
							annual_income,
							loan_product,
							interest_rate,
							loan_amount,
							job_group,
							etc_job,
							gender,
							maturity_date,
							memo,
							ins_date
						FROM
							tbl_customer_management
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

	// customer_management 리스트 카운트
	public function customer_management_list_count($data){
		$member_idx=$data['member_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_customer_management
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

	// customer_management 상세 보기
  public function customer_management_detail($data){
    $customer_management_idx=$data['customer_management_idx'];

    $sql = "SELECT
							customer_management_idx,
							member_idx,
							consult_date,
							consult_name,
							annual_income,
							loan_product,
							interest_rate,
							loan_amount,
							job_group,
							etc_job,
							gender,
							maturity_date,
							memo,
							ins_date
						FROM
							tbl_customer_management
						WHERE
							customer_management_idx=?
            ";

    return $this->query_row($sql,
														array(
														$customer_management_idx
														),
														$data
														);
  }

  //문의등록
  public function customer_management_reg_in($data){
    $member_idx = $data['member_idx'];
    $consult_date = $data['consult_date'];
    $consult_name = $data['consult_name'];
    $annual_income = $data['annual_income'];
    $loan_product = $data['loan_product'];
    $interest_rate = $data['interest_rate'];
    $loan_amount = $data['loan_amount'];
    $job_group = $data['job_group'];
    $etc_job = $data['etc_job'];
    $gender = $data['gender'];
    $maturity_date = $data['maturity_date'];
    $memo = $data['memo'];

    $this->db->trans_begin();

    $sql = "INSERT INTO
              tbl_customer_management
            (
							member_idx,
							consult_date,
							consult_name,
							annual_income,
							loan_product,
							interest_rate,
							loan_amount,
							job_group,
							etc_job,
							gender,
							maturity_date,
							memo,
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
									$consult_date,
									$consult_name,
									$annual_income,
									$loan_product,
									$interest_rate,
									$loan_amount,
									$job_group,
									$etc_job,
									$gender,
									$maturity_date,
									$memo,
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
	public function customer_management_mod_up($data){
		$customer_management_idx = $data['customer_management_idx'];
		$consult_date = $data['consult_date'];
		$consult_name = $data['consult_name'];
		$annual_income = $data['annual_income'];
		$loan_product = $data['loan_product'];
		$interest_rate = $data['interest_rate'];
		$loan_amount = $data['loan_amount'];
		$job_group = $data['job_group'];
		$etc_job = $data['etc_job'];
		$gender = $data['gender'];
		$maturity_date = $data['maturity_date'];
		$memo = $data['memo'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_customer_management
						SET
							consult_date,
							consult_name,
							annual_income,
							loan_product,
							interest_rate,
							loan_amount,
							job_group,
							etc_job,
							gender,
							maturity_date,
							memo,
							upd_date=NOW()
						WHERE
							customer_management_idx=?
						";

		$this->query($sql,
								array(
								$consult_date,
								$consult_name,
								$annual_income,
								$loan_product,
								$interest_rate,
								$loan_amount,
								$job_group,
								$etc_job,
								$gender,
								$maturity_date,
								$memo,
								$customer_management_idx
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
  public function customer_management_del($data){
    $customer_management_idx = $data['customer_management_idx'];

    $this->db->trans_begin();

    $sql = "UPDATE
	            tbl_customer_management
						SET
							del_yn='Y',
	            upd_date=NOW()
						WHERE
							customer_management_idx=?
            ";

    $this->query($sql,
								array(
								$customer_management_idx
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
