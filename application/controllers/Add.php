<?php
defined('BASEPATH') OR exit('No direct script access allowed');


	/**
	 * 
	 * function: Add
	 * description : Advertise management class,add edit delete upgrade renew etc  
	 * 	
	 *	
	 */


	
	
class Add extends CI_Controller {


	
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
	 * function: post
	 * description : post and add after login  
	 * parameter : none	
	 *	
	 */


	
	public function post()
	{
		
		if(!isset($_SESSION['user_id'])){
		redirect(base_url().'auth/login/');
		}
		if(isset($_SESSION['user_id'])){
			$user = $this->db->get_where('users',array('id'=>$_SESSION['user_id']))->result_array();
		    if($user[0]['user_type'] == null){
		     redirect(base_url());
			}
		}
		if($this->input->post('save_add')){
			$data['post_status'] = 'published';
			$data['add_title'] = $this->input->post('add_title');
			$data['add_description'] = $this->input->post('description');
			$data['add_category'] = $this->input->post('category');
			$data['add_price'] = $this->input->post('price');
			$data['add_city'] = $this->input->post('city');
			$data['add_brand'] = $this->input->post('brand');
			$data['add_model'] = $this->input->post('model');
			$data['add_used_type'] = $this->input->post('equip_used_type');
			$data['add_postal_code'] = $this->input->post('postal_code');
			$data['add_phone_number'] = $this->input->post('phone_no');
			$data['show_phone_number'] = $this->input->post('show_phone_number');
			$data['add_email'] = $this->input->post('email');
                        $data['add_dealer_type'] = $this->input->post('dealer_type');
			$data['add_dimensions'] = $this->input->post('size');
			
			$zip_code1 = $this->input->post('postal_code');
			$zip_code = $zip_code1 ? $zip_code1 : 'V6A 1R3';
                        $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($zip_code) . '&sensor=true');
                        $coordinates = json_decode($coordinates);
                        $data['latitude'] = @$coordinates->results[0]->geometry->location->lat;
                        $data['longitude'] = @$coordinates->results[0]->geometry->location->lng;
                        if(!isset($data['latitude']) || empty($data['latitude']) ||!isset( $data['longitude']) || empty( $data['longitude']) ){
					$data['latitude'] = $_SESSION['client_lat'];
                                        $data['longitude'] = $_SESSION['client_lon'];
                        }
			$show_on_maps = $this->input->post('show_on_maps');
			if(!empty($show_on_maps)){
			$data['add_show_on_map'] = $show_on_maps;
			} else {
			$data['add_show_on_map'] = 0;
			}
			
			$include_more_services = $this->input->post('include_more_services');
			if(!empty($include_more_services)){
			$data['include_more_services'] = $this->input->post('include_more_services');
			} else {
			$data['include_more_services'] = 0;
			}
			$data['add_added_by_member'] = $_SESSION['user_id'];
			$price = $this->input->post('add_price');
			if(empty($price)){
			$data['add_price_selected'] = 0;
			} else {
			$data['add_price_selected'] = $this->input->post('add_price');
			}
			$this->db->insert("advertisement",$data);
			$add_insert_id = $this->db->insert_id();
			if(!is_dir("assets/uploads/add_portfolio/".$add_insert_id."/")) {
   				 mkdir("assets/uploads/add_portfolio/".$add_insert_id."/");
			}
			$this->email_model->send_search_notifications($add_insert_id);
			$this->email_model->send_add_posted_notification($add_insert_id);
			foreach($_FILES as $name => $file)
			{	
				$num = count($file);
				for($i=0;$i < $num;$i++){
				  if(isset($file["name"][$i]) && isset($file["tmp_name"][$i]) && !empty($file["tmp_name"][$i])){ 			
			           $img_data['image'] =  $file["name"][$i];
				   $img_data['add_id'] = $add_insert_id;
				   $this->db->insert("add_images",$img_data);	
				   move_uploaded_file($file["tmp_name"][$i], "assets/uploads/add_portfolio/".$add_insert_id."/". $file["name"][$i]);
				   }
				}
			}
			
			redirect(base_url().'add/thankyou/'.$add_insert_id);
		}
		if($this->input->post('save_draft')){
			$data['post_status'] = 'draft';
			$data['add_title'] = $this->input->post('add_title');
			$data['add_description'] = $this->input->post('description');
			$data['add_category'] = $this->input->post('category');
			$data['add_price'] = $this->input->post('price');
			$data['add_brand'] = $this->input->post('brand');
			$data['add_model'] = $this->input->post('model');
			$data['add_used_type'] = $this->input->post('equip_used_type');
			$data['add_postal_code'] = $this->input->post('postal_code');
			$data['add_phone_number'] = $this->input->post('phone_no');
			$data['show_phone_number'] = $this->input->post('show_phone_number');
			$data['add_email'] = $this->input->post('email');
			$data['add_dimensions'] = $this->input->post('size');
			$data['add_dealer_type'] = $this->input->post('dealer_type');
			$data['add_city'] = $this->input->post('city');
                        $zip_code1 = $this->input->post('postal_code');
			$zip_code = $zip_code1 ? $zip_code1 : 'V6A 1R3';
                        $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($zip_code) . '&sensor=true');
                        $coordinates = json_decode($coordinates);
                        $data['latitude'] = @$coordinates->results[0]->geometry->location->lat;
                        $data['longitude'] = @$coordinates->results[0]->geometry->location->lng;
                        if(!isset($data['latitude']) || empty($data['latitude']) ||!isset( $data['longitude']) || empty( $data['longitude']) ){
					$data['latitude'] = $_SESSION['client_lat'];
                                        $data['longitude'] = $_SESSION['client_lon'];
                        }
			$show_on_maps = $this->input->post('show_on_maps');
			if(!empty($show_on_maps)){
			$data['add_show_on_map'] = $show_on_maps;
			} else {
			$data['add_show_on_map'] = 0;
			}
			
