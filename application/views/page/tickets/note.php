<div class="row">
    <div class="col-12 col-md-12">
        <h4>Ticket Information</h4>
    </div>
    <div class="col-6 col-md-6">
        <div>
            <div class="form-group row">
                <strong class="col-sm-3 col-form-label">Ticket #:</strong>
                <div class="col-sm-6"><?= $ticket->ticket_num ?></div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-3 col-form-label">Subject:</strong>
                <div class="col-sm-6"><?= ucwords($ticket->subject) ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="form-group row">
            <strong class="col-sm-4 col-form-label">Date:</strong>
            <div class="col-sm-6"><?= dateTimeFormat($ticket->date, "d/m/Y") ?></div>
        </div>
        <div class="form-group row">
            <strong class="col-sm-4 col-form-label">Status:</strong>
            <div class="col-sm-6"><span class="<?= $ticket->color ?>"><?= $ticket->status_desc ?></span></div>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <h4>Time Entry Information</h4>
    </div>
    <form id="ticket-form-note" class="col-6 col-md-6" autocomplete="nope" data-tid="<?= str_replace("=", "", base64_encode(serialize(array("tid" => $ticket->ticket_id)))) ?>">
        <div class="form-group row">
            <strong class="col-sm-2 col-form-label">Employee:</strong>
            <div class="col-sm-6">
                <select class="custom-select my-1 mr-sm-2 validate" name="employee" style="width: 100%;">
                    <option value="">Select Employee...</option>
                    <?php
                    $list = $this->getTick->getEmployeesByTicket($ticket->ticket_id);
                    foreach ($list as $val) {
                        ?>
                        <option value="<?= $val->employee_id ?>"><?= ucfirst($val->fullname) . " (" . str_pad($val->employee_id, 3, "0", STR_PAD_LEFT) . ")" ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <strong class="col-sm-2 col-form-label">Date:</strong>
            <div class="col-sm-5">
                <div class="input-group date datetimepicker-time" id="dateFrom" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" name="date_from" placeholder="DD/MM/YYYY HH:SS" data-target="#dateFrom" />
                    <div class="input-group-append" data-target="#dateFrom" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <div style="right: -8px; top: 10px; position: absolute;">To</div>
            </div>
            <div class="col-sm-5">
                <div class="input-group date datetimepicker-time" id="dateTo" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" name="date_to" placeholder="DD/MM/YYYY HH:SS" data-target="#dateTo" />
                    <div class="input-group-append" data-target="#dateTo" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <strong class="col-form-label">Note:</strong>
                <textarea class="form-control validate" name="note" style="height: 150px; width: 520px;"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 mt-4">
                <button type="button" class="btn btn-success mr-1">Save</button>
                <button type="button" class="btn btn-danger back">Cancel</button>
            </div>
        </div>
        <p class="alert alert-danger mt-3 mb-3" style="display: none;"><i class="fas fa-times"></i>&nbsp;&nbsp;<span></span></p>
        <p class="alert alert-success mt-3 mb-3" style="display: none; margin-top: 10px;"><i class="fas fa-check"></i>&nbsp;&nbsp;<span></span></p>
    </form>
</div>