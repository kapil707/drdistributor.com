<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppConfig {
    // Define application-wide settings
    public $siteTitle = "D R Distributors Pvt Ltd";
    public $siteWebsiteVersion = "10.0.0";

    public function getSiteTitle() {
        return $this->siteTitle;
    }

    public function getWebsiteVersion() {
        return $this->siteWebsiteVersion;
    }
}
