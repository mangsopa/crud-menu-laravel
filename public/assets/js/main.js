$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name=csrf_token]').attr('content')
    }
});

function handleAction(datatable, onShowAction, OnSuccessAction) {
    $('.page-content').on('click', '.action', function (e) {
        e.preventDefault();
        handleAjax(this.href)
            .onSuccess(function (res) {
                onShowAction && onShowAction(res); // Pastikan dipanggil
                handleFormSubmit('#form_action')
                    .setDataTable(datatable)
                    .onSuccess(function (res) {
                        OnSuccessAction && OnSuccessAction(res);
                    })
                    .init();
            }).execute();
    });
}


function showToast(status = 'success', message) {
    iziToast[status]({
        title: status == 'success' ? 'Success' : 'Error',
        message: message,
        position: "topRight"
    })
}

function handleDelete(datatable, onSuccessAction) {
    $('#' + datatable).on('click', '.delete', function (e) {
        e.preventDefault();

        const deleteUrl = $(this).attr('href');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-primary w-xs me-2 mt-2",
                cancelButton: "btn btn-danger w-xs mt-2"
            },
            confirmButtonText: "Yes, delete it!",
            buttonsStyling: false,
            showCloseButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                handleAjax(deleteUrl, 'delete')
                    .onSuccess(function (res) {

                        onSuccessAction && onSuccessAction(res);
                        showToast(res.status, res.message);

                        // Reload DataTable
                        window.LaravelDataTables[datatable].ajax.reload(null, false);
                    }, false).execute();
            }
        });
    });
}

function handleFormSubmit(selector, options = {}) {
    const { dataTableId, onSuccessCallback } = options;

    $(selector).on('submit', function (e) {
        e.preventDefault();
        const _form = this;

        $.ajax({
            url: this.action,
            method: this.method,
            data: new FormData(_form),
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(_form).find('.is-invalid').removeClass('is-invalid');
                $(_form).find('.invalid-feedback').remove();
            },
            success: (res) => {
                // Default success action
                $('#modal_action').modal('hide');

                // Show toast
                showToast(res.status, res.message);

                // Custom success callback
                onSuccessCallback && onSuccessCallback(res);

                // Reload DataTable if provided
                dataTableId && window.LaravelDataTables[dataTableId].ajax.reload(null, false);

                window.LaravelDataTables[datatable].ajax.reload(null, false);

            },
            error: function (err) {
                const errors = err.responseJSON?.errors;

                if (errors) {
                    for (let [key, message] of Object.entries(errors)) {
                        $(`[name=${key}]`)
                            .addClass('is-invalid')
                            .parent()
                            .append(
                                `<div class="invalid-feedback">${message}</div>`
                            );
                    }
                }

                showToast('error', err.responseJSON?.message || 'An error occurred');
            }
        });
    });

    function onSuccess(cb, runDefault = true) {
        this.onSuccessCallback = cb;
        this.runDefaultSuccessCallback = runDefault;
        return this;
    }

    function setDataTable(id) {
        this.dataTableId = id;
        return this;
    }

    return {
        init,
        runDefaultSuccessCallback: true,
        onSuccess,
        setDataTable
    }
}

function handleAjax(url, method = 'get') {
    function onSuccess(cb, runDefault = true) {
        this.onSuccessCallback = cb;
        this.runDefaultSuccessCallback = runDefault;
        return this;
    }

    function execute() {
        $.ajax({
            url,
            method,
            success: (res) => {
                if (this.runDefaultSuccessCallback) {
                    const modal = $('#modal_action')
                    modal.html(res)
                    modal.modal('show')
                }

                this.onSuccessCallback && this.onSuccessCallback(res)
            },
            error: function (err) {
                console.log(err);
            }
        })
    }

    function onError(cb) {
        this.onErrorCallback = cb;
        return this;
    }

    return {
        execute,
        onSuccess,
        runDefaultSuccessCallback: true
    }
}
