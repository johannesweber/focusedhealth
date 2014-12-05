<?php
/**
 * FitbitPHP v.0.73. Basic Fitbit API wrapper for PHP using OAuth
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

    /**
     * API Constants
     *
     */
    private $authHost = 'oauth.withings.com';
    private $apiHost = 'wbsapi.withings.net';

    private $baseApiUrl;
    private $authUrl;
    private $requestTokenUrl;
    private $accessTokenUrl;


    /**
     * Class Variables
     *
     */
    protected $oauth;

    protected $responseFormat = 'json';

    protected $metric = 0;
    protected $userAgent = 'WithingsPHP 0.72';
    protected $debug;

    protected $clientDebug;

    protected $oauth_consumer_key;
    protected $oauth_token;
    protected $oauth_signature_method;
    protected $oauth_signature;
    protected $oauth_version;
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

    private function initUrls($https = true, $httpsApi = true)
    {

        if ($httpsApi)
            $this->baseApiUrl = 'https://' . $this->apiHost;
        else
            $this->baseApiUrl = 'http://' . $this->apiHost;

        if ($https) {
            $this->authUrl = 'https://' . $this->authHost . '/account/authorize';
            $this->requestTokenUrl = 'https://' . $this->apiHost . 'account/request_token';
            $this->accessTokenUrl = 'https://' . $this->apiHost . '/account/access_token';
        } else {
            $this->authUrl = 'http://' . $this->authHost . '/account/authorize';
            $this->requestTokenUrl = 'http://' . $this->apiHost . 'account/request_token';
            $this->accessTokenUrl = 'http://' . $this->apiHost . '/account/access_token';
        }
    }

    public function setOAuthDetails($oauth_consumer_key, $oauth_token, $oauth_signature_method, $oauth_signature, $oauth_version, $oauth_timestamp, $userid, $oauth_nonce)
    {
        $this->oauth_consumer_key = $oauth_consumer_key;
        $this->oauth_token = $oauth_token;
        $this->oauth_signature_method = $oauth_signature_method;
        $this->oauth_signature = $oauth_signature;
        $this->oauth_version = $oauth_version;
        $this->oauth_timestamp = $oauth_timestamp;
        $this->userid = $userid;
        $this->oauth_nonce = $oauth_nonce;
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
    public function sendRequestToWithings($action) {

        $bodyMeasuresSchema = '/measure';
        $ActivitySchema = '/v2/measure';
        $SleepSchema = '/v2/sleep';

        switch ($action) {
            case "getactivity":
                $url = $this->baseApiUrl . $ActivitySchema . "?action=" . $action . "&oauth_consumer_key=" . $this->oauth_consumer_key . "&oauth_nonce=" . $this->oauth_nonce . "&oauth_signature=" . $this->oauth_signature . "&oauth_signature_method=" . $this->oauth_signature_method . "&oauth_timestamp=" . $this->oauth_timestamp . "&oauth_token=" . $this->oauth_token . "&oauth_version=" . $this->oauth_version . "&userid=" . $this->userid;
                break;
            case "getmeas":
                $url = $this->baseApiUrl . $bodyMeasuresSchema . "?action=" . $action ."&oauth_consumer_key=" . $this->oauth_consumer_key . "&oauth_nonce=" . $this->oauth_nonce . "&oauth_signature=" . $this->oauth_signature . "&oauth_signature_method=" . $this->oauth_signature_method . "&oauth_timestamp=" . $this->oauth_timestamp . "&oauth_token=" . $this->oauth_token . "&oauth_version=" . $this->oauth_version . "&userid=" . $this->userid;
                break;
            case "getintradayactivity":
                $url = $this->baseApiUrl . $ActivitySchema . "?action=" . $action . "&oauth_consumer_key=" . $this->oauth_consumer_key . "&oauth_nonce=" . $this->oauth_nonce . "&oauth_signature=" . $this->oauth_signature . "&oauth_signature_method=" . $this->oauth_signature_method . "&oauth_timestamp=" . $this->oauth_timestamp . "&oauth_token=" . $this->oauth_token . "&oauth_version=" . $this->oauth_version . "&userid=" . $this->userid;
                break;
            case "get":
                $url = $this->baseApiUrl . $SleepSchema . "?action=" . $action . "&oauth_consumer_key=" . $this->oauth_consumer_key . "&oauth_nonce=" . $this->oauth_nonce . "&oauth_signature=" . $this->oauth_signature . "&oauth_signature_method=" . $this->oauth_signature_method . "&oauth_timestamp=" . $this->oauth_timestamp . "&oauth_token=" . $this->oauth_token . "&oauth_version=" . $this->oauth_version . "&userid=" . $this->userid;
                break;
            case "getsummary":
                $url = $this->baseApiUrl . $SleepSchema . "?action=" . $action . "&oauth_consumer_key=" . $this->oauth_consumer_key . "&oauth_nonce=" . $this->oauth_nonce . "&oauth_signature=" . $this->oauth_signature . "&oauth_signature_method=" . $this->oauth_signature_method . "&oauth_timestamp=" . $this->oauth_timestamp . "&oauth_token=" . $this->oauth_token . "&oauth_version=" . $this->oauth_version . "&userid=" . $this->userid;
                break;
        }

        print_r($url);

        $json = file_get_contents($url);
        $result = json_decode($json);
        print_r($result);
    }
}