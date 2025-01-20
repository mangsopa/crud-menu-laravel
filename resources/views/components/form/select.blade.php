@props(['name', 'label', 'value' => '', 'placeholder' => $label, 'options'])

<div>
    <label class="form-label">{{ $label }}</label>
</div>
<div class="col-lg-12">
    <select {{ $attributes->merge(['class' => ' form-select rounded-pill']) }} name="{{ $name }}">
        <option selected value=""> {{ $placeholder }}</option>
        @foreach ($options as $key => $item)
            <option value="{{ $item }}" @selected($value == $item)>
                {{ $key }}</option>
        @endforeach
        {{ $slot }}
    </select>
</div>