			$include_more_services = $this->input->post('include_more_services');
			if(!empty($include_more_services)){
			$data['include_more_services'] = $this->input->post('include_more_services');
			} else {
			$data['include_more_services'] = 0;
			}
			$data['add_added_by_member'] = $_SESSION['user_id'];
			$price = $this->input->post('add_price');
			if(empty($price)){
			$data['add_price_selected'] = 0;
			} else {
			$data['add_price_selected'] = $this->input->post('add_price');
			}
			$this->db->insert("advertisement",$data);
			$add_insert_id = $this->db->insert_id();
			if(!is_dir("assets/uploads/add_portfolio/".$add_insert_id."/")) {
   				 mkdir("assets/uploads/add_portfolio/".$add_insert_id."/");
			}

			foreach($_FILES as $name => $file)
			{	
				$num = count($file);
				for($i=0;$i < $num;$i++){
				  if(isset($file["name"][$i]) && isset($file["tmp_name"][$i]) && !empty($file["tmp_name"][$i])){ 			
			           $img_data['image'] =  $file["name"][$i];
				   $img_data['add_id'] = $add_insert_id;
				   $this->db->insert("add_images",$img_data);	
				   move_uploaded_file($file["tmp_name"][$i], "assets/uploads/add_portfolio/".$add_insert_id."/". $file["name"][$i]);
				   }
				}
			}
			
