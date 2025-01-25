@props(['label' => null, 'value' => '', 'id' => 'select_' . rand(), 'placeholder' => $label, 'options'])

@if ($label)
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
@endif
<div class="col-lg-12">
    <select {{ $attributes->merge(['class' => ' form-select rounded-pill']) }} id="{{ $id }}">
        <option selected value=""> {{ $placeholder }}</option>
        @foreach ($options as $key => $item)
            <option value="{{ $item }}" @selected($value == $item)>
                {{ $key }}</option>
        @endforeach
        {{ $slot }}
    </select>
</div>
