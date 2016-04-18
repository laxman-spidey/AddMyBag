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
        $fromId = insertLocation($fromPlace);
        $toId = insertLocation($toPlace);
        
        if(fromId == -1 || toId == -1) {
            return -1;
        } else {
            $travelPost->from_location = $fromId;
            $travelPost->toId = $toId;    
            $this->db->insert($TRAVEL_POST,$travelPost);
            echo 'inserted';
            return $this->db->insert_id();
        }
    }
    public function insertLocation($location)
    {
        
        $query = "INSERT INTO location (place_id,address,locality,sub_locality,administrative_area_level_2,administrative_area_level_1,country,latitude,longitude)";
        $query.= "VALUES ($location->place_id,$location->address,$location->sub_locality,$location->administrative_area_level_1,$location->administrative_area_level_2,$location->country,$location->latitude,$location->longitude)";
        $query.= "WHERE NOT EXISTS (SELECT location_id FROM location WHERE place_id = $location->place_id)";
        $inserted = $this->db->query($query);
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
    