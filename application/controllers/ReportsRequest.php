<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReportsRequest extends CI_Controller {

    private $rtn = null, $obj = null;

    public function __construct() {
        parent::__construct();
        $this->rtn = new stdClass();
        $this->obj = new stdClass();
    }

    /**
     * Get report by dates
     */
    public function getReportByDates() {
        $from = dateTimeFormat($this->input->post('date_from'), "Y-m-d");
        $to = dateTimeFormat($this->input->post('date_to'), "Y-m-d");
        $this->rtn = $this->table_tbody->getReportByDates($from, $to);
        echo json_encode($this->rtn);
    }

}
