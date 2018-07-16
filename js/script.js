
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    /**
     * Tooltip
     */
    if ($('[data-toggle="tooltip"]').length) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    /**
     * Employee selector
     */
    if ($(".select-multiple").length) {
        $(".select-multiple").select2({
            placeholder: 'Select Employee(s)...'
        });
    }

    /**
     * The date and time selector with time
     */
    if ($(".datetimepicker-time").length) {
        $(".datetimepicker-time").datetimepicker({
            format: 'DD/MM/YYYY hh:mm',
            icons: {
                time: "far fa-clock",
                date: "far fa-calendar-alt",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
    }

    /**
     * The date and time selector without time
     */
    if ($(".datetimepicker-report").length) {
        $(".datetimepicker-report").datetimepicker({format: 'DD/MM/YYYY'});
    }

    /**
     * Back history
     */
    $(".back").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            history.back();
        }
    });


    /***************************************************************************
     * Login
     **/

    /**
     * Verify the user to give access
     */
    $('.form-signin .btn-primary').click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            $('.form-signin').qjvalidate({
                errortext: "",
                callbackerror: function () {
                    $btn.btnReset();
                }, callbackcompleted: function () {
                    $.post("/requestDashboard/login",
                            $(".form-signin").serialize(), function ($rtn) {
                        if ($rtn.status) {
                            location.href = "/dashboard";
                        } else {
                            $(".form-signin .alert-danger span").html($rtn.resp);
                            $(".form-signin .alert-danger").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        }
                    }, 'json');
                }
            });
        }
    });
    
    /**
     * When you press enter in email
     */
    $(".form-signin input[name=email]").on('keyup', function (e) {
        if (e.keyCode === 13 && !e.shiftKey) {
            $(".form-signin input[name=password]").val("").focus();
        }
    });
    
    /**
     * When you press enter in password
     */
    $(".form-signin input[name=password]").on('keyup', function (e) {
        if (e.keyCode === 13 && !e.shiftKey) {
            $('.form-signin .btn-primary').click();
        }
    });

    /***************************************************************************
     * Employees
     **/

    /**
     * Show new employees
     */
    $("#employees .btn-primary").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            location.href = "/employees/create";
        }
    });

    /**
     * Add new employee
     */
    $("#employee-form .btn-success").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            $('#employee-form').qjvalidate({
                errortext: "",
                callbackerror: function () {
                    $btn.btnReset();
                }, callbackcompleted: function () {
                    $.post("/employeesRequest/setNewEmployees",
                            $("#employee-form").serialize(), function (data) {
                        var $rtn = $.parseJSON(data);
                        if ($rtn.status) {
                            $("#employee-form .alert-success span").html($rtn.resp);
                            $("#employee-form .alert-success").fadeIn().delay(2500).fadeOut(function () {
                                location.href = "/employees";
                            });
                        } else {
                            $("#employee-form .alert-danger span").html($rtn.resp);
                            $("#employee-form .alert-danger").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        }
                    });
                }
            });
        }
    });

    /**
     * Remove employee by employee id
     */
    $("#employees").on("click", ".fa-trash-alt", function () {
        var $this = $(this);
        $icon = $this.removeClass("fas fa-trash-alt").addClass("fas fa-circle-notch fa-spin");
        $.confirm({
            title: 'Confirm action!',
            content: 'You really want to delete this record?',
            theme: 'bootstrap', // 'material', 'bootstrap'
            buttons: {
                accept: {
                    text: 'Accept',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function () {
                        if ($(".btn-blue").btnLoading()) {
                            $.post("/employeesRequest/setRemoveEmployee",
                                    {eid: $this.data("eid")}, function (data) {
                                var $rtn = $.parseJSON(data);
                                $("#employees tbody").html($rtn.resp);
                                $this.parent().parent().remove();
                            });
                        }
                    }
                }, cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-red',
                    action: function () {
                        $icon.removeClass("fas fa-circle-notch fa-spin").addClass("fas fa-trash-alt");
                    }
                }
            }
        });
    });

    /**
     * View employee by employee id
     */
    $("#employees").on("click", ".fa-search", function () {
        var $this = $(this);
        $icon = $this.removeClass("fa-search").addClass("fas fa-circle-notch fa-spin");
        location.href = "/employees/view/" + $(this).data("eid");
    });

    /**
     * Show edit employee
     */
    $("#vew-employee .btn-success").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            location.href = "/employees/edit/" + $(this).data("eid");
        }
    });

    /**
     * Edit employee
     */
    $("#employee-form-edit .btn-success").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            $('#employee-form-edit').qjvalidate({
                errortext: "",
                callbackerror: function () {
                    $btn.btnReset();
                }, callbackcompleted: function () {
                    $.post("/employeesRequest/setEditEmployees",
                            $("#employee-form-edit").serialize() + "&eid=" + $("#employee-form-edit").data("eid"), function (data) {
                        var $rtn = $.parseJSON(data);
                        if ($rtn.status) {
                            $("#employee-form-edit .alert-success span").html($rtn.resp);
                            $("#employee-form-edit .alert-success").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        } else {
                            $("#employee-form-edit .alert-danger span").html($rtn.resp);
                            $("#employee-form-edit .alert-danger").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        }
                    });
                }
            });
        }
    });

    /**
     * Edit password employee
     */
    $("#employee-form-edit-password .btn-success").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            $('#employee-form-edit-password').qjvalidate({
                errortext: "",
                callbackerror: function () {
                    $btn.btnReset();
                }, callbackcompleted: function () {
                    $.post("/employeesRequest/setChangePassword",
                            $("#employee-form-edit-password").serialize() + "&eid=" + $("#employee-form-edit").data("eid"), function (data) {
                        var $rtn = $.parseJSON(data);
                        if ($rtn.status) {
                            $("#employee-form-edit-password .alert-success span").html($rtn.resp);
                            $("#employee-form-edit-password .alert-success").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        } else {
                            $("#employee-form-edit-password .alert-danger span").html($rtn.resp);
                            $("#employee-form-edit-password .alert-danger").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        }
                    });
                }
            });
        }
    });

    /***************************************************************************
     * Tickets
     */

    /**
     * Show new tickets
     */
    $("#tickets .btn-primary").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            location.href = "/tickets/create";
        }
    });

    /**
     * Add new ticket
     */
    $("#ticket-form .btn-success").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            $('#ticket-form').qjvalidate({
                errortext: "",
                callbackerror: function () {
                    $btn.btnReset();
                }, callbackcompleted: function () {
                    $.post("/requestTickets/setNewTicket",
                            $("#ticket-form").serialize(), function (data) {
                        var $rtn = $.parseJSON(data);
                        if ($rtn.status) {
                            $("#ticket-form .alert-success span").html($rtn.resp);
                            $("#ticket-form .alert-success").fadeIn().delay(2500).fadeOut(function () {
                                location.href = "/tickets";
                            });
                        } else {
                            $("#ticket-form .alert-danger span").html($rtn.resp);
                            $("#ticket-form .alert-danger").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        }
                    });
                }
            });
        }
    });

    /**
     * Show edit tickets 
     */
    $("#tickets").on("click", ".fa-edit", function () {
        var $this = $(this);
        $icon = $this.removeClass("fa-edit").addClass("fas fa-circle-notch fa-spin");
        location.href = "/tickets/edit/" + $(this).parent().data("tid");
    });

    /**
     * Show view tickets 
     */
    $("#tickets").on("click", ".fa-search", function () {
        var $this = $(this);
        $icon = $this.removeClass("fa-search").addClass("fas fa-circle-notch fa-spin");
        location.href = "/tickets/view/" + $(this).parent().data("tid");
    });

    /**
     * Remove ticket by ticket id
     */
    $("#tickets").on("click", ".fa-trash-alt", function () {
        var $this = $(this);
        $icon = $this.removeClass("fas fa-trash-alt").addClass("fas fa-circle-notch fa-spin");
        $.confirm({
            title: 'Confirm action!',
            content: 'You really want to delete this record?',
            theme: 'bootstrap', // 'material', 'bootstrap'
            buttons: {
                accept: {
                    text: 'Accept',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function () {
                        if ($(".btn-blue").btnLoading()) {
                            $.post("/requestTickets/setRemoveTicket",
                                    {tid: $this.parent().data("tid")}, function (data) {
                                var $rtn = $.parseJSON(data);
                                $("#tickets tbody").html($rtn.resp);
                                $this.parent().parent().remove();
                            });
                        }
                    }
                }, cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-red',
                    action: function () {
                        $icon.removeClass("fas fa-circle-notch fa-spin").addClass("fas fa-trash-alt");
                    }
                }
            }
        });
    });

    /**
     * Edit ticket
     */
    $("#ticket-form-edit .btn-success").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            $('#ticket-form-edit').qjvalidate({
                errortext: "",
                callbackerror: function () {
                    $btn.btnReset();
                }, callbackcompleted: function () {
                    $.post("/requestTickets/setEditTicket",
                            $("#ticket-form-edit").serialize() + "&tid=" + $("#ticket-form-edit").data("tid"), function (data) {
                        var $rtn = $.parseJSON(data);
                        if ($rtn.status) {
                            $("#ticket-form-edit .alert-success span").html($rtn.resp);
                            $("#ticket-form-edit .alert-success").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        } else {
                            $("#ticket-form-edit .alert-danger span").html($rtn.resp);
                            $("#ticket-form-edit .alert-danger").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        }
                    });
                }
            });
        }
    });

    /**
     * Show edit ticket in the table
     */
    $("#tickets").on("click", ".fa-edit", function () {
        var $this = $(this);
        $icon = $this.removeClass("fa-edit").addClass("fas fa-circle-notch fa-spin");
        location.href = "/tickets/edit/" + $(this).parent().data("tid");
    });

    /**
     * Show edit ticket in the view
     */
    $("#vew-ticket .btn-success").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            location.href = "/tickets/edit/" + $btn.data("tid");
        }
    });

    /**
     * Show add new ticket
     */
    $("#tickets").on("click", ".fa-plus", function () {
        var $this = $(this);
        if (!$this.hasClass("disabled-icon")) {
            $icon = $this.removeClass("fa-plus").addClass("fas fa-circle-notch fa-spin");
            location.href = "/tickets/note/" + $(this).parent().data("tid");
        }
    });

    /**
     * Add new note by ticket and employee
     */
    $("#ticket-form-note .btn-success").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            $('#ticket-form-note').qjvalidate({
                errortext: "",
                callbackerror: function () {
                    $btn.btnReset();
                }, callbackcompleted: function () {
                    $.post("/requestTickets/setNoteTicketEmployee",
                            $("#ticket-form-note").serialize() + "&tid=" + $("#ticket-form-note").data("tid"), function (data) {
                        var $rtn = $.parseJSON(data);
                        if ($rtn.status) {
                            $("#ticket-form-note .alert-success span").html($rtn.resp);
                            $("#ticket-form-note .alert-success").fadeIn().delay(2500).fadeOut(function () {
                                location.href = "/tickets";
                            });
                        } else {
                            $("#ticket-form-note .alert-danger span").html($rtn.resp);
                            $("#ticket-form-note .alert-danger").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        }
                    });
                }
            });
        }
    });

    /**
     * Remove note by note id
     */
    $("#time-entries").on("click", ".fa-trash-alt", function () {
        var $this = $(this);
        $icon = $this.removeClass("fas fa-trash-alt").addClass("fas fa-circle-notch fa-spin");
        $.confirm({
            title: 'Confirm action!',
            content: 'You really want to delete this record?',
            theme: 'bootstrap', // 'material', 'bootstrap'
            buttons: {
                accept: {
                    text: 'Accept',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function () {
                        if ($(".btn-blue").btnLoading()) {
                            $.post("/requestTickets/setRemoveNote",
                                    {nid: $this.parent().data("nid")}, function () {
                                $this.parent().parent().remove();
                            });
                        }
                    }
                }, cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-red',
                    action: function () {
                        $icon.removeClass("fas fa-circle-notch fa-spin").addClass("fas fa-trash-alt");
                    }
                }
            }
        });
    });

    /**
     * Show edit note 
     */
    $("#time-entries").on("click", ".fa-edit", function () {
        var $this = $(this);
        $icon = $this.removeClass("fa-edit").addClass("fas fa-circle-notch fa-spin");
        location.href = "/tickets/editNote/" + $(this).parent().data("nid");
    });

    /**
     * Edit note by ticket and employee
     */
    $("#ticket-form-note-edit .btn-success").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            $('#ticket-form-note-edit').qjvalidate({
                errortext: "",
                callbackerror: function () {
                    $btn.btnReset();
                }, callbackcompleted: function () {
                    $.post("/requestTickets/setEditNoteTicketEmployee",
                            $("#ticket-form-note-edit").serialize() + "&nid=" + $("#ticket-form-note-edit").data("nid"), function (data) {
                        var $rtn = $.parseJSON(data);
                        if ($rtn.status) {
                            $("#ticket-form-note-edit .alert-success span").html($rtn.resp);
                            $("#ticket-form-note-edit .alert-success").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        } else {
                            $("#ticket-form-note-edit .alert-danger span").html($rtn.resp);
                            $("#ticket-form-note-edit .alert-danger").fadeIn().delay(2500).fadeOut(function () {
                                $btn.btnReset();
                            });
                        }
                    });
                }
            });
        }
    });

    /**
     * View employee
     */
    $("#ticket-employees").on("click", ".fa-edit", function () {
        var $this = $(this);
        $icon = $this.removeClass("fa-edit").addClass("fas fa-circle-notch fa-spin");
        location.href = "/employees/view/" + $(this).parent().data("eid");
    });

    /**
     * Remove employee by employee id
     */
    $("#ticket-employees").on("click", ".fa-trash-alt", function () {
        var $this = $(this);
        $icon = $this.removeClass("fas fa-trash-alt").addClass("fas fa-circle-notch fa-spin");
        $.confirm({
            title: 'Confirm action!',
            content: 'You really want to delete this record?',
            theme: 'bootstrap', // 'material', 'bootstrap'
            buttons: {
                accept: {
                    text: 'Accept',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function () {
                        if ($(".btn-blue").btnLoading()) {
                            $.post("/requestTickets/setRemoveTicketsEmployeesByEmployeeId",
                                    {eid: $this.parent().data("eid"), tid: $this.parent().data("tid")}, function ($rtn) {
                                $this.parent().parent().remove();
                                $("#time-entries tbody").html($rtn.note);
                            }, 'json');
                        }
                    }
                }, cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-red',
                    action: function () {
                        $icon.removeClass("fas fa-circle-notch fa-spin").addClass("fas fa-trash-alt");
                    }
                }
            }
        });
    });

    /***************************************************************************
     * Report
     */

    /**
     * Search by date
     */
    $("#report .btn-primary").click(function () {
        var $btn = $(this);
        if ($btn.btnLoading()) {
            $('#report form').qjvalidate({
                errortext: "",
                callbackerror: function () {
                    $btn.btnReset();
                }, callbackcompleted: function () {
                    $.post("/reportsRequest/getReportByDates",
                            $("#report form").serialize(), function ($rtn) {
                        $("#report table tbody").html($rtn.resp);
                        $("#report table tfoot span").html($rtn.total);
                        $btn.btnReset();
                    }, 'json');
                }
            });
        }
    });

});