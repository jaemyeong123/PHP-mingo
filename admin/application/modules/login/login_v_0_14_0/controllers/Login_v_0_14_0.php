<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	정수범
| Create-Date : 2017-01-15
| Memo : 제주왕플랫폼 로그인/로그아웃
|------------------------------------------------------------------------
*/

class Login_v_0_14_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

  }

  //인덱스
  public function index() {
    $this->login_detail();
  }

  //메인 화면
  public function login_detail(){
		$this->_view(mapping('login').'/view_login_detail');
  }

}// 클래스의 끝
?>
