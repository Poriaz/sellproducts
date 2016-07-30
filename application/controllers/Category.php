<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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
		$this->load->library("pagination");
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
   	 }

	/**
	 * 
	 * function: view
	 * description : display
	 * parameter : id of category	
	 *	
	 */
	
	
	
	public function view($id = null)
	{
		$data['title'] = "Foodequipments: Home";
		$data['slider_images'] = $this->db->get('slider_images')->result_array();
		
		$config = array();
        $config["base_url"] = base_url() . "category/view/".$id."/";
        $config["total_rows"] = count($this->db->get_where('advertisement',array('add_category'=>$id))->result_array());
        $config["per_page"] = 8;
        $config["uri_segment"] = 4;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$this->db->limit($config["per_page"], $page);
		$data['total_advertisements'] =  $this->db->get_where('advertisement',array('add_category'=>$id,'status'=>'active','post_status'=>'published'))->result_array();
		$data["links"] = $this->pagination->create_links();
		
		$data['category'] = $this->db->get_where('categories',array('c_id'=>$id))->result_array();
		$this->load->view('header',$data);
		$this->load->view('category/view',$data);
		$this->load->view('footer');
                	
	}


	


	
}
