<div class="row">
    <div class="col-6 col-md-6">
        <form id="employee-form" autocomplete="nope">
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">First Name:</strong>
                <div class="col-sm-6">
                    <input type="text" name="first-name" class="form-control validate" placeholder="First Name">
                </div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Last Name:</strong>
                <div class="col-sm-6">
                    <input type="text" name="last-name" class="form-control validate" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Email:</strong>
                <div class="col-sm-6">
                    <input type="text" name="email" class="form-control validate email" data-msjerror="Invalid email" placeholder="Email">
                </div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Status:</strong>
                <div class="col-sm-6">
                    <select class="custom-select my-1 mr-sm-2 validate" name="status">
                        <option value="" selected>Select a Status...</option>
                        <option value="1">Enabled</option>
                        <option value="2">Disabled</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Password:</strong>
                <div class="col-sm-6">
                    <input type="password" class="form-control validate minlength" minlength="5" data-msjminlength="It is necessary 5 characters minimum." name="new-pass" placeholder="Password">
                </div>
            </div>
            <div class="form-group row">
                <strong class="col-sm-4 col-form-label">Confim Password:</strong>
                <div class="col-sm-6">
                    <input type="password" class="form-control validate repinput" minlength="5" data-msjerror="Password does not match" data-repinput="input[name=new-pass]" name="rpassword" minlength="5" placeholder="Confim Password">
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
    <div class="col-6 col-md-4"></div>
</div>