<?php

/**
 * WithingsPHP v.0.73. Basic Withings API wrapper for PHP using OAuth
 *
 * Note: Library is in beta and provided as-is. We hope to add features as API grows, however
 *       feel free to fork, extend and send pull requests to us.
 *
 * - https://github.com/heyitspavel/fitbitphp
 *
 *
 * Date: 2014/09/23
 * Requires OAuth 1.0.0, SimpleXML
 * @version 0.73 ($Id$)
 */
class WithingsPHP
{

    protected $withingsBaseURL;
    protected $activityMeasuresURL;
    protected $bodyMeasuresURL;
    protected $sleepMeasuresURL;

    protected $oauth_consumer_key = '0b1de1b1e2473372f5e8e30d0f13e38f9b20c84320cf8243517e73c0c084';
    protected $oauth_consumer_secret = 'cdb631b4102893076d6feb038fd5fe7fd28431b998881d5c001307cece802';

    protected $oauth_token;
    protected $oauth_token_secret;
    protected $oauth_signature_method = 'HMAC-SHA1';
    protected $oauth_signature;
    protected $oauth_version = '1.0';
    protected $oauth_timestamp;
    protected $oauth_nonce;
    protected $userid;


    /**
     * @param string $consumer_key Application consumer key for Fitbit API
     * @param string $consumer_secret Application secret
     * @param int $debug Debug mode (0/1) enables OAuth internal debug
     * @param string $user_agent User-agent to use in API calls
     * @param string $response_format Response format (json or xml) to use in API calls
     */
    public function __construct()
    {
        $this->initUrls();
    }

    private function initUrls()
    {

        $this->withingsBaseURL = 'https://wbsapi.withings.net';

        $this->activityMeasuresURL = $this->withingsBaseURL . '/v2/measure';

        $this->bodyMeasuresURL = $this->withingsBaseURL . '/measure';

        $this->sleepMeasuresURL = $this->withingsBaseURL . '/v2/sleep';
    }

    public function setOAuthDetails($oauth_token, $oauth_token_secret, $userid)
    {

        $this->oauth_token = $oauth_token;
        $this->oauth_token_secret = $oauth_token_secret;
        $this->userid = $userid;
    }


//das token secret muss auch an den server geschickt werden und das consumer secret
    private function getSignature($actionParam, $hasTimespan = false, $startDate = null, $endDate = null)
    {

        $url = '';
        $action = $actionParam;

        switch ($actionParam) {
            case "getactivity":
                $url = $this->activityMeasuresURL;
                break;
            case "getmeas":
                $url = $this->bodyMeasuresURL;
                break;
            case "getintradayactivity":
                $url = $this->activityMeasuresURL;
                break;
            case "get":
                $url = $this->sleepMeasuresURL;
                break;
            case "getsummary":
                $url = $this->sleepMeasuresURL;
                break;
        }

        $this->oauth_timestamp = time();
        $this->oauth_nonce = uniqid();

        $method = 'GET';

        $encodedTokenSecret = urlencode($this->oauth_token_secret);

        $encodedConsumerSecret = urlencode($this->oauth_consumer_secret);

        $signingKey = $encodedConsumerSecret . '&' . $encodedTokenSecret;

        //ab hier ist es "sortiert"
        $encodedAction = urlencode($action);

        $encodedConsumerKey = urlencode($this->oauth_consumer_key);

        $encodedNonce = urlencode($this->oauth_nonce);

        $encodedSignatureMethod = urlencode($this->oauth_signature_method);

        $encodedTimestamp = urlencode($this->oauth_timestamp);

        $encodedToken = urlencode($this->oauth_token);

        $encodedVersion = urlencode($this->oauth_version);

        $encodedUserId = urlencode($this->userid);

        if ($hasTimespan == false) {
            $parameterString = 'action=' . $encodedAction . '&oauth_consumer_key=' . $encodedConsumerKey . '&oauth_nonce=' . $encodedNonce . '&oauth_signature_method=' . $encodedSignatureMethod . '&oauth_timestamp=' . $encodedTimestamp . '&oauth_token=' . $encodedToken . '&oauth_version=' . $encodedVersion . '&userid=' . $encodedUserId;
        } else {
            $parameterString = 'action=' . $encodedAction . "&enddate=" . $endDate . '&oauth_consumer_key=' . $encodedConsumerKey . '&oauth_nonce=' . $encodedNonce . '&oauth_signature_method=' . $encodedSignatureMethod . '&oauth_timestamp=' . $encodedTimestamp . '&oauth_token=' . $encodedToken . '&oauth_version=' . $encodedVersion . "&startdate=" . $startDate . '&userid=' . $encodedUserId;

        }

        $encodedParameterString = urlencode($parameterString);

        $encodedURL = urlencode(strip_tags($url));

        $signatureBaseString = $method . '&' . $encodedURL . '&' . $encodedParameterString;

        $signatureSHA1 = hash_hmac('sha1', $signatureBaseString, $signingKey, true);

        $signatureBase64 = base64_encode($signatureSHA1);

        $finalSignature = urlencode($signatureBase64);

        return $finalSignature;
    }



    /**
     * API wrappers
     *
     */

    /**
     * Get Method for all 5ive withings api requests
     *
     * @throws FitBitException
     * @param string $userId UserId of public profile, if none using set with setUser or '-' by default
     * @return mixed SimpleXMLElement or the value encoded in json as an object
     */

