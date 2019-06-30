function init() {
    mobile_menu();
    file_upload_trigger();
    load_datePicker();
    init_select_tag();
    delete_your_msg();
    my_select();
    my_select_dropdown();
    // readURL();
    set_panel();
    add_to_delete();
    add_to_send();
    add_to_send_invite();
    add_number_to_select2();
    $(".tag_box .tag_item span").unbind('click');
    $(".tag_box .tag_item span").on('click', function () {
        $(this).closest(".tag_item").remove();
    });


}

function add_to_delete() {
    $('.add_to_delete').on('click', function () {
        $('.add_to_delete').removeClass('deleteit');
        $(this).addClass('deleteit');
        $("#modal_delete .modal-title").text('حذف');
        $("#modal_delete .modal-body p").text('آیا مطمئنید آیتم ' + $(this).data('itemdetails') + ' حذف شود؟');
        $("#modal_delete").modal('show');
    });


}

function delete_row() {
    var deleteurl = $('.add_to_delete.deleteit').data('deleteurl');
    window.location.replace(deleteurl);
}


function add_to_send() {
    $('.add_to_send').on('click', function () {
        $('.add_to_send').removeClass('sendit');
        $(this).addClass('sendit');
        $("#modal_send .modal-title").text('ارسال');
        $("#modal_send .modal-body p").text('آیا مطمئنید  ' + $(this).data('itemdetails') + ' ارسال شود؟');
        $("#modal_send").modal('show');
    });


}

function add_to_send_invite() {
    $('.add_to_invite').on('click', function () {
        $('.add_to_invite').removeClass('sendit');
        $(this).addClass('sendit');
        $("#modal_invite .modal-title").text('ارسال');
        $("#modal_invite .modal-body p").text('آیا مطمئنید  ' + $(this).data('itemdetails') + ' ارسال شود؟');
        $("#modal_invite").modal('show');
    });
}

function send_invite() {
    var _url = $('.add_to_invite.sendit').data('inviteurl');
    console.log(_url );
    var _day = $("#day option:selected").val();
    console.log(_day );
    var finalURL='';

    if(_url.includes("sendSMS")){
        finalURL=_url;
    }else{
        finalURL=_url + '/' + _day;
    }

    console.log(finalURL);
    $.ajax({
        url: finalURL, //this is the submit URL
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            $(window).scrollTop(0);
            $('#modal_invite').modal('hide');
            $('#modal-yes-invite').prop('disabled', false);
            $('#modal-yes-invite').html('بله');
            if (data.status === 'success') {
                window.location.reload();
            } else {
                alert(data.message);
            }
        },
        beforeSend: function() {
            // setting a timeout
            $('#modal-yes-invite').prop('disabled', true);
            $('#modal-yes-invite').html('در حال ارسال اطلاعات ...');
        },
        error: function(xhr) { // if error occured
            alert("Error occured.please try again");
        },
        complete: function() {

        },
    });

}
function send_row() {
    console.log('send_row');
    var _url = $('.add_to_send.sendit').data('sendurl');
    console.log(_url );
    var _date = $("#date option:selected").val();
    console.log(_date);
    $.ajax({
        url: _url + '/' + _date, //this is the submit URL
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            $(window).scrollTop(0);
            $('#modal_send').modal('hide');
            $('#modal-yes').prop('disabled', false);
            $('#modal-yes').html('بله');
            if (data.status === 'success') {
                window.location.reload();
            } else {
                alert(data.message);
            }
        },
        beforeSend: function() {
            // setting a timeout
            $('#modal-yes').prop('disabled', true);
            $('#modal-yes').html('در حال ارسال اطلاعات ...');
        },
        error: function(xhr) { // if error occured
            alert("Error occured.please try again");
            console.log('XHR ERROR ' + XMLHttpRequest.status);
            return JSON.parse(XMLHttpRequest.responseText);
        },
        complete: function() {

        },
    });

}


