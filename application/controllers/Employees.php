<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

    private $data = null;

    public function __construct() {
        parent::__construct();
        $this->data = new stdClass();
        $this->utilities->validateUserSession();
        $this->utilities->sidebarMenu($this->data, "employees");
        $this->load->model("Employees/GetEmp", "getEmp");
    }

    /**
     * Employee page
     */
    public function index() {
        $this->data->title = "List of Employees";
        $this->data->tbody = $this->table_tbody->getListOfEmployees();
        $this->data->body = $this->parser->parse('page/employees', $this->data, true);
        $this->parser->parse('base', $this->data);
    }

    /**
     * Create page
     */
    public function create() {
        $this->data->title = "Employee Form";
        $this->data->body = $this->parser->parse('page/employees/create', $this->data, true);
        $this->parser->parse('base', $this->data);
    }

    /**
     * Edit page
     * @param type $vEid
     */
    public function edit($vEid = "") {
        $eid = unserialize(base64_decode($vEid));
        $emp = $this->getEmp->getEmployeeById($eid['eid']);
        if ($emp) {
            $this->data->employee = $emp;
            $this->data->title = "Employee #" . str_pad($eid['eid'], 3, "0", STR_PAD_LEFT);
            $this->data->body = $this->load->view('page/employees/edit', $this->data, true);
            $this->data->employee = "";
            $this->parser->parse('base', $this->data);
        } else {
            redirect("employees/");
        }
    }

    /**
     * View page
     * @param type $vEid
     */
    public function view($vEid = "") {
        $eid = unserialize(base64_decode($vEid));
        $emp = $this->getEmp->getEmployeeById($eid['eid']);
        if ($emp) {
            $this->data->employee = $emp;
            $this->data->title = "Employee #" . str_pad($eid['eid'], 3, "0", STR_PAD_LEFT);
            $this->data->tbltickets = $this->table_tbody->getListOfTicketsByEmployees($eid['eid']);
            $this->data->body = $this->load->view('page/employees/view', $this->data, true);
            $this->data->employee = "";
            $this->parser->parse('base', $this->data);
        } else {
            redirect("employees/");
        }
    }

}
