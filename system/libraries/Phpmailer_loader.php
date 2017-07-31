<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class CI_Phpmailer_loader {
    public function __construct() {
        require 'Phpmailer/PHPMailerAutoload.php';
    }
}

?>