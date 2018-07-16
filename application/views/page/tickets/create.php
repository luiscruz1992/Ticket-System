<form id="ticket-form" autocomplete="nope">
    <div class="row">
        <div class="col-6 col-md-6">
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Subject:</strong>
                <div class="col-sm-6">
                    <input type="text" name="subject" class="form-control validate" placeholder="Subject">
                </div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Employee(s):</strong>
                <div class="col-sm-6">
                    <select class="select-multiple" name="employee[]" multiple style="width: 100%;">
                        <?php
                        $list = $this->getEmp->getListofEmployeeActive();
                        foreach ($list as $val) {
                            ?>
                            <option value="<?= $val->employee_id ?>"><?= ucfirst($val->fullname) . " (" . str_pad($val->employee_id, 3, "0", STR_PAD_LEFT) . ")" ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <strong class="col-form-label">Description:</strong>
                    <textarea class="form-control validate" name="description" style="height: 200px; width: 428px;"></textarea>
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
        </div>
        <div class="col-6 col-md-6">
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Date:</strong>
                <div class="col-sm-6">
                    <div class="input-group date datetimepicker-time" id="dateTime" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="date" placeholder="DD/MM/YYYY HH:SS" data-target="#dateTime" />
                        <div class="input-group-append" data-target="#dateTime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Status:</strong>
                <div class="col-sm-6">
                    <select class="custom-select my-1 mr-sm-2 validate" name="status">
                        <option value="" selected>Select a Status...</option>
                        <option value="3">Open</option>
                        <option value="4">Close</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>