@extends('layouts.app')

@section('title', 'Konfigurasi Permission')

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
                                    @can('create konfigurasi/permissions')
                                        <a class="btn btn-success mb-3 btn-md action"
                                            href="{{ route('konfigurasi.permissions.create') }}">
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
            const datatable = 'permission-table';

            handleAction(datatable);

            handleDelete(datatable);
        </script>
    @endpush

@endsection
