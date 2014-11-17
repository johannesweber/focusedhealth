<?php
/**
 * WithingsPHP v.0.1. Basic Withings API wrapper for PHP using OAuth. Based on FitBit PHP from:
 *
 * - https://github.com/heyitspavel/fitbitphp
 *
 *
 * Date: 2014/11/16
 * Requires OAuth 1.0.0, SimpleXML
 * @version 0.1 ($Id$)
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
    protected $oauthToken, $oauthSecret;

    protected $responseFormat;

    protected $userId;

    protected $metric = 0;
    protected $userAgent = 'WithingsPHP 0.1';
    protected $debug;

    protected $clientDebug;


    /**
     * @param string $consumer_key Application consumer key for Withings API
     * @param string $consumer_secret Application secret
     * @param int $debug Debug mode (0/1) enables OAuth internal debug
     * @param string $user_agent User-agent to use in API calls
     * @param string $response_format Response format (json or xml) to use in API calls
     */
    public function __construct($consumer_key, $consumer_secret, $debug = 1, $user_agent = null, $response_format = 'json')
    {
        $this->initUrls();

        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->oauth = new OAuth($consumer_key, $consumer_secret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);

        $this->debug = $debug;
        if ($debug)
            $this->oauth->enableDebug();

        if (isset($user_agent))
            $this->userAgent = $user_agent;

        $this->responseFormat = $response_format;
    }


    /**
     * @param string $consumer_key Application consumer key for Withings API
     * @param string $consumer_secret Application secret
     */
    public function reinit($consumer_key, $consumer_secret)
    {

        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;

        $this->oauth = new OAuth($consumer_key, $consumer_secret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);

        if ($this->debug)
            $this->oauth->enableDebug();
    }


    /**
     * @param string $apiHost API host, i.e. wbsapi.withings.net
     * @param string $authHost Auth host, i.e. oauth.withings.com
     */
    public function setEndpointBase($apiHost, $authHost, $https = true, $httpsApi = true)
    {
        $this->apiHost = $apiHost;
        $this->authHost = $authHost;

        $this->initUrls($https, $httpsApi);
    }

    private function initUrls($https = true, $httpsApi = true)
    {

        if ($httpsApi)
            $this->baseApiUrl = 'https://' . $this->apiHost;
        else
            $this->baseApiUrl = 'http://' . $this->apiHost;

        if ($https) {
            $this->authUrl = 'https://' . $this->authHost . '/account/authorize';
            $this->requestTokenUrl = 'https://' . $this->authHost . '/account/request_token';
            $this->accessTokenUrl = 'https://' . $this->authHost . '/account/access_token';
        } else {
            $this->authUrl = 'http://' . $this->authHost . '/account/authorize';
            $this->requestTokenUrl = 'http://' . $this->authHost . '/account/request_token';
            $this->accessTokenUrl = 'http://' . $this->authHost . '/account/access_token';
        }
    }

    /**
     * @return OAuth debugInfo object for previous call. Debug should be enabled in __construct
     */
    public function oauthDebug()
    {
        return $this->oauth->debugInfo;
    }

    /**
     * @return OAuth debugInfo object for previous client_customCall. Debug should be enabled in __construct
     */
    public function client_oauthDebug()
    {
        return $this->clientDebug;
    }


    /**
     * Returns Withings session status for frontend (i.e. 'Sign in with Withings' implementations)
     *
     * @return int (0 - no session, 1 - just after successful authorization, 2 - session exist)
     */
    public static function sessionStatus()
    {
        $session = session_id();
        if (empty($session)) {
            session_start();
        }
        if (empty($_SESSION['withings_Session']))
            $_SESSION['withings_Session'] = 0;

        return (int)$_SESSION['withings_Session'];
    }

    /**
     * Initialize session. Inits OAuth session, handles redirects to Withings login/authorization if needed
     *
     * @param  $callbackUrl Callback for 'Sign in with Withings'
     * @param  $cookie Use persistent cookie for authorization, or session cookie only
     * @return int (1 - just after successful authorization, 2 - if session already exist)
     */
    public function initSession($callbackUrl, $cookie = true)
    {

        $session = session_id();
        if (empty($session)) {
            session_start();
        }

        if (empty($_SESSION['withings_Session']))
            $_SESSION['withings_Session'] = 0;


        if (!isset($_GET['oauth_token']) && $_SESSION['withings_Session'] == 1)
            $_SESSION['withings_Session'] = 0;


        if ($_SESSION['withings_Session'] == 0) {

            $request_token_info = $this->oauth->getRequestToken($this->requestTokenUrl, $callbackUrl);
            $_SESSION['withings_Secret'] = $request_token_info['oauth_token_secret'];

            $_SESSION['withings_Session'] = 1;

            header('Location: ' . $this->authUrl . '?oauth_token=' . $request_token_info['oauth_token']);
            exit;

        } else if ($_SESSION['withings_Session'] == 1) {

            $this->oauth->setToken($_GET['oauth_token'], $_SESSION['withings_Secret']);
            $access_token_info = $this->oauth->getAccessToken($this->accessTokenUrl);

            $_SESSION['withings_Session'] = 2;
            $_SESSION['withings_Token'] = $access_token_info['oauth_token'];
            $_SESSION['withings_Secret'] = $access_token_info['oauth_token_secret'];

            $this->setOAuthDetails($_SESSION['withings_Token'], $_SESSION['withings_Secret']);
            return 1;

        } else if ($_SESSION['withings_Session'] == 2) {
            $this->setOAuthDetails($_SESSION['withings_Token'], $_SESSION['withings_Secret']);
            return 2;
        }
    }


    /**
     * Reset session
     *
     * @return void
     */
    public function resetSession()
    {
        $_SESSION['withings_Session'] = 0;
    }


    /**
     * Sets OAuth token/secret. Use if library used in internal calls without session handling
     *
     * @param  $token
     * @param  $secret
     * @return void
     */
    public function setOAuthDetails($token, $secret)
    {
        $this->oauthToken = $token;
        $this->oauthSecret = $secret;

        $this->oauth->setToken($this->oauthToken, $this->oauthSecret);
    }

    /**
     * Get OAuth token
     *
     * @return string
     */
    public function getOAuthToken()
    {
        return $this->oauthToken;
    }

    /**
     * Get OAuth secret
     *
     * @return string
     */
    public function getOAuthSecret()
    {
        return $this->oauthSecret;
    }


    /**
     * Set Withings response format for future API calls
     *
     * @param  $response_format 'json' or 'xml'
     * @return void
     */
    public function setResponseFormat($response_format)
    {
        $this->responseFormat = $response_format;
    }


    /**
     * Set Withings userId for future API calls
     *
     * @param  $userId 'XXXXX'
     * @return void
     */
    public function setUser($userId)
    {
        $this->userId = $userId;
    }

    //TODO setup to withings
}