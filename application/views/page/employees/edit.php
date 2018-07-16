<div class="row">
    <div class="col-12 col-md-12">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Password</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="col-6 col-md-6">
                    <form id="employee-form-edit" autocomplete="nope" data-eid="<?= str_replace("=", "", base64_encode(serialize(array("eid" => $employee->employee_id)))) ?>">
                        <div class="form-group row mt-3">
                            <strong class="col-sm-4 col-form-label">First Name:</strong>
                            <div class="col-sm-6">
                                <input type="text" name="first-name" class="form-control validate" value="<?= $employee->first_name ?>" placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <strong class="col-sm-4 col-form-label">Last Name:</strong>
                            <div class="col-sm-6">
                                <input type="text" name="last-name" class="form-control validate" value="<?= $employee->last_name ?>" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <strong class="col-sm-4 col-form-label">Email:</strong>
                            <div class="col-sm-6">
                                <input type="text" name="email" class="form-control validate email" value="<?= $employee->email ?>" data-msjerror="Invalid email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <strong class="col-sm-4 col-form-label">Status:</strong>
                            <div class="col-sm-6">
                                <select class="custom-select my-1 mr-sm-2 validate" name="status">
                                    <option value="1" <?= ($employee->status_id == 1) ? "selected" : "" ?>>Enabled</option>
                                    <option value="2" <?= ($employee->status_id == 2) ? "selected" : "" ?>>Disabled</option>
                                </select>
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
            </div>
            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                <div class="col-6 col-md-6">
                    <form id="employee-form-edit-password" autocomplete="nope">
                        <div class="form-group row mt-3">
                            <strong class="col-sm-4 col-form-label">Current password:</strong>
                            <div class="col-sm-6">
                                <input type="password" class="form-control validate minlength" minlength="5" data-msjminlength="It is necessary 5 characters minimum." name="current-pass" placeholder="Current Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <strong class="col-sm-4 col-form-label">Password:</strong>
                            <div class="col-sm-6">
                                <input type="password" class="form-control validate minlength" minlength="5" data-msjminlength="It is necessary 5 characters minimum." name="new-pass" placeholder="New Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <strong class="col-sm-4 col-form-label">Confim Password:</strong>
                            <div class="col-sm-6">
                                <input type="password" class="form-control validate repinput" minlength="5" data-msjerror="Password does not match" data-repinput="input[name=new-pass]" name="rpassword" minlength="5" placeholder="Confim New Password">
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
            </div>
        </div>
    </div>
</div>