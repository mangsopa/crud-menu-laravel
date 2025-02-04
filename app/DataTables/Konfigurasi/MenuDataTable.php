<?php

namespace App\DataTables\Konfigurasi;

use App\Models\Konfigurasi\Menu;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MenuDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $user = request()->user();

        return (new EloquentDataTable($query))
            ->addColumn('active', function ($row) {
                if ($row->active == 1) {
                    return '<span class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i> Active</span>';
                } else {
                    return '<span class="text-danger"><i class="ri-close-circle-line fs-17 align-middle"></i> Inactive</span>';
                }
            })
            ->addColumn(
                'action',
                function ($row) use ($user) {
                    $actions = [];
                    if ($user->can('update konfigurasi/menu')) {
                        $actions['Edit'] = route('konfigurasi.menu.edit', $row->id);
                    }
                    return view('action', compact('actions'));
                }
            )
            ->rawColumns(['active', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Menu $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('menu-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name'),
            Column::make('orders'),
            Column::make('category'),
            Column::make('icon'),
            Column::make('url'),
            Column::make('active'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Menu_' . date('YmdHis');
    }
}
