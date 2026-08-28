<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <nav aria-label="{{ __('Settings') }}" class="flex flex-col gap-1">
            @foreach ([
                ['label' => __('Profile'), 'route' => 'profile.edit', 'active' => 'profile.*', 'test' => 'settings-nav-profile'],
                ['label' => __('Security'), 'route' => 'security.edit', 'active' => 'security.*', 'test' => 'settings-nav-security'],
                ['label' => __('Appearance'), 'route' => 'appearance.edit', 'active' => 'appearance.*', 'test' => 'settings-nav-appearance'],
            ] as $item)
                <a
                    href="{{ route($item['route']) }}"
                    wire:navigate
                    @if (request()->routeIs($item['active'])) aria-current="page" @endif
                    @class([
                        'rounded-md px-3 py-2 text-sm font-medium outline-none transition-colors focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background',
                        'bg-accent text-accent-foreground' => request()->routeIs($item['active']),
                        'text-muted-foreground hover:bg-accent hover:text-accent-foreground' => ! request()->routeIs($item['active']),
                    ])
                    data-test="{{ $item['test'] }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
    </div>

    <x-ui.separator class="md:hidden" />

    <div class="flex-1 self-stretch max-md:pt-6">
        <x-ui.heading variant="section">{{ $heading ?? '' }}</x-ui.heading>
        <p class="mt-2 text-sm leading-6 text-muted-foreground">{{ $subheading ?? '' }}</p>

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
