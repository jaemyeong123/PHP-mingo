<?  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()	{
		parent::__construct();
	}

	function index(){
		echo "success mingo!!";
		exit;
		$this->load->View('admin');
	}



}
