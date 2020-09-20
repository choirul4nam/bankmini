<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
   function cek_login_user() {	
   		$ci = get_instance();   
		if(! $ci->session->userdata('login')){
		  	redirect('login');
		}	  	   
	}   