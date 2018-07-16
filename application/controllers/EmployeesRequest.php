<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeesRequest extends CI_Controller {

    private $obj = null, $rtn = null;

    public function __construct() {
        parent::__construct();
        $this->obj = new stdClass();
        $this->rtn = new stdClass();
        $this->load->model("Employees/SetEmp", "setEmp");
        $this->load->model("Employees/UpdEmp", "updEmp");
        $this->load->model("Employees/RevEmp", "revEmp");
    }

    /**
     * Add new employee
     */
    public function setNewEmployees() {
        $this->form_validation->set_rules('first-name', 'First name', 'trim|required');
        $this->form_validation->set_rules('last-name', 'Last name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('status', 'Status', 'integer|required|in_list[1,2]');
        $this->form_validation->set_rules('rpassword', 'Password', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $this->obj->first_name = trim(strtolower($this->input->post('first-name', TRUE)));
            $this->obj->last_name = trim(strtolower($this->input->post('last-name', TRUE)));
            $this->obj->email = trim(strtolower($this->input->post('email', TRUE)));
            $this->obj->status_id = intval($this->input->post('status', TRUE));
            $this->obj->password = md5($this->input->post('rpassword', TRUE));
            if ($this->get->getUserByEmail($this->obj->email)) {
                $this->rtn->resp = "This email address is already registered.";
                $this->rtn->status = 0;
            } else {
                $this->rtn->resp = "Saved Correctly.";
                $this->rtn->status = 1;
                $this->setEmp->setNewEmployees($this->obj);
            }
        } else {
            $this->rtn->resp = validation_errors();
            $this->rtn->status = 0;
        }
        echo json_encode($this->rtn);
    }

    /**
     * Edit employee
     */
    public function setEditEmployees() {
        $this->form_validation->set_rules('first-name', 'First name', 'trim|required');
        $this->form_validation->set_rules('last-name', 'Last name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('status', 'Status', 'integer|required|in_list[1,2]');
        if ($this->form_validation->run() == TRUE) {
            $user = $this->get->getUserByHash();
            $this->obj->first_name = trim(strtolower($this->input->post('first-name', TRUE)));
            $this->obj->last_name = trim(strtolower($this->input->post('last-name', TRUE)));
            $this->obj->email = trim(strtolower($this->input->post('email', TRUE)));
            $this->obj->status_id = intval($this->input->post('status', TRUE));
            if ($this->get->getUserByEmail($this->obj->email) && $user->email != $this->obj->email) {
                $this->rtn->resp = "This email address is already registered.";
                $this->rtn->status = 0;
            } else {
                $this->rtn->resp = "Saved Correctly.";
                $this->rtn->status = 1;
                $eid = unserialize(base64_decode($this->input->post('eid', TRUE)));
                $this->updEmp->setEmployee($this->obj, $eid['eid']);
            }
        } else {
            $this->rtn->resp = validation_errors();
            $this->rtn->status = 0;
        }
        echo json_encode($this->rtn);
    }

    /**
     * Remove employee by employee id
     */
    public function setRemoveEmployee() {
        $eid = base64_decode($this->input->post("eid"));
        $this->revEmp->setEmployees($eid);
        $this->rtn->resp = $this->table_tbody->getListOfEmployees();
        echo json_encode($this->rtn);
    }

    /**
     * Change password by employee id
     */
    public function setChangePassword() {
        $this->form_validation->set_rules('current-pass', 'Current pass', 'trim|required');
        $this->form_validation->set_rules('new-pass', 'New pass', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $usr = $this->get->getUserByHash();
            if ($usr->password === md5($this->input->post("current-pass"))) {
                $this->rtn->resp = "Saved Correctly.";
                $this->rtn->status = 1;
                $eid = unserialize(base64_decode($this->input->post('eid', TRUE)));
                $this->updEmp->setChangePassword(md5($this->input->post("new-pass")), $eid['eid']);
            } else {
                $this->rtn->resp = "The current password is incorrect.";
                $this->rtn->status = 0;
            }
        } else {
            $this->rtn->resp = validation_errors();
            $this->rtn->status = 0;
        }
        echo json_encode($this->rtn);
    }

}
