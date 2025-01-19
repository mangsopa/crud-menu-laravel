<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/iziToast.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- Header -->
        @include('partials.header')

        <!-- Sidebar -->
        @include('partials.sidebar')

        <div class="modal fade zoomIn" id="modal_action" tabindex="-1" aria-labelledby="exampleModalFullscreenLgLabel"
            aria-hidden="true">
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('partials.footer')

    </div>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/iziToast.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script>
        function showToast(status = 'success', message) {
            iziToast[status]({
                title: status == 'success' ? 'Success' : 'Error',
                message: message,
                position: "topRight"
            })
        }

        function handleFormSubmit(selector) {
            function init() {
                const _this = this;
                $(selector).on('submit', function(e) {
                    e.preventDefault();
                    const _form = this;
                    $.ajax({
                        url: this.action,
                        method: this.method,
                        data: new FormData(_form),
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $(_form).find('.is-invalid').removeClass(
                                'is-invalid');
                            $(_form).find('.invalid-feedback').remove();
                        },
                        success: (res) => {
                            if (_this.runDefaultSuccessCallback) {
                                $('#modal_action').modal('hide');
                            }

                            showToast(res.status, res.message);

                            _this.onSuccessCallback && _this.onSuccessCallback(res);

                            _this.dataTableId && window.LaravelDataTables[_this.dataTableId].ajax
                                .reload();
                        },
                        error: function(err) {
                            const errors = err.responseJSON?.errors;

                            if (errors) {
                                for (let [key, message] of Object.entries(
                                        errors)) {
                                    // console.log(message);

                                    $(`[name=${key}]`).addClass('is-invalid')
                                        .parent()
                                        .append(
                                            `<div class="invalid-feedback">${message}</div>`
                                        );
                                }
                            }
                            showToast('error', err.responseJSON?.message);
                        }
                    })
                })
            }

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

                        this.onSuccessCallback && this.onSuccessCallback()
                    },
                    error: function(err) {
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
    </script>
    @stack('js')

</body>

</html>
