/* Click actions */
// color theme
$('.change-theme').on('click', function () {
    var cmd = $(this).data('cmd'),
        id = $(this).data('id');
    $.post('?cmd=' + cmd, {id: id}, function (data) {
        // parse data
        try {
            var color = JSON.parse(data);
        } catch (e) {
            notify('', 'Server error!', 'Please, try again.', 'danger');
            // data
            console.log(data);
            return false;
        }
        // change theme
        $('body').attr('data-ma-theme', data.color);
    });
});
// collapse card
$('.plus_minus').on('click', function () {
    var icon = $(this);
    if (icon.hasClass('zmdi-plus')) {
        icon.removeClass('zmdi-plus');
        icon.addClass('zmdi-minus');
    } else {
        icon.removeClass('zmdi-minus');
        icon.addClass('zmdi-plus');
    }
});
// collapse aside menu
$('.navigation__sub').on('click', function () {
    var icon = $(this).find('a .plus-minus');
    if (icon.hasClass('zmdi-plus')) {
        icon.removeClass('zmdi-plus');
        icon.addClass('zmdi-minus');
    } else {
        icon.removeClass('zmdi-minus');
        icon.addClass('zmdi-plus');
    }
});
// clear notifications
$('.clear_notifications').on('click', function (e) {
    var elem = $(this),
        animationName = elem.data('anim');
    $.post('?cmd=notifClear', {id: 'all'}, function (data) {
        var count = $('.notif_counter').html();
        for (i = 0; i <= count; i++) {
            $('.notif_counter').html('0');
        }
        // update count
        notifsCount();
        // parse data
        try {
            var data = JSON.parse(data);
        } catch (e) {
            notify('', 'Server error!', 'Please, try again.', 'danger');
            // data
            console.log(data);
            return false;
        }
    });
});
// submit form data
$('form').on('submit', function (e) {
    e.preventDefault();
    var form = $(this),
        btn = form.find('button[type=submit]'),
        id = form.data('id'),
        cmdName = form.data('cmd'),
        table = form.data('table'),
        formData = new FormData(form[0]);
    // checkboxes
    if (form.find('input[type=checkbox]')[0]) {
        form.find('input[type=checkbox]').each(function () {
            var checkboxInput = $(this),
                checkboxInputName = checkboxInput.attr('name'),
                checkboxInputVal = 0;
            if (typeof checkboxInputName !== typeof undefined && checkboxInputName !== false) {
                if (checkboxInput.is(':checked')) {
                    checkboxInputVal = 1;
                }
                // append
                formData.append(checkboxInputName, checkboxInputVal);
            }
        });
    }
    // file
    if (form.find('input[type=file]')[0]) {
        form.find('input[type=file]').each(function () {
            var fileInput = $(this),
                fileInputName = fileInput.attr('name');
            if (typeof fileInputName !== typeof undefined && fileInputName !== false) {
                // append
                var fileXSmall = fileInput.data('x-small'),
                    fileYSmall = fileInput.data('y-small'),
                    fileXLarge = fileInput.data('x-large'),
                    fileYLarge = fileInput.data('y-large'),
                    fileActionSmall = fileInput.data('action-small'),
                    fileActionLarge = fileInput.data('action-large'),
                    fileWatermark = fileInput.data('watermark');
                // append
                if (fileXSmall) {
                    formData.append('x-small', fileXSmall);
                }
                if (fileYSmall) {
                    formData.append('y-small', fileYSmall);
                }
                if (fileXLarge) {
                    formData.append('x-large', fileXLarge);
                }
                if (fileYLarge) {
                    formData.append('y-large', fileYLarge);
                }
                if (fileActionSmall) {
                    formData.append('action-small', fileActionSmall);
                }
                if (fileActionLarge) {
                    formData.append('action-large', fileActionLarge);
                }
                if (fileWatermark) {
                    formData.append('watermark', fileWatermark);
                }
            }
        });
    }
    // table 
    formData.append('table', table);
    // save
    if (id) {
        formData.append('id', id);
    }
    // login form
    if (cmdName == 'adminLogin') {
        var email = $('input[name=email]').val(),
            password = $('input[name=password]').val(),
            remember = $('input[name=remember]');
        // check data
        if (remember.is(':checked')) {
            localStorage.setItem('email', email);
        }
    }
    // ajax request
    $.ajax({
        url: '?cmd=' + cmdName,
        type: 'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            btn.prop('disabled', true);
        },
        success: function (data) {
            console.log(data);
            // parse data
            try {
                var data = JSON.parse(data);
            } catch (e) {
                notify('', 'Error!', 'Please, try again.', 'danger');
                btn.prop('disabled', false);
                // data
                return false;
            }
            // notify
            setTimeout(function () {
                // result
                var nType = data.messageType,
                    nTitle = data.messageTitle,
                    nMessage = data.message;
                notify('', nTitle, nMessage, nType);
                btn.prop('disabled', false);
            }, 300);
            // reload page
            setTimeout(function () {
                if (data.reload == 1) {
                    location.reload();
                }
            }, 3000);
        },
        error: function () {
            notify('', 'Error!', 'Please, try again.', 'warning');
            btn.prop('disabled', false);
        }
    });
    return false;
});


