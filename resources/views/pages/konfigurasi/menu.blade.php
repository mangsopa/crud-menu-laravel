@extends('layouts.app')

@section('title', 'Konfigurasi Menu')

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
                                    @can('create konfigurasi/menu')
                                        <a class="btn btn-success mb-3 add btn-md"
                                            href="{{ route('konfigurasi.menu.create') }}">
                                            <i class="ri-add-line align-bottom me-1"></i> Add</button>
                                        </a>
                                    @endcan
                                    @can('sort konfigurasi/menu')
                                        <a class="btn btn-success mb-3 sort btn-md" href="{{ route('konfigurasi.menu.sort') }}">
                                            Sort Menu</button>
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
            function handleMenuChange() {
                $('[name=level_menu]').on('change', function() {
                    if (this.value == 'sub_menu') {
                        $('#main_menu_wrapper').removeClass('d-none');
                    } else {
                        $('#main_menu_wrapper').addClass('d-none');
                    }
                })
            }

            $('.sort').on('click', function(e) {
                e.preventDefault();

                handleAjax(this.href, 'put')
                    .onSuccess(function(res) {
                        window.location.reload()
                    }, false)
                    .execute();
            })

            $('.add').on('click', function(e) {
                e.preventDefault();

                handleAjax(this.href).onSuccess(function(res) {
                    handleMenuChange();
                    handleFormSubmit('#form_action')
                        .setDataTable('menu-table')
                        .init();
                }).execute();
            })

            $('#menu-table').on('click', '.action', function(e) {
                e.preventDefault();
                handleAjax(this.href)
                    .onSuccess(function(res) {
                        handleMenuChange();
                        handleFormSubmit('#form_action')
                            .setDataTable('menu-table')
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
