<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2020-12-31
| Memo : 공지사항
|------------------------------------------------------------------------
*/

class Notice extends MY_Controller{
	function __construct(){
		parent::__construct();
	}

	//인덱스
  public function index() {
    $this->notice_list();
  }

	//리스트
  public function notice_list(){
    $this->_view_sub('notice/view_notice_list');
  }

	//상세
  public function notice_detail(){
    $this->_view_sub('notice/view_notice_detail');
  }


}// 클래스의 끝
?>
