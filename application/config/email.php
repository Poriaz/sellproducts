<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/
/*$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
$config['smtp_port'] = 25;
$config['smtp_user'] = 'testing.iws0306';
$config['smtp_pass'] = 'developer#!ws0306'; */
$config['mailtype'] = 'html';
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";

/* End of file email.php */
/* Location: ./application/config/email.php */