    public function getBodyMeasures()
    {
        $action = 'getmeas';

        $this->oauth_signature = $this->getSignature($action);

        $url = $this->bodyMeasuresURL . "?action=" . $action . "&oauth_consumer_key=" . $this->oauth_consumer_key . "&oauth_nonce=" . $this->oauth_nonce . "&oauth_signature=" . $this->oauth_signature . "&oauth_signature_method=" . $this->oauth_signature_method . "&oauth_timestamp=" . $this->oauth_timestamp . "&oauth_token=" . $this->oauth_token . "&oauth_version=" . $this->oauth_version . "&userid=" . $this->userid;

        $json = file_get_contents($url);
        $result = json_decode($json);
        //print_r($result);
        return $result;
    }


    public function getBodyMeasuresTimeRange($startDate, $endDate)
    {
        $action = 'getmeas';

        $this->oauth_signature = $this->getSignature($action, true, $startDate, $endDate);

        $url = $this->bodyMeasuresURL . "?action=" . $action . "&enddate=" . $endDate . "&oauth_consumer_key=" . $this->oauth_consumer_key . "&oauth_nonce=" . $this->oauth_nonce . "&oauth_signature=" . $this->oauth_signature . "&oauth_signature_method=" . $this->oauth_signature_method . "&oauth_timestamp=" . $this->oauth_timestamp . "&oauth_token=" . $this->oauth_token . "&oauth_version=" . $this->oauth_version . "&startdate=" . $startDate . "&userid=" . $this->userid;

        $json = file_get_contents($url);
        $result = json_decode($json);
        return $result;
    }


    public function getActivityMeasures()
    {
        $action = 'getactivity';

        $this->oauth_signature = $this->getSignature($action);

        $url = $this->activityMeasuresURL . "?action=" . $action . "&oauth_consumer_key=" . $this->oauth_consumer_key . "&oauth_nonce=" . $this->oauth_nonce . "&oauth_signature=" . $this->oauth_signature . "&oauth_signature_method=" . $this->oauth_signature_method . "&oauth_timestamp=" . $this->oauth_timestamp . "&oauth_token=" . $this->oauth_token . "&oauth_version=" . $this->oauth_version . "&userid=" . $this->userid;

        $json = file_get_contents($url);
        $result = json_decode($json);
        return $result;
    }

    public function getIntradayActivity()
    {
        $action = 'getintradayactivity';

        $this->oauth_signature = $this->getSignature($action);

        $url = $this->activityMeasuresURL . "?action=" . $action . "&oauth_consumer_key=" . $this->oauth_consumer_key . "&oauth_nonce=" . $this->oauth_nonce . "&oauth_signature=" . $this->oauth_signature . "&oauth_signature_method=" . $this->oauth_signature_method . "&oauth_timestamp=" . $this->oauth_timestamp . "&oauth_token=" . $this->oauth_token . "&oauth_version=" . $this->oauth_version . "&userid=" . $this->userid;

        $json = file_get_contents($url);
        $result = json_decode($json);
        return $result;
    }

    public function getSleepMeasure($startDate, $endDate)
    {
        $action = 'get';

        $this->oauth_signature = $this->getSignature($action, true, $startDate, $endDate);

        $url = $this->sleepMeasuresURL . "?action=" . $action . "&enddate=" . $endDate . "&oauth_consumer_key=" . $this->oauth_consumer_key . "&oauth_nonce=" . $this->oauth_nonce . "&oauth_signature=" . $this->oauth_signature . "&oauth_signature_method=" . $this->oauth_signature_method . "&oauth_timestamp=" . $this->oauth_timestamp . "&oauth_token=" . $this->oauth_token . "&oauth_version=" . $this->oauth_version . "&startdate=" . $startDate . "&userid=" . $this->userid;

        $json = file_get_contents($url);
        $result = json_decode($json);
        return $result;
    }

    public function getSleepSummary()
    {
        $action = 'getsummary';

        $this->oauth_signature = $this->getSignature($action);

        $url = $this->sleepMeasuresURL . "?action=" . $action . "&oauth_consumer_key=" . $this->oauth_consumer_key . "&oauth_nonce=" . $this->oauth_nonce . "&oauth_signature=" . $this->oauth_signature . "&oauth_signature_method=" . $this->oauth_signature_method . "&oauth_timestamp=" . $this->oauth_timestamp . "&oauth_token=" . $this->oauth_token . "&oauth_version=" . $this->oauth_version . "&userid=" . $this->userid;

        $json = file_get_contents($url);
        $result = json_decode($json);
        return $result;
    }

    public function convertMeasurementIdToMeasurementName($measurementId)
    {

        switch ($measurementId) {
            case 1:
                $name = 'weight';
                break;
            case 4:
                $name = 'height';
                break;
            case 5:
                $name = 'fatFreeMass';
                break;
            case 6:
                $name = 'fat';
                break;
            case 8:
                $name = 'fatMass';
                break;
            case 9:
                $name = 'diastolic';
                break;
            case 10:
                $name = 'systolic';
                break;
            case 11:
                $name = 'heartRate';
                break;
            case 54:
                $name = 'spO2';
                break;
            default:
                $name = 'measurement ID not available';
        }

        return $name;
    }

    public function devideSeconds ($seconds){

        $result = $seconds/60;

        return $result;

    }

    /*
 * function to check synchronization
 */
    public function showSynchronizeMessage($result)
    {
        if (!$result) {
            echo '{"success" : "-1", "message" : "Data could not be synchronized. Please try again later!"}';
        } else {
            echo '{"success" : "1", "message" : "Data successfully synchronized!"}';
        }
    }
}
