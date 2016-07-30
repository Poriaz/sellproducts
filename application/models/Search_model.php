<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function get_results_from_home_form($data = array(),$per_page=null,$page=null,$order_by = 'add_price-asc')
	{
		$data = array_map('trim', $data);
		$ordr = explode('-',$data['order']);
                if($ordr[0] == 'distance'){
                  $order_column = $ordr[0];  
                } else {
                $order_column = "advertisement.".$ordr[0];
                }
                $order_type = $ordr[1];
                if(!isset($data['dealer_type'])){
                    $data['dealer_type'] = "";
                }
                if(!isset($data['dealer_type1'])){
                    $data['dealer_type1'] = "";
                }
                if(!isset($data['used_type1'])){
                    $data['used_type1'] = "";
                }
                if(!isset($data['used_type'])){
                    $data['used_type'] = "";
                }
                if(!isset($data['postal_code'])){
                    $data['postal_code'] = '';
                }
                if(!isset($data['category']) || ($data['category'] == 'cat')){
                    $data['category'] = "";
                 }
                if(!isset($data['radius'])){
                    $data['radius'] = '';
                }
                if(!isset($data['max_price'])){
                    $data['max_price'] = "";
                }
                if(!isset($data['min_price'])){
                    $data['min_price'] = "";
                }
                $distance = $data['radius'];
                /*if($distance == '5000'){
                    $data['postal_code'] = "";
                }*/
		$zip_code1 = $data['postal_code'];
		$zip_code = $zip_code1 ? $zip_code1 : 'V6A 1R3';
                $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($zip_code) . '&sensor=false');
                $coordinates = json_decode($coordinates);
                $latitude = @$coordinates->results[0]->geometry->location->lat;
                $longitude = @$coordinates->results[0]->geometry->location->lng;
                if(!isset($latitude) || empty($latitude) ||!isset($longitude) || empty($longitude) ){
			$latitude = $_SESSION['client_lat'];
			$longitude = $_SESSION['client_lon'];
		} 
		if($data['category'] == 'cat'){
                    $data['category'] = "";
		}
                $data['postal_code'] = ""; 
		$query = "select advertisement.*, (3959 * acos(cos(radians('".$latitude."')) * cos(radians(advertisement.latitude)) * cos( radians(advertisement.longitude) - radians('".$longitude."')) + sin(radians('".$latitude."')) * sin(radians(advertisement.latitude)))) AS distance from advertisement LEFT JOIN zipcodes on zipcodes.zip_code = advertisement.add_postal_code";		
		if(!empty($data['term']) || !empty($data['postal_code']) || !empty($data['category']) || !empty($data['min_price']) || !empty($data['max_price']) || !empty($data['used_type']) || !empty($data['dealer_type'])){
		$query .= " where ";
		}	
		if(!empty($data['term'])){
		$query .= "(advertisement.add_title like '%".$data['term']."%' or advertisement.add_description like '%".$data['term']."%')";
		}
		if(empty($data['term'])){
		$query .= "";
		}
		
		if(!empty($data['term']) && !empty($data['postal_code'])){
		$query .= " and advertisement.add_postal_code = '".$data['postal_code']."'";
		} 
		else if(empty($data['term']) && !empty($data['postal_code'])){
			$query .= " advertisement.add_postal_code = '".$data['postal_code']."'";
		} else {
			
		}
		
		if(!empty($data['term']) && !empty($data['postal_code']) && !empty($data['category'])){
		$query .= " and advertisement.add_category = ".$data['category'];
		} else if(empty($data['term']) && !empty($data['postal_code']) && !empty($data['category'])){
		$query .= " and advertisement.add_category = ".$data['category'];	
		} else if(!empty($data['term']) && empty($data['postal_code']) && !empty($data['category'])){
		$query .= " and advertisement.add_category = ".$data['category'];	
		} else if(empty($data['term']) && empty($data['postal_code']) && !empty($data['category'])){
		$query .= " advertisement.add_category = ".$data['category'];	
		} else {
			
		}
		
		if(!empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price'])){ 
		$query .= " and advertisement.add_price > ".$data['min_price'];
		} else if(empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price'])){
		$query .= " and advertisement.add_price > ".$data['min_price'];
		} else if(!empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price'])){
		$query .= " and advertisement.add_price > ".$data['min_price'];	
		} else if(empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && !empty($data['term'])){
		$query .= " and advertisement.add_price > ".$data['min_price'];		
		} else if(empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && empty($data['term'])){
                $query .= " advertisement.add_price > ".$data['min_price'];    
                }
		
		if(!empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];
		} else if(empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(!empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(!empty($data['postal_code']) && !empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(!empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(empty($data['postal_code']) && !empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " advertisement.add_price < ".$data['max_price'];	
		} else {
			
		}
		
		if((!empty($data['used_type']) || !empty($data['used_type1'])) && ((!empty($data['term']) || !empty($data['postal_code']) || !empty($data['category']) || !empty($data['min_price']) || !empty($data['max_price'])))){
		$query .= " and (advertisement.add_used_type = '".$data['used_type']."' or advertisement.add_used_type='".$data['used_type1']."')";
		} 
                if((!empty($data['used_type']) || !empty($data['used_type1'])) && (empty($data['term']) && empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && empty($data['max_price']))){
		$query .= " (advertisement.add_used_type = '".$data['used_type']."' or advertisement.add_used_type='".$data['used_type1']."')";
		} 
                if((!empty($data['dealer_type']) || !empty($data['dealer_type1'])) && empty($data['used_type']) && empty($data['used_type1']) && empty($data['term']) && empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && empty($data['max_price'])){
                    $query .= " (advertisement.add_dealer_type = '".$data['dealer_type']."' or advertisement.add_dealer_type='".$data['dealer_type1']."')";
		} 
                if((!empty($data['dealer_type'])|| !empty($data['dealer_type1'])) && (!empty($data['used_type']) || !empty($data['used_type1'])  || (!empty($data['term']) || !empty($data['postal_code']) || !empty($data['category']) || !empty($data['min_price']) || !empty($data['max_price'])))) {
                     $query .= " and (advertisement.add_dealer_type = '".$data['dealer_type']."' or advertisement.add_dealer_type='".$data['dealer_type1']."')";
                }
                if(empty($data['term']) && empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && empty($data['max_price']) && empty($data['dealer_type']) && empty($data['dealer_type1']) && empty($data['used_type']) && empty($data['used_type1'])){
                    $query .= ' where (advertisement.status = "active" or advertisement.status = "renewed") and advertisement.post_status = "published"';
                } else {
                $query .= ' and (advertisement.status = "active" or advertisement.status = "renewed") and advertisement.post_status = "published"';
                }
                if($distance == '5000' || $distance == ''){
                 
                } else {
                $query .= " AND (((acos(sin((".$latitude."*pi()/180)) * sin((`advertisement`.`latitude`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`advertisement`.`latitude`*pi()/180)) * cos(((".$longitude."- `advertisement`.`longitude`)* 
            pi()/180))))*180/pi())*60*1.1515)  <= ".$distance;
                }
		if($page == 1){
			$page = 0;
		}
		if(is_numeric($order_by)){
		$query .= " order by advertisement.add_price asc limit ".$page.",".$per_page;
		} else {
		$query .= " order by ".$order_column." ".$order_type." limit ".$page.",".$per_page;
		}
		
		$result = $this->db->query($query)->result_array();
		
		return $result;
		
	}
	
	function get_results_count_from_home_form($data = array())
	{
                $data = array_map('trim', $data);
                if(array_key_exists('postal_code',$data) == false){
                                   $data['postal_code'] = '';
                }
		if($data['category'] == 'cat' || !isset($data['category'])){
					$data['category'] = "";
				}
		if($data['max_price'] == 'price'){
					$data['max_price'] = "";
		}
                if(!isset($data['dealer_type'])){
                    $data['dealer_type'] = "";
                }
                if(!isset($data['dealer_type1'])){
                    $data['dealer_type1'] = "";
                }
                if(!isset($data['used_type1'])){
                    $data['used_type1'] = "";
                }
                if(!isset($data['used_type'])){
                    $data['used_type'] = "";
                }
                 if(!isset($data['category'])){
                    $data['category'] = "";
                 }
                 if(!isset($data['radius'])){
                    $data['radius'] = '';
                }
                 if(!isset($data['max_price'])){
                    $data['max_price'] = "";
                }
		$zip_code1 = $data['postal_code'];
		$zip_code = $zip_code1 ? $zip_code1 : 'V6A 1R3';
                $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($zip_code) . '&sensor=true');
                $coordinates = json_decode($coordinates);
                $latitude = @$coordinates->results[0]->geometry->location->lat;
                $longitude = @$coordinates->results[0]->geometry->location->lng;
                if(!isset($latitude) || empty($latitude) ||!isset($longitude) || empty($longitude) ){
			$latitude = $_SESSION['client_lat'];
			$longitude = $_SESSION['client_lon'];
		}
		if($data['category'] == 'cat'){
                    $data['category'] = "";
		}
		$data['postal_code'] = ""; 		
		$query = "select advertisement.*, (3959 * acos(cos(radians('".$latitude."')) * cos(radians(advertisement.latitude)) * cos( radians(advertisement.longitude) - radians('".$longitude."')) + sin(radians('".$latitude."')) * sin(radians(advertisement.latitude)))) AS distance from advertisement LEFT JOIN zipcodes on zipcodes.zip_code = advertisement.add_postal_code";	
		if(!empty($data['term']) || !empty($data['postal_code']) || !empty($data['category']) || !empty($data['min_price']) || !empty($data['max_price']) || !empty($data['used_type']) || !empty($data['dealer_type'])){
		$query .= " where ";
		}	
		if(!empty($data['term'])){
		$query .= "(advertisement.add_title like '%".$data['term']."%' or advertisement.add_description like '%".$data['term']."%')";
		}
		if(empty($data['term'])){
		$query .= "";
		}
		if(!empty($data['term']) && !empty($data['postal_code'])){
		$query .= " and advertisement.add_postal_code = '".$data['postal_code']."'";
		} 
		else if(empty($data['term']) && !empty($data['postal_code'])){
			$query .= " advertisement.add_postal_code = '".$data['postal_code']."'";
		} else {
			
		}
		
		if(!empty($data['term']) && !empty($data['postal_code']) && !empty($data['category'])){
		$query .= " and advertisement.add_category = ".$data['category'];
		} else if(empty($data['term']) && !empty($data['postal_code']) && !empty($data['category'])){
		$query .= " and advertisement.add_category = ".$data['category'];	
		} else if(!empty($data['term']) && empty($data['postal_code']) && !empty($data['category'])){
		$query .= " and advertisement.add_category = ".$data['category'];	
		} else if(empty($data['term']) && empty($data['postal_code']) && !empty($data['category'])){
		$query .= " advertisement.add_category = ".$data['category'];	
		} else {
			
		}
		
		if(!empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price'])){ 
		$query .= " and advertisement.add_price > ".$data['min_price'];
		} else if(empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price'])){
		$query .= " and advertisement.add_price > ".$data['min_price'];
		} else if(!empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price'])){
		$query .= " and advertisement.add_price > ".$data['min_price'];	
		} else if(empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && !empty($data['term'])){
		$query .= " and advertisement.add_price > ".$data['min_price'];		
		} else if(empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && empty($data['term'])){
                $query .= " advertisement.add_price > ".$data['min_price'];    
                }
		
		if(!empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];
		} else if(empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(!empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(!empty($data['postal_code']) && !empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(!empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(empty($data['postal_code']) && !empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " advertisement.add_price < ".$data['max_price'];	
		} else {
			
		}
		if(!empty($data['used_type'])){
		$query .= " and advertisement.add_used_type = '".$data['used_type']."'";
		}
		if(!empty($data['dealer_type'])){
		$query .= " and advertisement.add_dealer_type = '".$data['dealer_type']."'";
		}
                if(empty($data['term']) && empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && empty($data['max_price']) && empty($data['dealer_type']) && empty($data['dealer_type1']) && empty($data['used_type']) && empty($data['used_type1'])){
                    $query .= ' where (advertisement.status = "active" or advertisement.status = "renewed") and advertisement.post_status = "published"';
                } else {
                $query .= ' and (advertisement.status = "active" or advertisement.status = "renewed") and advertisement.post_status = "published"';
                }
                if($distance == '5000' || $distance == ''){
                 
                } else {
                $query .= " AND (((acos(sin((".$latitude."*pi()/180)) * sin((`advertisement`.`latitude`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`advertisement`.`latitude`*pi()/180)) * cos(((".$longitude."- `advertisement`.`longitude`)* 
            pi()/180))))*180/pi())*60*1.1515)  <= ".$distance;
                }
		$result = $this->db->query($query)->result_array();
		$count_results = $result[0]['count'];
		if($count_results < 1){
		$result = $this->db->query("select count(*) as count from advertisement")->result_array();	
		}
		
		return $result;
		
	}
	
	function get_results_count_from_home_form_bt_display($data = array()){
			
                $data = array_map('trim', $data);
                                
                if(!isset($data['postal_code'])){
                        $data['postal_code'] = '';
                }
                if(!isset($data['radius'])){
                        $data['radius'] = '';
                }
                if(!isset($data['max_price'])){
                        $data['max_price'] = "";
                }
		if($data['category'] == 'cat'){
			$data['category'] = "";
		}
		if($data['max_price'] == 'price'){
			$data['max_price'] = "";
		}
                if(!isset($data['max_price'])){
                        $data['max_price'] = "";
                }
                if(!isset($data['term'])){
                        $data['term'] = "";
                }
                if(!isset($data['min_price'])){
                        $data['min_price'] = "";
                }
                $distance = $data['radius'];
                if($distance == '5000'){
                        $data['postal_code'] = "";
                }
                if(!isset($data['dealer_type'])){
                        $data['dealer_type'] = "";
                }
                if(!isset($data['dealer_type1'])){
                        $data['dealer_type1'] = "";
                }
                if(!isset($data['used_type1'])){
                        $data['used_type1'] = "";
                }
                if(!isset($data['used_type'])){
                        $data['used_type'] = "";
                }
                
		$zip_code1 = $data['postal_code'];
		$zip_code = $zip_code1 ? $zip_code1 : 'V6A 1R3';
                $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($zip_code) . '&sensor=true');
                $coordinates = json_decode($coordinates);
                $latitude = @$coordinates->results[0]->geometry->location->lat;
                $longitude = @$coordinates->results[0]->geometry->location->lng;
                if(!isset($latitude) || empty($latitude) ||!isset($longitude) || empty($longitude) ){
			$latitude = $_SESSION['client_lat'];
			$longitude = $_SESSION['client_lon'];
		}
                $data['postal_code'] = "";          
                $query = "select count(*) as count from advertisement LEFT JOIN zipcodes on zipcodes.zip_code = advertisement.add_postal_code";	
		if(!empty($data['term']) || !empty($data['postal_code']) || !empty($data['category']) || !empty($data['min_price']) || !empty($data['max_price']) || !empty($data['used_type']) || !empty($data['dealer_type']) || !empty($data['used_type1']) || !empty($data['dealer_type1'])){
		$query .= " where ";
		}	
		if(!empty($data['term'])){
		$query .= "(advertisement.add_title like '%".$data['term']."%' or advertisement.add_description like '%".$data['term']."%')";
		}
		if(empty($data['term'])){
		$query .= "";
		}
		if(!empty($data['term']) && !empty($data['postal_code'])){
		$query .= " and advertisement.add_postal_code = '".$data['postal_code']."'";
		} 
		else if(empty($data['term']) && !empty($data['postal_code'])){
			$query .= " advertisement.add_postal_code = '".$data['postal_code']."'";
		} else {
			
		}
		
		if(!empty($data['term']) && !empty($data['postal_code']) && !empty($data['category'])){
                    
		$query .= " and advertisement.add_category = ".$data['category'];
		} else if(empty($data['term']) && !empty($data['postal_code']) && !empty($data['category'])){
                    
		$query .= " and advertisement.add_category = ".$data['category'];	
		} else if(!empty($data['term']) && empty($data['postal_code']) && !empty($data['category'])){
                    
		$query .= " and advertisement.add_category = ".$data['category'];	
		} else if(empty($data['term']) && empty($data['postal_code']) && !empty($data['category'])){
                   
		$query .= " advertisement.add_category = ".$data['category'];	
		} else {
                    
		}
               
		if(!empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price'])){ 
		$query .= " and advertisement.add_price > ".$data['min_price'];
		} else if(empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price'])){
		$query .= " and advertisement.add_price > ".$data['min_price'];
		} else if(!empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price'])){
		$query .= " and advertisement.add_price > ".$data['min_price'];	
		} else if(empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && !empty($data['term'])){
		$query .= " and advertisement.add_price > ".$data['min_price'];		
		} else if(empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && empty($data['term'])){
                $query .= " advertisement.add_price > ".$data['min_price'];    
                } 
		
		if(!empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];
		} else if(empty($data['postal_code']) && !empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(!empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(!empty($data['postal_code']) && !empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(empty($data['postal_code']) && empty($data['category']) && !empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and advertisement.add_price < ".$data['max_price'];	
		} else if(!empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and add_price < ".$data['max_price'];	
		} else if(empty($data['postal_code']) && !empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " and add_price < ".$data['max_price'];	
		} else if(empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && !empty($data['max_price'])){
		$query .= " advertisement.add_price < ".$data['max_price'];	
		} else {
			
		}
		if((!empty($data['used_type']) || !empty($data['used_type1'])) && ((!empty($data['term']) || !empty($data['postal_code']) || !empty($data['category']) || !empty($data['min_price']) || !empty($data['max_price'])))){
		$query .= " and (advertisement.add_used_type = '".$data['used_type']."' or advertisement.add_used_type='".$data['used_type1']."')";
		} 
                if((!empty($data['used_type']) || !empty($data['used_type1'])) && (empty($data['term']) && empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && empty($data['max_price']))){
		$query .= " (advertisement.add_used_type = '".$data['used_type']."' or advertisement.add_used_type='".$data['used_type1']."')";
		} 
                if((!empty($data['dealer_type']) || !empty($data['dealer_type1'])) && empty($data['used_type'])  && empty($data['used_type1']) && empty($data['term']) && empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && empty($data['max_price'])){
                    $query .= " (advertisement.add_dealer_type = '".$data['dealer_type']."' or advertisement.add_dealer_type='".$data['dealer_type1']."')";
		} 
                if((!empty($data['dealer_type'])|| !empty($data['dealer_type1'])) && (!empty($data['used_type']) || !empty($data['used_type1'])  || (!empty($data['term']) || !empty($data['postal_code']) || !empty($data['category']) || !empty($data['min_price']) || !empty($data['max_price'])))) {
                     $query .= " and (advertisement.add_dealer_type = '".$data['dealer_type']."' or advertisement.add_dealer_type='".$data['dealer_type1']."')";
                }
                if(empty($data['term']) && empty($data['postal_code']) && empty($data['category']) && empty($data['min_price']) && empty($data['max_price']) && empty($data['dealer_type']) && empty($data['dealer_type1']) && empty($data['used_type']) && empty($data['used_type1'])){
                    $query .= ' where (advertisement.status = "active" or advertisement.status = "renewed") and advertisement.post_status = "published"';
                } else {
                $query .= ' and (advertisement.status = "active" or advertisement.status = "renewed") and advertisement.post_status = "published"';
                }
                if($distance == '5000' || $distance == ''){
                 
                } else {
                $query .= " AND (((acos(sin((".$latitude."*pi()/180)) * sin((`advertisement`.`latitude`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`advertisement`.`latitude`*pi()/180)) * cos(((".$longitude."- `advertisement`.`longitude`)* 
            pi()/180))))*180/pi())*60*1.1515)  <= ".$distance;
                  
                }
                $result = $this->db->query($query)->result_array();
		$count_results = $result[0]['count'];
		
		return $result;
		
	}
}

