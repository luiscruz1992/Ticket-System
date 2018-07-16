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
class GetTick extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get code tickets by tickets
     * @return type
     */
    public function getTicketNumber() {
        $this->db->select("lpad(count(t.ticket_id) + 1, 4, '0') as code");
        $this->db->from('tickets t');
        $this->db->order_by('t.ticket_id', 'desc');
        $this->db->limit(1);
        return $this->db->get()->row()->code;
    }

    /**
     * Get list of tickets
     * @return type
     */
    public function getListOfTickets() {
        $this->db->select("t.ticket_id, t.ticket_num, t.subject, 
                           group_concat(concat(ep.first_name, ' ',ep.last_name) SEPARATOR ', ') as employees,
                           date_format(t.date, '%m/%d/%Y') as date, t.status_id,
                           s.description as status_desc, s.color");
        $this->db->from('tickets t');
        $this->db->join('status s', 's.status_id=t.status_id', 'inner');
        $this->db->join('tickets_employees e', 'e.ticket_id=t.ticket_id', 'left');
        $this->db->join('employees ep', 'ep.employee_id=e.employee_id', 'left');
        $this->db->group_by('t.ticket_id');
        $this->db->order_by('t.ticket_id', 'desc');
        return $this->db->get()->result();
    }

    /**
     * Get list of tickets by employees
     * @param type $employee_id
     * @return type
     */
    public function getListOfTicketsByEmployees($employee_id) {
        $this->db->select("t.ticket_id, t.ticket_num, t.subject, 
                           group_concat(concat(ep.first_name, ' ',ep.last_name) SEPARATOR ', ') as employees,
                           date_format(t.date, '%m/%d/%Y') as date, 
                           s.description as status_desc, s.color");
        $this->db->from('tickets t');
        $this->db->join('status s', 's.status_id=t.status_id', 'inner');
        $this->db->join('tickets_employees e', 'e.ticket_id=t.ticket_id', 'left');
        $this->db->join('employees ep', 'ep.employee_id=e.employee_id', 'left');
        $this->db->where("e.employee_id", $employee_id);
        $this->db->group_by('t.ticket_id');
        $this->db->order_by('t.ticket_id', 'desc');
        return $this->db->get()->result();
    }

    /**
     * Get ticket by id
     * @param type $ticket_id
     * @return type
     */
    public function getTicketsById($ticket_id) {
        $this->db->select("t.*,group_concat(e.employee_id) as employees,
                           s.description as status_desc, s.color");
        $this->db->from('tickets t');
        $this->db->join('tickets_employees e', 'e.ticket_id=t.ticket_id', 'left');
        $this->db->join('status s', 's.status_id=t.status_id', 'inner');
        $this->db->where("t.ticket_id", $ticket_id);
        $this->db->group_by('t.ticket_id');
        return $this->db->get()->row();
    }

    /**
     * Get employees by ticket
     * @param type $ticket_id
     * @return type
     */
    public function getEmployeesByTicket($ticket_id) {
        $this->db->select("e.employee_id, e.first_name,' ',e.last_name, e.email,
                           concat(e.first_name,' ',e.last_name) as fullname");
        $this->db->from('tickets_employees t');
        $this->db->join('employees e', 'e.employee_id=t.employee_id', 'inner');
        $this->db->where("t.ticket_id", $ticket_id);
        $this->db->group_by('e.employee_id');
        return $this->db->get()->result();
    }

    /**
     * Get just employee id by ticket
     * @param type $ticket_id
     * @return type
     */
    public function getJustEmployeesIdByTicket($ticket_id) {
        $this->db->select("group_concat(t.employee_id) as employees");
        $this->db->from('tickets_employees t');
        $this->db->where("t.ticket_id", $ticket_id);
        $this->db->group_by('t.ticket_id');
        return $this->db->get()->row();
    }

    /**
     * Get list of note ticket of employee by ticket
     * @param type $ticket_id
     * @return type
     */
    public function getNoteTicketEmployeeByTicket($ticket_id) {
        $this->db->select("n.note_id,concat(e.first_name,' ',e.last_name) as fullname,
                           date_format(n.date_from, '%m/%d/%Y %h:%i %p') as date, n.note");
        $this->db->from('note_ticket_employee n');
        $this->db->join('employees e', 'e.employee_id=n.employee_id ', 'inner');
        $this->db->where("n.ticket_id", $ticket_id);
        return $this->db->get()->result();
    }

    /**
     * Get note ticket of employee by note id
     * @param type $note_id
     * @return type
     */
    public function getNoteTicketEmployeeByTicketById($note_id) {
        $this->db->select("*");
        $this->db->from('note_ticket_employee n');
        $this->db->where("n.note_id", $note_id);
        return $this->db->get()->row();
    }

    /**
     * Get report by dates
     * @return type
     */
    public function getReportByDates($from, $to) {
        $this->db->select("t.ticket_num, concat(e.first_name,' ',e.last_name) as fullname,
                         date_format(te.date_from, '%m/%d/%Y %h:%i %p') as date_from,
                         date_format(te.date_to, '%m/%d/%Y %h:%i %p') as date_to,
                         te.note,round((time_to_sec(timediff(te.date_to, te.date_from))/60)/60, 1) as hours");
        $this->db->from('note_ticket_employee te');
        $this->db->join('tickets t', 't.ticket_id=te.ticket_id ', 'inner');
        $this->db->join('employees e', 'e.employee_id=te.employee_id ', 'inner');
        $this->db->where("te.date_from >=", $from);
        $this->db->where("te.date_from <=", $to);
        return $this->db->get()->result();
    }

}
