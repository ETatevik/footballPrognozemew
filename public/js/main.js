
/* forms */
// submit form data
$('form').submit(function(e) {
    e.preventDefault();
    var form = $(this),
        btn = form.find('button[type=submit]'),
        id = form.data('id'),
        cmdName = form.data('cmd'),
        formData = new FormData(form[0]);
    // save
    if (id) {
        formData.append('id', id);
    }
    // send data
    $.ajax({
        url: '/index.php?cmd=' + cmdName,
        type: 'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            btn.prop('disabled', true);
        },
        success: function (data) {
            // parse data
            try {
                var data = JSON.parse(data);
            } catch(e) {
                notify('', 'Error!', 'Please, try again.', 'danger');
                btn.prop('disabled', false);
                // data
                console.log(data);
                return false;
            }
            // notify
            setTimeout(function() {
                // result
                var nType = data.messageType,
                    nTitle = data.messageTitle,
                    nMessage = data.message;
                notify('', nTitle, nMessage, nType);
                // reload page
                if (data.reload) {
                    location.reload();
                }
                btn.prop('disabled', false);
            }, 300);
        },
        error: function () {
            notify('', 'Error!', 'Please, try again.', 'warning');
            btn.prop('disabled', false);
        }
    });
    return false;
});

// Notifications
function notify(btn, title, message, type) {
    if (btn[0]) {
        var from,
            align,
            icon = btn.attr('data-icon'),
            animIn,
            animOut;
        // anim in
        if (btn.attr('data-animation-in')) {
            animIn = btn.attr('data-animation-in');
        } else {
            animIn = 'animated bounceInRight';
        }
        // anim out
        if (btn.attr('data-animation-out')) {
            animOut = btn.attr('data-animation-out');
        } else {
            animOut = 'animated bounceOutRight';
        }
        // from
        if (btn.attr('data-from')) {
            from = btn.attr('data-from');
        } else {
            from = 'bottom';
        }
        // align
        if (btn.attr('data-align')) {
            align = btn.attr('data-align');
        } else {
            align = 'right';
        }
    } else {
        var from = 'bottom',
            align = 'right',
            icon = '',
            animIn = 'animated bounceInRight',
            animOut = 'animated bounceOutRight';
    }
    $.notify({
        icon: icon,
        title: title,
        message: message,
        url: ''
    },{
        element: 'body',
        type: type,
        allow_dismiss: true,
        placement: {
            from: from,
            align: align
        },
        offset: {
            x: 30,
            y: 30
        },
        spacing: 10,
        z_index: 1031,
        delay: 2000,
        timer: 2000,
        url_target: '_blank',
        mouse_over: false,
        animate: {
            enter: animIn,
            exit: animOut
        },
        icon_type: 'class',
        template:   '<div data-notify="container" class="alert alert-dismissible alert-{0}" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>' +
                        '<span data-notify="icon"></span> ' +
                        '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' +
                        '<div class="progress" data-notify="progressbar">' +
                            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>'
    });
}