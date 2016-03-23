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
		$username = $request->username;
		//var_dump($username);
		$arrayName = array(	'success' => 'true',
							'username' => $username );
		$string = json_encode($arrayName);
		//var_dump($string);
		echo $string;
	}
	public function LoginPartial()
	{
		$this->load->view('LoginPartial');
	}
}
