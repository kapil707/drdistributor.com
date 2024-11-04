<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppConfig {
    // Define application-wide settings
    public $siteTitle = "D R Distributors Pvt Ltd";
    public $WebsiteVersion = "10.0.0";
    public $Weburl = "https://www.drdistributor.com/";
    public $WebJs = "10-0-01";
    public $UserProfileUrl = "https://www.drdweb.co.in/user_profile/";
    public $MedicineImageUrl = "https://www.drdweb.co.in/";
    public $ApiUrl2 = "https://www.drdweb.co.in/";

    public function getSiteTitle() {
        return $this->siteTitle;
    }

    public function getWebsiteVersion() {
        return $this->WebsiteVersion;
    }

    public function getWeburl() {
        return $this->Weburl;
    }

    public function getWebJs() {
        return $this->WebJs;
    }

    public function getUserProfileUrl() {
        return $this->UserProfileUrl;
    }

    public function getMedicineImageUrl() {
        return $this->MedicineImageUrl;
    }

    public function getApiUrl2() {
        return $this->ApiUrl2;
    }
}

