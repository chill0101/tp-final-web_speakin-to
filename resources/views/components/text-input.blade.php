@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-primary bg-neutral text-secondary focus:border-accent focus:ring-info rounded-md shadow-sm transition']) }}>
