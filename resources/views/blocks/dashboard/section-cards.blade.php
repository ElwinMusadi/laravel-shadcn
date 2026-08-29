<section class="px-4 lg:px-6" aria-labelledby="dashboard-overview-heading" data-test="dashboard-section-cards">
    <x-ui.heading id="dashboard-overview-heading" variant="section" class="sr-only">
        {{ __('Dashboard overview') }}
    </x-ui.heading>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($metrics as $metric)
            <x-ui.card class="flex min-h-48 flex-col gap-0 py-0">
                <x-ui.card.header class="flex-row items-center justify-between gap-3 border-b border-border px-4 py-3">
                    <x-ui.card.title class="text-sm font-medium">{{ $metric['label'] }}</x-ui.card.title>

                    <x-ui.badge :variant="$metric['trendPositive'] ? 'default' : 'outline'" class="shrink-0">
                        <x-ui.icon :name="$metric['trendIcon']" class="size-3" />
                        {{ $metric['trend'] }}
                    </x-ui.badge>
                </x-ui.card.header>

                <x-ui.card.content class="flex flex-1 flex-col gap-2 px-4 py-4">
                    <p class="text-2xl font-semibold tracking-tight text-card-foreground sm:text-3xl">{{ $metric['value'] }}</p>
                    <p class="flex items-center gap-1 text-sm font-medium text-foreground">
                        <x-ui.icon :name="$metric['trendIcon']" class="size-4" />
                        {{ $metric['trendText'] }}
                    </p>
                    <x-ui.card.description>{{ $metric['description'] }}</x-ui.card.description>
                </x-ui.card.content>
            </x-ui.card>
        @endforeach
    </div>
</section>
