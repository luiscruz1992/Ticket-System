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
class Upd extends CI_Model {

    /**
     * Update hash by user_id
     * @param type $hash
     * @param type $userid
     */
    public function setHash($hash, $userid) {
        $this->db->set('hash', $hash);
        //$this->db->set('last_visited', date("Y-m-d H:i:s"));
        $this->db->where('employee_id', $userid);
        $this->db->update('employees');
    }

}
