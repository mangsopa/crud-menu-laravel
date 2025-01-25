<x-form.modal title="Form Akses Role" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('PUT')
    @endif
    <div class="row gap-2">
        <div class="col-xl-12">
            <h4>Role : {{ $data->name }}</h4>
            <div class="mb-3 mt-3">
                <x-form.select class="copy-role" label="Pilih dari role" placeholder="Pilih role" name="role"
                    :options="$roles" />
            </div>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="menu_permissions">
                        @include('pages.konfigurasi.akses-role-items')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-form.modal>
