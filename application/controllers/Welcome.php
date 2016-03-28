<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('test');
	}
	public function testFunction()
	{
		$string = '{"testString" : "value"}';
		echo $string;
	}
	public function Login()
	{
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$email = $request->email;
		$response = array();
		if($request->loggedVia == $request.LOGIN_VIA_APP)
		{
			
		}
		$response;
		//further authentication code here
		if($request->loggedVia == $request.LOGIN_VIA_FB)
		{
			
		}
		else if($request->loggedVia == $request.LOGIN_VIA_GOOGLE)
		{
		
		}
		$userId = $this->UserModel->getUserIdIfExists($request->email);			
		if($userId >0 ) //if user exists
		{
				header('success: true');
				$response['success'] = true;
				$response['userId'] = $userId;
		}
		else{
			//register the user
			$userId = $this->registerSocial($request);
			if($userId >0)
			{
				header('success: true');
				$response['success'] = true;
				$response['userId'] = $userId;
			}
			else 
			{
				header('success: false');
				$response['success'] = false;
			}
		}
			
		echo $response;
		
		//var_dump($username);
		$arrayName = array(	'success' => 'true',
							'username' => $username );
		$string = json_encode($arrayName);
		//var_dump($string);
		//echo $string;
	}
	private function registerSocial($request)
	{
		$data = array();
		$data['email'] = $request->email;
		if($request->loggedVia == $request.LOGIN_VIA_FB)
		{
			$data['fb_id'] = $request->socialId;
		}
		else if($request->loggedVia == $request.LOGIN_VIA_GOOGLE)
		{
			$data['google_id'] = $request->socialId;
		}
		$data['first_name'] = $request->firstName;
		$data['last_name'] = $request->last_name;
		if(isset($request->gender))
		{
			$data['gender'] = $request->gender;
		}
		//data object is built.
		//now create a datamodel and insert a row into it
		$this->load->model('UserModel');
		return $this->UserModel->insertUser($data);
		
		
		
	}
	public function LoginPartial()
	{
		$this->load->view('LoginPartial');
	}
	public function ChannelPartial()
	{
		$this->load->view('channel');
	}
	
	
	public function fbLogin()
	{
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$this->load->model('UserModel');
		var_dump($request);
		$this->UserModel->email = 'email';
		$this->UserModel->password = 'password';
		$this->UserModel->fb_id = 1234567;
		$this->UserModel->gender = 'M';
		echo 'sending insert command';
		$this->UserModel->insert();
		$userId =  $this->db->insert_id();
		echo $userId;
	}
}
