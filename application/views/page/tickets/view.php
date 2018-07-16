<div class="row" id="vew-ticket">
    <div class="col-6 col-md-6">
        <div class="form-group row">
            <div class="col-sm-10 mb-4">
                <button type="button" class="btn btn-success mr-1" data-tid="<?= str_replace("=", "", base64_encode(serialize(array("tid" => $ticket->ticket_id)))) ?>">Edit</button>
                <button type="button" class="btn btn-danger back">Cancel</button>
            </div>
        </div>
        <div>
            <div class="form-group row">
                <strong class="col-sm-3 col-form-label">Ticket #:</strong>
                <div class="col-sm-6"><?= $ticket->ticket_num ?></div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-3 col-form-label">Subject:</strong>
                <div class="col-sm-6"><?= ucwords($ticket->subject) ?></div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-3 col-form-label">Date:</strong>
                <div class="col-sm-6"><?= dateTimeFormat($ticket->date, "d/m/Y") ?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <strong class="col-form-label">Description:</strong>
                    <p><?= $ticket->description ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4"></div>
</div>

<div class="row" id="time-entries-employee">
    <div class="col-12 col-md-12">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="time-entries-tab" data-toggle="tab" href="#time-entries" role="tab" aria-controls="time-entries" aria-selected="true">Time Entries</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ticket-employees-tab" data-toggle="tab" href="#ticket-employees" role="tab" aria-controls="ticket-employees" aria-selected="true">Employees</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="time-entries" role="tabpanel" aria-labelledby="time-entries-tab">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="20%">Employee</th>
                            <th scope="col" width="20%">Date</th>
                            <th scope="col" width="55%">Description</th>
                            <th scope="col" width="5%" class="text-center">Actions</th>            
                        </tr>
                    </thead>
                    <tbody><?= $note ?></tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="ticket-employees" role="tabpanel" aria-labelledby="employees-tab">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Actions</th>            
                        </tr>
                    </thead>
                    <tbody><?= $tblemployees ?></tbody>
                </table>
            </div>
        </div>  
    </div>
</div>