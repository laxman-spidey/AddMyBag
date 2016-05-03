<?php
/**
 * Module : Search
 * 
 */
class MatchFinder
{
    private $searchModel;
    private $fromLocations;
    private $toLocations;
    /**
     * this class requires few models to get data from database
     */
    public function __construct($searchModel)
    {
        $this->searchModel = $searchModel;
    }
    public function getLocations($from, $to)
    {
        $this->fromLocations = $this->searchModel->getLocations($from->locality);
        $this->toLocations = $this->searchModel->getLocations($to->locality);
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
    
    public function searchRequests($from, $to)
    {
        $success = $this->getLocations($from,$to);
        if($success == true)
        {
            $requests = $this->searchModel->getRequestsWith($this->fromLocations,$this->toLocations);
            if(requests != null)
            {
                return $requests;
            }
            else
            {
                
            }
        }
    }
    
    public function searchTravels($from, $to)
    {
        $success = $this->getLocations($from,$to);
        if($success == true)
        {
            $travels = $this->searchModel->getTravelsWith($this->fromLocations,$this->toLocations);
            if(requests != null)
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