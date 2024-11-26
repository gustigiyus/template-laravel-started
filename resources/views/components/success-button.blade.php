<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-5 py-2.5 bg-green-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