// ajax actions (delete, archive)
$('.ajax-action').on('click', function (e) {
    e.preventDefault();
    var btn = $(this);
    ajaxAction(btn);
});
$('.ajax-action-confirm').on('click', function (e) {
    e.preventDefault();
    var btn = $(this);
    swal({
        title: '<span style="color: #333;">Are you sure?</span>',
        type: 'warning',
        background: '#fff',
        buttonsStyling: false,
        confirmButtonClass: 'btn btn-danger btn--raised',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonClass: 'btn btn-light btn--raised m-l-5',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.value) {
            ajaxAction(btn);
        }
    });
});
// Sortable
$(".sortable").parent().sortable({
    handle: '.handle',
    items: '> .sortable',
    start: function (event, ui) {
        result = $(ui.item[0]).find('.result-sort');
    },
    update: function () {
        var container = $(this),
            order = container.sortable('serialize'),
            table = container.find('.sortable').data("table");
        // send data
        $.ajax({
            url: '?cmd=sortData&' + order,
            type: 'post',
            data: {
                table: table
            },
            beforeSend: function () {
                result.html('<i class="zmdi zmdi-spinner fa-spin"></i>');
            },
            success: function (data) {
                try {
                    var data = JSON.parse(data);
                } catch (e) {
                    // result
                    result.html('<i class="zmdi zmdi-swap-vertical handle"></i>');
                    notify('', 'Server error!', 'Please, try again.', 'danger');
                    // data
                    console.log(data);
                    return false;
                }
                // notify
                setTimeout(function () {
                    // result
                    result.html('<i class="zmdi zmdi-swap-vertical handle"></i>');
                    var nType = data.messageType,
                        nTitle = data.messageTitle,
                        nMessage = data.message;
                    notify('', nTitle, nMessage, nType);
                }, 300);
                // reload page
                setTimeout(function () {
                    if (data.reload == 1) {
                        location.reload();
                    }
                }, 3000);
            },
            error: function () {
                notify('', 'Error!', 'Please, try again.', 'warning');
                result.html('<i class="zmdi zmdi-swap-vertical handle"></i>');
            }
        });
    }
});
/* Functions */

