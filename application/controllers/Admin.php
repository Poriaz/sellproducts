<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
*class name : Admin
*manage the admin actions and control data in backend
*
*
*
*/
class Admin extends CI_Controller {
	/*
	*function : index
	*arguments : none
	* admin dashboard page after login
	*
	*/
	function __construct()
	{
		parent::__construct();
		
	    if($_SESSION['user_id'] != '22' || $_SESSION['user_id'] != 22){
			redirect(base_url());
		}
	}
	
	public function index()
	{
	  $data['categories'] = $this->db->get('categories')->num_rows();
	  $data['advertisements'] = $this->db->get('advertisement')->num_rows();
	  $data['users'] = $this->db->get('users')->num_rows();
	  $data['news'] = $this->db->get('news')->num_rows();
	  $data['logo'] = $this->db->get('logo')->result_array();
	  $this->load->view('admin_header');	
	  $this->load->view('admin/dashboard',$data);
	  $this->load->view('admin_footer');			
	}
	
	
	
	public function profile()
	{
	  if($this->input->post('update_profile')){
		  if($_FILES['profile_picture']['tmp_name']){
                $random = rand("111111111","999999999");
				$filename = $random.$_FILES['profile_picture']['name'];
				$path = "assets/uploads/user_images/".$filename;
                move_uploaded_file($_FILES['profile_picture']['tmp_name'],$path);
                $data_update['image'] = $filename;
            }
			$data_update['firstname'] = $this->input->post('fname');
			$data_update['lastname'] = $this->input->post('lname');
			$data_update['city'] = $this->input->post('city');
            $data_update['state'] = $this->input->post('state');
			$data_update['postal_code'] = strtoupper($this->input->post('postal_code'));
			$zip_code = $data_update['postal_code'] ? $data_update['postal_code'] : 'V6A 1R3';
            $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($zip_code) . '&sensor=false');
            $coordinates = json_decode($coordinates);
            $lat = @$coordinates->results[0]->geometry->location->lat;
            $lon = @$coordinates->results[0]->geometry->location->lng;
			$data_update['latitude'] = $lat;
			$data_update['longitude'] = $lon;
			$data_update['telephone'] = $this->input->post('telephone');
            $data_update['website_url'] = $this->input->post('website_url');
			$mail = trim($this->input->post('email'));
			if(!empty($mail)){
			$data_update['email'] = $mail;
			}
			$this->db->where('id',$this->session->userdata('user_id'));
			$this->db->update('users',$data_update);
	  }
	  
