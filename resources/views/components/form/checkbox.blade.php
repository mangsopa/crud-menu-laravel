@props([
    'label' => null,
    'value' => '',
    'justify' => 'form-check-inline',
    'id' => 'id_' . rand(),
    'checked' => false,
])

<div class=" form-check-dark me-3 {{ $justify }}">
    <input {{ $attributes->merge(['class' => 'form-check-input']) }} {{ $checked }} type="checkbox"
        value="{{ $value }}" id="{{ $id }}">
    @if ($label)
        <label class="form-check-label" for="{{ $id }}"> {{ $label }} </label>
    @endif
</div>
