<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Get
 *
 * @author eren
 */
class SetEmp extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Add new employees
     * @param type $obj
     */
    public function setNewEmployees($obj) {
        $this->db->set('first_name', $obj->first_name);
        $this->db->set('last_name', $obj->last_name);
        $this->db->set('email', $obj->email);
        $this->db->set('status_id', $obj->status_id);
        $this->db->set('password', $obj->password);
        $this->db->insert('employees', $obj);
    }

}
