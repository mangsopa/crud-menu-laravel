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
                                        <a class="btn btn-success mb-3 add btn-md"
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

            $('.add').on('click', function(e) {
                e.preventDefault();

                handleAjax(this.href).onSuccess(function(res) {
                    handleFormSubmit('#form_action')
                        .setDataTable(datatable)
                        .init();
                }).execute();
            })

            $('#' + datatable).on('click', '.action', function(e) {
                e.preventDefault();
                handleAjax(this.href)
                    .onSuccess(function(res) {
                        handleFormSubmit('#form_action')
                            .setDataTable(datatable)
                            .init();
                    }).execute();
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
