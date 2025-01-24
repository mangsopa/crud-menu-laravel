@extends('layouts.app')

@section('title', 'Konfigurasi Role')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><?= $title ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @can('create konfigurasi/roles')
                                        <a class="btn btn-success mb-3 btn-md action"
                                            href="{{ route('konfigurasi.roles.create') }}">
                                            <i class="ri-add-line align-bottom me-1"></i> Add</button>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}

        <script>
            const datatable = 'role-table';

            handleAction(datatable);

            $('#' + datatable).on('click', '.delete', function(e) {
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
                            .onSuccess(function(res) {
                                showToast(res.status, res.message);

                                // Reload DataTable
                                window.LaravelDataTables[datatable].ajax.reload();
                            }, false).execute();
                    }
                });
            });

            function toggleCheckbox(checkedId, uncheckedId) {
                const checkedBox = document.getElementById(checkedId);
                const uncheckedBox = document.getElementById(uncheckedId);

                if (checkedBox.checked) {
                    uncheckedBox.checked = false;
                }
            }
        </script>
    @endpush

@endsection
