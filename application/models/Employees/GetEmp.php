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
class GetEmp extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Check if the user exists
     * @param type $email
     * @param type $pass
     * @return type
     */
    public function getListOfEmployees() {
        $this->db->select("e.employee_id,e.first_name,e.last_name,e.email,
                        date_format(e.date_created, '%d/%m/%Y') as date_created,
                        s.status_id, s.description, s.color");
        $this->db->from('employees e ');
        $this->db->join('status s', 's.status_id=e.status_id');
        return $this->db->get()->result();
    }

    /**
     * Get Employee by employee id
     * @return type
     */
    public function getEmployeeById($employee_id) {
        $this->db->select("e.employee_id,e.first_name, e.last_name, e.email, e.status_id,
                           date_format(e.date_created, '%d/%m/%Y %h:%i %p') as created_on");
        $this->db->from('employees e');
        $this->db->join('status s', 's.status_id=e.status_id');
        $this->db->where('employee_id', $employee_id);
        return $this->db->get()->row();
    }

    /**
     * Get list of employee active
     * @return type
     */
    public function getListofEmployeeActive() {
        $this->db->select("e.employee_id,concat(e.first_name,' ',e.last_name) as fullname");
        $this->db->from('employees e ');
        $this->db->where('e.status_id', 1);
        return $this->db->get()->result();
    }
}