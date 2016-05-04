<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Module : Search
 * 
 */
class MatchFinder
{
    var $searchModel;
    var $googleLocation;
    var $fromLocations;
    var $toLocations;
    /**
     * this class requires few models to get data from database
     */
    public function __construct($params)
    {
        $this->searchModel = $params['searchModel'];
        $this->googleLocation = $params['googlelocation'];
    }
    public function getLocations($from, $to)
    {
        $this->fromLocations = $this->searchModel->getLocations($from->locality);
        $this->toLocations = $this->searchModel->getLocations($to->locality);
        //var_dump($this->fromLocations);
        
        if($this->fromLocations != null && $this->toLocations != null)
        {
            return true;
        }
        else 
        {
            if($this->fromLocations == null )
            {
                
            }
            else
            {
                
            }
        }
    }
    
    public function searchRequests($from, $to, $weight=0)
    {
        $success = $this->getLocations($from,$to);
        if($success == true)
        {
            $requests = $this->searchModel->getRequestsWith($this->fromLocations,$this->toLocations,$weight);
            if(requests != null)
            {
                return $requests;
            }
            else
            {
                
            }
        }
    }
    
    public function searchTravels($from, $to, $weight=0)
    {
        $success = $this->getLocations($from,$to);
        if($success == true)
        {
            $travels = $this->searchModel->getTravelsWith($this->fromLocations,$this->toLocations,$weight);
            if($travels != null)
            {
                return $travels;
            }
            else
            {
                
            }
        }
    }
}
?>