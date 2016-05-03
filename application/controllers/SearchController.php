<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchController extends CI_Controller {
    
    public function searchTravels()
	{
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$from = $request->from;
		$to = $request->to;
		
		$this->load->model('SearchModel');
		$this->load->library('MatchFinder',$this->SearchModel);
		
		
		$response = array();
		
		$travels = $this->MatchFinder->searchTravels($request->from,$request->to);
		if($travels != null)
		{
		    
		}
		else {
		    $response["success"] = "true";
		    $response["count"] = "0";
		}
		
	}
	
	private function buildTravelResponse($response)
	{
	    $travel = array();
	    
	    return $travel;
	}
}
?>