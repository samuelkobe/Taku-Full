<?php

/**
 * Description of Booking Easy
 * This Class is User for interaction with the Web Service
 * @author zohaib
 */
include_once( SAGENDA_PLUGIN_DIR . 'classes/SubscribeForEvent.php');

class MyReservationService {

    protected $apiUrl = 'http://www.sagenda.net/api/'; //Live Server
    protected $curl;

    public function __construct() {
        $this->curl = curl_init();
    }

    private function _isCurl() {
        return function_exists('curl_version');
    }

    public function ValidateAuthCode($authCode) {
        try {

            $serviceUrl = $this->apiUrl . 'ValidateAccount/' . $authCode;

            $results = $this->curlGetData($serviceUrl);
            if ($results == 2)
                return 2;
            elseif ($results == 3)
                return 3;
            else
                return $results->Success;
        } catch (Exception $exc) {
            return 2;
        }
    }

    public function getBookableItems($authCode) {
        try {
            $serviceUrl = $this->apiUrl . 'Events/GetBookableItemList/' . $authCode;
            $results = $this->curlGetData($serviceUrl);
        } catch (Exception $exc) {
            
        }
        return $results;
    }

    public function getEventsList($authCode, $startDate = "07-13-2014", $endDate = "07-30-2014", $bookableItemId = 0) {
        try {
            $serviceUrl = $this->apiUrl . 'Events/GetAvailability/' . $authCode . '/' . $startDate . '/' . $endDate . '/?bookableItemId=' . $bookableItemId;
            $results = $this->curlGetData($serviceUrl);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $results;
    }

    public function subscribeToEvent(SubscribeForEvent $SEvent) {
        try {
            $Booking = array("ApiToken" => $SEvent->getApiToken(), "EventIdentifier" => $SEvent->getEventIdentifier(), "BookableItemId" => $SEvent->getBookableItemId(), "EventScheduleId" => $SEvent->getEventScheduleId(), "Courtesy" => $SEvent->getCourtesy(), "FirstName" => $SEvent->getFirstName(), "LastName" => $SEvent->getLastName(), "PhoneNumber" => $SEvent->getPhoneNumber(), "Email" => $SEvent->getEmail(), "Description" => $SEvent->getDescription());
            $json_data = json_encode($Booking);
            $serviceUrl = $this->apiUrl . 'Events/SetBooking';
            return $this->curlPostData($serviceUrl, $json_data);
//            if ($result->Success) {
//                return true;
//            } else {
//                return false;
//            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    private function curlPostData($url, $json_data) {
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->curl, CURLOPT_USERAGENT, $userAgent);

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json_data))
        );

        curl_setopt($this->curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 10);


        $contents = curl_exec($this->curl);
        curl_close($this->curl);
        return $contents;
    }

    private function curlGetData($url) {
        try {
            $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
            //The URL to fetch. This can also be set when initializing a session with curl_init().
            curl_setopt($this->curl, CURLOPT_URL, $url);
            //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
            //The number of seconds to wait while trying to connect.	
            curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 10);
            //The contents of the "User-Agent: " header to be used in a HTTP request.
            curl_setopt($this->curl, CURLOPT_USERAGENT, $userAgent);
            //To fail silently if the HTTP code returned is greater than or equal to 400.
            curl_setopt($this->curl, CURLOPT_FAILONERROR, TRUE);
            //To follow any "Location: " header that the server sends as part of the HTTP header.
            //curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, TRUE);
            //To automatically set the Referer: field in requests where it follows a Location: redirect.
            curl_setopt($this->curl, CURLOPT_AUTOREFERER, TRUE);
            //The maximum number of seconds to allow cURL functions to execute.	
            curl_setopt($this->curl, CURLOPT_TIMEOUT, 10);
            $contents = curl_exec($this->curl);
            if (curl_errno($this->curl)) {
                if (curl_errno($this->curl) == 60) {
                    return 3;
                } else {
                    return 2;
                }
            }


            if (curl_error($this->curl)) {
                return 2;
            }

            curl_close($this->curl);
            // Decode json object
            $results = json_decode($contents);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $results;
    }

}

?>
