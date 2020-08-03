<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_common extends CI_Model {

  //생성자
  public function __construct() {
    parent::__construct();

    $this->load->database();
  }

    // 전체 게시글 db 조회
	public function noticeGetList(){
    return $this->db->get('tbl_notice')->result_array();
	}

  // 게시글 db 등록
  public function noticeRegist(){

    $row = array('title' => $_REQUEST['title'],
                 'contents' => $_REQUEST['contents']
    );

    return $this->db->insert('tbl_notice', $row);
  }

  public function noticeSelectById($notice_idx){
      return $this->db->get_where('tbl_notice', array('notice_idx' => $notice_idx))->row();
  }

  public function noticeUpdate($notice_idx){
    $row = array('title' => $_REQUEST['title'],
                 'contents' => $_REQUEST['contents']
    );
    return $this->db->update('tbl_notice', $row, array('notice_idx' => $notice_idx));
  }

  public function noticeDelete($notice_idx){
      return $this->db->delete('tbl_notice', array('notice_idx' => $notice_idx));
  }
}
