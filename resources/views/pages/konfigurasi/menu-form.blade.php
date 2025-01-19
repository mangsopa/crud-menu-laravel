<div class="modal-dialog modal-fullscreen-lg-down modal-dialog-centered">
    <div class="modal-content">
        <form action="{{ $action }}" method="post" id="form_action">
            @csrf
            @if ($data->id)
                @method('PUT')
            @endif
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalFullscreenLgLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div>
                            <label for="namaMenu" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control" id="namaMenu" name="name"
                                value="{{ $data->name }}" placeholder="Nama Menu">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div>
                            <label for="icon" class="form-label">Icon</label>
                            <input type="text" class="form-control" id="icon" name="icon"
                                value="{{ $data->icon }}" placeholder="Icon">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div>
                            <label for="url" class="form-label">Url</label>
                            <input type="text" class="form-control" id="url" name="url"
                                value="{{ $data->url }}" placeholder="Url">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div>
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="category"
                                value="{{ $data->category }}" placeholder="Kategori">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div>
                            <label for="noUrut" class="form-label">Orders</label>
                            <input type="text" class="form-control" id="noUrut" name="orders"
                                value="{{ $data->orders }}" placeholder="Orders">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div>
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
                        </div>
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
                                    <input class="form-check-input" type="checkbox"
                                        id="permissionWrapper1{{ $item }}" value="{{ $item }}"
                                        name="permissions[]">
                                    <label class="form-check-label" for="permissionWrapper1{{ $item }}">
                                        {{ $item }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium material-shadow-none"
                    data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                <button type="submit" class="btn btn-primary ">Save changes</button>
            </div>
        </form>
    </div>
</div>
