@props(['name', 'label', 'value' => '', 'placeholder' => $label, 'id' => $name])

<div>
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input type="text" id="{{ $id }}" {{ $attributes->merge(['class' => 'form-control']) }}
        name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}">
</div>
