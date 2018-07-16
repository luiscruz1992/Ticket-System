<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UpdTick
 *
 * @author eren
 */
class UpdTick extends CI_Model {

    /**
     * Update ticket
     * @param type $obj
     */
    public function setTickets($obj) {
        $this->db->set('subject', $obj->subject);
        $this->db->set('description', $obj->description);
        $this->db->set('date', $obj->date);
        $this->db->set('status_id', $obj->status_id);
        $this->db->where('ticket_id', $obj->ticket_id);
        $this->db->update('tickets');
    }

    /**
     * Update note ticket employee
     * @param type $obj
     */
    public function setNoteTicketEmployee($obj) {
        $this->db->set('employee_id', $obj->employee_id);
        $this->db->set('date_from', $obj->date_from);
        $this->db->set('date_to', $obj->date_to);
        $this->db->set('note', $obj->note);
        $this->db->where('note_id', $obj->note_id);
        $this->db->update('note_ticket_employee');
    }
}