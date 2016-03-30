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
		$this->load->model('UserModel');
		$response = array();
		$userId = $this->UserModel->getUserIdIfExists($request->email);			
		if($request->loggedVia == $request->LOGIN_VIA_APP)
		{
			if($userId > 0)
			{
				$userId = $this->UserModel->authenticateAppUser($request->email,$request->password);
				if($userId > 0)
				{
					$response['success'] = true;
					$response['userId'] = $userId;
					$response['responseCode'] = $request->responseCode->LOGIN_SUCCESS;	
				}
				else {
					$response['success'] = false;
					$response['responseCode'] = $request->responseCode->WRONG_PASSWORD;	
				}
			}
			else {
				$response['success'] = false;
				$response['responseCode'] = $request->responseCode->EMAIL_DOES_NOT_EXISTS;
			}
		}
		
		
		//further authentication code here
		else if($request->loggedVia == $request->LOGIN_VIA_FB)
		{
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
			
		}
		else if($request->loggedVia == $request->LOGIN_VIA_GOOGLE)
		{
		
		}
		
		echo json_encode($response);
		
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
		return $this->UserModel->insertUser($data);
		
		
		
	}
	public function register()
	{
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$this->load->model('UserModel');
		$response = array();
		$data = array();
		$userId = $this->UserModel->getUserIdIfExists($request->email);			
		if($userId > -1)
		{
			$response['responseCode'] = $request->responseCode->EMAIL_ALREADY_TAKEN;
		}
		else {
			$data['first_name'] = $request->firstName;
			$data['last_name'] = $request->lastName;
			$data['email'] = $request->email;
			$data['password'] = $request->password;
			if(isset($request->phoneNumber) && $request->phoneNumber == '')
			{
				$data['phone'] == $request->phoneNumber;
			}
			if(isset($request->gender) && $request->gender == '')
			{
				$data['gender'] == $request->gender;
			}
			$userId = $this->UserModel->insertUser($data);
			$response['userId'] = $userId;
			$response['responseCode'] = $request->responseCode.REGISTER_SUCCESS;
		}
		echo json_encode($response);
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
