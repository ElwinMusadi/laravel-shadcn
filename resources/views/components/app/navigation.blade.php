@props([
    'groups' => [],
    'label' => null,
    'mobile' => false,
])

<nav {{ $attributes->class('flex h-full w-full flex-col gap-4')->merge(['aria-label' => $label ?? __('Primary navigation')]) }} data-test="application-navigation-{{ $mobile ? 'mobile' : 'desktop' }}">
  @foreach ($groups as $group)
    <section @class(['mt-auto' => ($group['position'] ?? null) === 'bottom']) aria-labelledby="sidebar-group-{{ $mobile ? 'mobile' : 'desktop' }}-{{ $group['key'] ?? $loop->index }}">
      @if (filled($group['label'] ?? null))
        <p id="sidebar-group-{{ $mobile ? 'mobile' : 'desktop' }}-{{ $group['key'] ?? $loop->index }}" class="flex h-8 shrink-0 items-center px-2 text-xs font-medium text-sidebar-foreground/70">
          {{ $group['label'] }}
        </p>
      @endif

      <ul class="flex flex-col gap-1" role="list">
        @if ($group['quickActions'] ?? false)
          <li class="flex items-center gap-2 pb-2">
            <x-ui.button size="sm" class="h-8 min-w-0 flex-1 justify-start text-sm" data-test="sidebar-quick-create">
              <x-ui.icon name="circle-plus" class="size-4" />
              {{ __('Quick Create') }}
            </x-ui.button>

            {{-- <x-ui.button variant="outline" size="icon" class="h-8 w-8 shrink-0" aria-label="{{ __('Inbox') }}" data-test="sidebar-inbox">
              <x-ui.icon name="inbox" class="size-4" />
              <span class="sr-only">{{ __('Inbox') }}</span>
            </x-ui.button> --}}
          </li>
        @endif

        @foreach ($group['items'] ?? [] as $item)
          @php
            $activePatterns = $item['active'] ?? ($item['route'] ?? null);
            $activePatterns = is_array($activePatterns) ? $activePatterns : [$activePatterns];
            $activePatterns = array_filter($activePatterns);
            $isActive = $activePatterns !== [] && request()->routeIs(...$activePatterns);
            $href = isset($item['route']) ? route($item['route'], $item['parameters'] ?? []) : $item['href'] ?? '#main-content';
          @endphp

          <li>
            <a href="{{ $href }}" @if ($item['wireNavigate'] ?? isset($item['route'])) wire:navigate @endif @if ($isActive) aria-current="page" @endif data-test="sidebar-navigation-item-{{ $item['key'] ?? $loop->index }}" @class([
                'flex h-8 items-center gap-2 rounded-md px-2 text-sm outline-none transition-colors focus-visible:ring-2 focus-visible:ring-sidebar-ring focus-visible:ring-offset-2 focus-visible:ring-offset-sidebar',
                'bg-sidebar-accent text-sidebar-accent-foreground font-medium' => $isActive,
                'text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground' => !$isActive,
            ])>
              <x-ui.icon :name="$item['icon'] ?? 'circle-help'" class="size-4" />
              <span class="truncate">{{ $item['label'] }}</span>
            </a>
          </li>
        @endforeach
      </ul>
    </section>
  @endforeach
</nav>
