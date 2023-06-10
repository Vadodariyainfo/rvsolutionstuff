$(document).ready(function() {
    $('#html-input').focus();
    // on submit
    $('body').on('click', '#html-submit-button', function(event) {
        event.preventDefault();
        var htmlData = $('#html-input').val();
        $.ajax({
            type: 'POST',
            context: $(this),
            url: "html-formatter",
            data: {
                '_token': CSRF_TOKEN,
                'html_data': htmlData
            },
            beforeSend: function() {
                $(this).attr('disabled', 'disabled');
                $(this).html('<i class="fa fa-spinner fa-spin"></i>  Please Wait...');
            },
            complete: function() {
                $(this).attr('disabled', false);
            },
            success: function(data) {
                $(this).html('Validate and Format json');
                if(data.success == true) {
                    iziToast.success({
                        maxWidth: 400,
                        timeout: 10000,
                        position: 'topRight',
                        title: 'Json valid',
                        message: data.message,
                    });
                    $('#html-output').val(data.json_response);
                } else {
                    iziToast.error({
                        maxWidth: 400,
                        timeout: 10000,
                        position: 'topRight',
                        title: 'Invalid json',
                        message: data.message,
                    });
                    $('#html-output').val(data.json_response);
                }
            },
            error: function(xhr) {
                $(this).html('Validate and Format json');
                $('#html-output').val("");
                iziToast.error({
                    maxWidth: 400,
                    timeout: 10000,
                    position: 'topRight',
                    title: 'Error Alert',
                    message: xhr.responseText,
                });
            }
        });
    });

    // click json output button
    var textBox = document.getElementById("html-output");
    textBox.onfocus = function() {
        textBox.select();
        textBox.onmouseup = function() {
            textBox.onmouseup = null;
            return false;
        };
    };

    // copy text
    $('#copy-button').on('click', function() {
        $('#html-output').select();
        document.execCommand("copy");
        iziToast.success({
            maxWidth: 400,
            timeout: 10000,
            position: 'topRight',
            title: 'Copy alert',
            message: 'Text copied.',
        });
    });

    // clear text
    $('#clear-button').on('click', function() {
        $('#html-input').val('');
        $('#html-output').val('');
        iziToast.success({
            maxWidth: 400,
            timeout: 10000,
            position: 'topRight',
            title: 'Success Alert',
            message: 'Textbox cleared',
        });
    });

    // download file
    $('#download-button').click(function() {
        $("<a />", {
            download: "file.html",
            href: URL.createObjectURL(
                new Blob([$('#html-output').val()], {
                type: 'text/plain'
            }))
        }).appendTo("body")[0].click();
        $(window).one('focus', function() {
            $("a").last().remove()
        })
    })
});