// Notifications
function notify(btn, title, message, type) {
    if (btn[0]) {
        var from,
            align,
            icon = btn.attr('data-icon'),
            animIn,
            animOut;
        // anim in
        if (btn.attr('data-anim-in')) {
            animIn = btn.attr('data-anim-in');
        } else {
            animIn = 'animated bounceInRight';
        }
        // anim out
        if (btn.attr('data-anim-out')) {
            animOut = btn.attr('data-anim-out');
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
    }, {
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
        template: '<div data-notify="container" class="alert alert-dismissible alert-{0}" role="alert">' +
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

// ajaxAction (only ID)
function ajaxAction(btn) {
    if (btn[0]) {
        var id = btn.attr('data-id'),
            cmdName = btn.attr('data-cmd'),
            tableName = btn.attr('data-table'),
            actionName = btn.attr('data-action'),
            animationName = btn.attr('data-anim');
        // check data
        if (id == '' || cmdName == '') {
            var nType = 'warning';
            notify(btn, 'Ошибка! ', 'Please, try again.', nType);
            return false;
        } else {
            btn.prop('disabled', true);
            var elem;
            // hide button
            if (actionName == 'hide-btn') {
                elem = btn;
            }
            // hide row
            else if (actionName == 'hide-row') {
                elem = btn.closest($('tr'));
            }
            // hide element
            else if (actionName == 'hide-element') {
                elem = $('[data-element-id=' + id + ']');
            }
            // hide element
            hideElement(elem, animationName);
            // other actions
            if (btn.attr('data-update')) {
                var updateFunc = btn.attr('data-update');
                window[updateFunc]();
            }
            // send data
            $.post('?cmd=' + cmdName + '', {table: tableName, id: id}, function (data) {
                // parse data
                try {
                    var data = JSON.parse(data);
                } catch (e) {
                    notify('', 'Server error!', 'Please, try again.', 'danger');
                    // data
                    console.log(data);
                    return false;
                }
                // notify
                setTimeout(function () {
                    // result
                    var nType = data.messageType,
                        nTitle = data.messageTitle,
                        nMessage = data.message;
                    notify(btn, nTitle, nMessage, nType);
					// hide tooltips
					hideTooltips();
                }, 300);
                // reload page
                setTimeout(function () {
                    if (data.reload == 1) {
                        location.reload();
                    }
                }, 3000);
            });
            return false;
        }
    } else {
        notify('', 'Ошибка! ', 'Кнопка не обнаружена.', 'warning');
        return false;
    }
};

// hide element aniamtions
function hideElement(elem, animationName, animationDuration = '.8s', removeTimeOut = '700') {
    elem.css({
        'animation-duration': animationDuration,
        '-webkit-animation-duration': animationDuration,
        '-moz-animation-duration': animationDuration,
    });
    elem.addClass('animated ' + animationName);
    setTimeout(function () {
        elem.remove();
    }, removeTimeOut);
}

function hideTooltips() {
	if ($('.tooltip.show')[0]) {
		$('.tooltip.show').each(function() {
			var tooltipElem = $(this);
			hideElement(tooltipElem, 'fadeOut', '.3s', '0');
			setTimeout(function() {
				hideElement(tooltipElem, 'fadeOut', '.3s', '0');
			}, 300);
		});
	}
}

// update notifications count
function notifsCount() {
    var countElement = $('.notif_counter'),
        animationName = countElement.data('anim'),
        count = $('.notif_counter').html();
    count--;
    if (count < 1) {
//        hideElement(countElement, animationName);
//        hideElement($('.clear_notifications'), animationName);
        $('.top-nav__notifications .top-nav__notify').removeClass('top-nav__notify');
    } else {
        countElement.text(count);
    }
}

/*-----------------------------------------------------------
    Summernote HTML Editor
-----------------------------------------------------------*/
function ajaxUploadSummernoteImage(file, editor) {
    var formData = new FormData();
    formData.append('file', file);
    $.ajax({
        url: '?cmd=uploadSummernoteImage',
        type: 'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            // parse data
            try {
                var data = JSON.parse(data);
            } catch (e) {
                notify('', 'Server error!', 'Please, try again.', 'danger');
                // data
                console.log(data);
                return false;
            }
            // result
            setTimeout(function () {
                if (data.reload) {
                    editor.summernote('insertImage', data.reload, function ($image) {
//                        $image.css('display', 'block');
                    });
                    console.log(data.reload);
                } else {
                    console.log(data);
                }
                // notify
                var nType = data.messageType,
                    nTitle = data.messageTitle,
                    nMessage = data.message;
                notify('', nTitle, nMessage, nType);
            }, 300);
        },
        error: function () {
            notify('', 'Error!', 'Please, try again.', 'warning');
        }
    });
    return false;
}

if ($('.html-editor')[0]) {
    $('.html-editor').summernote({
        minHeight: 150,
        maxHeight: 500,
        // default: 'en-US'
        lang: 'en-US',
//            placeholder: '...',
//            fontNames: ['snas-serif'],
        dialogsFade: true,
        toolbar: [
            // [groupName, [list of button]]
            ['actions', ['undo', 'redo']],
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'fontsize', 'color', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['elements', ['hr', 'table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        callbacks: {
            onImageUpload: function (files, editor) {
                var editor = $(this);
                for (var i = 0; i < files.length; i++) {
                    ajaxUploadSummernoteImage(files[i], editor);
                }
                return false;
            }
        },
        // codemirror options
        codemirror: {
            theme: 'monokai',
            lineNumbers: true,
            lineWrapping: true
        }
    });
}
if ($('.html-editor-click')[0]) {
    // Edit
    $('body').on('click', '.hec-button', function () {
        $('.html-editor-click').summernote({
            focus: true
        });
        $('.hec-save').show();
    })

    //Save
    $('body').on('click', '.hec-save', function () {
        $('.html-editor-click').code();
        $('.html-editor-click').destroy();
        $('.hec-save').hide();
    });
}





$('#get_league_teams').on('change', function(){
    var cmd = $(this).data('cmd'),
        id = $(this).val();
    $.post('?cmd=' + cmd, { id: id }, function (data) {
        // parse data
        try {
            var teams = JSON.parse(data);
        } catch (e) {
            notify('', 'Server error!', 'Please, try again.', 'danger');
            // data
            console.log(data);
            return false;
        }
        $('#league_team_1').html('');
        $('#league_team_2').html('');
        // change team
        for(i = 0; i < teams.length; i++) {
            var teamID = teams[i].id,
                teamName = teams[i].name;
            $('#league_team_1').append('<option value="'+teamID+'">'+teamName+'</option>');
            $('#league_team_2').append('<option value="'+teamID+'">'+teamName+'</option>');
        }
    });
});

$('#league_team_1').on('change', function() {
    var select = $(this);
    $('#league_team_2 option').each(function() {
        $(this).prop('disabled', false);
    });
    var id = select.val();
    var team_2_option = $('#league_team_2 option[value=' + id + ']');
    team_2_option.prop('disabled', true);
    select.select2({
        dropdownAutoWidth: !0,
        width: "100%",
    });
});

$('#league_team_2').on('change', function() {
    var select = $(this);
    $('#league_team_1 option').each(function(){
       $(this).prop('disabled', false);
    });
    var id = select.val();
    var team_1_option = $('#league_team_1 option[value=' + id + ']');
    team_1_option.prop('disabled', true);
    select.select2({
        dropdownAutoWidth: !0,
        width: "100%",
    });
});