const body = $('body');

export function ajaxProcessing(id, processRoute, method, csrfToken, routeAfterProcess = null, errorText){
    Swal.fire({
        title: 'Sedang memproses...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: processRoute.replace(':id', id),
        type: method,
        data: {
            _token: csrfToken
        },
        success: function (response) {
            Swal.close();
            Swal.fire({
                title: response.message,
                icon: 'success',
                showCancelButton: false,
                allowOutsideClick: false,
                confirmButtonText:
                    'Ok!'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (routeAfterProcess) {
                        window.location.href = routeAfterProcess;
                    } else {
                        location.reload();
                    }

                }
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            Swal.close();
            const response = JSON.parse(jqXHR.responseText);
            Swal.fire({
                icon: "error",
                title: errorText,
                text: response.message
            });
        }
    });
}

export function confirmAlert(btnClass, processRoute, routeAfterProcess, method, confirmationText, errorText, csrfToken) {
    body.on('click', btnClass, function () {
        const id = $(this).attr('id');
        Swal.fire({
            title: confirmationText,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                ajaxProcessing(id, processRoute, method, csrfToken, routeAfterProcess, errorText)
            }
        });
    });
}
