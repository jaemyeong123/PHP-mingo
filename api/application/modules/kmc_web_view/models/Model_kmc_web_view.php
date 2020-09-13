<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김용덕
| Create-Date : 2019-05-13
| Memo :  인증
|------------------------------------------------------------------------
*/

Class Model_kmc_web_view extends MY_Model {

  // 가입여부체크
	public function member_join_check($data){

		$member_phone = $data['member_phone'];
		$member_name = $data['member_name'];
		$member_birth = $data['member_birth'];

		$sql = "SELECT
              member_idx,
              del_yn,
              member_leave_date,
              TIMESTAMPDIFF(DAY, member_leave_date, NOW()) as day_diff
						FROM
							tbl_member
						WHERE
							member_name = FN_AES_ENCRYPT(?)
              and member_phone = FN_AES_ENCRYPT(?)
              and member_birth = FN_AES_ENCRYPT(?)
            order by member_leave_date  limit 1
		";

		return $this->query_row($sql,array($member_name,$member_phone,$member_birth));
	}


} // 클래스의 끝
?>
