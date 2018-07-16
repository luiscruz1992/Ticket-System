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
class Get extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Check if the user exists
     * @param type $email
     * @param type $pass
     * @return type
     */
    public function getVerifyCredentials($email, $pass) {
        $this->db->select('*');
        $this->db->from('employees');
        $this->db->where('email', $email);
        $this->db->where('password', md5($pass));
        return $this->db->get()->row();
    }

    /**
     * Get user by email
     * @param type $email
     * @return type
     */
    public function getUserByEmail($email) {
        $this->db->select('*');
        $this->db->from('employees');
        $this->db->where('email', $email);
        return $this->db->get()->row();
    }

    /**
     * Get user by hash
     * @return type
     */
    public function getUserByHash() {
        $this->db->select('*');
        $this->db->from('employees');
        $this->db->where('hash', $this->session->hash);
        return $this->db->get()->row();
    }

    /**
     * Get status by type
     * @return type
     */
    public function getstatusByType($type) {
        $this->db->select('*');
        $this->db->from('status s');
        $this->db->where('s.type', $type);
        return $this->db->get()->result();
    }
    
        /**
     * Get code number by patient
     * @return type
     */
    public function getCodeNumber() {
        $this->db->select("lpad(count(p.code_number) + 1, 4, '0') as code");
        $this->db->from('patients_by_doctor p');
        $this->db->order_by('p.code_number', 'desc');
        $this->db->limit(1);
        return $this->db->get()->row()->code;
    }
}