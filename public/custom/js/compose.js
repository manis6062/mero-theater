var v1_url = js_base_url + '/api/v1/compose/to-autocomplete';
var data;
$.getJSON(v1_url, function (json) {
    data = (json.message);

});
window.onload = function () {
};
var contacts = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('display'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,

    prefetch: {
        url: v1_url,
        transform: function (response) {
            console.log(response);
            // Map the remote source JSON array to a JavaScript object array
            return $.map(response.message, function (movie) {
                return {
                    display: movie.display,
                    tuple: movie.tuple
                };
            });
        }
    }
});

contacts.initialize();
localStorage.clear();
$('#the-basics input').tagsinput({
    typeaheadjs: ({
        minLength: 1,
        highlight: true,
    }, {
        minlength: 3,
        name: 'contacts',
        displayKey: 'display',
        valueKey: 'display',
        source: contacts.ttAdapter(),
    }),
    freeInput: true,
    confirmKeys: [13,32]
});

$('#the-basics input').on('beforeItemAdd', function(event) {
    console.log(event.item);
    var phoneNumber=event.item;
    var regExp = /\(([^)]+)\)/;
    var matches = regExp.exec(phoneNumber);
    if (matches != null && matches[1]) {
        phoneNumber = matches[1];
    }
    var finalNumber = phoneNumber.split(' ').join('');
    var networkArray = ['980','981','982','984','985', '986'];

    var networkOfPhoneNumber = finalNumber.substring(0, 3);
    if ( finalNumber.length == 10 && /^\d+$/.test(finalNumber) ) {
        if (networkArray.indexOf(networkOfPhoneNumber) != -1) {
            $('.bootstrap-tagsinput').removeClass('inputwrong');
            $("#short-number").text('');
        }
    }
    else{
        if( $("#short-number").text('')){
            if (networkArray.indexOf(networkOfPhoneNumber) == -1 || !$.isNumeric(finalNumber)){
                $('.bootstrap-tagsinput').addClass('inputwrong');
                $('#short-number').append(finalNumber+' must be a valid Mobile Number');
            }
            else{
                $('.bootstrap-tagsinput').addClass('inputwrong');
                $('#short-number').append(finalNumber+' must be 10 digit Number');
            }

            }
        }
});

function validatePhone(phoneNumber) {
    var regExp = /\(([^)]+)\)/;
    var matches = regExp.exec(phoneNumber);
    if (matches != null && matches[1]) {
        phoneNumber = matches[1];
    }

    if ( phoneNumber.length == 10 && /^\d+$/.test(phoneNumber) ) {
        var networkArray = ['980', '981', '982', '984', '985', '986'];
        var networkOfPhoneNumber = phoneNumber.substring(0, 3);
        if (networkArray.indexOf(networkOfPhoneNumber) != -1) {
            return false;
        }
    }
    return true;
}

var substringMatcher = function (strs) {
    return function findMatches(q, cb) {
        var matches, substringRegex;
        // an array that will be populated with substring matches
        matches = [];
        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');
        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function (i, str) {
            if (substrRegex.test(str.name)) {
                templateBody = [];
                matches.push(str.name);
                templateBody[str.name] = str.body;
            }
        });
        cb(matches);
    };
};
var v1_url_templates = js_base_url + '/api/v1/compose/get-message-templates';
var v1_url_templates_data;
var templates = [];
var templateBody = [];
$.getJSON(v1_url_templates, function (json) {
    v1_url_templates_data = (json.message);
    $.each(v1_url_templates_data, function (i, e) {
        templates.push(e);
    });
});
window.onload = function () {

    $('#template .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 0
    }, {
        name: 'templates',
        source: substringMatcher(templates)
    }).on('typeahead:selected', function (obj, datum) {
        console.log(obj);
        console.log(datum);
    });

    $('#template .typeahead').bind('typeahead:select', function (ev, suggestion) {
        $('#message').val(templateBody[suggestion]);
        $('#message').trigger('keyup');
    });
    $("#save-template-with-name").click(function (event) {
        var message = $("#message").val();
        var name = $('#template_name').val();
        if (message.length == 0) {
            var $toastContent = $('<span>Oops! Something went wrong!</span>');
            $.toaster({ priority : 'danger', title : 'Error', message : $toastContent});
            return false;
        }
        var v1_url = js_base_url + '/api/v1/compose/save-message-template';
        var n = message.includes(":via aakashsms.com");
        var strip_message = message.replace(":via aakashsms.com", "");
        var send = {
            message: strip_message,
            name: name,
            tagline: n
        };
        $.ajax({
            type: 'post',
            url: v1_url,
            dataType: 'json',
            data: send,
            success: function (json) {
                if (json.error == true) {
                    var txt = '';
                    $.each(json.message, function (index, value) {
                        txt += value[0] + '</br>';
                    });
                    var $toastContent = $('<span>' + txt + '</span>');
                    $.toaster({ priority : 'danger', title : 'Error', message : $toastContent});
                    var $toastContent = $('<span>Oops! Something went wrong! ' + err + '</span>');
                    $.toaster({ priority : 'danger', title : 'Error', message : $toastContent});
                } else {
                    templates.push(strip_message);
                    var $toastContent = $('<span>Your message has been successfully saved as a template.</span>');
                    $.toaster({ priority : 'success', title : 'Success', message : $toastContent});
                }
            }
        });
    });
};


