<?php
class TransactionModel extends CI_Model {
    private $TRAVEL_POST = "travel_post";
    private $ADD_REQUEST = "add_request";
    private $LOCATION = "location";
    private $USER = "user";
    
    public function getLocations($locality)
    {
        $this->db->select('location_id')->from($LOCATION)->where('locality',$locality);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result;
        }
        else {
            
        }
    }
    
    public function getLocations($lat, $lng, $country)
    {
        /**
        *   Source: https://developers.google.com/maps/articles/phpsqlsearch_v3?csw=1#finding-locations-with-mysql        
        *   SELECT location_id, ( 3959 * acos( cos( radians(17.39300) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(78.47300) ) + sin( radians(17.39300) ) * sin( radians( lat ) ) ) ) AS distance FROM location HAVING distance < 45 ORDER BY distance LIMIT 0 , 20;
        *   To search by kilometers instead of miles, replace 3959 with 6371.
        *
        **/
        
        $this->db->select(" location_id, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance ")
            ->from($LOCATION)
            ->having('distance < 25') 
            ->order_by('distance')
            ->limit('0 , 20');
        $query = $this->gdb->get();
        if($query->num_rows() > 0)
        {
            return $query->result;
        }
        else {
            return null;
        }
    }
    
    public function getTravelsWith($fromIds,$toIds, $weight)
    {
        /**
         * 
         * SELECT   T.post_id, T.available_weight, T.price_per_kg, T.comment,
         *          U.user_id, U.first_name, U.last_name,
         *          from.location_id, from.formatted_address,
         *          to.location_id, to.formatted_address
         * FROM     travel_post T
         * JOIN     user U          ON U.user_id = T.user_id
         * JOIN     location from   ON from.location_id = T.from_location
         * JOIN     location to     ON to.location_id   = T.to_location
         * 
         * WHERE    T.available_weight >= $weight
         * AND      T.from_location IN ($fromIds)
         * AND      T.to_location   IN ($toIds)
         * 
         */ 
        $this->db->select('T.post_id,T.available_weight,T.price_per_kg,T.comment,U.user_id,U.first_name,U.last_name,from.location_id,from.formatted_address,to.location_id,to.formatted_address')
            ->from($TRAVEL_POST." T")
            ->join($USER." U", "U.user_id = T.user_id")
            ->join($LOCATION." from","T.from_location = from.location_id")
            ->join($LOCATION." to","T.to_location = to.location_id")
            ->where("available_weight >=","$weight")
            ->where_in('from',$fromIds)
            ->where_in('to',$toIds)
            
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result;
        }
        else{
            return null;
        }
    }
    public function getRequestsWith($fromIds,$toIds)
    {
        /**
         * 
         * SELECT   T.post_id, T.weight, T.comment,
         *          U.user_id, U.first_name, U.last_name,
         *          from.location_id, from.formatted_address,
         *          to.location_id, to.formatted_address
         * FROM     add_request T
         * JOIN     user U          ON U.user_id = T.user_id
         * JOIN     location from   ON from.location_id = T.from_location
         * JOIN     location to     ON to.location_id   = T.to_location
         * 
         * WHERE    T.weight >= $weight
         * AND      T.from_location IN ($fromIds)
         * AND      T.to_location   IN ($toIds)
         * 
         */ 
        $this->db->select('T.post_id,T.weight,T.comment,U.user_id,U.first_name,U.last_name,from.location_id,from.formatted_address,to.location_id,to.formatted_address')
            ->from($ADD_REQUEST." T")
            ->join($USER." U", "U.user_id = T.user_id")
            ->join($LOCATION." from","T.from_location = from.location_id")
            ->join($LOCATION." to","T.to_location = to.location_id")
            ->where("weight <=","$weight")
            ->where_in('from',$fromIds)
            ->where_in('to',$toIds)
           
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result;
        }
        else{
            return null;
        }
    }
}
?>