<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    private $data = null;

    public function __construct() {
        parent::__construct();
        $this->data = new stdClass();
        $this->utilities->validateUserSession();
        $this->utilities->sidebarMenu($this->data, "tickets");
        $this->load->model("Employees/GetEmp", "getEmp");
        $this->load->model("Tickets/GetTick", "getTick");
    }

    /**
     * Tickets page
     */
    public function index() {
        $this->data->title = "List of Tickets";
        $this->data->tbody = $this->table_tbody->getListOfTickets();
        $this->data->body = $this->parser->parse('page/tickets', $this->data, true);
        $this->parser->parse('base', $this->data);
    }

    /**
     * Create page
     */
    public function create() {
        $this->data->title = "Tickets Form";
        $this->data->body = $this->parser->parse('page/tickets/create', $this->data, true);
        $this->parser->parse('base', $this->data);
    }

    /**
     * Edit page
     * @param type $vTid
     */
    public function edit($vTid = "") {
        $eid = unserialize(base64_decode($vTid));
        $tick = $this->getTick->getTicketsById($eid['tid']);
        if ($tick) {
            $this->data->ticket = $tick;
            $this->data->title = "Tickets #" . $tick->ticket_num;
            $this->data->body = $this->load->view('page/tickets/edit', $this->data, true);
            $this->data->ticket = "";
            $this->parser->parse('base', $this->data);
        } else {
            redirect("ticket/");
        }
    }

    /**
     * Edit page
     * @param type $vTid
     */
    public function view($vTid = "") {
        $tid = unserialize(base64_decode($vTid));
        $tick = $this->getTick->getTicketsById($tid['tid']);
        if ($tick) {
            $this->data->ticket = $tick;
            $this->data->title = "Tickets #" . $tick->ticket_num;
            $this->data->note = $this->table_tbody->getNoteTicketEmployeeByTicket($tid['tid']);
            $this->data->tblemployees = $this->table_tbody->getEmployeesByTicket($tid['tid']);
            $this->data->body = $this->load->view('page/tickets/view', $this->data, true);
            $this->data->ticket = "";
            $this->parser->parse('base', $this->data);
        } else {
            redirect("ticket/");
        }
    }

    /**
     * Note page
     * @param type $vTid
     */
    public function note($vTid) {
        $tid = unserialize(base64_decode($vTid));
        $tick = $this->getTick->getTicketsById($tid['tid']);
        if ($tick) {
            $this->data->ticket = $tick;
            $this->data->title = "Time Entry From";
            $this->data->body = $this->load->view('page/tickets/note', $this->data, true);
            $this->data->ticket = "";
            $this->parser->parse('base', $this->data);
        } else {
            redirect("ticket/");
        }
    }

    /**
     * Edit note page
     * @param type $vTid
     */
    public function editNote($vTid = "") {
        $nid = unserialize(base64_decode($vTid));
        $tick = $this->getTick->getNoteTicketEmployeeByTicketById($nid['nid']);
        if ($tick) {
            $this->data->note = $tick;
            $this->data->title = "Time Entry From";
            $this->data->body = $this->load->view('page/tickets/edit-note', $this->data, true);
            $this->data->note = "";
            $this->parser->parse('base', $this->data);
        } else {
            redirect("ticket/");
        }
    }

}
