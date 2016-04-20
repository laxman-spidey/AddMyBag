<?php
class TravelModel extends CI_Model {
    
    private $TRAVEL_POST = "travel_post";
    private $LOCATION = "location";
        
    public function __construct()
    {
        $this->load->database();
    }
    public function insert($travelPost, $fromPlace, $toPlace)
    {
        $fromId = $this->insertLocation($fromPlace);
        $toId = $this->insertLocation($toPlace);
        
        if($fromId == -1 || $toId == -1) {
            return -1;
        } else {
            $travelPost["from_location"] = $fromId;
            $travelPost["to_location"] = $toId;    
            $this->db->insert($this->TRAVEL_POST,$travelPost);
            return $this->db->insert_id();
        }
    }
    public function insertLocation($location)
    {
        
        $this->db->select('location_id')->from($this->LOCATION)->where('place_id',$location->placeId);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $locationId = $query->result();
        }
        else {
            $inserted = $this->db->insert($this->LOCATION,$location);
            if($inserted == true)
            {
                return $this->db->insert_id();    
            }
            else
            {
                return -1;
            }
        }
        
        /*
        ***************************
        * earlier code tried to add where condition to the insert query.
        ****************************
        //var_dump($location);
        $colums = "";
        $values = "";
        foreach ($location as $key => $value)
        {
            $this->db->set($key, $value);
            
        }
        //$this->db->where("NOT EXISTS (SELECT location_id FROM location WHERE place_id = $location->place_id");
        $inserted = $this->db->insert($this->LOCATION);
                    //->where("NOT EXISTS (SELECT location_id FROM location WHERE place_id = $location->place_id");
        //$query = "INSERT INTO location (place_id,address,locality,sub_locality,administrative_area_level_2,administrative_area_level_1,country,latitude,longitude)";
        //$query.= "VALUES ($location->place_id,$location->address,$location->sub_locality,$location->administrative_area_level_1,$location->administrative_area_level_2,$location->country,$location->latitude,$location->longitude)";
        //$query.= "WHERE NOT EXISTS (SELECT location_id FROM location WHERE place_id = $location->place_id)";
        //$inserted = $this->db->query($query);
        if($inserted == true)
        {
            return $this->db->insert_id();    
        }
        else
        {
            $this->db->select('location_id')->from($LOCATION)->where('place_id',$placeId);
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                return $locationId = $query->result();
            }
            else{
                return -1;
            }
        }
        */
    }
    
    public function checkIfTheLocationExists($placeId)
    {
        $this->db->select('location_id')->from($LOCATION)->where('place_id',$placeId);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $userid = $query->result();
        }
        else 
        {
            $userid = -1;
        }
        return $userid;
    }
}
?>
    