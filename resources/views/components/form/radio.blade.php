@props(['name', 'label', 'value' => '', 'options', 'inline' => false])

<div class="d-block">
    <label class="form-label">{{ $label }}</label>
</div>

@foreach ($options as $key => $optionValue)
    <div class="form-check {{ $inline ? 'form-check-inline' : '' }}">
        <input class="form-check-input" {{ $value == $optionValue ? 'checked' : '' }} type="radio"
            id="{{ $optionValue . $key }}" name="{{ $name }}" value="{{ $optionValue }}">
        <label class="form-check-label" for="{{ $optionValue . $key }}">
            {{ $key }}
        </label>
    </div>
@endforeach
