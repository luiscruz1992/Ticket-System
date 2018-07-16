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
class SetTick extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Add new ticket
     * @param type $obj
     */
    public function setNewTickets($obj) {
        $this->db->set('ticket_num', $obj->ticket_num);
        $this->db->set('subject', $obj->subject);
        $this->db->set('description', $obj->description);
        $this->db->set('date', $obj->date);
        $this->db->set('status_id', $obj->status_id);
        $this->db->insert('tickets');
        return $this->db->insert_id();
    }

    /**
     * Add employee by ticket
     * @param type $obj
     */
    public function setTicketEmployees($obj) {
        $this->db->set('ticket_id', $obj->ticket_id);
        $this->db->set('employee_id', $obj->employee_id);
        $this->db->insert('tickets_employees');
    }

    /**
     * Add note by ticket and employee
     * @param type $obj
     */
    public function setNoteTicketEmployee($obj) {
        $this->db->set('employee_id', $obj->employee_id);
        $this->db->set('ticket_id', $obj->ticket_id);
        $this->db->set('date_from', $obj->date_from);
        $this->db->set('date_to', $obj->date_to);
        $this->db->set('note', $obj->note);
        $this->db->insert('note_ticket_employee');
    }
}