<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-02-29
| Memo : 공통 기능
|------------------------------------------------------------------------
*/

Class Model_common extends MY_Model {

  //지역 시도 리스트
	public function city_list() {

		$sql = "SELECT
							city_cd,
							city_name,
							id_cd
						FROM
							tbl_city_cd
						ORDER BY order_no ASC
				  ";

		return $this->query_result($sql,
															array(

															)
														  );
	}

  //구군 리스트
	public function region_list($data) {
		$city_cd=$data['city_cd'];

		$sql = "SELECT
							region_cd,
							region_name,
							city_cd
						FROM
							tbl_region_cd
						WHERE
							city_cd =?
						ORDER BY order_no ASC
				  ";

		return $this->query_result($sql,
															array(
															$city_cd
															),$data
															);

	}

  //app 버전 가져오기
	public function app_version($data) {
		$device_os=$data['device_os'];

		$sql = "SELECT
							version
						FROM
							tbl_app_version
						WHERE
							device_os=?
					";

		return $this->query_row($sql,
														array(
														$device_os
														),$data
														);
	}

}
?>
