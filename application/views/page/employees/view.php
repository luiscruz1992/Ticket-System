<div class="row" id="vew-employee">
    <div class="col-6 col-md-6">
        <div class="form-group row">
            <div class="col-sm-10 mb-4">
                <button type="button" class="btn btn-success mr-1" data-eid="<?= str_replace("=", "", base64_encode(serialize(array("eid" => $employee->employee_id)))) ?>">Edit</button>
                <button type="button" class="btn btn-danger back">Cancel</button>
            </div>
        </div>
        <div>
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">First Name:</strong>
                <div class="col-sm-6"><?= ucwords($employee->first_name) ?></div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Last Name:</strong>
                <div class="col-sm-6"><?= ucwords($employee->last_name) ?></div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Email:</strong>
                <div class="col-sm-6"><?= $employee->email ?></div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Date Created:</strong>
                <div class="col-sm-6"><?= $employee->created_on ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4"></div>
</div>

<div class="row" id="tickets-employee">
    <div class="col-12 col-md-12">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tickets-tab" data-toggle="tab" href="#tickets" role="tab" aria-controls="tickets" aria-selected="true">Tickets</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tickets" role="tabpanel" aria-labelledby="tickets-tab">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Description</th>
                            <th scope="col">Employee(s)</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Actions</th>            
                        </tr>
                    </thead>
                    <tbody><?= $tbltickets ?></tbody>
                </table>
            </div>
        </div>  
    </div>
</div>