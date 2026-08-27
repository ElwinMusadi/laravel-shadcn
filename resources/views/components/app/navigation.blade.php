@props([
    'groups' => [],
    'label' => null,
    'mobile' => false,
])

@php
    $collapsedControlClass = $mobile ? '{}' : "{ '!justify-center !px-0': ! sidebarExpanded }";
    $collapsedNavigationClick = $mobile ? 'void 0' : 'if (! sidebarExpanded) { sidebarExpanded = true; open = true }';
@endphp

<nav {{ $attributes->class('w-full')->merge(['aria-label' => $label ?? __('Primary navigation')]) }} data-test="application-navigation-{{ $mobile ? 'mobile' : 'desktop' }}">
    <div class="flex flex-col gap-5">
        @foreach ($groups as $group)
            <section aria-labelledby="sidebar-group-{{ $mobile ? 'mobile' : 'desktop' }}-{{ $group['key'] ?? $loop->index }}">
                <p
                    id="sidebar-group-{{ $mobile ? 'mobile' : 'desktop' }}-{{ $group['key'] ?? $loop->index }}"
                    @if (! $mobile) x-show="sidebarExpanded" @endif
                    class="px-2 text-xs font-medium tracking-wide text-sidebar-foreground/70"
                >
                    {{ $group['label'] }}
                </p>

                <ul class="mt-2 flex flex-col gap-1" role="list">
                    @foreach ($group['items'] ?? [] as $item)
                        @php
                            $children = $item['children'] ?? [];
                            $activePatterns = $item['active'] ?? ($item['route'] ?? null);
                            $activePatterns = is_array($activePatterns) ? $activePatterns : [$activePatterns];
                            $activePatterns = array_filter($activePatterns);
                            $isActive = $activePatterns !== [] && request()->routeIs(...$activePatterns);

                            foreach ($children as $child) {
                                $childPatterns = $child['active'] ?? ($child['route'] ?? null);
                                $childPatterns = is_array($childPatterns) ? $childPatterns : [$childPatterns];
                                $childPatterns = array_filter($childPatterns);
                                $isActive = $isActive || ($childPatterns !== [] && request()->routeIs(...$childPatterns));
                            }
                        @endphp

                        @if ($children !== [])
                            <li>
                                <x-ui.collapsible
                                    id="sidebar-navigation-{{ $mobile ? 'mobile' : 'desktop' }}-{{ $item['key'] ?? $loop->index }}"
                                    :default-open="$isActive"
                                    data-test="sidebar-navigation-group-{{ $item['key'] ?? $loop->index }}"
                                >
                                    <x-ui.collapsible.trigger
                                        class="w-full justify-start px-2 text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground"
                                        aria-label="{{ $item['label'] }}"
                                        title="{{ $item['label'] }}"
                                        x-bind:class="{{ $collapsedControlClass }}"
                                        @click="{{ $collapsedNavigationClick }}"
                                    >
                                        <span class="flex size-6 shrink-0 items-center justify-center rounded-md bg-sidebar-primary text-xs font-semibold text-sidebar-primary-foreground" aria-hidden="true">
                                            {{ $item['icon'] ?? mb_strtoupper(mb_substr($item['label'], 0, 1)) }}
                                        </span>
                                        <span @if (! $mobile) x-show="sidebarExpanded" @endif class="min-w-0 flex-1 truncate text-left">
                                            {{ $item['label'] }}
                                        </span>
                                        <span @if (! $mobile) x-show="sidebarExpanded" @endif class="text-sm transition-transform" :class="{ 'rotate-90': open }" aria-hidden="true">›</span>
                                    </x-ui.collapsible.trigger>

                                    <div @if (! $mobile) x-show="sidebarExpanded" @endif>
                                        <x-ui.collapsible.content class="pt-1">
                                            <ul class="ms-5 flex flex-col gap-1 border-s border-sidebar-border ps-3" role="list">
                                                @foreach ($children as $child)
                                                    @php
                                                        $childPatterns = $child['active'] ?? ($child['route'] ?? null);
                                                        $childPatterns = is_array($childPatterns) ? $childPatterns : [$childPatterns];
                                                        $childPatterns = array_filter($childPatterns);
                                                        $childIsActive = $childPatterns !== [] && request()->routeIs(...$childPatterns);
                                                        $childHref = isset($child['route'])
                                                            ? route($child['route'], $child['parameters'] ?? [])
                                                            : ($child['href'] ?? '#');
                                                    @endphp

                                                    <li>
                                                        <a
                                                            href="{{ $childHref }}"
                                                            @if (($child['wireNavigate'] ?? isset($child['route']))) wire:navigate @endif
                                                            @if ($childIsActive) aria-current="page" @endif
                                                            data-test="sidebar-navigation-item-{{ $child['key'] ?? $loop->index }}"
                                                            @class([
                                                                'flex min-h-8 items-center rounded-md px-2 py-1.5 text-sm outline-none transition-colors focus-visible:ring-2 focus-visible:ring-sidebar-ring focus-visible:ring-offset-2 focus-visible:ring-offset-sidebar',
                                                                'bg-sidebar-accent font-medium text-sidebar-accent-foreground' => $childIsActive,
                                                                'text-sidebar-foreground/80 hover:bg-sidebar-accent hover:text-sidebar-accent-foreground' => ! $childIsActive,
                                                            ])
                                                        >
                                                            <span class="truncate">{{ $child['label'] }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </x-ui.collapsible.content>
                                    </div>
                                </x-ui.collapsible>
                            </li>
                        @else
                            @php
                                $href = isset($item['route'])
                                    ? route($item['route'], $item['parameters'] ?? [])
                                    : ($item['href'] ?? '#');
                            @endphp

                            <li>
                                <a
                                    href="{{ $href }}"
                                    @if (($item['wireNavigate'] ?? isset($item['route']))) wire:navigate @endif
                                    @if ($isActive) aria-current="page" @endif
                                    aria-label="{{ $item['label'] }}"
                                    title="{{ $item['label'] }}"
                                    data-test="sidebar-navigation-item-{{ $item['key'] ?? $loop->index }}"
                                    x-bind:class="{{ $collapsedControlClass }}"
                                    @class([
                                        'flex min-h-9 items-center gap-2 rounded-md px-2 py-2 text-sm font-medium outline-none transition-colors focus-visible:ring-2 focus-visible:ring-sidebar-ring focus-visible:ring-offset-2 focus-visible:ring-offset-sidebar',
                                        'bg-sidebar-accent text-sidebar-accent-foreground' => $isActive,
                                        'text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground' => ! $isActive,
                                    ])
                                >
                                    <span class="flex size-6 shrink-0 items-center justify-center rounded-md bg-sidebar-primary text-xs font-semibold text-sidebar-primary-foreground" aria-hidden="true">
                                        {{ $item['icon'] ?? mb_strtoupper(mb_substr($item['label'], 0, 1)) }}
                                    </span>
                                    <span @if (! $mobile) x-show="sidebarExpanded" @endif class="truncate">{{ $item['label'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </section>
        @endforeach
    </div>
</nav>
