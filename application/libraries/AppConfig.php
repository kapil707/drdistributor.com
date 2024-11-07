<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppConfig {
    // Define application-wide settings
    public $siteTitle = "D.R. Distributors Pvt Ltd";
    public $siteTitle2 = "D.R. Distributors Pvt Ltd";
    public $FooterTitle = "D.R. Distributors Pvt Ltd";
    public $WebsiteVersion = "10.0.06";
    public $WebJs = "10-0-06";
    public $Weburl = "https://www.drdistributor.com/";
    public $UserProfileUrl = "https://www.drdweb.co.in/user_profile/";
    public $MedicineImageUrl = "https://www.drdweb.co.in/";
    public $ApiUrl2 = "https://www.drdweb.co.in/";
    public $SiteEmail = "vipul@drdindia.com";
    public $SiteMobile = "+919899133989";
    public $SiteWhatsApp = "+919899133989";
    public $AppUrl = "https://play.google.com/store/apps/details?id=com.drdistributor.dr&hl=en";

    public function getSiteTitle() {
        return $this->siteTitle;
    }

    public function getSiteTitle2() {
        return $this->siteTitle2;
    }

    public function getFooterTitle() {
        return $this->FooterTitle;
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

    public function getSiteEmail() {
        return $this->SiteEmail;
    }

    public function getSiteMobile() {
        return $this->SiteMobile;
    }

    public function getSiteWhatsApp() {
        return $this->SiteWhatsApp;
    }

    public function getAppUrl() {
        return $this->AppUrl;
    }
}

