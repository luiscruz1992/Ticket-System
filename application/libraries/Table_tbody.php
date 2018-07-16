<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Table
 *
 * @author escanor
 */
class Table_tbody {

    private $CI = null;

    public function __construct() {
        $this->CI = & get_instance();
    }

    /**
     * Get list of employees
     * @return string
     */
    public function getListOfEmployees() {
        $this->CI->load->model('Employees/GetEmp', 'getEmp');
        $this->CI->load->model('Get', 'get');
        $user_id = $this->CI->get->getUserByHash()->employee_id;
        $data = $this->CI->getEmp->getListOfEmployees();
        $html = "";
        if ($data) {
            foreach ($data as $val) {
                $opts = ($val->employee_id == $user_id) ? "" : '&nbsp;<i class="fas fa-trash-alt pointer red-lbl"  data-toggle="tooltip" data-placement="top" title="Remove employee" data-eid="' . base64_encode($val->employee_id) . '"></i>';
                $html .= '<tr>
                    <td>' . str_pad($val->employee_id, 3, "0", STR_PAD_LEFT) . '</td>
                    <td>' . ucwords($val->first_name) . '</td>
                    <td>' . ucwords($val->last_name) . '</td>
                    <td>' . $val->email . '</td>
                    <td>' . $val->date_created . '</td>
                    <td><label class="' . $val->color . '">' . $val->description . '</label></td>
                    <td class="text-center"><i class="fas fa-search pointer" data-eid="' . str_replace("=", "", base64_encode(serialize(array("eid" => $val->employee_id)))) . '" data-toggle="tooltip" data-placement="top" title="View employee"></i>' . $opts . '</td>
                </tr>';
            }
        } else {
            $html = '<tr class="text-center"><td colspan="6"><label style="color: #b6b6b6;">No record found</label></td></tr>';
        }
        return $html;
    }

    /**
     * Get list of tickets by employees
     * @return string
     */
    public function getListOfTicketsByEmployees($employee_id) {
        $this->CI->load->model('Tickets/GetTick', 'getTick');
        $data = $this->CI->getTick->getListOfTicketsByEmployees($employee_id);
        $html = "";
        if ($data) {
            foreach ($data as $val) {
                $html .= '<tr>
                        <td>' . $val->ticket_num . '</td>
                        <td>' . $val->subject . '</td>
                        <td>' . ucwords($val->employees) . '</td>
                        <td>' . $val->date . '</td>
                        <td><label class="' . $val->color . '">' . $val->status_desc . '</label></td>
                        <td class="text-center" data-tid="' . str_replace("=", "", base64_encode(serialize(array("tid" => $val->ticket_id)))) . '">
                        <i class="fas fa-search pointer" data-toggle="tooltip" data-placement="top" title="View ticket"></i>
                        &nbsp;<i class="fas fa-edit pointer" data-toggle="tooltip" data-placement="top" title="Edit ticket"></i>
                        &nbsp;<i class="fas fa-trash-alt pointer red-lbl"  data-toggle="tooltip" data-placement="top" title="Remove ticket"></i></td>
                    </tr>';
            }
        } else {
            $html = '<tr class="text-center"><td colspan="6"><label style="color: #b6b6b6;">No record found</label></td></tr>';
        }
        return $html;
    }

    /**
     * Get list of tickets
     * @return string
     */
    public function getListOfTickets() {
        $this->CI->load->model('Tickets/GetTick', 'getTick');
        $data = $this->CI->getTick->getListOfTickets();
        $html = "";
        if ($data) {
            foreach ($data as $val) {
                $status =  ($val->status_id == 4) ? "disabled-icon" : "pointer";
                $title =  ($val->status_id == 4) ? "This ticket is disabled" : "Add note";
                $html .= '<tr>
                        <td>' . $val->ticket_num . '</td>
                        <td>' . $val->subject . '</td>
                        <td>' . ucwords($val->employees) . '</td>
                        <td>' . $val->date . '</td>
                        <td><label class="' . $val->color . '">' . $val->status_desc . '</label></td>
                        <td class="text-center" data-tid="' . str_replace("=", "", base64_encode(serialize(array("tid" => $val->ticket_id)))) . '">
                        <i class="fas fa-plus '.$status.'" data-toggle="tooltip" data-placement="top" title="'.$title.'"></i>
                        &nbsp;<i class="fas fa-search pointer" data-toggle="tooltip" data-placement="top" title="View ticket"></i>
                        &nbsp;<i class="fas fa-edit pointer" data-toggle="tooltip" data-placement="top" title="Edit ticket"></i>
                        &nbsp;<i class="fas fa-trash-alt pointer red-lbl"  data-toggle="tooltip" data-placement="top" title="Remove ticket"></i></td>
                    </tr>';
            }
        } else {
            $html = '<tr class="text-center"><td colspan="6"><label style="color: #b6b6b6;">No record found</label></td></tr>';
        }
        return $html;
    }

