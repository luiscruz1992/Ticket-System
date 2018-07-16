<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RequestTickets extends CI_Controller {

    private $obj = null, $rtn = null;

    public function __construct() {
        parent::__construct();
        $this->obj = new stdClass();
        $this->rtn = new stdClass();
        $this->load->model("Tickets/GetTick", "getTick");
        $this->load->model("Tickets/SetTick", "setTick");
        $this->load->model("Tickets/RevTick", "revTick");
        $this->load->model("Tickets/UpdTick", "updTick");
        $this->load->model("Employees/GetEmp", "getEmp");
    }

    /**
     * Create new ticket
     */
    public function setNewTicket() {
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        $this->form_validation->set_rules('employee[]', 'Employees', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'integer|required|in_list[3,4]');
        if ($this->form_validation->run() == TRUE) {
            $this->obj->ticket_num = $this->getTick->getTicketNumber();
            $this->obj->subject = trim($this->input->post('subject', TRUE));
            $this->obj->description = nl2br(trim($this->input->post('description', TRUE)));
            $this->obj->date = dateTimeFormat($this->input->post('date', TRUE), "Y-m-d H:i:s");
            $this->obj->status_id = intval($this->input->post('status', TRUE));
            $ticket_id = $this->setTick->setNewTickets($this->obj);
            $employee = $this->input->post('employee', TRUE);
            foreach ($employee as $val) {
                $this->obj->ticket_id = $ticket_id;
                $this->obj->employee_id = $val;
                $this->setTick->setTicketEmployees($this->obj);
            }
            $this->rtn->resp = "Saved Correctly.";
            $this->rtn->status = 1;
        } else {
            $this->rtn->resp = validation_errors();
            $this->rtn->status = 0;
        }
        echo json_encode($this->rtn);
    }

    /**
     * Edit ticket
     */
    public function setEditTicket() {
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        $this->form_validation->set_rules('employee[]', 'Employees', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'integer|required|in_list[3,4]');
        if ($this->form_validation->run() == TRUE) {
            $tid = unserialize(base64_decode($this->input->post('tid', TRUE)));
            $this->obj->subject = trim($this->input->post('subject', TRUE));
            $this->obj->description = nl2br(trim($this->input->post('description', TRUE)));
            $this->obj->date = dateTimeFormat($this->input->post('date', TRUE), "Y-m-d H:i:s");
            $this->obj->status_id = intval($this->input->post('status', TRUE));
            $this->obj->ticket_id = $tid['tid'];
            $this->updTick->setTickets($this->obj);
            //Remove employees
            $employee = $this->input->post('employee', TRUE);
            $this->revTick->setTicketsEmployees($employee, $tid['tid']);
            $list = $this->getTick->getJustEmployeesIdByTicket($tid['tid']);
            foreach ($employee as $val) {
                $this->obj->ticket_id = $tid['tid'];
                $this->obj->employee_id = $val;
                //If it does not exist
                if (empty($list)) {
                    $this->setTick->setTicketEmployees($this->obj);
                } else if (!in_array($val, explode(",", $list->employees))) {
                    $this->setTick->setTicketEmployees($this->obj);
                }
            }
            $this->rtn->resp = "Saved Correctly.";
            $this->rtn->status = 1;
        } else {
            $this->rtn->resp = validation_errors();
            $this->rtn->status = 0;
        }
        echo json_encode($this->rtn);
    }

    /**
     * Remove ticket
     */
    public function setRemoveTicket() {
        $tid = unserialize(base64_decode($this->input->post('tid', TRUE)));
        $this->revTick->setTicket($tid['tid']);
        $this->rtn->resp = $this->table_tbody->getListOfTickets();
        echo json_encode($this->rtn);
    }

    /**
     * Add new note by ticket and employee
     */
    public function setNoteTicketEmployee() {
        $tid = unserialize(base64_decode($this->input->post('tid', TRUE)));
        $this->form_validation->set_rules('employee', 'Employee', 'trim|required|integer');
        $this->form_validation->set_rules('date_from', 'Date', 'trim|required');
        $this->form_validation->set_rules('date_to', 'Date', 'trim|required');
        $this->form_validation->set_rules('note', 'Note', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $this->obj->ticket_id = $tid['tid'];
            $this->obj->employee_id = trim($this->input->post('employee', TRUE));
            $this->obj->date_to = dateTimeFormat($this->input->post('date_to', TRUE), "Y-m-d H:i:s");
            $this->obj->date_from = dateTimeFormat($this->input->post('date_from', TRUE), "Y-m-d H:i:s");
            $this->obj->note = nl2br(trim($this->input->post('note', TRUE)));
            if ($this->obj->date_to > $this->obj->date_from) {
                $this->setTick->setNoteTicketEmployee($this->obj);
                $this->rtn->resp = "Saved Correctly.";
                $this->rtn->status = 1;
            } else {
                $this->rtn->resp = "The second date has to be higher than the first.";
                $this->rtn->status = 0;
            }
        } else {
            $this->rtn->resp = validation_errors();
            $this->rtn->status = 0;
        }
        echo json_encode($this->rtn);
    }

    /**
     * Remove note
     */
    public function setRemoveNote() {
        $nid = unserialize(base64_decode($this->input->post('nid', TRUE)));
        $this->revTick->setNote($nid['nid']);
    }

    /**
     * Edit note ticket employee
     */
    public function setEditNoteTicketEmployee() {
        $nid = unserialize(base64_decode($this->input->post('nid', TRUE)));
        $this->form_validation->set_rules('employee', 'Employee', 'trim|required|integer');
        $this->form_validation->set_rules('date_from', 'Date', 'trim|required');
        $this->form_validation->set_rules('date_to', 'Date', 'trim|required');
        $this->form_validation->set_rules('note', 'Note', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $this->obj->employee_id = trim($this->input->post('employee', TRUE));
            $this->obj->date_to = dateTimeFormat($this->input->post('date_to', TRUE), "Y-m-d H:i:s");
            $this->obj->date_from = dateTimeFormat($this->input->post('date_from', TRUE), "Y-m-d H:i:s");
            $this->obj->note = nl2br(trim($this->input->post('note', TRUE)));
            $this->obj->note_id = $nid['nid'];
            if ($this->obj->date_to > $this->obj->date_from) {
                $this->updTick->setNoteTicketEmployee($this->obj);
                $this->rtn->resp = "Saved Correctly.";
                $this->rtn->status = 1;
            } else {
                $this->rtn->resp = "The second date has to be higher than the first.";
                $this->rtn->status = 0;
            }
        } else {
            $this->rtn->resp = validation_errors();
            $this->rtn->status = 0;
        }
        echo json_encode($this->rtn);
    }

    /**
     * Remove tickets employees by employee id
     */
    public function setRemoveTicketsEmployeesByEmployeeId() {
        $eid = unserialize(base64_decode($this->input->post('eid', TRUE)));
        $tid = unserialize(base64_decode($this->input->post('tid', TRUE)));
        $this->revTick->setTicketsEmployeesByEmployeeId($eid['eid']);
        $this->rtn->note = $this->table_tbody->getNoteTicketEmployeeByTicket($tid['tid']);
        echo json_encode($this->rtn);
    }

}
