<?php
/**
 * This class is used to send requests to medisana for data retrieval
 *
 * Created by PhpStorm.
 * User: chris
 * Date: 05/12/14
 * Time: 14:13
 */
//header('Accept: application/json');
//header('Content-Type: application/json;charset=utf-8');
require '../../../../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

error_reporting(E_ALL);
ini_set('display errors' , 'On');


class medisanaPHP
{

    protected $medisanaBaseURL;
    protected $module;

    //Optional attributes needed for the signature
    protected $max;
    protected $date_since;
    //Optional value that is not included in the signature
    protected $start;

    protected $oauth_consumer_key = 'K98ZeXLehlgJDXxdA22Ygp5ix8GPiBczjiabohrA5kBCrcVZeErb42MpTvTT1ZpD';
    protected $oauth_consumer_secret = 'LLwnjU3LMtSzdLDfm11imRkja12sY1SF7S5M7tiCL0yaaeEkyiGMEojXqCojE0Sh';

    protected $oauth_token;
    protected $oauth_token_secret;
    protected $oauth_signature_method = 'HMAC-SHA256';
    protected $oauth_signature;
    protected $oauth_version = '1.0';
    protected $oauth_timestamp;
    protected $oauth_nonce;


    public function __construct()
    {
        $this->initUrls();
    }

    /**
     *
     */
    private function initUrls()
    {
        $this->medisanaBaseURL = 'https://cloud.vitadock.com/data/';
    }

    /**
     * @param $oauth_token
     * @param $oauth_token_secret
     */
    public function setOAuthDetails($oauth_token, $oauth_token_secret)
    {
        $this->oauth_token = $oauth_token;
        $this->oauth_token_secret = $oauth_token_secret;
    }


    /**
     * function to
     * @return string
     */
    private function getSignature(){

        $this->oauth_timestamp = time();
        $this->oauth_nonce = uniqid();

        $method = 'GET';

        $encodedTokenSecret = urlencode($this->oauth_token_secret);

        $encodedConsumerSecret = urlencode($this->oauth_consumer_secret);

        $signingKey = $encodedConsumerSecret . '&' . $encodedTokenSecret;

        $encodedConsumerKey = urlencode($this->oauth_consumer_key);

        $encodedNonce = urlencode($this->oauth_nonce);

        $encodedSignatureMethod = urlencode($this->oauth_signature_method);

        $encodedTimestamp = urlencode($this->oauth_timestamp);

        $encodedToken = urlencode($this->oauth_token);

        $encodedVersion = urlencode($this->oauth_version);

        if($this->start != 0){
            $parameterString = 'date_since=' . $this->date_since . '&max=' . $this->max . '&oauth_consumer_key=' . $encodedConsumerKey . '&oauth_nonce=' . $encodedNonce . '&oauth_signature_method=' . $encodedSignatureMethod . '&oauth_timestamp=' . $encodedTimestamp . '&oauth_token=' . $encodedToken . '&oauth_version=' . $encodedVersion . '&start=' . $this->start;
        }else{
            $parameterString = 'date_since=' . $this->date_since . '&max=' . $this->max . '&oauth_consumer_key=' . $encodedConsumerKey . '&oauth_nonce=' . $encodedNonce . '&oauth_signature_method=' . $encodedSignatureMethod . '&oauth_timestamp=' . $encodedTimestamp . '&oauth_token=' . $encodedToken . '&oauth_version=' . $encodedVersion;
        }

        $encodedParameterString = urlencode($parameterString);

        $encodedURL = urlencode(strip_tags($this->medisanaBaseURL . $this->module));

        $signatureBaseString = $method . '&' . $encodedURL . '&' . $encodedParameterString;

        $signatureSHA256 = hash_hmac('sha256', $signatureBaseString, $signingKey, true);

        $signatureBase64 = base64_encode($signatureSHA256);

        $finalSignature = urlencode($signatureBase64);

        return $finalSignature;
    }

    /**
     * function to get all data from medisana
     * @param $module
     * @param int $max
     * @param int $date_since
     * @param int $start
     * @return mixed
     */
    public function getData($module, $max = 10, $date_since = 0, $start = 1){

        $this->start = $start;
        $this->date_since = $date_since;
        $this->max = $max;
        $this->module = $module;
        $this->oauth_signature = $this->getSignature();

        $url = $this->getUrl();
        $headers = $this->setHeaders();

        $client = new Client();
        try {
            $request = $client->get($url, $headers);
        } catch (RequestException $e) {
        }
        $response = $request->getBody();
        return $response;
    }

    /**
     * function to set the URL for the request
     * @return string
     */
    function getUrl(){
        if ($this->start != 0){
            $url = $this->medisanaBaseURL . $this->module . "?start=" . $this->start . "&max=" . $this->max . "&date_since=" . $this->date_since;
        }else{
            $url = $this->medisanaBaseURL . $this->module . "?max=" . $this->max . "&date_since=" . $this->date_since;
        }
        return $url;
    }

    /**
     * function to set headers required for receiving data from Medisana
     * @return array
     */
    function setHeaders(){
        $headers = [ 'headers' => [
            'Accept'           => 'application/json',
            'Content-Type'     => 'application/json;charset=utf-8',
            'Authorization '    => 'OAuth oauth_consumer_key=' . $this->oauth_consumer_key . ',oauth_signature_method=' . $this->oauth_signature_method . ',oauth_timestamp=' . $this->oauth_timestamp . ',oauth_nonce=' . $this->oauth_nonce . ',oauth_token=' . $this->oauth_token . ',oauth_version=' . $this->oauth_version . ',oauth_signature=' . $this->oauth_signature

        ]];
        return $headers;
    }
}

?>