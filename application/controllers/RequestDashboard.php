<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RequestDashboard extends CI_Controller {

    private $rtn = null, $obj = null;

    public function __construct() {
        parent::__construct();
        $this->rtn = new stdClass();
        $this->obj = new stdClass();
    }

    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $resp = $this->get->getVerifyCredentials(trim(strtolower($this->input->post('email', TRUE))), trim($this->input->post('password', TRUE)));
            if ($resp) {
                if (intval($resp->status_id) === 1) {
                    $obj = array();
                    $obj['fullname'] = ucwords($resp->first_name . " " . $resp->last_name);
                    $obj['hash'] = md5(time());
                    $this->session->set_userdata($obj);
                    $this->upd->setHash($obj['hash'], $resp->employee_id);
                    $this->rtn->status = 1;
                } else {
                    $this->rtn->resp = "This account is disabled.";
                    $this->rtn->status = 0;
                }
            } else {
                $this->rtn->resp = "Incorrect user or password.";
                $this->rtn->status = 0;
            }
        } else {
            $this->rtn->resp = "Incorrect user or password.";
            $this->rtn->status = 0;
        }
        echo json_encode($this->rtn);
    }

}
