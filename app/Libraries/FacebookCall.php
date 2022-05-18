<?php

namespace App\Libraries;
use Exception;
use Facebook\Facebook;

class FacebookCall {

    public function __construct() {
        $this->config = array(
            'app_id'  => '5462245873807276',
            'app_secret' => '6b0ef3ab2261e87e86b41e0f79532da4',
            'default_graph_version' => 'v4.0');

        $this->fb = new Facebook($this->config);
        $this->permissions = ['email'];
        $this->fb_helper = $this->fb->getRedirectLoginHelper();
    }

    public function loginURL() {
        $callbackUrl = htmlspecialchars('https://eso.vse.cz/~maki01/signin/facebookLogin');
        return $this->fb_helper->getLoginUrl($callbackUrl, $this->permissions);
    }

    public function getFbUserData() {
        try {
            $accessToken = $this->fb_helper->getAccessToken();
        } catch (Exception $e) {
            echo 'Facebook Login ended with error: ' . $e->getMessage();
            exit();
        }
        if (!$accessToken) {
            exit('Facebook Login went wrong, please try again.');
        }
        $oAuth2Client = $this->fb->getOAuth2Client();

        $accessTokenMetadata = $oAuth2Client->debugToken($accessToken);

        $fbUserId = $accessTokenMetadata->getUserId();

        $response = $this->fb->get('/me?fields=name,email', $accessToken);
        $graphUser = $response->getGraphUser();

        $fbUserEmail = $graphUser->getEmail();
        $fbUserName = $graphUser->getName();

        return array('facebook_id' => $fbUserId, 'name' => $fbUserName, 'email' => $fbUserEmail);
    }
}