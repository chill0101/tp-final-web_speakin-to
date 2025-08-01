<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-error border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-warning active:bg-error focus:outline-none focus:ring-2 focus:ring-error focus:ring-offset-2 dark:focus:ring-offset-background transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
