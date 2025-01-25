@extends('layouts.app')

@section('title', 'Konfigurasi Akses Role')

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

            function handleCheckMenu() {
                $('.parent').on('click', function() {
                    const childs = $(this).parents('tr').find('.child')

                    childs.prop('checked', this.checked)
                })

                $('.child').on('click', function() {
                    const parent = $(this).parents('tr')

                    const childs = parent.find('.child')

                    const checked = parent.find('.child:checked')

                    parent.find('.parent').prop('checked', childs.length === checked.length)
                })

                $('.parent').each(function() {
                    const parent = $(this).parents('tr')

                    const childs = parent.find('.child')

                    const checked = parent.find('.child:checked')

                    parent.find('.parent').prop('checked', childs.length === checked.length)
                })
            }

            handleAction(datatable, function() {

                handleCheckMenu();

                $('.search').on('keyup', function() {
                    const value = this.value.toLowerCase();

                    $('#menu_permissions tr').filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                })

                $('.copy-role').on('change', function() {
                    handleAjax(`{{ url('konfigurasi/akses-role') }}/${this.value}/role`)
                        .onSuccess(function(res) {
                            $('#menu_permissions').html(res)
                            handleCheckMenu();
                        }, false)
                        .execute();
                })
            })

            handleDelete(datatable);
        </script>
    @endpush

@endsection
