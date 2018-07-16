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
class RevEmp extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Add new employees
     * @param type $obj
     */
    public function setEmployees($employee_id) {
        $this->db->where('employee_id', $employee_id);
        $this->db->delete('employees');
    }

}
