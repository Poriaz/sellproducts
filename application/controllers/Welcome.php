<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	
	
	
	public function index()
	{
		$data['title'] = "Foodequipments: Home";
		$data['slider_images'] = $this->db->get('slider_images')->result_array();
		$data['categories'] = $this->db->query('select * from categories order by c_id DESC')->result_array();
		$data['advertisements_slider'] =  $this->db->query('select * from advertisement where status = "active" and post_status = "published" order by rand() limit 4')->result_array();	
		if(isset($_SESSION['user_id'])){
                    $chk_lat_lng1 = $this->db->get_where('users' ,array('id' => $_SESSION['user_id']))->result_array();
                    $home_adds_query = "select add_id,add_title,add_price,add_postal_code,latitude,longitude,(3959 * acos(cos(radians('".$chk_lat_lng1[0]['latitude']."')) * cos(radians(latitude)) * cos( radians(longitude) - radians('".$chk_lat_lng1[0]['longitude']."')) + sin(radians('".$chk_lat_lng1[0]['latitude']."')) * sin(radians(latitude)))) AS distance from advertisement where status = 'active' and post_status = 'published' order by rand() limit 4 ";
                } else {
                    
                    $latitude = $_SESSION['client_lat'] ? $_SESSION['client_lat'] : '';
                    $longitude = $_SESSION['client_lon'] ? $_SESSION['client_lon'] : '';
                    $home_adds_query = "select add_id,add_title,add_price,add_postal_code,latitude,longitude,(3959 * acos(cos(radians('".$latitude."')) * cos(radians(latitude)) * cos( radians(longitude) - radians('".$longitude."')) + sin(radians('".$latitude."')) * sin(radians(latitude)))) AS distance from advertisement where status = 'active' and post_status = 'published' order by rand() limit 4";
                }
                $data['advertisements'] =  $this->db->query($home_adds_query)->result_array();
                $i = 0;
                foreach($data['advertisements'] as $advertisement){
                    if(isset($_SESSION['user_id'])){
                                $current_usr = $this->db->get_where('users',array('id' => $_SESSION['user_id']))->result_array(); 
                                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$current_usr[0]['postal_code'];
                             } else {
                                 $postal_from_latlng = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$_SESSION['client_lat'].",".$_SESSION['client_lon']."&sensor=true";
                                 $postal_get = file_get_contents($postal_from_latlng);
                                 $postal_get = json_decode($postal_get);
                                 //echo "<pre>";print_r($postal_get);echo "</pre>";
                                 $postal_get->results[0]->formatted_address;
                                 $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$postal_get->results[0]->formatted_address;
                             }
                    $url .="&destinations=".$advertisement['add_postal_code']."&mode=driving";
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
                    if(empty($distance_driv)){
                           $data['advertisement'][$i]['distance'] = round($advertisement['distance'])." km away"; 
                    } else {
                            $data['advertisement'][$i]['distance'] = round($distance_driv)." km away";
                    }
                    $i++;
                }
		$data['total_advertisements'] =  $this->db->query('select * from advertisement where (advertisement.status = "active" or advertisement.status = "renewed") and advertisement.post_status = "published"')->num_rows();
		$search_id = $this->uri->segment(3);
		if(isset($search_id) && is_numeric($search_id)){
		$data['search_data'] = $this->db->get_where('save_search',array('id' =>$search_id))->result_array();
		}
		if($this->input->post('save_user_type')){
			$user_type = $this->input->post('user_type');
			if(!empty($user_type)){
			$this->db->query("update users set user_type = '".$this->input->post('user_type')."' where id = '".$_SESSION['user_id']."'");
			}
		}
                
		$this->db->query("update advertisement set status = 'expired' where `created` + INTERVAL 180 DAY < NOW()"); 
		$this->load->view('header.php',$data);
		$this->load->view('welcome/index.php',$data);
		$this->load->view('footer.php');
                	
	}


	public function save_message(){
                                        $data['add_id'] = $this->input->post('add_id');
                                        $data['message_to'] = $this->input->post('message_to');
                                        $data['name'] = $this->input->post('name');
                                        $data['email'] = $this->input->post('email');
                                        $data['phone'] = $this->input->post('phone');
                                        $data['message'] = $this->input->post('message');
                                        $data['send_copy'] = $this->input->post('send_copy');
					if(empty($data['send_copy'])){
						$data['send_copy'] = 0;
					}
                                        $advertisement = $this->db->get_where('advertisement',array('add_id' => $data['add_id']))->result_array();
                                        $user = $this->db->query('select * from users where id = '.$advertisement[0]['add_added_by_member'])->result_array();
                                        $system_name = "Foodequipemnts";
                                        $from = $data['email'] ? $data['email'] : "ajayrana@gmail.com";
                                        $email_sub = $advertisement[0]['add_title'];
                                        $msg = "Hi ".$user[0]['firstname']." ".$user[0]['lastname'].", <br />";
                                        $msg .= $data['message']."<br />";
                                        $msg .= "Original food equipments post:<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".base_url()."add/view/".$advertisement[0]['add_id']."'>".base_url()."add/view/".$advertisement[0]['add_id']."</a><br/>";
                                        $msg .= "<br /><br /><br /><br /><br /><br /><br /><center><a href=''>&copy; 2015 Food Equipments</a></center>";
                                        $this->email->from($from, $system_name);
                                        $this->email->to($user[0]['email']);
                                        $this->email->subject($email_sub);
                                        $this->email->message($msg);
                                        $this->email->send();
                                        if($data['send_copy'] == 1){
                                                $this->email->from($from, $system_name);
                                                $this->email->to($data['email']);
                                                $this->email->subject($email_sub);
                                                $this->email->message($msg);
                                                $this->email->send();
                                                if(isset($_SESSION['user_id'])){
                                                    $data_sender['add_id'] = $this->input->post('add_id');
                                                    $data_sender['message_to'] = $_SESSION['user_id'];
                                                    $data_sender['message_from'] = $_SESSION['user_id'];
                                                    $data_sender['name'] = $this->input->post('name');
                                                    $data_sender['email'] = $this->input->post('email');
                                                    $data_sender['phone'] = $this->input->post('phone');
                                                    $data_sender['message'] = $this->input->post('message');
                                                  $this->db->insert('messages',$data_sender);  
                                                }
                                        }
                                        if(!empty($data['email']) && !empty($data['message'])){
                                        $this->db->insert('messages',$data);
                                        }
          }

        public function send_message(){
                                        $name = $this->input->post('name');
                                        $email = $this->input->post('email');
                                        $add_id = $this->input->post('add_id');
                                        $friend_email = $this->input->post('friend_email');
                                        $phone = $this->input->post('phone');
                                        $message = $this->input->post('message');
                                        $send_copy = $this->input->post('send_copy');
                                        $advertisement = $this->db->get_where('advertisement',array('add_id' => $add_id))->result_array();
                                        $add_title = $advertisement[0]['add_title'];
                                        $add_price = $advertisement[0]['add_price'];
                                        $add_model = $advertisement[0]['add_model'];
                                        $fromemail = "admin@collab-o-nation.com";
                                        if(empty($model)){$model = 'Unknown';}
                                        $distance = 100;
                                        $images  = $this->db->get_where('add_images',array('add_id'=> $add_id))->result_array();
                                        if(!empty($images[0]['image']) && file_exists('assets/uploads/add_portfolio/'.$add_id."/".$images[0]['image'])){ 
                                        $item_image =  str_replace('/index.php','',base_url())."assets/uploads/add_portfolio/". $add_id."/".$images[0]['image'];
                                        } else { 
                                        $item_image =   str_replace('/index.php','',base_url())."assets/images/product_dummy.jpeg";
                                        }
                                                
                                        $advertisement = $this->db->get_where('advertisement',array('add_id' => $add_id))->result_array();
                                        $user = $this->db->query('select * from users where id = '.$advertisement[0]['add_added_by_member'])->result_array();
                                        $system_name = "Foodequipemnts";
                                        $from = $email ? $email : "ajayrana@gmail.com";
                                        $email_sub = $advertisement[0]['add_title'];
                                        $msg = "Hi ".$name.", <br />";
                                        $msg .= $message."<br />";
                                        $msg .= "Original food equipments post:<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".base_url()."add/view/".$advertisement[0]['add_id']."'>".base_url()."add/view/".$advertisement[0]['add_id']."</a><br/>";
                                        $msg .= "<br /><br /><br /><br /><br /><br /><br /><center><a href=''>&copy; 2015 Food Equipments</a></center>";
                                        $this->email->from($fromemail, $system_name);
                                        $this->email->to($friend_email);
                                        $this->email->subject($email_sub);
                                        $this->email->message($msg);
                                        $this->email->send();
                                        if($send_copy == 1){
                                                $this->email->from($fromemail, $system_name);
                                                $this->email->to($email);
                                                $this->email->subject($email_sub);
                                                $this->email->message($msg);
                                                $this->email->send();
                                        }
        }
        
        public function send_message_from_compare(){
                                        $data['add_id'] = $this->input->post('add_id');
                                        $data['name'] = $this->input->post('name');
                                        $data['email'] = $this->input->post('email');
                                        $data['phone'] = $this->input->post('phone');
                                        $data['message'] = $this->input->post('message');
                                        $advertisement = $this->db->get_where('advertisement',array('add_id' => $data['add_id']))->result_array();
                                        $data['message_to'] = $advertisement[0]['add_added_by_member'];
                                        $system_name = "Foodequipemnts";
                                        $from = "ajayrana@gmail.com";
                                        $this->email->from($from, $system_name);
                                        $this->email->from($from, $system_name);
                                        $this->email->to($data['email']);
                                        $this->email->subject("You sent a message regarding ".$advertisement[0]['add_title']);
                                        $msg = "Message :<br><p>".$data['message']."</p><p>Your message was sent successfuly !</p>";
                                        $msg = $msg."Support Team,<br/>Food Equipments<br /><br /><br /><br /><br /><br /><br /><center><a href=''>&copy; 2015 Food Equipments</a></center>";
                                        $this->email->message($msg);
                                        $this->email->send();
                                        if(!empty($data['email']) && !empty($data['message'])){
                                        $this->db->insert('messages',$data);
                                        }
        }
        
        public function print_ad(){
                $id = $this->uri->segment(3);
                $data['advertisement'] = $this->db->get_where('advertisement',array('add_id' => $id))->result_array();
                $this->load->view('welcome/print.php',$data);
		
        }
        
        public function report_spam(){
                $data['email'] = $this->input->post('email');
                $data['message'] = $this->input->post('comments');
                $data['add_id'] = $this->input->post('add_id');
                if(!empty($data['email']) && !empty($data['message']) && !empty($data['add_id'])){
                $this->db->insert('spam_reports',$data);
                }
        }
        
        public function get_dealers(){
                            $radius = $this->input->post('radius');
			    $zip_code1 = $this->input->post('zipcode');
                            $page_num = $this->input->post('page_num');
                            $rows_per_page = $this->input->post('rows_per_page');
                            $sort = explode('-',$this->input->post('sort'));
                            $start = ((int)$page_num - 1) * (int)$rows_per_page;
                            $zip_code = $zip_code1 ? $zip_code1 : 'V6A 1R3';
                            $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($zip_code) . '&sensor=false');
                            $coordinates = json_decode($coordinates);
                            $lat = $coordinates->results[0]->geometry->location->lat;
                            $lon = $coordinates->results[0]->geometry->location->lng;
                            $data_zip['latitude'] = $lat;
                            $data_zip['longitude'] = $lon;
                            $data['main_marker'] = $data_zip;
                            $radius = $radius ? $radius : 50;
			    /* $sql = 'SELECT distinct(zip_code) FROM zipcodes  WHERE (3958*3.1415926*sqrt((latitude-'.$lat.')*(latitude-'.$lat.') + cos(latitude/57.29578)*cos('.$lat.'/57.29578)*(longitude-'.$lon.')*(longitude-'.$lon.'))/180) <= '.$radius.';';
                            $result = $this->db->query($sql)->result_array();
                            $zipcodeList = array();
                            foreach($result as $r)
                            {
				array_push($zipcodeList, "'".$r['zip_code']."'");
                            } */
                            $order_column = $sort[0];
                            $order_asc_or_desc = $sort[1];
                            //echo "select users.*, (3959 * acos(cos(radians('".$lat."')) * cos(radians(users.latitude)) * cos( radians(users.longitude) - radians('".$lon."')) + sin(radians('".$lat."')) * sin(radians(users.latitude)))) AS distance from users where (3958*3.1415926*sqrt((latitude-'".$lat."')*(latitude-'".$lat."') + cos(latitude/57.29578)*cos('".$lat."'/57.29578)*(longitude-'".$lon."')*(longitude-'".$lon."'))/180) <= '".$radius."' and user_type != 'admin'";
                            $data['dealers'] = $this->db->query("select users.*, (3959 * acos(cos(radians('".$lat."')) * cos(radians(users.latitude)) * cos( radians(users.longitude) - radians('".$lon."')) + sin(radians('".$lat."')) * sin(radians(users.latitude)))) AS distance from users where (3958*3.1415926*sqrt((latitude-'".$lat."')*(latitude-'".$lat."') + cos(latitude/57.29578)*cos('".$lat."'/57.29578)*(longitude-'".$lon."')*(longitude-'".$lon."'))/180) <= '".$radius."' and user_type != 'admin' and user_type = 'dealer' order by ".$order_column." ".$order_asc_or_desc." limit ".$start.",".$rows_per_page)->result_array();
                            $earthRadius = 6371000;
                            $i = 0;
                            foreach($data['dealers'] as $dealer){
                                    if(isset($_SESSION['user_id'])){
                                        $current_usr = $this->db->get_where('users',array('id' => $_SESSION['user_id']))->result_array(); 
                                        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$current_usr[0]['postal_code'];
                                     } else {
                                         $postal_from_latlng = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$_SESSION['client_lat'].",".$_SESSION['client_lon']."&sensor=true";
                                         $postal_get = file_get_contents($postal_from_latlng);
                                         $postal_get = json_decode($postal_get);
                                         //echo "<pre>";print_r($postal_get);echo "</pre>";
                                         $postal_get->results[0]->formatted_address;
                                         $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$postal_get->results[0]->formatted_address;
                                     }
                                    $url .="&destinations=".$add['add_postal_code']."&mode=driving";
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
                                       $data['dealers'][$i]['radius'] = round($dealer['distance'])." km away"; 
                                    } else {
                                        $data['dealers'][$i]['radius'] = round($distance_driv)." km away";
                                    }
                                    
                                   if(empty($dealer['image'])){
                                           $data['dealers'][$i]['image'] = 'user.jpeg';
                                   }
                                   $i++;
                           }
                           echo json_encode($data);
        }
        
        public function get_dealers_num_pages(){
                            $radius = $this->input->post('radius');
			    $zip_code1 = $this->input->post('zipcode');
                            $zip_code = $zip_code1 ? $zip_code1 : 'V6A 1R3';
                            $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($zip_code) . '&sensor=true');
                            $coordinates = json_decode($coordinates);
                            $lat = $coordinates->results[0]->geometry->location->lat;
                            $lon = $coordinates->results[0]->geometry->location->lng;
                            $data_zip['latitude'] = $lat;
                            $data_zip['longitude'] = $lon;
                            $data['main_marker'] = $data_zip;
                            $radius = $radius ? $radius : 50;
			    /*$sql = 'SELECT distinct(zip_code) FROM zipcodes  WHERE (3958*3.1415926*sqrt((latitude-'.$lat.')*(latitude-'.$lat.') + cos(latitude/57.29578)*cos('.$lat.'/57.29578)*(longitude-'.$lon.')*(longitude-'.$lon.'))/180) <= '.$radius.';';
                            $result = $this->db->query($sql)->result_array();
                            $zipcodeList = array();
                            foreach($result as $r)
                            {
				array_push($zipcodeList, "'".$r['zip_code']."'");
                            }*/
                            $data['dealers'] = $this->db->query("select users.*, (3959 * acos(cos(radians('".$lat."')) * cos(radians(users.latitude)) * cos( radians(users.longitude) - radians('".$lon."')) + sin(radians('".$lat."')) * sin(radians(users.latitude)))) AS distance from users where (3958*3.1415926*sqrt((latitude-'".$lat."')*(latitude-'".$lat."') + cos(latitude/57.29578)*cos('".$lat."'/57.29578)*(longitude-'".$lon."')*(longitude-'".$lon."'))/180) <= '".$radius."' and user_type != 'admin' and user_type = 'dealer'")->result_array();
                            echo count($data['dealers']);
        }
        
    
	
}
