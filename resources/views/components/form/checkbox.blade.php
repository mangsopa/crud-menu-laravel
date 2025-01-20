@props(['name', 'label', 'value' => '', 'id' => $name, 'checked' => false])

<div class="form-check form-check-dark me-3">
    <input class="form-check-input" {{ $checked }} type="checkbox" value="{{ $value }}" name="permissions[]"
        id="{{ $id }}">
    <label class="form-check-label" for="{{ $id }}">
        {{ $label }}
    </label>
</div>
