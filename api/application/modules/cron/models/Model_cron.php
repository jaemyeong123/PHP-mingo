<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김용옥훈
| Create-Date : 2018-02-17
| Memo : cron
|------------------------------------------------------------------------
*/

Class Model_cron extends MY_Model {

  //배송중에서 배송완료(배송일이후 14일 이후 강제)
	public function json_parse(){
		ini_set("memory_limit" , -1);

		$this->db->trans_begin();

		// Web JSON 파일 읽어오기

		$url = 'http://api.ourdong.com/media/dong.json';
		$json_string = file_get_contents($url);

		$json = json_decode($json_string, true);

		$result_list = $json['features'];

		foreach ($result_list as $row) {

		 $full_code=$row['properties']['adm_cd'];

 		 $do_code=mb_substr($full_code,0,2);
 		 $gu_code=mb_substr($full_code,0,5);
 		 $dong_code=$full_code;

 		 $adm_nm=$row['properties']['adm_nm'];
 		 $temp =explode(" ",$adm_nm);

 		 $do_name=$temp[0];
 		 $gu_name=$temp[1];
 		 $dong_name=$temp[2];
 		 $full_name=$adm_nm;
 		 $full_code=$full_code;

 		 $x=0;
 		 $data_array = array();
 		 $result_list2=$row['geometry']['coordinates'][0][0];
 		 foreach ($result_list2 as $row2) {
 			 $data_array[$x]['lat'] = $row2[1];
 			 $data_array[$x]['lng'] = $row2[0];
 			 $x++;
 		 }

 		 $coordinates = $data_array;

		 $sql = "INSERT INTO
							 tbl_dong
						 (
							do_code,
							do_name,
							gu_code,
							gu_name,
							dong_code,
							dong_name,
							full_name,
							full_code,
							coordinates,
							ins_date
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
							NOW()
						)
		 ";

		 $this->query($sql,
								array(
									$do_code,
									$do_name,
									$gu_code,
									$gu_name,
									$dong_code,
									$dong_name,
									$full_name,
									$full_code,
									json_encode($data_array),
								)
								);


		}



    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
  }


	//알람발송
public function alarm_send(){
	$sgcm = new GCMPushMessage();
	$sgcm->setApiKey(GCM_KEY_1);

	$this->db->trans_begin();

	$sql ="SELECT
					 alarm_idx,
					 member_idx,
					 `index` as _index,
					 gcm_key,
					 device_os,
					 msg,
					 alarm_yn,
					 data
				 FROM
					tbl_alarm
				 where
					del_yn='Y'
					and alarm_yn='Y'
					and send_yn='N'
					order by 	alarm_idx asc
	";
	 $result_list=	$this->query_result($sql,array());
	 foreach($result_list as $row){

			$data['member_idx'] = $row->member_idx;
			$data['gcm_key'] = $row->gcm_key;
			$data['device_os'] = $row->device_os;
			$data['msg']=  $row->msg;
			$data["index"] =$row->_index;
			$body_loc_key = $row->_index;
			$body_loc_args =[""];

			if($row->gcm_key !="" && $row->alarm_yn=="Y"){
					$sgcm->setDevices($row->gcm_key);
					$response = $sgcm->send($row->msg,$row->gcm_key,json_decode($row->data),"",$body_loc_key,$body_loc_args,"");
			}

			if($row->_index>=900){
				$sql="UPDATE tbl_alarm set send_yn='Y',read_yn='Y' where alarm_idx='$row->alarm_idx'";
			}else{
				$sql="UPDATE tbl_alarm set send_yn='Y' where alarm_idx='$row->alarm_idx'";
			}
			$this->query($sql,array());

	 }

	 if($this->db->trans_status() === FALSE){
		 $this->db->trans_rollback();
		 return "0";
	 } else {
		 $this->db->trans_commit();
		 return "1";
	 }
}








}
?>