	  $data['admin'] = $this->db->get_where('users',array('id' => $_SESSION['user_id']))->result_array();
	  $this->load->view('admin_header');	
	  $this->load->view('admin/profile',$data);
	  $this->load->view('admin_footer');			
	}
	
	
	/*
	*function : categories
	*arguments : none
	* admin categories page after login
	*
	*/
	public function categories()
	{
	  $this->load->view('admin_header');
	  $data['categories']	= $this->db->get('categories')->result_array();
	  $this->load->view('admin/category_list',$data);
	  $this->load->view('admin_footer');			
	}
        
        /*
	*function : repot spams
	*arguments : none
	* 
	*
	*/
	public function reported_ads()
	{
	  $this->load->view('admin_header');
	  $data['spam_reports']	= $this->db->get('spam_reports')->result_array();
	  $this->load->view('admin/reported_ads_list',$data);
	  $this->load->view('admin_footer');			
	}
	
        /*
	*function : delete report
	*arguments : none
	* 
	*
	*/
	public function delete_report($id = null)
	{
	  $this->db->delete('spam_reports',array('id' => $id));
	  redirect(base_url().'admin/reported_ads/');
	}
	
	/*
	*function : add categories
	*arguments : none
	* admin add categories page after login
	*
	*/
	public function add_categories()
	{
	  if($this->input->post('submit')){	 
			$insert_data['c_title'] = $this->input->post('c_name');
			$insert_data['c_description'] = $this->input->post('c_description');
			if(!empty($_FILES['c_image']['tmp_name'])){
				$rand = rand('111111111','999999999');
				$image = $rand.$_FILES['c_image']['name'];
				move_uploaded_file($_FILES['c_image']['tmp_name'], 'assets/uploads/category_images/' . $image);
				$insert_data['c_image'] =  $image;
			}
			$this->db->insert('categories',$insert_data);
	  }
	  $this->load->view('admin_header');	
	  $this->load->view('admin/category_add');
	  $this->load->view('admin_footer');			
	}

	

	/*
	*function : edit categories
	*arguments : none
	* admin add categories page after login
	*
	*/
	public function edit_categories($id = null)
	{
		if($this->input->post('update_category')){	 
			$update_data['c_title'] = $this->input->post('c_title');
			$update_data['c_description'] = $this->input->post('c_description');
			if(!empty($_FILES['c_image']['tmp_name'])){
				$rand = rand('111111111','999999999');
				$image = $rand.$_FILES['c_image']['name'];
				move_uploaded_file($_FILES['c_image']['tmp_name'], 'assets/uploads/category_images/'.$image);
				$update_data['c_image'] =  $image;
			}
			$c_id = $this->input->post('c_id');
			$this->db->where('c_id',$c_id);
			$this->db->update('categories',$update_data);
			redirect(base_url().'admin/edit_categories/'.$c_id);
		}	  
		$this->load->view('admin_header');	
	  	$data['category'] = $this->db->get_where('categories',array('c_id' => $id))->result_array();
	  	$this->load->view('admin/category_edit',$data);
	  	$this->load->view('admin_footer');			
	}

	/*
	*function : delete categories
	*arguments : none
	* admin users page after login
	*
	*/
	public function delete_categories($id = NULL)
	{
	  $this->db->delete('categories',array('c_id' => $id));
	  redirect(base_url().'admin/categories/');		
	}
	
	/*
	*function : users
	*arguments : none
	* admin users page after login
	*
	*/
	public function users()
	{
	  $this->load->view('admin_header');	
	  $data['users'] = $this->db->get('users')->result_array();
	  $this->load->view('admin/users_list',$data);
	  $this->load->view('admin_footer');			
	}

	/*
	*function : add categories
	*arguments : none
	* admin add categories page after login
	*
	*/
	public function edit_user($id = null)
	{
		if($this->input->post('update_user')){	 
			$update_data['firstname'] = $this->input->post('fname');
			$update_data['lastname'] = $this->input->post('lname');
			if($this->input->post('reg_type') != "Normal"){
				$update_data['email'] = $this->input->post('reg_type')."|".$this->input->post('email');
			} else {
				$update_data['email'] = $this->input->post('email');
			}
			$user_id = $this->input->post('id');
			$this->db->where('id',$user_id);
			$this->db->update('users',$update_data);
			redirect(base_url().'admin/edit_user/'.$user_id);
		}
		$this->load->view('admin_header');
		$data['user'] = $this->db->get_where('users',array('id' => $id))->result_array();	
		$this->load->view('admin/user_edit',$data);
		$this->load->view('admin_footer');			
	}

	/*
	*function : delete users
	*arguments : none
	* admin users page after login
	*
	*/
	public function delete_user($id = NULL)
	{
	  $this->db->delete('users',array('id' => $id));
	  redirect(base_url().'admin/users/');		
	}
	
	
	/*
	*function : advertisements
	*arguments : none
	* admin users page after login
	*
	*/
	public function advertisements()
	{
	  $this->load->view('admin_header');
	  $data['adds']	= $this->db->get('advertisement')->result_array();	
	  $this->load->view('admin/add_list',$data);
	  $this->load->view('admin_footer');			
	}

	/*
	*function : edit_advertisement
	*arguments : none
	* admin add news page after login
	*
	*/
	public function edit_advertisement($id = null)
	{
	  
		if($this->input->post('update_add')){	
			$update_data['add_title'] = $this->input->post('add_title');
			$update_data['add_description'] = $this->input->post('add_description');
			$update_data['add_category'] = $this->input->post('add_category');
			$update_data['add_price'] = $this->input->post('add_price');
			$update_data['add_postal_code'] = $this->input->post('add_postal_code');
			$update_data['add_phone_number'] = $this->input->post('add_phone_number');
			$update_data['add_email'] = $this->input->post('add_email');
			$update_data['add_contact_by'] = $this->input->post('add_contact_by');
			$add_id = $this->input->post('add_id');
			$this->db->where('add_id',$add_id);
			$this->db->update('advertisement',$update_data);
			redirect(base_url().'admin/edit_advertisement/'.$add_id);
		}
		$this->load->view('admin_header');	
		$data['add']	= $this->db->get_where('advertisement',array('add_id' => $id))->result_array();
		$data['images'] = $this->db->get_where('add_images',array('add_id' => $id))->result_array();
		$this->load->view('admin/advertisement_edit',$data);
		$this->load->view('admin_footer');			
	}

	/*
	*function : delete advertisement
	*arguments : none
	* admin users page after login
	*
	*/
	public function delete_advertisement($id = NULL)
	{
	  $this->db->delete('advertisement',array('add_id' => $id));
	  redirect(base_url().'admin/advertisements/');		
	}
	
	/*
	*function : news
	*arguments : none
	* admin users page after login
	*
	*/
	public function news()
	{
	  $this->load->view('admin_header');
	  $data['news']	= $this->db->get('news')->result_array();	
	  $this->load->view('admin/news_list',$data);
	  $this->load->view('admin_footer');			
	}

	/*
	*function : add news
	*arguments : none
	* admin add news page after login
	*
	*/
	public function add_news()
	{
	  if($this->input->post('submit')){	 
			$insert_data['nw_title'] = $this->input->post('nw_title');
			$insert_data['nw_description'] = $this->input->post('nw_description');
			$insert_data['nw_image'] = $this->input->post('nw_image');
			if(!empty($_FILES['nw_image']['tmp_name'])){
				$rand = rand('111111111','999999999');
				$image = $rand.$_FILES['nw_image']['name'];
				move_uploaded_file($_FILES['nw_image']['tmp_name'], 'assets/uploads/news_images/' . $image);
				$insert_data['nw_image'] =  $image;
			}
			$this->db->insert('news',$insert_data);
	  }
	  $this->load->view('admin_header');	
	  $this->load->view('admin/news_add');
	  $this->load->view('admin_footer');			
	}
	
	/*
	*function : edit news
	*arguments : none
	* admin add news page after login
	*
	*/
	public function edit_news($id = null)
	{
		if($this->input->post('update_news')){	 
			$update_data['nw_title'] = $this->input->post('nw_title');
			$update_data['nw_description'] = $this->input->post('nw_description');
			if(!empty($_FILES['nw_image']['tmp_name'])){
				$rand = rand('111111111','999999999');
				$image = $rand.$_FILES['nw_image']['name'];
				move_uploaded_file($_FILES['nw_image']['tmp_name'], 'assets/uploads/news_images/' . $image);
				$update_data['nw_image'] =  $image;
			}
			$nw_id = $this->input->post('nw_id');
			$this->db->where('nw_id',$nw_id);
			$this->db->update('news',$update_data);
			redirect(base_url().'admin/edit_news/'.$nw_id);
		}	  
	  	$this->load->view('admin_header');
	 	$data['news_item']	= $this->db->get_where('news',array('nw_id' => $id))->result_array();	
	 	$this->load->view('admin/news_edit',$data);
	  	$this->load->view('admin_footer');			
	}
	
	/*
	*function : delete news
	*arguments : none
	* admin users page after login
	*
	*/
	public function delete_news($id = NULL)
	{
	  $this->db->delete('news',array('nw_id' => $id));
	  redirect(base_url().'admin/news/');		
	}
	
	/*
	*function : slider images
	*arguments : none
	* admin users page after login
	*
	*/
	public function slider()
	{
		$data['slider_images'] = $this->db->get('slider_images')->result_array();
	  	$this->load->view('admin_header');
	 	$this->load->view('admin/slider_images',$data);
	  	$this->load->view('admin_footer');		
	}
	
	/*
	*function : add slider images
	*arguments : none
	* admin users page after login
	*
	*/
	public function add_slider_image()
	{
		if(!empty($_FILES['slider_image']['tmp_name'])){
				$rand = rand('111111111','999999999');
				$image = $rand.$_FILES['slider_image']['name'];
				move_uploaded_file($_FILES['slider_image']['tmp_name'], 'assets/uploads/slider_images/' . $image);
				$insert_data['slider_image'] =  $image;
				$this->db->insert('slider_images',$insert_data);
				redirect(base_url().'admin/slider/');
			}
		
	  	$this->load->view('admin_header');
	 	$this->load->view('admin/add_slider_images');
	  	$this->load->view('admin_footer');		
	}
	
	/*
	*function : delete slider images
	*arguments : none
	* admin users page after login
	*
	*/
	public function delete_slider_image($id = NULL)
	{
		$this->db->delete('slider_images',array('s_id'=>$id));
	  	redirect(base_url().'admin/slider/');				
	}
	
	/*
	*function : social icon images
	*arguments : none
	* admin users page after login
	*
	*/
	public function social_icons()
	{
		$data['social_icons'] = $this->db->get('social_icons')->result_array();
	  	$this->load->view('admin_header');
	 	$this->load->view('admin/social_icons',$data);
	  	$this->load->view('admin_footer');		
	}
	
	/*
	*function : add social icons
	*arguments : none
	* admin users page after login
	*
	*/
	public function add_social_icons()
	{
		
		if($this->input->post('submit')){
				if(!empty($_FILES['social_image']['tmp_name'])){
					$rand = rand('111111111','999999999');
					$image = $rand.$_FILES['social_image']['name'];
					move_uploaded_file($_FILES['social_image']['tmp_name'], 'assets/uploads/social_icons/' . $image);
					$insert_data['icon_image'] =  $image;
				}
				$insert_data['icon_url'] = $this->input->post('url');
				$this->db->insert('social_icons',$insert_data);
				redirect(base_url().'admin/social_icons/');
		}
	  	$this->load->view('admin_header');
	 	$this->load->view('admin/add_social_icons');
	  	$this->load->view('admin_footer');		
	}
	
	/*
	*function : delete social icons
	*arguments : none
	* admin users page after login
	*
	*/
	public function delete_social_icons($id = NULL)
	{
		$this->db->delete('social_icons',array('id'=>$id));
	  	redirect(base_url().'admin/social_icons/');				
	}
	
	/*
	*function : change logo
	*arguments : none
	* admin users page after login
	*
	*/
	public function change_logo()
	{
		if(!empty($_FILES['logo']['tmp_name'])){
					$rand = rand('111111111','999999999');
					$image = $rand.$_FILES['logo']['name'];
					move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/uploads/logo/' . $image);
					$insert_data['logo'] =  $image;
					$this->db->where('id','1');
					$this->db->update('logo',$insert_data);
					redirect(base_url().'admin/index/');
		}
		$this->load->view('admin_header');
	 	$this->load->view('admin/add_logo');
	  	$this->load->view('admin_footer');					
	}
}
