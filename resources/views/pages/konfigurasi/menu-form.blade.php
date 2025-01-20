<x-form.modal title="Form Menu" action="{{ $action }}">
    @if ($data->id)
        @method('PUT')
    @endif
    <div class="row g-3">
        <div class="col-md-6">
            <x-form.input name="name" value="{{ $data->name }}" label="Name" />
        </div>
        <div class="col-md-6">
            <x-form.input name="category" value="{{ $data->kategori }}" label="Kategori" />
        </div>

        <div class="col-md-12">
            <x-form.input name="url" value="{{ $data->url }}" label="Url" />
        </div>

        <div class="col-md-6">
            <x-form.input name="orders" value="{{ $data->orders }}" label="Orders" />
        </div>

        <div class="col-md-6">
            <x-form.input name="icon" value="{{ $data->icon }}" label="Icon" />
        </div>

        <div class="col-md-6">
            <x-form.radio label="Level Menu" name="level_menu" inline="true"
                value="{{ $data->main_menu_id ? 'sub_menu' : 'main_menu' }}" :options="['Main menu' => 'main_menu', 'Sub menu' => 'sub_menu']" />
        </div>

        <div class="col-md-6 {{ !$data->main_menu_id ? 'd-none' : '' }}" id="main_menu_wrapper">
            <x-form.select id="main_menu" name="main_menu" value="{{ $data->main_menu_id }}" label="Main Menu"
                placeholder="Pilih main menu" :options="$mainMenus" />
        </div>

        @if (!$data->id)
            <div class="col-md-12" id="permission_wrapper">
                <div>
                    <label for="" class="mb-2 form-label d-block">Permissions</label>
                </div>
                <div class="d-flex mb-2">
                    @foreach (['create', 'read', 'update', 'delete'] as $item)
                        <x-form.checkbox name="permissions[]" id="{{ $item }}_permissions"
                            value="{{ $item }}" label="{{ $item }}" />
                    @endforeach
                </div>
            </div>
        @endif


    </div>
</x-form.modal>
