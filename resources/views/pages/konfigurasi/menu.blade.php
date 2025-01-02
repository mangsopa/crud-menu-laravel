@extends('layouts.app')

@section('title', 'Konfigurasi')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Konfigurasi Menu</h5>
                        </div>
                        <div class="card-body">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                    @push('js')
                        {!! $dataTable->scripts() !!}
                    @endpush
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title -->


        </div>
        <!-- container-fluid -->
    </div>

@endsection
