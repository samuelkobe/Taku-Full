jQuery(document).ready(function ($) {

    var startDate = "";
    var endDate = "";
    var startDateObj = $("#startDate");
    var endDateObj = $("#endDate");
    startDateObj.blur(function (event)
    {
        str = this.value;
        var res = str.split("-");
        startDate = res[1] + "-" + res[2] + "-" + res[0];

    });

    endDateObj.blur(function (event)
    {
        str = this.value;
        var res = str.split("-");
        endDate = res[1] + "-" + res[2] + "-" + res[0];

    });


    // Get Events List


    function getEventList() {
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'html',
            data: {
                action: 'getEventsList',
                startDate: startDate,
                endDate: endDate,
                bookableItemId: $('#bookableitems :selected').val()
            },
            success: function (data) {
                jQuery("#events-list").html('');
                jQuery("#events-list").append(data);

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

            }
        });

    }
    //Bookable Item Change

    $("#bookableitems").change(function () {

        if (startDate == "" || endDate == "") {
            $("#alert-mesg").css("display", "block");
            $("#alert-mesg").text("Please Select the Start and End date.");
        }
        else if (this.value == 0) {
            $("#alert-mesg").css("display", "block");
            $("#alert-mesg").text("Please Select a Bookable Item to see the Events.");
        }

        else {
            $("#alert-mesg").css("display", "none");
            getEventList();
        }
    });


    //Save Button Click


    $('input[type=radio]').live('click', function () {
        var value = this.value;
        $("#EventIdentifier").val(this.id);
        $("#form-step1").hide();
        $("#booking-form").show();
    });

    $("#backtocalender").bind("click", function () {

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
        if ($("#email").val().length == 0) {
            $("#email").css("background", "#FFAAAA");
            is_error = false;
        }

        if ($("#description").val().length == 0) {
            $("#description").css("background", "#FFAAAA");
            is_error = false;
        }

        return is_error;
    }

    $("#submit-reservation").bind("click", function () {
        //$("#booking-form").delegate("#submit-reservation", "click", function() {
        if (validateStep1()) {
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
                    $("#booking-form").hide();
                    $("#form-step1").show();
                    //jQuery("#events-list").html('');
                    $("input:radio[name=event-item]:checked").prop('checked', false);
                    $(".sagenda_alert").css("display", "inline-block");
                    getEventList();

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    });
});    