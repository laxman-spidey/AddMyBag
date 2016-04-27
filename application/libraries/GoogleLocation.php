<?php
class GoogleLocation
{
    private $levelLabels;
    
    public function __construct()
    {
        $this->levelLabels = array(
            "locality",
            "postal_code",
            "administrative_area_level_2",
            "administrative_area_level_1",
            "country"
        );
    }
    public function getNextLevel($currentLevel)
    {
        if($currentLevel == $this->levelLabels[4])
        {
            return -1;
        }
        $i=0;
        foreach ($this->levelLabels as $label)
        {
            
            if($currentLevel == $label)
            {
                
                return $this->levelLabels[$i];
            }
            $i++;
        }
    }
    public function getDistanceBetweenTwoPlaces($xLat,$xLng,$yLat,$yLng)
    {
           
    }
}

?>