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
class RevTick extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Remove ticket by ticket id
     * @param type $ticket_id
     */
    public function setTicket($ticket_id) {
        $this->db->where('ticket_id', $ticket_id);
        $this->db->delete('tickets');
    }

    /**
     * Remove employee in ticket
     * @param type $employee_id
     * @param type $ticket_id
     */
    public function setTicketsEmployees($employee_id, $ticket_id) {
        $this->db->where_not_in('employee_id ', $employee_id);
        $this->db->where('ticket_id ', $ticket_id);
        $this->db->delete('tickets_employees');
    }

    /**
     * Remove note ticket of employee by note id
     * @param type $note_id
     */
    public function setNote($note_id) {
        $this->db->where('note_id ', $note_id);
        $this->db->delete('note_ticket_employee');
    }

    /**
     * Remove employee in tickets_employees 
     * @param type $employee_id
     */
    public function setTicketsEmployeesByEmployeeId($employee_id) {
        $this->db->where('employee_id ', $employee_id);
        $this->db->delete('tickets_employees');
    }

}
