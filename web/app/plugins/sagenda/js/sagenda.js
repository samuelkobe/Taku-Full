jQuery(document).ready(function ($) {

    function padNum(num, padding) {
        num = '' + num;
        while (num.length < padding) {
            num = '0' + num;
        }
        return num;
    }

    function formatDate(date) {
        var language = $("#sagenda_lang").val();
       // alert(date);
        if (language == "fr-FR") {
            var monthNames = ["janv.", "févr.", "mars", "avr.", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."];
        }
        else {
            var monthNames = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];
        }
        
        return padNum(date.getDate(), 2) + ' ' +
                monthNames[date.getMonth()] + ' ' +
                padNum(date.getFullYear(), 4);
    }

    function ReverseFormatDate(date) {
        if (typeof date != 'undefined') {
            date = date.replace('janv.', 'jan');
            date = date.replace('févr.', 'feb');
            date = date.replace('mars', 'mar');
            date = date.replace('avr.', 'apr');
            date = date.replace('mai', 'apr');
            date = date.replace('juin', 'jun');
            date = date.replace('juil.', 'jul');
            date = date.replace('août', 'aug');
            date = date.replace('sept.', 'sep');
            date = date.replace('oct.', 'oct');
            date = date.replace('nov.', 'nov');
            date = date.replace('déc.', 'dec');


            date = new Date(date);
            return padNum(date.getMonth() + 1, 2) + '-' +
                    padNum(date.getDate(), 2) + '-' +
                    padNum(date.getFullYear(), 4);
        }
    }


    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var startDate = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var endDate = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate() + 7, 0, 0, 0, 0);
    $('#dpd2').val(formatDate(endDate));
    $('#dpd1').val(formatDate(now));
    $('#dp4').datepicker({
        format: 'yyyy-mm-dd',
        onRender: function (date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    })
            .on('changeDate', function (ev) {
                startDate = new Date(ev.date);
                endDate = new Date(ev.date);
                if (ev.date.valueOf() > endDate.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    endDate.setValue(newDate);
                    $("#bookableitems option[value='0']").attr('selected', 'selected');
                    $('#alert').show().find('strong').text('The start date can not be greater then the end date');
                }
                else {                  
                   
                    $('#dpd1').val(formatDate(new Date($('#dp4').data('date'))));
                }
                $('#dp4').datepicker('hide');
                $('#dp5')[0].focus();

            });
    $('#dp5').datepicker({
        format: 'yyyy-mm-dd',
        onRender: function (date) {
            console.log(endDate.valueOf());
            return date.valueOf() <= startDate.valueOf() ? 'disabled' : '';
        }
    })
            .on("show", function (date) {
                $(this).datepicker('update');
            })
            .on('changeDate', function (ev) {

                if (ev.date.valueOf() < startDate.valueOf()) {
                    $('#alert').show().find('strong').text('The end date can not be less then the start date');
                } else {
                    $("#bookableitems option[value='0']").attr('selected', 'selected');
                    endDate = new Date(ev.date);
                    $('#alert').hide();
                    $('#dpd2').val(formatDate(new Date($('#dp5').data('date'))));

                }
                $('#dp5').datepicker('hide');
            });


// Get Events List


    function getEventList() {
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'html',
            data: {
                action: 'getEventsList',
                startDate: ReverseFormatDate($('#dpd1').val()),
                endDate: ReverseFormatDate($('#dpd2').val()),
                bookableItemId: $('#bookableitems :selected').val(),
                bookableItem: $("#bookableitems :selected").text()
            },
            success: function (data) {
                jQuery("#events-list").html('');
                jQuery("#events-list").append(data);

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

            }
        });
    }
    getEventList();

    //Bookable Item Change

    $("#bookableitems").change(function () {

        if ($('#dpd1').val().length == 0 || $('#dpd2').val().length == 0) {
            $("#alert-mesg").css("display", "block");
            $("#alert-mesg").text("Please Select the Start and End date.");
        }
        else if (this.value == 0) {
            $("#alert-mesg").css("display", "block");
            $("#alert-mesg").text("Please Select a Bookable Item to see the Events");
        }
        else {
            $("#alert-mesg").css("display", "none");
            getEventList();

        }
    });




    //Save Button Click

    $("#bookableitemsss").change(function () {



    });


    $("#events-list").delegate("input[name='event-item']", "click", function () {

        var value = this.value;
        $("#EventIdentifier").val(this.id);
        $("#form-step1").hide();
        $("#booking-form").show();
    });


    $("#booking-form").delegate("#backtocalender", "click", function () {

        $("#booking-form").hide();
        $("#form-step1").show();
    });

    function validateStep1() {
        is_error = true;
        if ($("#firstName").val().length == 0) {
            $("#firstName").css("background", "#FFAAAA");
            is_error = false;
        }
        else {
            $("#firstName").css("background", "#FFFFFF");
        }
        if ($("#lastName").val().length == 0) {
            $("#lastName").css("background", "#FFAAAA");
            is_error = false;
        }
        if ($("#phonenumber").val().length == 0) {
            $("#phonenumber").css("background", "#FFAAAA");
            is_error = false;
        }
        var x = $("#email").val();
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");

        if ($("#email").val().length == 0) {
            $("#email").css("background", "#FFAAAA");
            is_error = false;
        }
        else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
            $("#email").css("background", "#FFAAAA");
            is_error = false;
        }

        if ($("#description").val().length == 0) {
            //  $("#description").css("background", "#FFAAAA");
            //    is_error = false;
        }
        return is_error;
    }

    $("#booking-form").delegate("#submit-reservation", "click", function () {
        if (validateStep1()) {
            $("#sagenda-fields").hide();
            jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'html',
                data: {
                    action: 'subscribeForEvent',
                    EventIdentifier: $('#EventIdentifier').val(),
                    endDate: $('#dpd2').val(),
                    BookableItemId: $('#bookableitems :selected').val(),
                    EventScheduleId: $("input:radio[name=event-item]:checked").val(),
                    Courtesy: $("input:radio[name=optionsRadios]:checked").val(),
                    FirstName: $('#firstName').val(),
                    LastName: $('#lastName').val(),
                    PhoneNumber: $('#phonenumber').val(),
                    Email: $('#email').val(),
                    Description: $('#description').val()
                },
                success: function (data) {
                    //$('#subscribe_event').trigger("reset");
                    obj = JSON.parse(data);
                    $("#booking-form").hide();
                    $("#form-step1").show();
                    //jQuery("#events-list").html('');
                    if (obj.Success == true) {
                        $("input:radio[name=event-item]:checked").prop('checked', false);
                        $(".sagenda_alert").css("display", "inline-block");
                        $(".sagenda_alert-faliure").css("display", "none");
                        getEventList();
                    }
                    else {
                        $(".sagenda_alert-faliure").text(obj.Message);
                        $(".sagenda_alert-faliure").css("display", "inline-block");

                    }
                    console.log(obj.Message);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
        else {
            $("#sagenda-fields").show();
        }
    });
});    