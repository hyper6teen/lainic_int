<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class CI_Skypephp_loader {
    public function __construct() {
        require 'Skypephp/skype.class.php';
    }
}

?>