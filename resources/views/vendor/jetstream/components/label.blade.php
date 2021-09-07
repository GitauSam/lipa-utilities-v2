@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-base text-white']) }}>
    {{ $value ?? $slot }}
</label>
