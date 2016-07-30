<?php
defined('BASEPATH') OR exit('No direct script access allowed');


	/**
	 * 
	 * class:Search
	 * description : search the items on the website 
	 * parameter : none	
	 *	
	 */


	
	
class Search extends CI_Controller {

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
		$this->load->model('search_model');
		$this->load->library("pagination");
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
   	 }

	/**
	 * 
	 * function: results
	 * description : display results from a search
	 * parameter : all the data posted from search form	
	 *	
	 */
	
	
	
	public function results()
	{
		if($this->input->get('find') || $this->uri->segment(3)){
			$_POST['category'] = ($this->input->get('category')) ? $this->input->get('category') : '';
			$_POST['max_price'] = ($this->input->get('max_price')) ? $this->input->get('max_price') : '0';
                        $_POST['max_price'] = ($this->input->get('min_price')) ? $this->input->get('min_price') : '1';
			$data['post_data'] = $_GET;
                        if($data['post_data']['min_price'] == "0"){
                        $data['post_data']['min_price'] = "1";
                        }
			$config = array();
			$config["base_url"] = base_url() . "search/results/";
			$rowss = $this->search_model->get_results_count_from_home_form_bt_display($_GET);
			$config["total_rows"] = $rowss[0]['count'];
			$config["per_page"] = ($this->input->get('per_page')) ? $this->input->get('per_page') : '25';
			$data['total_results'] = $rowss[0]['count'];
			$data['per_page'] = $config["per_page"];
			$config['num_links'] = 8;
			$this->pagination->initialize($config);
			$page = ($this->input->get('page')) ? $this->input->get('page') : 0;
			$data['advertisements'] = $this->search_model->get_results_from_home_form($_GET,$config["per_page"],$page,$this->input->get('order')); 
			
                        
                        $i = 0;
                        foreach($data['advertisements'] as $advertisements){
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
                            $url .="&destinations=".$advertisements['add_postal_code']."&mode=driving";
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
                                   $data['advertisements'][$i]['distance'] = round($advertisements['distance'] * 1.6)." km away"; 
                            } else {
                                    $data['advertisements'][$i]['distance'] = round($distance_driv * 1.6)." km away";
                            }
                            $i++;
                        }
                        
                        $count_results = count($data['advertisements']);
			if($config["total_rows"] < 1){
				$data['matching_results'] = 'no_results';
			} else {
			$data['matching_results'] = 'matching';
			}
			$data['results_on_page'] = 	count($data['advertisements']);
                        $data['this_page_number'] = $this->pagination->cur_page;
			$data["links"] = $this->pagination->create_links();
                        $zip_code1 = $this->input->get('postal_code');
                        $zip_code = $zip_code1 ? $zip_code1 : 'V6A 1R3';
                        $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($zip_code) . '&sensor=true');
                        $coordinates = json_decode($coordinates);
                        //echo "<pre>";print_r($coordinates);echo "</pre>";
                        $data['place_details'] = @$coordinates->results[0]->formatted_address;
		}
		$data['title'] = "Foodequipments: Search Results";
		$data['categories'] = $this->db->query('select * from categories order by c_id DESC')->result_array();
		$data['post_data'] = $_GET;
		$data['slider_images'] = $this->db->get('slider_images')->result_array();
		$this->load->view('header.php',$data);
		$this->load->view('search/search.php',$data);
		$this->load->view('footer.php');
                	
	}

	public function count_results()
	{
		
		 $count_it = $this->search_model->get_results_count_from_home_form_bt_display($_POST);
		echo "Search(".$count_it[0]['count'].")"; 
		
	}
	


	
}
