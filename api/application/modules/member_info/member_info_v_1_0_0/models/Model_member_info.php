<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2018-02-11
| Memo : 회원 정보
|------------------------------------------------------------------------
*/
class Model_member_info extends MY_Model
{

//회원 정보 상세 보기
  public function member_info_detail($data) {

    $member_idx = $data['member_idx'];

    $sql = "SELECT
              member_idx,
              FN_AES_DECRYPT(member_id) AS member_id,
              FN_AES_DECRYPT(member_name) AS member_name,
              FN_AES_DECRYPT(member_phone) AS member_phone,
              FN_AES_DECRYPT(member_birth) AS member_birth,
              member_gender
            FROM
            tbl_member
            WHERE
              member_idx = ?
              AND del_yn ='N'
          ";

      return $this->query_row($sql,
                              array(
                              $member_idx
                              ),
                              $data);
  }

//회원 정보 수정
  public function member_info_mod_up($data) {

    $member_idx = $data['member_idx'];
    $member_name = $data['member_name'];
		$member_phone = $data['member_phone'];

    $sql = "UPDATE
          	 tbl_member
          	SET
              member_phone = FN_AES_ENCRYPT(?),
              member_birth = FN_AES_ENCRYPT(?),
              upd_date = NOW()
          	WHERE
          	 member_idx = ?
          ";

      return $this->query($sql,
                          array(
                        	$member_name,
                        	$member_phone,
                          $member_idx
                          ),
                          $data);
  }

//회원 정보 상세 보기
  public function expert_info_detail($data) {

    $member_idx = $data['member_idx'];

    $sql = "SELECT
              member_idx,
              FN_AES_DECRYPT(member_id) AS member_id,
              FN_AES_DECRYPT(member_name) AS member_name,
              FN_AES_DECRYPT(member_phone) AS member_phone,
              FN_AES_DECRYPT(member_birth) AS member_birth,
              member_gender,
              del_yn,
              member_company,
              member_other_company,
              registration_num,
              member_img,
              calling_card_img,
              loan_expert_type,
              member_intro,
              contactable_time,
              city_1,
              city_2,
              city_3,
              sigungu_1,
              sigungu_2,
              sigungu_3
            FROM
            tbl_member
            WHERE
              member_idx = ?
              AND del_yn ='N'
          ";

      return $this->query_row($sql,
                              array(
                              $member_idx
                              ),
                              $data);
  }

//회원 정보 수정
  public function expert_info_mod_up($data) {

    $member_idx = $data['member_idx'];
    $member_name = $data['member_name'];
		$member_phone = $data['member_phone'];
		$member_intro = $data['member_intro'];
		$contactable_time = $data['contactable_time'];

    $sql = "UPDATE
          	 tbl_member
          	SET
              member_phone = FN_AES_ENCRYPT(?),
              member_birth = FN_AES_ENCRYPT(?),
              member_intro = ?,
              contactable_time = ?,
              upd_date = NOW()
          	WHERE
          	 member_idx = ?
          ";

      return $this->query($sql,
                          array(
                        	$member_name,
                        	$member_phone,
                        	$member_intro,
                        	$contactable_time,
                          $member_idx
                          ),
                          $data);
  }


  //회원 정보 수정 ::이미지
  public function member_img_mod_up($data) {

    $member_idx = $data['member_idx'];
		$member_img = $data['member_img'];

    $sql = "UPDATE
          	 tbl_member
          	SET
            	member_img = ?,
              upd_date = NOW()
          	WHERE
          	 member_idx = ?
    ";

    return $this->query($sql,
                          array(
                          $member_img,
                          $member_idx
                          ),
                          $data);
  }
  //
  // public function member_auth_list($data){
  //
	// 	$member_idx = $data['member_idx'];
  //   $page_size=(int)$data['page_size'];
	// 	$page_no=(int)$data['page_no'];
  //
	// 	$sql = "SELECT
	// 						member_auth_idx,
	// 						DATE_FORMAT(ins_date,'%Y.%m.%d') as  ins_date,
	// 						DATE_FORMAT(upd_date,'%Y.%m.%d') as  upd_date
	// 					FROM
	// 						tbl_member_auth
	// 					WHERE
	// 						del_yn = 'N'
  //             AND member_idx = ?
	// 					";
  //
  //   $sql.=" ORDER BY member_auth_idx DESC limit ?,? ";
  //
	// 	return $this->query_result($sql,array(
  //                               $member_idx,
  //                               $page_no,
  //                               $page_size),
  //                               $data);
	// }
  //
  // public function member_auth_list_count($data){
  //
	// 	$member_idx = $data['member_idx'];
  //
	// 	$sql = "SELECT
	// 						count(*) as cnt
	// 					FROM
	// 						tbl_member_auth
	// 					WHERE
	// 						del_yn = 'N'
  //             AND member_idx = ?
	// 					";
  //
	// 	return $this->query_cnt($sql,array(
  //                           $member_idx),
  //                           $data);
	// }
  //
  //
  // public function member_auth_detail($data) {
  //
  //   $member_auth_idx = $data['member_auth_idx'];
  //
  //   $sql = "SELECT
  //             member_auth_idx,
  //             DATE_FORMAT(ins_date,'%Y.%m.%d') as  ins_date,
	// 						DATE_FORMAT(upd_date,'%Y.%m.%d') as  upd_date,
  //             registration_number,
  //             affiliat,
  //             img_paths,
  //             reject_reason
  //           FROM
  //             tbl_member_auth
  //           WHERE
  //             member_auth_idx = ?
  //             AND del_yn ='N'
  //         ";
  //
  //     return $this->query_row($sql,
  //                             array(
  //                             $member_auth_idx
  //                             ),
  //                             $data);
  // }

}
?>
