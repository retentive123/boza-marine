@props(['agents'])

<div x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false" class="fixed bottom-6 left-6 z-40">
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute bottom-full left-0 mb-3 w-64 rounded-xl border border-navy-100 bg-white p-3 shadow-soft"
    >
        <div class="flex items-center justify-between px-2 pb-2">
            <p class="text-xs font-semibold uppercase tracking-wider text-navy-400">Chat with us on WhatsApp</p>
            <button @click="open = false" aria-label="Hide" class="text-navy-300 transition hover:text-navy-600">
                <x-icon name="x" class="h-3.5 w-3.5" />
            </button>
        </div>
        <div class="space-y-1">
            @foreach ($agents as $agent)
                <a
                    href="https://wa.me/{{ preg_replace('/\D/', '', $agent['number']) }}"
                    target="_blank"
                    rel="noopener"
                    class="flex items-center gap-3 rounded-lg px-2 py-2 transition hover:bg-navy-50"
                >
                    @if ($agent['photo'] ?? null)
                        <img src="{{ asset('storage/'.$agent['photo']) }}" alt="{{ $agent['name'] }}" class="h-9 w-9 shrink-0 rounded-full object-cover">
                    @else
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-white" style="background-color: #25D366">
                            <x-icon name="whatsapp" class="h-4 w-4" />
                        </span>
                    @endif
                    <span class="text-sm font-semibold text-navy-800">{{ $agent['name'] }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <button
        @click="open = !open"
        aria-label="Chat on WhatsApp"
        class="flex h-11 w-11 items-center justify-center rounded-full text-white shadow-soft transition hover:-translate-y-0.5"
        style="background-color: #25D366"
    >
        <x-icon name="whatsapp" class="h-5 w-5" />
    </button>
</div>
