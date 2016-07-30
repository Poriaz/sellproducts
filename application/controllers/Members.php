<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * 
	 * class: Members
	 * description : display all the user details and links under dashboard and manage account information by the user itself
	 * 
	 * 
	 */


	
class Members extends CI_Controller {

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
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
		$this->load->library("pagination");		
		
	    }	


	/**
	 * 
	 * function: dashboard
	 * description : display all the user details and links under dashboard
	 * parameter : none	
	 *	
	 */


	
	public function dashboard(){
		if(!isset($_SESSION['user_id'])){
		redirect(base_url().'auth/login/');
		}
		$category = ($this->input->get('category')) ? $this->input->get('category') : 'all';
		$post_type = ($this->input->get('post_type')) ? $this->input->get('post_type') : 'all';
		if($category != "all"){
			$cat = " and add_category = '".$category."'";
		} else {
			$cat = "";
		}
		if($post_type == "active"){
			$post = " and (status = 'active' or status = 'renewed')";
		} else if($post_type == "all"){
			$post = " and (status = 'active' or status = 'renewed' or status = 'inactive' or status = 'expired' or status ='deleted')";
		} else if($post_type == "inactive") {
			$post = " and (status = 'inactive' or status = 'expired' or status ='deleted')";
		} else {
			$post = "";
		}
		$query_ads = "select * from advertisement where add_added_by_member = ".$this->session->userdata('user_id')." ".$cat." ".$post;
		$config = array();
		$config['anchor_class'] = 'class="link-pagination" ';
		$config["base_url"] = base_url() . "members/dashboard/";
                $config["total_rows"] = count($this->db->query($query_ads)->result_array());
                $config["per_page"] = 20;
                $config["uri_segment"] = 3;
		$config['num_links'] = 3;
		$data['total_results'] = $config["total_rows"];
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->db->limit($config["per_page"], $page);
		$data['advertisements'] =  $this->db->query($query_ads)->result_array();
		$data["links"] = $this->pagination->create_links();
		$data["categories"] = $this->db->order_by('c_title', 'asc')->get('categories')->result_array();
		$data['user_details'] = $this->db->get_where('users',array('id'=>$this->session->userdata('user_id')))->result_array();
		$this->load->view('header');
		$this->load->view('members/new_dashboard',$data);
		$this->load->view('footer');

	  } 

	/**
	 * 
	 * function: profile
	 * description : display all the user details and links
	 * parameter : none	
	 *	
	 */


	

	public function profile(){
		if(!isset($_SESSION['user_id'])){
		redirect(base_url().'auth/login/');
		}
                
		if($this->input->post('update_profile')){
			if($_FILES['profile_picture']['tmp_name']){
                                $random = rand("111111111","999999999");
				$filename = $random.$_FILES['profile_picture']['name'];
				$path = "assets/uploads/user_images/".$filename;
                                move_uploaded_file($_FILES['profile_picture']['tmp_name'],$path);
                                $data_update['image'] = $filename;
                        }
			$data_update['firstname'] = $this->input->post('firstname');
			$data_update['lastname'] = $this->input->post('lastname');
			$data_update['city'] = $this->input->post('city');
                        $data_update['state'] = $this->input->post('state');
			$data_update['postal_code'] = strtoupper($this->input->post('postalcode'));
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
		$data['user_details'] = $this->db->get_where('users',array('id'=>$this->session->userdata('user_id')))->result_array();
		$this->load->view('header');
		$this->load->view('members/profile_settings.php',$data);
		$this->load->view('footer');

	  }
	/**
	 * 
	 * function: orders
	 * description : display all the orders by user
	 * parameter : none	
	 *	
	 */


	/*public function orders(){
		if(!isset($_SESSION['user_id'])){
		redirect(base_url().'auth/login/');
		}
		$data['user_details'] = $this->db->get_where('users',array('id'=>$this->session->userdata('user_id')))->result_array();
		$this->load->view('header');
		$this->load->view('members/orders',$data);
		$this->load->view('footer');

	  }
	  */

	/**
	 * 
	 * function: index
	 * description : none
	 * parameter : none	
	 *	
	 */


	public function drafts()
	   {
		   $this->load->view('header');
		    $data['drafts'] = $this->db->get_where('advertisement',array('post_status'=>'draft'))->result_array();
			$this->load->view('members/drafts',$data);
			$this->load->view('footer');
	   }

	   
	   /**
	 * 
	 * function: index
	 * description : none
	 * parameter : none	
	 *	
	 */

/*
	public function billing()
	   {
		   $this->load->view('header');
			$this->load->view('members/billing');
			$this->load->view('footer');
	   }
*/
	/**
	 * 
	 * function: index
	 * description : none
	 * parameter : none	
	 *	
	 */


	public function index()
	   {
		$this->load->view('welcome_message');
	   }


	/**
	 * 
	 * function: dealers
	 * description : display all the dealers
	 * parameter : none	
	 *	
	 */


	public function dealers(){
		$data['advertisements'] =  $this->db->query('select * from advertisement where status = "active" and post_status = "published" order by add_id DESC limit 15')->result_array();
		$data['advertisements_slider'] =  $this->db->query('select * from advertisement where status = "active" and post_status = "published" order by rand() limit 1')->result_array();	
		$config = array();
                $config["base_url"] = base_url() . "members/dealers/";
                $config["total_rows"] = count($this->db->query("select users.*,zipcodes.* from users left join zipcodes On users.postal_code = zipcodes.zip_code where users.postal_code is not NULL")->result_array());
                $config["per_page"] = 5;
		$config['use_page_numbers'] = TRUE;
                $config["uri_segment"] = 3;
		$config['num_links'] = 3;
		$data['total_results'] = 	$config["total_rows"];
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->db->limit($config["per_page"], $page);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$order_by = $this->uri->segment(4);
		if(isset($order_by)){
		$data['dealers'] =  $this->db->query("select users.*,zipcodes.* from users left join zipcodes On users.postal_code = zipcodes.zip_code where users.postal_code is not NULL order by users.firstname ".$order_by." limit ".$page.",".$config["per_page"])->result_array();
		} else {
		$data['dealers'] =  $this->db->query("select users.*,zipcodes.* from users left join zipcodes On users.postal_code = zipcodes.zip_code where users.postal_code is not NULL limit ".$page.",".$config["per_page"])->result_array();
		}
		$data["links"] = $this->pagination->create_links();
		$data['slider_images'] = $this->db->get('slider_images')->result_array();
		$data['main_marker'] = array('latitude'=>'34.11042','longitude'=>'-118.2583','zip_code'=>'90039');
		$this->load->view('header');
		$this->load->view('members/dealers',$data);
		$this->load->view('footer');
	}


	/**
	 * 
	 * function: dealers
	 * description : find all the dealers and search for dealers
	 * parameter : none	
	 *	
	 */


	public function find_dealers(){
		
			    $radius = $this->input->post('radius');
			    $dealername = $this->input->post('dealername');
				$x = explode(" ",$dealername);
			    $zip_code1 = $this->input->post('postal_code');
				if(!empty($zip_code1) || !empty($radius)){
					$zip_code = $zip_code1 ? $zip_code1 : 35035;
					$data_zip  = $this->db->query('select * from zipcodes where zip_code like "%'.$zip_code.'%"')->result_array();
					$lat = $data_zip[0]['latitude'];
					$lon = $data_zip[0]['longitude'];
					$data['main_marker'] = $data_zip[0];
					$radius = $radius ? $radius : 20;
					$sql = 'SELECT distinct(zip_code) FROM zipcodes  WHERE (3958*3.1415926*sqrt((latitude-'.$lat.')*(latitude-'.$lat.') + cos(latitude/57.29578)*cos('.$lat.'/57.29578)*(longitude-'.$lon.')*(longitude-'.$lon.'))/180) <= '.$radius.';';
					$result = $this->db->query($sql)->result_array();
					$zipcodeList = array();
					foreach($result as $r)
					{
					array_push($zipcodeList, "'".$r['zip_code']."'");
					}
					if(!empty($x)){
						  $data['dealers'] = $this->db->query("select users.*,zipcodes.* from users inner join zipcodes On users.postal_code = zipcodes.zip_code where users.firstname like '%".$x[0]."%' or  users.lastname like '%".$x[0]."%' or users.postal_code IN(".implode(',',$zipcodeList).")")->result_array();
			 
					} else {
						  $data['dealers'] = $this->db->query("select users.*,zipcodes.* from users inner join zipcodes On users.postal_code = zipcodes.zip_code where users.postal_code IN(".implode(',',$zipcodeList).")")->result_array();
			 
					}
			    } else {
				    $data['dealers'] = $this->db->query("select users.*,zipcodes.* from users inner join zipcodes On users.postal_code = zipcodes.zip_code where users.firstname like '%".$x[0]."%' or  users.lastname like '%".$x[1]."%' and users.postal_code is not null")->result_array();
					$data['main_marker'] = array('latitude' => $data['dealers'][0]['latitude'],'longitude'=>$data['dealers'][0]['longitude']);
			  }
			  $earthRadius = 6371000;
			  $i = 0;
			  foreach($data['dealers'] as $dealer){
				  $dealer_adds = $this->db->get_where('advertisement',array('add_added_by_member'=> $dealer['id'],'status'=>'active','post_status'=>'published'))->result_array();
				  $dealer_adds = $this->db->get_where('advertisement',array('add_added_by_member'=> $dealer['id'],'status'=>'active','post_status'=>'published'))->result_array();
				  $adds = array();
				  foreach($dealer_adds as $add){
					  $adds[] = "<br><a href=".base_url()."add/view/".$add['add_id'].">".$add['add_title']."</a>- $".$add['add_price']; 
				  }
				  $ads = implode(' ',$adds);
				  if(empty($ads)){
					  $ads = "Not Found";
				  } 
				  $data['dealers'][$i]['ads'] = $ads;
				  $latFrom = deg2rad(trim($dealer['latitude']));
				  $lonFrom = deg2rad(trim($dealer['longitude']));
				  $latTo = deg2rad(trim($data['main_marker']['latitude']));
				  $lonTo = deg2rad(trim($data['main_marker']['longitude']));

				  $latDelta = $latTo - $latFrom;
				  $lonDelta = $lonTo - $lonFrom;

				  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
				    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
				  $data['dealers'][$i]['radius'] = round($angle * $earthRadius)."M";
				 if(empty($dealer['image'])){
					 $data['dealers'][$i]['image'] = 'user.jpeg';
				 }
				 /* $this->db->select('image');
				  $this->db->from('add_images');   
    				  $this->db->where('add_id', $dealer['add_id']);
				  $images = $this->db->get()->result_array();
				  $data['dealers'][$i]['images'] = $images[0]['image'];*/
				  
				  $i++;
			}
			echo json_encode($data);
			     	
	}	

	/**
	 * 
	 * function: categories
	 * description : display all the links and search for items
	 * parameter : none	
	 *	
	 */


	public function categories(){
		$data['slider_images'] = $this->db->get('slider_images')->result_array();
		$data['categories'] = $this->db->query('select * from categories order by c_id DESC')->result_array();
		$this->load->view('header');
		$this->load->view('members/categories',$data);
		$this->load->view('footer');
	}


	/**
	 * 
	 * function: newandfeatures
	 * description : display all the newandfeatures 
	 * parameter : none	
	 *	
	 */


	public function newandfeatures(){
		$data['advertisements'] =  $this->db->query('select * from advertisement where status = "active" and post_status = "published" order by add_id DESC limit 15')->result_array();
		$data['slider_images'] = $this->db->get('slider_images')->result_array();
		$filter = ($this->input->get('filter')) ? $this->input->get('filter') : 'all';
		if($filter == "all"){
			$fil = "";
		} else {
                        $month_year = explode("-",$filter);
                        $fil = " where EXTRACT(YEAR_MONTH FROM created_on) = ".$month_year[1].$month_year[0];
                }
		$newsquery = 'select *,EXTRACT(YEAR_MONTH FROM created_on) as ym from news '.$fil.' order by nw_id DESC limit 10';
		$data['news'] = $this->db->query($newsquery)->result_array();
                $this->load->view('header');
		$this->load->view('members/features',$data);
		$this->load->view('footer');
	}


	/**
	 * 
	 * function: news_item
	 * description : display all the news_item 
	 * parameter : none	
	 *	
	 */


	public function news_item($id = null){
		$data['advertisements'] =  $this->db->query('select * from advertisement where status = "active" and post_status = "published" order by add_id DESC limit 15')->result_array();
		$data['advertisements_slider'] =  $this->db->query('select * from advertisement where status = "active" and post_status = "published" order by rand() limit 15')->result_array();
		$data['slider_images'] = $this->db->get('slider_images')->result_array();
		$data['news_item'] = $this->db->get_where('news',array('nw_id'=>$id))->result_array();
		$data['news'] = $this->db->query('select * from news order by nw_id DESC limit 50')->result_array();
		$this->load->view('header');
		$this->load->view('members/news_item',$data);
		$this->load->view('footer');
	}


	/**
	 * 
	 * function: updateuser
	 * description : updateuser details 
	 * parameter : none	
	 *	
	 */


	
	public function updateuser(){


	}


	/**
	 * 
	 * function: updatepassword
	 * description : updatepassword  
	 * parameter : none	
	 *	
	 */


	public function updatepassword(){


	}


	
	/**
	 * 
	 * function: updatepassword
	 * description : updatepassword  
	 * parameter : none	
	 *	
	 */


	public function changepassword(){
		if(!isset($_SESSION['user_id'])){
		redirect(base_url().'auth/login/');
		}
		if($this->input->post('update_password')){
			$old_password = $this->input->post('old_password');
			$new_password = $this->input->post('new_password');
			$confirm_new_password = $this->input->post('confirm_new_password');
		}
		$data['user_details'] = $this->db->get_where('users',array('id'=>$this->session->userdata('user_id')))->result_array();
		$this->load->view('header');
		$this->load->view('members/changepassword',$data);
		$this->load->view('footer');

	}


	/**
	 * 
	 * function: saved_items
	 * description : display all the saved_items by user  
	 * parameter : none	
	 *	
	 */


	public function saved_items(){
		if(!isset($_SESSION['user_id'])){
		redirect(base_url().'auth/login/');
		}
		
		$config = array();
                $config["base_url"] = base_url() . "members/saved_items/";
                $config["total_rows"] = count($this->db->query('select * from saved_adds INNER JOIN advertisement ON saved_adds.add_id = advertisement.add_id where advertisement.status = "active" and advertisement.post_status = "published" and saved_adds.user_id = '.$this->session->userdata('user_id'))->result_array());
                $config["per_page"] = 10;
                $config["uri_segment"] = 3;
		$config['num_links'] = 3;
                $data['total_results'] = $config["total_rows"];
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $chk_lat_lng1 = $this->db->get_where('users' ,array('id' => $_SESSION['user_id']))->result_array();
		$data['saved_items'] =  $this->db->query('select saved_adds.id,advertisement.add_id,add_title,add_price,add_postal_code,latitude,longitude,(3959 * acos(cos(radians("'.$chk_lat_lng1[0]['latitude'].'")) * cos(radians(latitude)) * cos( radians(longitude) - radians("'.$chk_lat_lng1[0]['longitude'].'")) + sin(radians("'.$chk_lat_lng1[0]['latitude'].'")) * sin(radians(latitude)))) AS distance from saved_adds INNER JOIN advertisement ON saved_adds.add_id = advertisement.add_id where advertisement.status = "active" and advertisement.post_status = "published" and saved_adds.user_id = '.$this->session->userdata('user_id').' limit '.$page.','.$config["per_page"])->result_array();
		$i = 0;
                foreach($data['saved_items'] as $saved_items){
                    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$chk_lat_lng1[0]['postal_code'];
                    $url .="&destinations=".$saved_items['add_postal_code']."&mode=driving";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $response_a = json_decode($response, true);
                                        //echo "<pre>";print_r($response_a);echo "</pre>";
                    $distance_driv = $response_a['rows'][0]['elements'][0]['distance']['value'] / 1000;
                    if(!$distance_driv){
                           $data['compare_items'][$i]['distance'] = round($saved_items['distance'])." km away"; 
                    } else {
                            $data['compare_items'][$i]['distance'] = round($distance_driv)." km away";
                    }
                    $i++;
                }
                
                $data["links"] = $this->pagination->create_links();
		
		
		
		
		$data['user_details'] = $this->db->get_where('users',array('id'=>$this->session->userdata('user_id')))->result_array();
		$this->load->view('header');
		$this->load->view('members/saved_items',$data);
		$this->load->view('footer');
	}

	
	/**
	 * 
	 * function: compare_items
	 * description : display all the compare_items by user  
	 * parameter : none	
	 *	
	 */


	
	public function compare_items(){
		if(!isset($_SESSION['user_id'])){
		redirect(base_url().'auth/login/');
		}
		$current_usr = $this->db->get_where('users',array('id' => $_SESSION['user_id']))->result_array(); 
                $data['compare_items'] =  $this->db->query('select compare_adds.*,advertisement.add_id,advertisement.add_price,advertisement.add_title,advertisement.add_postal_code, (3959 * acos(cos(radians("'.$current_usr[0]['latitude'].'")) * cos(radians(advertisement.latitude)) * cos( radians(advertisement.longitude) - radians("'.$current_usr[0]['longitude'].'")) + sin(radians("'.$current_usr[0]['latitude'].'")) * sin(radians(advertisement.latitude)))) AS distance from compare_adds INNER JOIN advertisement ON compare_adds.add_id = advertisement.add_id where advertisement.status = "active" and advertisement.post_status = "published" and compare_adds.user_id = '.$this->session->userdata('user_id').' order by compare_adds.add_id desc limit 4 ')->result_array();
                $i = 0;
                foreach($data['compare_items'] as $compare_items){
                    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$current_usr[0]['postal_code'];
                    $url .="&destinations=".$compare_items['add_postal_code']."&mode=driving";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $response_a = json_decode($response, true);
                                        //echo "<pre>";print_r($response_a);echo "</pre>";
                    $distance_driv = $response_a['rows'][0]['elements'][0]['distance']['value'] / 1000;
                    if(!$distance_driv){
                           $data['compare_items'][$i]['distance'] = round($compare_items['distance'])." km away"; 
                    } else {
                            $data['compare_items'][$i]['distance'] = round($distance_driv)." km away";
                    }
                    $i++;
                }
		$data['user_details'] = $this->db->get_where('users',array('id'=>$this->session->userdata('user_id')))->result_array();
		$this->load->view('header');
		$this->load->view('members/compare_items',$data);
		$this->load->view('footer');
	}

	/**
	 * 
	 * function: save search
	 * description : display all the compare_items by user  
	 * parameter : none	
	 *	
	 */


	
	public function save_search(){
		if(!isset($_SESSION['user_id'])){
		echo "0";
		} else {
		$data['min_price'] = $this->input->post('min_price');
		$data['max_price'] = $this->input->post('max_price');
		$data['postal_code'] = $this->input->post('postal_code');
                $data['category'] = $this->input->post('category');
		$data['radius'] = $this->input->post('radius');
		$data['term'] = $this->input->post('term');
		$data['item_condition'] = $this->input->post('used_type') ? $this->input->post('used_type'): '';
                $data['min_price'] = $this->input->post('min_price') ? $this->input->post('min_price'): '';
                $data['dealer_type'] = $this->input->post('dealer_type') ? $this->input->post('dealer_type'): '';
                $data['dealer_type1'] = $this->input->post('dealer_type1') ? $this->input->post('dealer_type1'): '';
		$data['user_id'] = $this->session->userdata('user_id');
		if(!empty($data['term']) && !empty($data['postal_code'])){
			$this->db->insert('save_search',$data);
			echo $this->db->insert_id();
		}else {
			echo "2";
		}
                }
	}

        public function update_search_name(){
                $search_id = $this->input->post('id');
                $data['set_alert'] = $this->input->post('alert');
                $this->db->where('id',$search_id);
                $this->db->update('save_search',$data);
        }
        
	/**
	 * 
	 * function: saved search
	 * description : display all the saved searches by user  
	 * parameter : none	
	 *	
	 */

	public function saved_searches(){
		if(!isset($_SESSION['user_id'])){
		redirect(base_url().'auth/login/');
		}
                $config["base_url"] = base_url() . "members/saved_searches/";
                $config["total_rows"] = count($this->db->get_where('save_search',array('user_id' =>$_SESSION['user_id']))->result_array());
                $config["per_page"] = 20;
                $config["uri_segment"] = 3;
		$config['num_links'] = 3;
		$data['total_results'] = $config["total_rows"];
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->db->limit($config["per_page"], $page);
		$data['search_saved'] = $this->db->get_where('save_search',array('user_id' =>$_SESSION['user_id']))->result_array();
		$data["links"] = $this->pagination->create_links();
		$data['user_details'] = $this->db->get_where('users',array('id'=>$this->session->userdata('user_id')))->result_array();
		
		$this->load->view('header');
		$this->load->view('members/saved_searches',$data);
		$this->load->view('footer');
	}
	/**
	 * 
	 * function: delete saved search
	 * description : delete searches by user  
	 * parameter : none	
	 *	
	 */

	public function delete_search(){
		$search_id = $this->input->post('search_id');
		$this->db->where('id',$search_id);
		$this->db->delete('save_search');
	}
	
	public function dealers_autocomplete(){
		$term = $_REQUEST['term'];
		$data = $this->db->query("select users.firstname,users.lastname,users.telephone,zipcodes.latitude,zipcodes.longitude,advertisement.add_title,categories.c_title from users inner join zipcodes On users.postal_code = zipcodes.zip_code INNER JOIN advertisement On advertisement.add_added_by_member = users.id INNER JOIN categories ON categories.c_id = advertisement.add_category where lower(users.firstname) like '%".strtolower($term)."%' or  lower(users.lastname) like '%".strtolower($term)."%' or lower(advertisement.add_title) like '%".strtolower($term)."%' or lower(categories.c_title) like '%".strtolower($term)."%'")->result_array();
		header('Content-Type: application/json'); 
		echo json_encode($data);
	}
        
        public function messages(){
                $config["base_url"] = base_url() . "members/messages/";
                $config["total_rows"] = count($this->db->get_where('messages',array('message_to'=>$_SESSION['user_id'],'message_from !=' =>$_SESSION['user_id']))->result_array());
                $config["per_page"] = 10;
                $config["uri_segment"] = 3;
		$config['num_links'] = 3;
		$data['total_results'] = $config["total_rows"];
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->db->limit($config["per_page"], $page);
		$data['messages'] = $this->db->get_where('messages',array('message_to'=>$_SESSION['user_id'],'message_from !=' =>$_SESSION['user_id']))->result_array();
		$data["links"] = $this->pagination->create_links();
                $this->load->view('header');
		$this->load->view('members/messages',$data);
		$this->load->view('footer');
        }
        
		public function sent_messages(){
                $config["base_url"] = base_url() . "members/sent_messages/";
                $config["total_rows"] = count($this->db->get_where('messages',array('message_from'=>$_SESSION['user_id'],'message_from' =>$_SESSION['user_id']))->result_array());
                $config["per_page"] = 10;
                $config["uri_segment"] = 3;
		$config['num_links'] = 3;
		$data['total_results'] = $config["total_rows"];
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->db->limit($config["per_page"], $page);
		$data['messages'] = $this->db->get_where('messages',array('message_to'=>$_SESSION['user_id'],'message_from' =>$_SESSION['user_id']))->result_array();
		$data["links"] = $this->pagination->create_links();
                $this->load->view('header');
		$this->load->view('members/sent_messages',$data);
		$this->load->view('footer');
        }
		
        public function delete_account(){
                if(!isset($_SESSION['user_id'])){
		redirect(base_url().'auth/login/');
		}
                if($_SESSION['user_id'] != "2" && $_SESSION['user_id'] != "22"){
                    $datau['status'] = 'expired';
                    $this->db->where('add_added_by_member',$_SESSION['user_id']);
                    $this->db->update('advertisement',$datau);
                    //delete user
                    $this->db->delete('users',array('id' => $_SESSION['user_id']));
                    redirect(base_url().'auth/logout/');
                }
        }
	
}
