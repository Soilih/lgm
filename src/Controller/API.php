<?php 

    function api_dolibarr($method, $apikey, $url, $data = false)
    {
       error_log("1");
        $resultat = '';
        $curl = curl_init();
        $httpheader = ['DOLAPIKEY: '.$apikey];
        error_log("1");
        switch ($method)
        {  
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                $httpheader[] = "Content-Type:application/json";
                error_log("1");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    error_log("1");  
            break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                $httpheader[] = "Content-Type:application/json";
                error_log("1");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                // if ($data);
                // $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        //    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
       
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
       
        $result = curl_exec($curl);

    curl_close($curl);
    
    $resultat = json_decode($result, true);

    return  error_log($resultat);
    }

?>