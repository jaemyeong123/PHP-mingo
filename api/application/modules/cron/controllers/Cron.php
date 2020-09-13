<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2018-02-17
| Memo : 업체 리스트 및 상세
|------------------------------------------------------------------------
*/
class Cron extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('cron/model_cron');

  }

	//배송중에서 배송완료(배송일이후 14일 이후 강제)
	public function json_parse(){
    //$this->model_cron->json_parse();
	}

  //5초마다 실행(등록필요)
  public function alarm_send(){
    $this->model_cron->alarm_send();
  }




}
