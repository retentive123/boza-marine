@if ($clients->isNotEmpty())
    <section class="border-y border-navy-100 bg-navy-50/50 py-14">
        <div class="container-boza">
            <div class="reveal flex items-center justify-center gap-4 sm:gap-6">
                <span class="h-px w-10 shrink-0 bg-navy-200 sm:w-20"></span>
                <p class="whitespace-nowrap text-center text-xs font-bold uppercase tracking-widest text-navy-400">Trusted by Industry Leaders Worldwide</p>
                <span class="h-px w-10 shrink-0 bg-navy-200 sm:w-20"></span>
            </div>
        </div>

        <div class="reveal relative mt-8 overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_8%,black_92%,transparent)]">
            <div class="flex w-max animate-marquee items-center gap-4">
                @foreach (range(1, 2) as $repeat)
                    @foreach ($clients as $client)
                        @php $tag = $client->website_url ? 'a' : 'div'; @endphp
                        <{{ $tag }}
                            @if ($client->website_url) href="{{ $client->website_url }}" target="_blank" rel="noopener" @endif
                            class="flex shrink-0 items-center gap-2.5 rounded-full border border-navy-100 bg-white px-5 py-2.5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-soft"
                        >
                            @if ($client->logo_path)
                                <img src="{{ asset('storage/'.$client->logo_path) }}" alt="{{ $client->name }}" class="h-6 w-auto object-contain">
                            @else
                                <x-icon name="building-office" class="h-4 w-4 text-[var(--color-primary)]" />
                            @endif
                            <span class="whitespace-nowrap text-sm font-semibold text-navy-700">{{ $client->name }}</span>
                        </{{ $tag }}>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
@endif
