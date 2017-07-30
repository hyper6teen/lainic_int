<?php
        
        
            //$skype = $_GET["skype_id"];
/*
            $url = "https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=13&ct=1501278133&rver=6.7.6626.0&wp=MBI_SSL&wreply=https%3A%2F%2Flw.skype.com%2Flogin%2Foauth%2Fproxy%3Fclient_id%3D578134%26redirect_uri%3Dhttps%253A%252F%252Fweb.skype.com%252F%26site_name%3Dlw.skype.com&lc=1033&id=293290&mkt=en-PH&uaid=4b934bab08d2bb881e9fe2515f4bd1bc&psi=skype&lw=1&cobrandid=90010&client_flight=hsu%2CReservedFlight33%2CReservedFlight67&username=ennan16";
            
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false );
            curl_setopt($ch, CURLOPT_HEADER, 0);
                // This is what solved the issue (Accepting gzip encoding)
            //curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");     
            $response = curl_exec($ch);
            curl_close($ch);

            $response = str_replace('<', '&lt;', $response);
            $response = str_replace('>', '&gt;', $response);

            //$valid = 
            //echo json_encode($valid);
            
            //return strpos($response, '"IfExistsResult":0') != false ? "" : "Skype ID doesn't exist";
            
            echo json_encode($response);

   */

   $unparsed_json = file_get_contents("https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=13&ct=1501278133&rver=6.7.6626.0&wp=MBI_SSL&wreply=https%3A%2F%2Flw.skype.com%2Flogin%2Foauth%2Fproxy%3Fclient_id%3D578134%26redirect_uri%3Dhttps%253A%252F%252Fweb.skype.com%252F%26site_name%3Dlw.skype.com&lc=1033&id=293290&mkt=en-PH&uaid=4b934bab08d2bb881e9fe2515f4bd1bc&psi=skype&lw=1&cobrandid=90010&client_flight=hsu%2CReservedFlight33%2CReservedFlight67&username=ennan16");     

   $json_object = json_decode($unparsed_json, true);

   //$response = str_replace('<', '&lt;', $json_object);
   //$response = str_replace('>', '&gt;', $json_object);

   echo $json_object;

?>