<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function account_opening_email($email = '')
	{
		
		
		$system_name = "Food Equipments";
		$email_msg		=	"Welcome to ".$system_name."<br />";
		$email_msg		.=	"Your account has been created !<br />";
		$email_msg		.=	"Your login password : ".$this->db->get_where('users' , array('u_email' => $email))->row()->u_password."<br />";
		$email_msg		.=	"Login Here : ".base_url()."<br />";
		$email_sub		=	"Congratulations! Welcome to Food Equipments family ";
		$email_to		=	$email;
		
		$this->do_email($email_msg , $email_sub , $email_to);
	}
	
	function send_search_notifications($add_id){
		$get_newly_posted_add = $this->db->get_where('advertisement',array('add_id'=>$add_id))->result_array();
		// search this add in saved searches table in database
		$query = 'select  DISTINCT (user_id) from save_search where ( UPPER(REPLACE(postal_code, " ", "")) = "'.strtoupper(str_replace(" ","",$get_newly_posted_add[0]['add_postal_code'])).'") and (term like "%'.$get_newly_posted_add[0]['add_title'].'%" or category like "%'.$get_newly_posted_add[0]['add_category'].'%") and (set_alert = "1")';
		
		$get_users = $this->db->query($query)->result_array();
		$email_sub = "You might be interested in the new add posted on Food Equipments";
		$msg = "A new advertisement is posted on Food Equipments that might be similar to your search.Please visit <a href='".base_url()."/add/view/".$add_id."'>here</a> <br />You have set an alert for the new products related to your requirements in the saved searches with US !";
		foreach($get_users as $user_id){
				$user = $this->db->query('select * from users where id = '.$user_id['user_id'])->result_array();
				$email_msg = "Hi, ".$user[0]['firstname']." ".$user[0]['lastname']."<br />".$msg;
				$this->do_email($email_msg , $email_sub , $user[0]['email']);
		}
		
	}
	
        function send_add_posted_notification($add_id){
		$get_newly_posted_add = $this->db->get_where('advertisement',array('add_id'=>$add_id))->result_array();
                $get_newly_posted_add_cat = $this->db->get_where('categories',array('c_id'=>$get_newly_posted_add[0]['add_category']))->result_array();
                $user = $this->db->query('select * from users where id = '.$get_newly_posted_add[0]['add_added_by_member'])->result_array();
		
		$email_sub = 'Food Equipments post '.$get_newly_posted_add[0]['add_id'].': "'.$get_newly_posted_add_cat[0]['c_title'].'"';
		$msg = "Posting ID #".$get_newly_posted_add[0]['add_id'].": <br/>";
                $msg .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"'.$get_newly_posted_add_cat[0]['c_title'].'"&nbsp;'.$get_newly_posted_add[0]['add_dealer_type'].'<br/>';
                $msg .= 'Should now be viewing at following URL: <br/>';
                $msg .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".base_url()."/add/view/".$add_id."'>".base_url()."/add/view/".$add_id."</a><br/>";
                $msg .= "Inbox pages and search results are updated every 15 minutes. <br />";
                $msg .= "To edit or delete your ad, please visit the following URL: <br />";
                $msg .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".base_url()."/members/dashboard/'>".base_url()."/members/dashboard/</a><br/>";
               
		
		$this->do_email($msg , $email_sub , $user[0]['email']);
		
	}
        
        
	function password_reset_email($email = '')
	{
		$query			=	$this->db->get_where('users' , array('u_email' => $email));
		if($query->num_rows() > 0)
		{
			$password	=	$query->row()->u_password;
			$system_name    = "Food Equipments";
			$email_msg	=	"Welcome to ".$system_name."<br />";
			$email_msg	.=	"Your password is : ".$password."<br />";
			$email_sub	=	"Password reset request!";
			$email_to	=	$email;
			$this->do_email($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{	
			return false;
		}
	}
	
	/***custom email sender****/
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL)
	{
		
		$config = array();
        $config['useragent']	= "Organisations";
        $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']		= "smtp";
        $config['smtp_host']	= "localhost";
        $config['smtp_port']	= "25";
        $config['mailtype']		= 'html';
        $config['charset']		= 'utf-8';
        $config['newline']		= "\r\n";
        $config['wordwrap']		= TRUE;

        $this->load->library('email');

        $this->email->initialize($config);

		$system_name = "Food Equipments";
		$from = "ajayrana@gmail.com";
		$this->email->from($from, $system_name);
		$this->email->from($from, $system_name);
		$this->email->to($to);
		$this->email->subject($sub);
		$msg	=	$msg."<br /><br />Support Team,<br />Food Equipments<br /><br /><br /><br /><br /><br /><br /><center><a href=''>&copy; 2015 Food Equipments</a></center>";
		$this->email->message($msg);
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
}

