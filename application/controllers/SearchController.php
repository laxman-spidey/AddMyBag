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
		$params = array();
		$params['searchModel'] = $this->SearchModel;
		$this->load->library('MatchFinder',$params);
		
		
		$response = array();
		
		$travels = $this->matchfinder->searchTravels($request->from,$request->to);
		if($travels != null)
		{
		    $response["success"] = "true";
		    $response['data'] = array();
		    $index = 0;
		    foreach($travels as $travel)
		    {
		        $response['data'][$index] = $this->buildResponse($travel);
		        $index++;
		    }
		    $response["count"] = $index;
		}
		else {
		    $response["success"] = "true";
		    $response["count"] = "0";
		}
		echo json_encode($response);
		
	}
	
	private function buildResponse($data)
	{
	    $response = array();
	    $response['postId'] = $data->post_id;
	    
	    $response['from'] = array();
	    $response['from']['formattedAddress'] = $data->fromAddress;
	    $response['from']['locationId'] = $data->fromId;
	    //$response['from']['distance'] = $data->distance;
	    
	    $response['to'] = array();
	    $response['to']['formattedAddress'] = $data->toAddress;
	    $response['to']['locationId'] = $data->toId;
	    //$response['to']['distance'] = $data->distance;
	    
	    $response['user'] = array();
	    $response['user']['user_id'] = $data->user_id;
	    $response['user']['firstName'] = $data->first_name;
	    $response['user']['lastName'] = $data->last_name;
	    //$response['user']['rating'] = $data->rating;
	    
	    $response['weight'] = $data->available_weight;
	    $response['price'] = $data->price_per_kg;
	    $response['comment'] = $data->comment;
	    
 	    return $response;
	}
}
?>