function mobile_menu() {
    $(".mobile_menu_btn").click(function () {
        if (!$(".wrapper").hasClass("to_left")) {
            $(".wrapper").addClass("to_left");
        } else {
            $(".wrapper").removeClass("to_left");
        }
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.inp_img').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(".imgInp").change(function () {
    readURL(this);
});

function my_select() {
    $(document).ready(function () {
        if ($('.select2-multiple').length > 0) {
            $('.select2-multiple').select2({
                dir: 'rtl',
            });
        }
    });
}

function my_select_dropdown() {
    $(document).ready(function () {
        if ($('.select2-dropdown').length > 0) {
            $('.select2-dropdown').select2({
                multiple: false,
                dir: 'rtl',
            });
        }
    });
}

function my_select_all(elem) {
    var sel = $(elem).data('for');
    if ($(elem).is(':checked')) {
        $("#" + sel + " > option").prop("selected", "selected");
        $("#" + sel).trigger("change");
    } else {
        $("#" + sel + " > option").prop('selected', false);
        $("#" + sel).trigger("change");
    }
}


function init_select_tag() {
    if ($('.placeholder').length > 0) {
        $(".placeholder").select2({
            dir: "rtl",
            theme: "bootstrap",
        });
    }

    //$('.js-example-basic-multiple').select2({allowClear: true});
}

function delete_your_msg() {
    $(".yes_dlt_your_msg").on('click', function () {
        var your_message_box = $(this).closest(".your_message_box");
        $(".your_message", your_message_box).fadeOut();
    });
}

function file_upload_trigger() {
    $(".upload_file_btn").click(function () {
        var parent = $(this).closest(".like_input");
        $(".my_trigger", parent).click();
    });
}


function load_datePicker() {

    if ($('#dateInput').length > 0) {
        kamaDatepicker('dateInput', {

            // placeholder text
            placeholder: "",

            // enable 2 digits
            twodigit: true,

            // close calendar after select
            closeAfterSelect: true,

            // nexy / prev buttons
            nextButtonIcon: "بعدی",
            previousButtonIcon: "قبلی ",

            // color of buttons
            buttonsColor: "#fff",

            // force Farsi digits
            forceFarsiDigits: false,

            // highlight today
            markToday: true,

            // highlight holidays
            markHolidays: true,

            // highlight user selected day
            highlightSelectedDay: true,

            // true or false
            sync: true,

            // display goto today button
            gotoToday: true

        });
    }

    if ($('#dateInput1').length > 0) {
        kamaDatepicker('dateInput1', {

            // placeholder text
            placeholder: "",

            // enable 2 digits
            twodigit: true,

            // close calendar after select
            closeAfterSelect: true,

            // nexy / prev buttons
            nextButtonIcon: "بعدی",
            previousButtonIcon: "قبلی ",

            // color of buttons
            buttonsColor: "#fff",

            // force Farsi digits
            forceFarsiDigits: false,

            // highlight today
            markToday: true,

            // highlight holidays
            markHolidays: true,

            // highlight user selected day
            highlightSelectedDay: true,

            // true or false
            sync: true,

            // display goto today button
            gotoToday: true

        });
    }

}

function date_checker(element, type) {
    var for_hour = [8, 23];
    var for_min = [0, 59];
    var steps = 5;
    var balacer;
    var data_type = $(element).data('type');
    if (data_type == 'hour') {
        balacer = for_hour;
    }
    if (data_type == 'min') {
        balacer = for_min;
    }
    if (type == 'inc') {
        var num = parseInt($(element).text());
        if (data_type == 'min') {
            num += steps;
        } else {
            num += 1;
        }
        if (num > balacer[1]) {
            num = balacer[0];
        }
        $(element).text(number_formater(num));
    }
    if (type == 'dec') {
        var num = parseInt($(element).text());
        if (data_type == 'min') {
            num -= steps;
        } else {
            num -= 1;
        }
        if (num < balacer[0]) {
            num = balacer[1];
        }
        $(element).text(number_formater(num));
    }
    if (parseInt($(".start_time .hour_num").text()) >= parseInt($(".end_time .hour_num").text())) {
        if (parseInt($(".end_time .hour_num").text()) == for_hour[1]) {
            $(".start_time .hour_num").text(number_formater(for_hour[1] - 1));
        } else {
            $(".end_time .hour_num").text(number_formater(parseInt($(".end_time .hour_num").text()) + 1));
        }

    }
}

function set_panel() {
    $('.set_panel_element .up').on('click', function () {
        var parent = $(this).closest('.set_panel_element');
        date_checker($('.target_text', parent), 'inc');
    });
    $('.set_panel_element .down').on('click', function () {
        var parent = $(this).closest('.set_panel_element');
        date_checker($('.target_text', parent), 'dec');
    });
}

function number_formater(num) {
    num = parseInt(num);
    if (num < 10) {
        return '0' + num;
    } else {
        return num.toString();
    }
}

function add_number_to_select2() {
    var i = 0;
    $("#add_time_btn").on('click', function (event) {
        var start_time = $(".start_time .hour_num").text() + ':' + $(".start_time .minute_num").text();
        var end_time = $(".end_time .hour_num").text() + ':' + $(".end_time .minute_num").text();
        var data = {
            id: i++,
            text: start_time + "," + end_time
        };
        if (!time_conflict(start_time + "," + end_time)) {
            $(".setting_error").show(1);
            setTimeout(function () {
                $(".setting_error").hide(1);
            }, 3000);
            event.stopPropagation();
        } else {
            var str = '<div class="tag_item">' + start_time + "," + end_time + '<span class="fa fa-times"></span></div>';
            $(".tag_box").append(str);
            fill_time_item_input();
            $(".tag_box .tag_item span").unbind('click');
            $(".tag_box .tag_item span").on('click', function () {
                $(this).closest(".tag_item").remove();
            });
        }

    });
}
function copiable()
{
    $
}
function fill_time_item_input() {
    var exp = [];
    $(".tag_box .tag_item").each(function (key, value) {
        exp.push($(value).text());
    });
    $("#time_item_input").val(JSON.stringify(exp));

}

function time_conflict(time_string) {
    var result = true;
    $(".tag_box .tag_item").each(function (index, element) {
        var stored_item = time_string_to_array($(element).text());

        var new_item = time_string_to_array(time_string);
        console.log(new_item[0] + ' comapare in : ' + stored_item[0] + ',' + stored_item[1]);
        if ((new_item[0] >= stored_item[0] && new_item[0] <= stored_item[1]) || (new_item[1] >= stored_item[0] && new_item[1] <= stored_item[1])) {
            result = false;
            return false;
        }
    });
    return result;
}

function time_string_to_array(element_text) {
    var temp = element_text.split(",");
    var temp_start_time = temp[0].split(':');
    var temp_end_time = temp[1].split(':');
    var element_array = [0, 0];
    element_array[0] = parseInt((temp_start_time[0]) + (temp_start_time[1]));
    element_array[1] = parseInt((temp_end_time[0]) + (temp_end_time[1]));
    console.log(element_array);
    return element_array;

}