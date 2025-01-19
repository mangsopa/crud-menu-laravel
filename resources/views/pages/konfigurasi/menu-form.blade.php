<x-form.modal title="Form Modal">
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


            {{-- <div>
                <label class="form-label">Level Menu</label>
            </div>
            <div class="mt-2">
                <input class="form-check-input" {{ !$data->main_menu_id ? 'checked' : '' }} type="checkbox"
                    id="level_menu1" name="level_menu" value="main_menu"
                    onclick="toggleCheckbox('level_menu1', 'level_menu2')">
                <label class="form-check-label" for="level_menu1" style="margin-right: 20px;">
                    Main Menu
                </label>

                <input class="form-check-input" {{ $data->main_menu_id ? 'checked' : '' }} type="checkbox"
                    id="level_menu2" name="level_menu" value="sub_menu"
                    onclick="toggleCheckbox('level_menu2', 'level_menu1')">
                <label class="form-check-label" for="level_menu2">
                    Sub Menu
                </label>
            </div> --}}
        </div>

        <div class="col-md-6 {{ !$data->main_menu_id ? 'd-none' : '' }}" id="main_menu_wrapper">
            <div>
                <label class="form-label">Main Menu</label>
            </div>
            <div class="col-lg-12">
                <select class="form-select rounded-pill" name="main_menu">
                    <option selected value="">Pilih Main Menu</option>
                    @foreach ($mainMenus as $item)
                        <option value="{{ $item->id }}" @selected($data->main_menu_id == $item->id)>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12" id="permission_wrapper">
            <div>
                <label class="form-label">Permission</label>
            </div>
            <div class="d-flex mb-2">
                @foreach (['create', 'read', 'update', 'delete'] as $item)
                    <div class="form-check form-check-dark me-3">
                        <input class="form-check-input" type="checkbox" id="permissionWrapper1{{ $item }}"
                            value="{{ $item }}" name="permissions[]">
                        <label class="form-check-label" for="permissionWrapper1{{ $item }}">
                            {{ $item }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-form.modal>
