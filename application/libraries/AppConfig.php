<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppConfig {
    // Define application-wide settings
    public $siteTitle = "D R Distributors Pvt Ltd";
    public $WebsiteVersion = "10.0.0";
    public $Weburl = "";
    public $WebJs = "10-0-0";
    public $UserProfileUrl = "https://www.drdweb.co.in/user_profile/";

    public function getSiteTitle() {
        return $this->siteTitle;
    }

    public function getWebsiteVersion() {
        return $this->WebsiteVersion;
    }

    public function getWebJs() {
        return $this->WebJs;
    }

    public function getUserProfileUrl() {
        return $this->UserProfileUrl;
    }
}

