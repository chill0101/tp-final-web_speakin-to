<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-neutral border border-primary rounded-md font-semibold text-xs text-secondary uppercase tracking-widest shadow-sm hover:bg-primary hover:text-white focus:outline-none focus:ring-2 focus:ring-info focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