			redirect(base_url().'add/thankyou/'.$add_insert_id);
		}
		$data1['categories'] = $this->db->get('categories')->result_array();
		$data1['user'] = $this->db->get_where('users',array('id'=>$this->session->userdata('user_id')))->result_array();
		$this->load->view('header.php');
		$this->load->view('add/post',$data1);
		$this->load->view('footer.php');
	}
	


	/**
	 * 
	 * function: renew
	 * description : renew item 
	 * parameter : $id ,id of item to be renewd	
	 *	
	 */


	
	function renew($id = null){
		$id = $this->uri->segment(3);
                $query = 'update advertisement set status ="renewed", status_change_date = now() where add_id='.$id;
		$this->db->query($query);
		redirect(base_url().'members/dashboard');
	}
	
        function repost($id = null){
                $id = $this->uri->segment(3);
                $query = 'update advertisement set status ="active", status_change_date = now() where add_id='.$id;
		$this->db->query($query);
		redirect(base_url().'members/dashboard');
	}
	/**
	 * 
	 * function: delete
	 * description : delete advertisement  
	 * parameter : none	
	 *	
	 */


	
	function delete_add(){ 
		$query = 'update advertisement set status ="deleted", status_change_date = now() where add_id='.$this->input->post('add_id');
		$this->db->query($query);
	}
	

	/**
	 * 
	 * function: edit
	 * description : edit advertisement  
	 * parameter : none	
	 *	
	 */


	
	function edit($id = null){ 
                if(isset($_SESSION['user_id'])){
			$user = $this->db->get_where('users',array('id'=>$_SESSION['user_id']))->result_array();
		    if($user[0]['user_type'] == null){
		     redirect(base_url());
			}
		}
		$data['categories'] = $this->db->get('categories')->result_array();
		$data['add_data'] = $this->db->get_where('advertisement', array('add_id' => $id))->result_array(); 
		$data['images'] = $this->db->get_where('add_images', array('add_id' => $id))->result_array(); 
		$this->load->view('header');
		$this->load->view('add/edit',$data);
		$this->load->view('footer');
		if($this->input->post('update_add')){
			$update_data['show_phone_number'] = $this->input->post('show_phone_number');
			$update_data['add_title'] = $this->input->post('add_title');
			$update_data['add_description'] = $this->input->post('description');
			$update_data['add_category'] = $this->input->post('category');
			$update_data['add_price'] = $this->input->post('price');
			$update_data['add_brand'] = $this->input->post('brand');
			$update_data['add_model'] = $this->input->post('model');
			$update_data['add_used_type'] = $this->input->post('equip_used_type');
			$update_data['add_postal_code'] = $this->input->post('postal_code');
			$update_data['add_phone_number'] = $this->input->post('phone_no');
			$update_data['add_email'] = $this->input->post('email');
			$update_data['add_dimensions'] = $this->input->post('size');
			$update_data['add_dealer_type'] = $this->input->post('dealer_type');
			$update_data['add_city'] = $this->input->post('city');
                        $zip_code1 = $this->input->post('postal_code');
			$zip_code = $zip_code1 ? $zip_code1 : 'V6A 1R3';
                        $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($zip_code) . '&sensor=true');
                        $coordinates = json_decode($coordinates);
                        $data['latitude'] = @$coordinates->results[0]->geometry->location->lat;
                        $data['longitude'] = @$coordinates->results[0]->geometry->location->lng;
                        if(!isset($data['latitude']) || empty($data['latitude']) ||!isset( $data['longitude']) || empty( $data['longitude']) ){
					$data['latitude'] = $_SESSION['client_lat'];
                                        $data['longitude'] = $_SESSION['client_lon'];
                        } 
			$show_on_maps = $this->input->post('show_on_maps');
			if(!empty($show_on_maps)){
			$data['add_show_on_map'] = $show_on_maps;
			} else {
			$data['add_show_on_map'] = 0;
			}
			
			$include_more_services = $this->input->post('include_more_services');
			if(!empty($include_more_services)){
			$update_data['include_more_services'] = $this->input->post('include_more_services');
			} else {
			$update_data['include_more_services'] = 0;
			}
			$update_data['add_added_by_member'] = $_SESSION['user_id'];
			$price = $this->input->post('add_price');
			if(empty($price)){
			$update_data['add_price_selected'] = 0;
			} else {
			$update_data['add_price_selected'] = $this->input->post('add_price');
			}
			$this->db->where('add_id',$this->input->post('add_id'));
			$this->db->update("advertisement",$update_data);
			
			if(!is_dir("assets/uploads/add_portfolio/".$this->input->post('add_id')."/")) {
   				 mkdir("assets/uploads/add_portfolio/".$this->input->post('add_id')."/");
			}
                        $check = count($_FILES);
                        if($check > 0){
                            $this->db->where('add_id',$this->input->post('add_id'));
                            $this->db->delete('add_images');
                        }
			foreach($_FILES as $name => $file)
			{	
				$num = count($file);
				for($i=0;$i < $num;$i++){
				  if(!empty($file["name"][$i]) && !empty($file["tmp_name"][$i])){ 			
			           $img_data1['image'] =  $file["name"][$i];
				   $img_data1['add_id'] =  $this->input->post('add_id');
				   $this->db->insert("add_images",$img_data1);	
				   move_uploaded_file($file["tmp_name"][$i], "assets/uploads/add_portfolio/".$this->input->post('add_id')."/". $file["name"][$i]);
				   }
				}
			}
			redirect(base_url().'add/view/'.$this->input->post('add_id'));

		}
	}
	

	
	/**
	 * 
	 * function: upgrade
	 * description : upgrade the saved item  
	 * parameter : $id,id of item to be upgraded	
	 *	
	 */


	
	function upgrade($id = null){
		$data['advertisement'] = $this->db->get_where('advertisement',array('add_id'=>$id))->result_array();
		$this->load->view('header',$data);
		$this->load->view('add/upgrade',$data);
		$this->load->view('footer');
	}
	

	/**
	 * 
	 * function: view
	 * description : display all the details of item
	 * parameter : $id ,id of item	
	 *	
	 */


	
	function view($id = null){
		$data['slider_images'] = $this->db->get('slider_images')->result_array();
		$data['advertisement'] = $this->db->get_where('advertisement',array('add_id'=>$id))->result_array();
		$data['advertisements'] =  $this->db->query('select * from advertisement order by add_id DESC limit 15')->result_array();
		$data['related'] =  $this->db->query('select * from advertisement where add_category = "'.$data['advertisement'][0]['add_category'].'" or add_added_by_member = "'.$data['advertisement'][0]['add_added_by_member'].'" order by add_id DESC limit 3')->result_array();
		$zip_code = $data['advertisement'][0]['add_postal_code'];
		if(!empty($zip_code)){
		$data_zip  = $this->db->get_where('zipcodes',array('zip_code'=>$zip_code))->result_array();
			if(!empty($data_zip)){
			$data['main_marker'] = $data_zip[0];
			}
		}
		$this->load->view('header',$data);
		$this->load->view('add/view',$data);
		$this->load->view('footer');
	}
	

	/**
	 * 
	 * function: save
	 * description : add items to saved items list
	 * parameter : none	
	 *	
	 */


	
	function save(){

		$data['user_id'] = $_SESSION['user_id'];
		$data['add_id'] = $this->input->post('id');
		$chk_if_already = $this->db->get_where('saved_adds',array('user_id'=>$data['user_id'],'add_id' =>$data['add_id']))->num_rows();
		if($chk_if_already < 1){
		$this->db->insert('saved_adds',$data);
                echo "1";
		} else {
		echo "0";
		}
		
	}


	/**
	 * 
	 * function: compare
	 * description : add items to compare list
	 * parameter : none	
	 *	
	 */


	
	function compare(){
		$data['user_id'] = $_SESSION['user_id'];
		$data['add_id'] = $this->input->post('id');
                $check_compare_count = $this->db->get_where('compare_adds',array('user_id'=>$data['user_id']))->num_rows();
		$chk_if_already = $this->db->get_where('compare_adds',array('user_id'=>$data['user_id'],'add_id' =>$data['add_id']))->num_rows();
		if($chk_if_already < 1 && $check_compare_count < 4){
		$this->db->insert('compare_adds',$data);
                echo "1";
		} else {
		echo "0";
		}
		
	}


	/**
	 * 
	 * function: delete_saved
	 * description : delete saved items by user  
	 * parameter : none	
	 *	
	 */


	
	function delete_saved(){
		$this->db->where(array('add_id'=>$this->input->post('add_id'),'user_id' =>$this->session->userdata('user_id')));
		$this->db->delete('saved_adds');
	}


	/**
	 * 
	 * function: delete_compared
	 * description : delete compared items by user  
	 * parameter : none	
	 *	
	 */


	
	function delete_compared(){
		$this->db->where(array('add_id'=>$this->input->post('add_id'),'user_id' =>$this->session->userdata('user_id')));
		$this->db->delete('compare_adds');
	}
	
	function delete_draft(){
		$id = $this->input->post('add_id');
		$this->db->where(array('add_id'=>$this->input->post('add_id'),'add_added_by_member' =>$this->session->userdata('user_id')));
		$this->db->delete('advertisement');
	}
	
	function publish_draft(){
		$data = array(
               'post_status' => 'published',
             );

		$this->db->where('add_id', $this->input->post('add_id'));
		$this->db->update('advertisement', $data); 
	}
        
        public function thankyou(){
                if(!isset($_SESSION['user_id'])){
			redirect(base_url());
		}
                $this->load->view('header');
		$this->load->view('add/thankyou');
		$this->load->view('footer');
        }
        function get_related_adds(){
                $status = $this->input->post('visibility');
                $category = $this->input->post('cat_id');
                $user_id = $this->session->userdata('user_id');
                if($category == 0 && $status == 'all'){
                $all_related = $this->db->query('select advertisement.add_id,advertisement.add_title,advertisement.add_dealer_type,advertisement.add_price,advertisement.add_city,categories.c_title,advertisement.created,advertisement.status from advertisement inner join categories on categories.c_id = advertisement.add_category where advertisement.add_added_by_member ='.$user_id)->result_array();    
                }
                if($category == 0 && $status != 'all'){
                $all_related = $this->db->query('select advertisement.add_id,advertisement.add_title,advertisement.add_dealer_type,advertisement.add_price,advertisement.add_city,categories.c_title,advertisement.created,advertisement.status from advertisement inner join categories on categories.c_id = advertisement.add_category where advertisement.status = "'.$status.'" and advertisement.add_added_by_member ='.$user_id)->result_array();    
                } 
                if($category != 0 && $status == 'all'){
                 $all_related = $this->db->query('select advertisement.add_id,advertisement.add_title,advertisement.add_dealer_type,advertisement.add_price,advertisement.add_city,categories.c_title,advertisement.created,advertisement.status from advertisement inner join categories on categories.c_id = advertisement.add_category where advertisement.add_category = '.$category.' and advertisement.add_added_by_member ='.$user_id)->result_array();   
                }
                if($category != 0 && $status != 'all'){
                $all_related = $this->db->query('select advertisement.add_id,advertisement.add_title,advertisement.add_dealer_type,advertisement.add_price,advertisement.add_city,categories.c_title,advertisement.created,advertisement.status from advertisement inner join categories on categories.c_id = advertisement.add_category where advertisement.add_category = '.$category.' and advertisement.status ="'.$status.'" and advertisement.add_added_by_member ='.$user_id)->result_array();
                }
                echo json_encode($all_related);
        }
	
}
