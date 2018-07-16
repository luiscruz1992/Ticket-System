<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Upd
 *
 * @author eren
 */
class UpdEmp extends CI_Model {

    /**
     * Update employees by status_id
     * @param type $obj
     * @param type $employee_id
     */
    public function setEmployee($obj, $employee_id) {
        $this->db->set('first_name', $obj->first_name);
        $this->db->set('last_name', $obj->last_name);
        $this->db->set('email', $obj->email);
        $this->db->set('status_id', $obj->status_id);
        $this->db->where('employee_id', $employee_id);
        $this->db->update('employees');
    }

    /**
     * Change password by employee id
     * @param type $password
     * @param type $employee_id
     */
    public function setChangePassword($password, $employee_id) {
        $this->db->set('password', $password);
        $this->db->where('employee_id', $employee_id);
        $this->db->update('employees');
    }
}