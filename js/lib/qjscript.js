(function ($) {

    //Validador de elementos
    $.valinit = function (options) {
        defaults = {
            number: null,
            letters: null,
            letters_number: null,
            upper: null
        };
        var opts = $.extend({}, defaults, options);
        //Solo acepta numeros
        if (opts.number) {
            $("body").on("keypress", opts.number, function (evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
            });
        }
        if (opts.letters) {
            //Solo acepta letras
            $("body").on("keypress", opts.letters, function (e) {
                var key = e.keyCode || e.which;
                var tecla = String.fromCharCode(key).toLowerCase();
                var letras = " Ã¡Ã©Ã­Ã³ÃºabcdefghijklmnÃ±opqrstuvwxyz-'";
                var especiales = [9, 8];
                var tecla_especial = false;
                for (var i in especiales) {
                    if (key === especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }
                if (letras.indexOf(tecla) === -1 && !tecla_especial)
                    return false;
            });
        }
        //Only letters and numbers
        if (opts.letters_number) {
            $("body").on("keypress", opts.letters_number, function (e) {
                var key = e.keyCode || e.which;
                var tecla = String.fromCharCode(key).toLowerCase();
                var letras = "abcdefghijklmnopqrstuvwxyz0123456789";
                var especiales = [8]; //8 = backspace
                var tecla_especial = false;
                for (var i in especiales) {
                    if (key === especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }
                if (letras.indexOf(tecla) === -1 && !tecla_especial)
                    return false;
            });
            $('.jqletter').on('paste', function () {
                var element = this;
                var regex = new RegExp("^([a-zA-Z '-]*)$");
                setTimeout(function () {
                    var text = $(element).val();
                    if (!regex.test(text))
                        $(element).val('');
                }, 1);
            });
        }
        //Convert string to uppercase
        if (opts.upper) {
            $("body").on("keyup", opts.upper, function (e) {
                $(this).val($(this).val().toUpperCase());
            });
        }
    };

    //Validador de formulario
    $.fn.qjvalidate = function (options) {
        defaults = {
            errortext: "",
            callbackerror: function () {
            },
            callbackcompleted: function () {
            }
        };
        var options = $.extend({}, defaults, options),
                returnvalidat = true, msj, validar = true, prsmjs = null;
        $(this).find("span.msj-validate").remove();
        $(this).find('input.validate,textarea.validate,select.validate').each(function (index) {
            $(this).removeClass('msj-validate-field');
            //If not disabled
            if ($(this).data("disabled") !== true) {
                //Verifica si si esta en blanco
                if ($(this).val() === '0' || $.trim($(this).val()) === '' || $.trim($(this).val()) === 'null') {
                    validar = true;
                } else {
                    validar = false;
                }

                //Si es contiene la clase email valida
                if ($(this).hasClass('email') && !validar) {
                    var expresion = /^[0-9a-z_\-\.]+@[0-9a-z\-\.]+\.[a-z]{2,4}$/i;
                    var valor = $(this).val();
                    if (!expresion.test(valor)) {
                        validar = true;
                    } else {
                        validar = false;
                    }
                }

                //Si es contiene la clase email valida
                if ($(this).hasClass('passval') && !validar) {
                    var expresion = /(?=.{8,})((?=.*\d)(?=.*[a-z])(?=.*[A-Z])|(?=.*\d)(?=.*[a-zA-Z])(?=.*[\W_])|(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_])).*/;
                    var valor = $(this).val();
                    if (!expresion.test(valor)) {
                        validar = true;
                        prsmjs = ($(this).data('msjpassval') === undefined) ? null : $(this).data("msjpassval");
                    } else {
                        validar = false;
                    }
                }

                //Only accepts numbers, letters and dots
                if ($(this).hasClass('username') && !validar) {
                    var expresion = /^[a-z0-9_.-]{5,15}$/i;
                    var valor = $(this).val();
                    if (!expresion.test(valor)) {
                        validar = true;
                        prsmjs = ($(this).data('msjusername') === undefined) ? null : $(this).data("msjusername");
                    } else {
                        validar = false;
                    }
                }

                //if it contains the valid date class if it is date
                if ($(this).hasClass('date') && !validar && $(this).val()) {
                    var expresion = /(0[1-9]|[12][0-9]|3[01])[/](0[1-9]|1[012])[/](19|20)\d\d/g;
                    var valor = $(this).val();
                    if (!expresion.test(valor)) {
                        validar = true;
                    } else {
                        validar = false;
                    }
                }

                //Validate the minimum characters
                if ($(this).attr('minlength') && !validar) {
                    if ($(this).val().length < parseInt($(this).attr('minlength'))) {
                        validar = true;
                        prsmjs = ($(this).data('msjminlength') === undefined) ? null : $(this).data("msjminlength");
                    } else {
                        validar = false;
                    }
                }

                //Si tiene que repetir la contraseÃ±a
                if ($(this).data('repinput') && !validar) {
                    if ($($(this).data('repinput')).val() !== $(this).val()) {
                        validar = true;
                        prsmjs = ($(this).data('msjrepinput') === undefined) ? null : $(this).data("msjrepinput");
                    } else {
                        validar = false;
                    }
                }

                //Si la contraseÃ±a tiene que ser dirente a la anterior
                if ($(this).data('dftinput') && !validar) {
                    if ($($(this).data('dftinput')).val() === $(this).val()) {
                        validar = true;
                        prsmjs = ($(this).data('msjdftinput') === undefined) ? null : $(this).data("msjdftinput");
                    } else {
                        validar = false;
                    }
                }

                //Muestra lo errores
                if (validar) {
                    msj = ($(this).data('msjerror') === undefined) ? (options.errortext !== undefined) ? options.errortext : '' : $(this).data('msjerror');
                    msj = (prsmjs === null) ? msj : prsmjs;

                    if (msj) {
                        var span = $('<span/>');
                        span.attr('id', 'error' + index);
                        span.html(msj);
                        span.addClass("msj-validate");
                        $(this).after(span);
                    }

                    $(this).addClass('msj-validate-field');
                    if ($(this).data('event') !== undefined) {
                        $(this).bind($(this).data('event'), function () {
                            $(this).removeClass('msj-validate-field');
                            (msj) ? $("#error" + index).remove() : '';
                        });
                    } else {
                        if ($(this).is('select')) {
                            $(this).unbind("change");
                            $(this).change(function () {
                                $(this).removeClass('msj-validate-field');
                                (msj) ? $("#error" + index).remove() : '';
                            });
                        } else {
                            $(this).unbind("click keypress");
                            $(this).bind("click keypress", function () {
                                $(this).removeClass('msj-validate-field');
                                (msj) ? $("#error" + index).remove() : '';
                            });
                        }
                    }
                    returnvalidat = false;
                }
            }
        });
        //Enfoca el primer input con error
        $(".msj-validate-field:first").focus();
        //Ejecutamos el callback
        if (returnvalidat === true) {
            options.callbackcompleted();
        } else {
            options.callbackerror();
        }
        return returnvalidat;
    };

    //Optiene la url base
    $.getbaseurl = function (url) {
        var curl = (url !== undefined) ? url : '';
        return location.protocol + "//" + location.hostname +
                (location.port && ":" + location.port) + "/" + curl;
    };

    /**
     * Show pagination
     */
    $.fn.qjpagination = function (options) {
        $(this).each(function () {
            var opt = $.extend({}, {rpage: 10, plink: 6, blockson: "li", cssClass: ""}, options),
                    table = $("#" + $(this).attr("id")), s = 1, pagination = 0, count = 0,
                    blockpg = $("<div/>").addClass(opt.cssClass);
            var pqf = {
                inittable: function () {
                    count = table.find(opt.blockson).addClass('display').length;
                    s = 1;
                    table.find('.display').hide();
                    table.find('.display').each(function () {
                        if (s <= opt.rpage) {
                            $(this).show();
                            s++;
                        }
                    });
                    pqf.initpagination();
                },
                //Pagination::::::::::::::::::::::::::::::::::::::::
                initpagination: function () {
                    blockpg.html("");
                    if (count > parseInt(opt.rpage)) {
                        var mp = (count / parseFloat(opt.rpage));
                        mp = (mp === +mp && mp !== (mp | 0)) ? (parseInt(mp) + 1) : mp;
                        blockpg.html("");
                        pagination = $("<ul/>");
                        pagination.addClass("pagination");
                        pagination.append($("<li/>").append($("<a/>").html("&laquo;")).data("event", "previous"));
                        for (var a = 1; a <= mp; a++) {
                            if (a === 1) {
                                pagination.append($("<li/>").append($("<a/>").html(a)).data("event", "num").data("page", a).addClass("active"));
                            } else {
                                pagination.append($("<li/>").append($("<a/>").html(a)).data("event", "num").data("page", a).css('display', ((a > 6) ? 'none' : 'inline-block')));
                            }
                        }
                        pagination.append($("<li/>").append($("<a/>").html("&raquo;")).data("event", "next").css('display', 'inline-block'));
                        blockpg.unbind("click");
                        blockpg.on("click", 'ul.pagination li', function () {
                            var li = $(this), l = 1;
                            switch (li.data("event")) {
                                case "num":
                                    s = 1;
                                    table.find('.display').hide();
                                    table.find('.display').each(function (index) {
                                        if ((index + 1) > (parseInt(opt.rpage) * (parseInt(li.data("page")) - 1))) {
                                            if (s <= opt.rpage) {
                                                $(this).show();
                                                s++;
                                            }
                                        }
                                    });
                                    table.next().find("li.active").removeClass("active");
                                    li.addClass("active");
                                    break;
                                case "previous":
                                    if (pagination.find("li.active").prev().data("page")) {
                                        if (!pagination.find("li.active").prev().is(":visible")) {
                                            pagination.find("li").hide();
                                            pagination.find("li").each(function () {
                                                if (($(this).data("page") <= pagination.find("li.active").data("page") &&
                                                        $(this).data("page") >= (pagination.find("li.active").data("page") - opt.plink)) && l <= opt.plink) {
                                                    $(this).show();
                                                    l++;
                                                }
                                            });
                                            pagination.find("li:first-child").show();
                                            pagination.find("li:last-child").show();
                                        }
                                        pagination.find("li.active").prev().click();
                                    }
                                    break;
                                case "next":
                                    if (pagination.find("li.active").next().data("page")) {
                                        if (!pagination.find("li.active").next().is(":visible")) {
                                            pagination.find("li").hide();
                                            pagination.find("li").each(function () {
                                                if ($(this).data("page") > pagination.find("li.active").data("page") && l <= opt.plink) {
                                                    $(this).show();
                                                    l++;
                                                }
                                            });
                                            pagination.find("li:first-child").show();
                                            pagination.find("li:last-child").show();
                                        }
                                        pagination.find("li.active").next().click();
                                    }
                                    break;
                            }
                        });
                        blockpg.append(pagination);
                        table.after(blockpg);
                    }
                }};
            pqf.inittable();
        });
    };

    /**
     * Remove pagination
     * @returns {undefined}
     */
    $.fn.qjpaginationremove = function () {
        var table = this;
        table.next().remove();
    };

    /**
     lpad(10, 4);      // 0010
     lpad(9, 4);       // 0009
     lpad(123, 4);     // 0123
     lpad(10, 4, '-'); // --10
     * @param {type} n
     * @param {type} width
     * @param {type} z
     * @returns {String}
     */
    $.lpad = function (n, width, z) {
        z = z || '0';
        n = n + '';
        return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
    };

    /**
     * ucwords
     * @param {type} str
     * @returns {String}
     */
    $.ucwords = function (str) {
        return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
            return $1.toUpperCase();
        });
    };

    /**
     * strtolower
     * @param {type} str
     * @returns {String}
     */
    $.strtolower = function (str) {
        return (str + '').toLowerCase();
    };

    /**
     * Currency format
     * @param {type} n
     * @param {type} currency
     * @returns {String}
     */
    $.currencyFormat = function (n, currency) {
        return currency + " " + parseFloat(n).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
    };

    /**
     * Button loading
     * @returns {undefined}
     */
    $.fn.btnLoading = function () {
        var $this = $(this), loadingText = ($this.data('text')) ? $this.data('text') : '<i class="fas fa-circle-notch fa-spin"></i> Wait...';
        if (!$this.hasClass("disabled")) {
            if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                $this.addClass("disabled");
                $this.attr("disabled");
            }
            return true;
        } else {
            return false;
        }
    };

    /**
     * Button reset
     * @returns {undefined}
     */
    $.fn.btnReset = function () {
        var $this = $(this);
        $this.removeClass("disabled");
        $this.removeAttr("disabled");
        $this.html($this.data('original-text'));
    };

})(jQuery);