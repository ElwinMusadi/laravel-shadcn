<section aria-labelledby="dashboard-overview-heading" data-test="dashboard-section-cards">
    <x-ui.heading id="dashboard-overview-heading" variant="section" class="sr-only">
        {{ __('Dashboard overview') }}
    </x-ui.heading>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($metrics as $metric)
            <x-ui.card class="flex min-h-44 flex-col">
                <x-ui.card.header class="flex-row items-start justify-between gap-4">
                    <div class="flex min-w-0 flex-col gap-1.5">
                        <x-ui.card.title class="text-base">{{ $metric['label'] }}</x-ui.card.title>
                        <x-ui.card.description>{{ $metric['description'] }}</x-ui.card.description>
                    </div>

                    <x-ui.badge variant="secondary" class="shrink-0">{{ $metric['trend'] }}</x-ui.badge>
                </x-ui.card.header>

                <x-ui.card.content class="mt-auto">
                    <p class="text-3xl font-semibold tracking-tight text-card-foreground sm:text-4xl">{{ $metric['value'] }}</p>
                </x-ui.card.content>
            </x-ui.card>
        @endforeach
    </div>
</section>
