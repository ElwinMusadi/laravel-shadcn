@props([
    'title' => null,
    'description' => null,
    'breadcrumbs' => [],
])

<div {{ $attributes->class('flex flex-col gap-4 border-b border-border pb-6 sm:flex-row sm:items-end sm:justify-between') }}>
    <div class="flex min-w-0 flex-col gap-3">
        @if ($breadcrumbs !== [])
            <x-ui.breadcrumb>
                @foreach ($breadcrumbs as $breadcrumb)
                    <x-ui.breadcrumb.item>
                        @if (! $loop->last && isset($breadcrumb['route']))
                            <x-ui.breadcrumb.link href="{{ route($breadcrumb['route'], $breadcrumb['parameters'] ?? []) }}" wire:navigate>
                                {{ $breadcrumb['label'] }}
                            </x-ui.breadcrumb.link>
                        @else
                            <x-ui.breadcrumb.page>{{ $breadcrumb['label'] }}</x-ui.breadcrumb.page>
                        @endif
                    </x-ui.breadcrumb.item>

                    @if (! $loop->last)
                        <x-ui.breadcrumb.separator />
                    @endif
                @endforeach
            </x-ui.breadcrumb>
        @endif

        @if (filled($title))
            <div class="flex flex-col gap-1">
                <x-ui.heading variant="page">{{ $title }}</x-ui.heading>

                @if (filled($description))
                    <x-ui.heading variant="description">{{ $description }}</x-ui.heading>
                @endif
            </div>
        @endif
    </div>

    @if (isset($actions) && ! $actions->isEmpty())
        <div class="flex shrink-0 items-center gap-2">
            {{ $actions }}
        </div>
    @endif
</div>