$('#send-message').click(function (event) {

    var string = $('.field-on-required').val();
    console.log(string);
    var array = string.split(',');
    var arr = [];
    if ( (array == "") && (document.getElementById("contactsCSVFile").files.length == 0) && ($('#contact').val() == null) ) {
        $("input[name='recipients']").val('');
        console.log("PLEASE MAKE TO OR CHOOSE CONTACTS FILE OR SELECT GROUP");
        $.toaster({ priority : 'danger', title : 'Error', message : "Please Provide at least one Recipient Number"});
        return 0;
    }
    $.each(array, function (i, e) {
        var obj = data.filter(function (obj) {
            return obj.display === e;
        })[0];
        if (obj !== undefined) {
            arr.push(obj.tuple);
        } else {
            var more = {
                "type": "phone",
                "id": e,
                "display": e
            };
            arr.push(more);

        }
    });
    $("input[name='recipients']").val(JSON.stringify(arr));

    var v1_url = js_base_url + '/sms/v1/compose/bulk';
    console.log(v1_url);



    var form = $('form#compose-form');
    var formData = new FormData($(form)[0]);
    console.log(formData);



    $.ajax({
        type: 'post',
        url: v1_url,
        dataType: 'json',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        success: function (json) {
            if (json.error == true) {
                $('#loadingImg').hide();
                $('#send-message').show();
                var txt = '';
                $.each(json.message, function (index, value) {
                    txt += value[0] + '</br>';
                });
                var $toastContent = $('<span>' + txt + '</span>');
                $.toaster({ priority : 'danger', title : 'Error', message : $toastContent});
            } else {
                $('#loadingImg').hide();
                $('#send-message').show();
                var $toastContent = $('<span>'+json.message+'</span>');
                $.toaster({ priority : 'success', title : 'Success', message : $toastContent});
                setTimeout(function () {
                    $('#modalConfirmationSendMoreBulkSMS').modal('show');
                }, 1000);
            }
        }
    });

});

$("#help").click(function (event) {
    $('.help-box').fadeToggle("400");
});



function setSelectionRange(input, selectionStart, selectionEnd) {
    if (input.setSelectionRange) {
        input.focus();
        input.setSelectionRange(selectionStart, selectionEnd);
    }
    else if (input.createTextRange) {
        var range = input.createTextRange();
        range.collapse(true);
        range.moveEnd('character', selectionEnd);
        range.moveStart('character', selectionStart);
        range.select();
    }
}

function setCaretToPos(input, pos) {
    setSelectionRange(input, pos, pos);
}


$('#message').click(function (event) {
    current_length = $(this).val().length;
    new_cursor_position = current_length - via_message.length

    if (isTaglinechecked) {
        setCaretToPos(document.getElementById("message"), new_cursor_position);
    }
});

$('#message').focus(function (event) {
    current_length = $(this).val().length;
    new_cursor_position = current_length - via_message.length

    if (isTaglinechecked) {
        setCaretToPos(document.getElementById("message"), new_cursor_position);
    }

});

function checkfile(sender) {
    var validExts = new Array(".csv");
    var fileExt = sender.value;
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    if (validExts.indexOf(fileExt) < 0) {
        alert("Only CSV file are supported and please use the exact format as given in sample " );
        $("#contactsCSVFile").val('');
        return 0;
    }
    else return true;
}
