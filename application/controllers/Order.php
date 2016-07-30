<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	/**
	 * 
	 * function: __construct
	 * description : load database,model
	 * parameter : none	
	 *	
	 */

	function __construct()
    	{
		parent::__construct();
		$this->load->database();
		$this->load->model('email_model');
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
   	 }

	/**
	 * 
	 * function: index
	 * description : display login screen plus home page 
	 * parameter : none	
	 *	
	 */
	
	
	
	

	public function payment()
	{
		$this->load->view('header.php');
		$this->load->view('order/payment');
		$this->load->view('footer.php');


	}
}
