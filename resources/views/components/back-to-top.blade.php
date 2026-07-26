<div
    x-data="{ show: false }"
    x-init="window.addEventListener('scroll', () => { show = window.scrollY > 500 })"
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed bottom-6 right-6 z-40"
>
    <button
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        aria-label="Back to top"
        class="flex h-11 w-11 items-center justify-center rounded-full text-white shadow-soft transition hover:-translate-y-0.5"
        style="background-color: var(--color-primary)"
    >
        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 19V5M5 12l7-7 7 7" />
        </svg>
    </button>
</div>
