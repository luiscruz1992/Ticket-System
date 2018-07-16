<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    private $data = null;

    public function __construct() {
        parent::__construct();
        $this->data = new stdClass();
        $this->utilities->validateUserSession();
        $this->utilities->sidebarMenu($this->data, "reports");
    }

    public function index() {
        $this->data->title = "Generate Report";
        $this->data->body = $this->parser->parse('page/reports', $this->data, true);
        $this->parser->parse('base', $this->data);
    }
}
