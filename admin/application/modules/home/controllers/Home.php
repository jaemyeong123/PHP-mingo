<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends MY_Controller {

  function __construct(){
    parent::__construct();

  }

  //인덱스
  public function index() {
    $this->home();
  }

  // 초기 진입화면
  function home(){
		$this->_view('home/view_home');
	}



}
?>
