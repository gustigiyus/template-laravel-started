@props(['value'])

<p {{ $attributes->merge(['class' => 'mt-1 text-sm message-normal']) }}>
    {{ $value ?? $slot }}
</p>
