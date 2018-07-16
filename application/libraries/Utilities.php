<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utilities
 *
 * @author eren
 */
class Utilities {

    private $CI = null;

    public function __construct() {
        $this->CI = & get_instance();
    }

    /**
     * Initializes the menu shadow
     * @param type $obj
     * @param type $opt
     */
    public function sidebarMenu($obj, $opt = "") {
        $obj->tickets = ($opt == "tickets") ? " active" : "";
        $obj->employees = ($opt == "employees") ? " active" : "";
        $obj->reports = ($opt == "reports") ? " active" : "";
    }

    /**
     * Shade the menu option
     * @param type $data
     * @param type $opt
     */
    public function setHoverNav($data, $opt) {
        $data->$opt = " active";
    }

    /**
     * If the user is not logged in, redirects to the login
     */
    public function validateUserSession() {
        if (!$this->CI->session->has_userdata('hash')) {
            redirect(base_url());
        } else {
            if (!$this->CI->get->getUserByHash()) {
                $this->CI->session->sess_destroy();
                redirect(base_url("signOut"));
            }
        }
    }

    /**
     * Generate a random password
     * @param type $length
     * @return string
     */
    public function getRandomPassword($length = 10) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
        return $result;
    }

}
