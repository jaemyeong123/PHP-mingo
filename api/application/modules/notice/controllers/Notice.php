<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

	function __construct(){
    parent::__construct();

  }

	// 기본값
	public function index(){
		$this->noticeGetList();
	}

	// 게시글 리스트 조회
	public function noticeGetList(){
		$this->load->model('model_notice');
		$data['noticeList'] = $this->model_notice->noticeGetList();
		$this->load->view('noticeView', $data);
	}

	//게시글 등록 양식으로 이동
	public function noticeWriteForm(){
		$this->load->view('noticeWriteForm');
	}

	// 게시글 등록 후 리스트 조회
	public function noticeRegist(){
		$this->load->model('model_notice');
		$regist_result = $this->model_notice->noticeRegist();
		$data['noticeList'] = $this->model_notice->noticeGetList();
		$this->load->view('noticeView', $data);
	}

	//게시글 상세 양식으로 이동
	public function noticeDetail(){
		$this->load->model('model_notice');
		$data['noticeRow'] = $this->model_notice->noticeSelectById($_REQUEST['notice_idx']);
		$this->load->view('noticeDetail', $data);
	}

	// 게시글 수정 양식으로 이동
	public function noticeModifyForm(){
		$this->load->model('model_notice');
		$data['noticeRow'] = $this->model_notice->noticeSelectById($_REQUEST['notice_idx']);
		$this->load->view('noticeModifyForm', $data);
	}

	// 게시글 수정 후 리스트 상세조회
	public function noticeModify(){
		$this->load->model('model_notice');
		$this->model_notice->noticeUpdate($_REQUEST['notice_idx']);
		$data['noticeRow'] = $this->model_notice->noticeSelectById($_REQUEST['notice_idx']);
		$this->load->view('noticeDetail', $data);
	}

	// 게시글 삭제 후 리스트 조회
	public function noticeDelete(){
		$this->load->model('model_notice');
		$this->model_notice->noticeDelete($_REQUEST['notice_idx']);
		$data['noticeList'] = $this->model_notice->noticeGetList();
		$this->load->view('noticeView', $data);
	}
}
