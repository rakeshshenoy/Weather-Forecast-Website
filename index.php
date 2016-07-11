<?php
extract($_GET);
   
$url = "https://maps.google.com/maps/api/geocode/xml?address=".$address.",".$city.",".$state."&key=AIzaSyCw2JMFkppFKS7URX6mmvTMs-jRtRZO8q4";
    ini_set('allow_url_fopen','ON');
    $xmldoc = simplexml_load_file($url) or die("Error!");

    if($xmldoc -> status == "OK" && $xmldoc -> result -> type == "street_address")
    { 
        $x = $xmldoc -> result -> geometry -> location;
             
        if($units == "celsius")
            $unit = "si";
        else
            $unit = "us";
                    
        $forecasturl = "https://api.forecast.io/forecast/34c8b2875f7f15c1faf0f9058b6a1b8a/".$x -> lat.",".$x -> lng."?units=".$unit."&exclude=flags";
   
        $jsonobj = file_get_contents($forecasturl);
        echo $jsonobj;
    }
?>