    /**
     * Get list of note ticket of employee by ticket
     * @param type $ticket_id
     * @return string
     */
    public function getNoteTicketEmployeeByTicket($ticket_id) {
        $this->CI->load->model('Tickets/GetTick', 'getTick');
        $data = $this->CI->getTick->getNoteTicketEmployeeByTicket($ticket_id);
        $html = "";
        if ($data) {
            foreach ($data as $val) {
                $html .= '<tr>
                        <td>' . ucwords($val->fullname) . '</td>                        
                        <td>' . $val->date . '</td>                        
                        <td>' . $val->note . '</td>
                        <td class="text-center" data-nid="' . str_replace("=", "", base64_encode(serialize(array("nid" => $val->note_id)))) . '">
                        &nbsp;<i class="fas fa-edit pointer" data-toggle="tooltip" data-placement="top" title="Edit note"></i>
                        &nbsp;<i class="fas fa-trash-alt pointer red-lbl"  data-toggle="tooltip" data-placement="top" title="Remove note"></i></td>
                    </tr>';
            }
        } else {
            $html = '<tr class="text-center"><td colspan="6"><label style="color: #b6b6b6;">No record found</label></td></tr>';
        }
        return $html;
    }

    /**
     * Get employees by ticket
     * @param type $ticket_id
     * @return string
     */
    public function getEmployeesByTicket($ticket_id) {
        $this->CI->load->model('Tickets/GetTick', 'getTick');
        $data = $this->CI->getTick->getEmployeesByTicket($ticket_id);
        $html = "";
        if ($data) {
            foreach ($data as $val) {
                $html .= '<tr>
                        <td>' . ucwords($val->first_name) . '</td>                        
                        <td>' . ucwords($val->last_name) . '</td>                        
                        <td>' . $val->email . '</td>                        
                        <td class="text-center" data-tid="' . str_replace("=", "", base64_encode(serialize(array("tid" => $ticket_id)))) . '" data-eid="' . str_replace("=", "", base64_encode(serialize(array("eid" => $val->employee_id)))) . '">
                        &nbsp;<i class="fas fa-edit pointer" data-toggle="tooltip" data-placement="top" title="Edit employee"></i>
                        &nbsp;<i class="fas fa-trash-alt pointer red-lbl"  data-toggle="tooltip" data-placement="top" title="Remove employee"></i></td>
                    </tr>';
            }
        } else {
            $html = '<tr class="text-center"><td colspan="6"><label style="color: #b6b6b6;">No record found</label></td></tr>';
        }
        return $html;
    }

    /**
     * Get report by dates
     * @param type $from
     * @param type $to
     * @return string
     */
    public function getReportByDates($from, $to) {
        $rtn = new stdClass();
        $this->CI->load->model('Tickets/GetTick', 'getTick');
        $data = $this->CI->getTick->getReportByDates($from, $to);
        $html = "";
        $total = 0;
        if ($data) {
            foreach ($data as $val) {
                $html .= '<tr>
                        <td>' . $val->ticket_num . '</td>                        
                        <td>' . ucwords($val->fullname) . '</td>     
                        <td>' . $val->note . '</td>
                        <td>' . $val->date_from . '</td>    
                        <td>' . $val->date_to . '</td>    
                        <td align="right">' . $val->hours . '</td>                                
                    </tr>';
                $total = $total + floatval($val->hours);
            }
        } else {
            $html = '<tr class="text-center"><td colspan="6"><label style="color: #b6b6b6;">No record found</label></td></tr>';
        }
        $rtn->resp = $html;
        $rtn->total = $total;
        return $rtn;
    }

}
