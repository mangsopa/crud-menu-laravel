@props(['name', 'label', 'value' => '', 'placeholder' => $label])

<div>
    <label for="namaMenu" class="form-label">{{ $label }}</label>
    <input type="text" class="form-control" id="namaMenu" name="{{ $name }}" value="{{ $value }}"
        placeholder="{{ $placeholder }}">
</div>
