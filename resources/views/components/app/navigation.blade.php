@props([
    'items' => null,
    'label' => null,
])

@php
    $items ??= [
        [
            'key' => 'dashboard',
            'label' => __('Dashboard'),
            'route' => 'dashboard',
            'active' => ['dashboard'],
        ],
        [
            'key' => 'ui-components',
            'label' => __('UI Components'),
            'route' => 'ui.components',
            'active' => ['ui.components'],
        ],
    ];
@endphp

<nav {{ $attributes->class('w-full')->merge(['aria-label' => $label ?? __('Primary navigation')]) }} data-test="application-navigation">
    <ul class="flex flex-col gap-1 lg:flex-row lg:items-center">
        @foreach ($items as $item)
            @php
                $activePatterns = $item['active'] ?? ($item['route'] ?? null);
                $activePatterns = is_array($activePatterns) ? $activePatterns : [$activePatterns];
                $activePatterns = array_filter($activePatterns);
                $isActive = $activePatterns !== [] && request()->routeIs(...$activePatterns);
                $href = isset($item['route'])
                    ? route($item['route'], $item['parameters'] ?? [])
                    : ($item['href'] ?? '#');
            @endphp

            <li>
                <a
                    href="{{ $href }}"
                    @if (($item['wireNavigate'] ?? isset($item['route']))) wire:navigate @endif
                    @if ($isActive) aria-current="page" @endif
                    data-test="application-navigation-item-{{ $item['key'] ?? $loop->index }}"
                    @class([
                        'flex min-h-9 items-center rounded-md px-3 py-2 text-sm font-medium outline-none transition-colors focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background',
                        'bg-accent text-accent-foreground' => $isActive,
                        'text-muted-foreground hover:bg-accent hover:text-accent-foreground' => ! $isActive,
                    ])
                >
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
