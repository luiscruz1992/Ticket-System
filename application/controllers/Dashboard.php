<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private $data = null;

    public function __construct() {
        parent::__construct();
        $this->data = new stdClass();
    }

    /**
     * Login page
     */
    public function index() {
        if ($this->session->hash) {
            redirect("tickets");
        }
        $this->load->view('login');
    }

    /**
     * Sign out page
     */
    public function signOut() {
        $this->session->sess_destroy();
        redirect(base_url("/"));
    }

}
