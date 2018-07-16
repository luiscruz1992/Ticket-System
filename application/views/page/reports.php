<div id="report">
    <form class="row mb-4">
        <div class="col-sm-3"></div>
        <div class="col-sm-3">
            <div class="input-group date datetimepicker-report" id="dateFrom" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" name="date_from" placeholder="DD/MM/YYYY" data-target="#dateFrom" />
                <div class="input-group-append" data-target="#dateFrom" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
        <div class="col-sm-1 text-center">to</div>
        <div class="col-sm-3">
            <div class="input-group date datetimepicker-report" id="date_to" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" name="date_to" placeholder="DD/MM/YYYY" data-target="#date_to" />
                <div class="input-group-append" data-target="#date_to" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-primary btn-block">Generate</button>
        </div>
    </form>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" width="8%">Tikect #</th>
                <th scope="col" width="21%">Employee</th>
                <th scope="col" width="30%">Note</th>
                <th scope="col" width="18%">Date Start</th>
                <th scope="col" width="18%">Date End</th>
                <th scope="col" width="5%">Hours</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-center"><td colspan="6"><label style="color: #b6b6b6;">No record found</label></td></tr>
        </tbody>
        <tfoot>
        <td colspan="6" align="right"><strong>Total:</strong>&nbsp;<span>0</span></td>
        </tfoot>
    </table>
</div>