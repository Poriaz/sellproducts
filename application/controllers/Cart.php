<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

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
	
	
	
	public function add()
	{
		$item_id =  $this->input->post('id');
		$advertisement = $this->db->get_where('advertisement',array('add_id'=>$item_id))->result_array();
		$add_images = $this->db->get_where('add_images',array('add_id'=>$item_id))->result_array();
		if(empty($add_images[0]['image'])){
		$image = "";
		} else {
		$image = $add_images[0]['image'];
		}
		
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
		}		
		if(@$_SESSION['cart']['cart_total'] < 1 ){
			$_SESSION['cart']['id'] = array();
			$_SESSION['cart']['title'] = array();
			$_SESSION['cart']['price'] = array();
			$_SESSION['cart']['quantity'] = array();
			$_SESSION['cart']['image'] = array();
			$_SESSION['cart']['cart_total'] = "";
		}
		array_push($_SESSION['cart']['id'], $item_id);
		array_push($_SESSION['cart']['title'], $advertisement[0]['add_title']);
		array_push($_SESSION['cart']['quantity'], '1');
		array_push($_SESSION['cart']['image'], $image);
		array_push($_SESSION['cart']['price'], $advertisement[0]['add_price']);
		$_SESSION['cart']['cart_total'] = count($_SESSION['cart']['id']);
		echo $_SESSION['cart']['cart_total'];
                	
	}

	public function view()
	{
		if($this->input->post('update_cart')){
			$_SESSION['cart']['quantity'] = $_POST['quantity'];

		}		
		$this->load->view('header.php');
		$this->load->view('cart/cart.php');
		$this->load->view('footer.php');


	}
	
	public function remove($index = null){
		unset($_SESSION['cart']['id'][$index]);
		$_SESSION['cart']['id'] = array_values($_SESSION['cart']['id']);

		unset($_SESSION['cart']['title'][$index]);
		$_SESSION['cart']['title'] = array_values($_SESSION['cart']['title']);

		unset($_SESSION['cart']['quantity'][$index]);
		$_SESSION['cart']['quantity'] = array_values($_SESSION['cart']['quantity']);

		unset($_SESSION['cart']['image'][$index]);
		$_SESSION['cart']['image'] = array_values($_SESSION['cart']['image']);

		unset($_SESSION['cart']['price'][$index]);
		$_SESSION['cart']['price'] = array_values($_SESSION['cart']['price']);
		redirect(base_url().'cart/view');

	}

	public function review()
	{
		$this->load->view('header.php');
		$this->load->view('cart/cart_review.php');
		$this->load->view('footer.php');


	}
}
