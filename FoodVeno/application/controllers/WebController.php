<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class WebController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form', 'url');

    }

    function index()
    {
        log_message('debug', "Index Function");
        echo "index  Web Controller";
    }
}