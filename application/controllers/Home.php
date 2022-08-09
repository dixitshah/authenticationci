<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function login()
	{
		$userobj = $this->session->userdata('userobj');
		if(isset($userobj) && !empty($userobj)){
			return redirect('/home');

		}else{

			$this->load->view('index');
		}
	}

	public function homepage()
	{
		
		$userobj = $this->session->userdata('userobj');
        

			$phonenumber = $userobj[0]->phonenumber;
			$filename = $this->myclass->select_data('*','file'," `usernumber` = '$phonenumber'");
			
			$this->load->view('home',['filelist'=>$filename]);

	}

	
	public function newregister()
	{
		$userobj = $this->session->userdata('userobj');
        $typeuser = $userobj[0]->typeuser;
        if(isset($userobj) && !empty($userobj) && $typeuser == 1){

        	$this->load->view('newregister');
        }
        else
        {
        	return redirect('/home');
        }
	}

}
