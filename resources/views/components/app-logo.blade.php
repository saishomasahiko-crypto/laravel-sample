<div {{ $attributes->merge(['class' => 'flex aspect-square size-10 items-center justify-center rounded-md bg-accent-content text-accent-foreground']) }}>
    <!-- <x-app-logo-icon class="size-5 fill-current text-white dark:text-black" /> -->
    <img src="{{ asset('img/logo.jpg')}}" class = "bg-white">
</div>
<div class="ms-1 grid flex-1 text-start text-sm">
    <span class="mb-0.5 truncate leading-tight font-semibold">Laravel Starter Kit</span>
</div>
