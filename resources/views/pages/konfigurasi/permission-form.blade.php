<x-form.modal title="Form Menu" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('PUT')
    @endif
    <div class="row g-3">
        <div class="col-md-6">
            <x-form.input name="name" value="{{ $data->name }}" label="Name" />
        </div>
        <div class="col-md-6">
            <x-form.input name="guard_name" value="{{ $data->guard_name }}" label="guard_name" />
        </div>
    </div>
</x-form.modal>
