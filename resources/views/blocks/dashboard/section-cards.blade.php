<section class="px-4 lg:px-6" aria-labelledby="dashboard-overview-heading" data-test="dashboard-section-cards">
  <x-ui.heading id="dashboard-overview-heading" variant="section" class="sr-only">
    {{ __('Dashboard overview') }}
  </x-ui.heading>

  <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    @foreach ($metrics as $metric)
      <x-ui.card>
        <x-ui.card.header class="flex-row items-center justify-between space-y-0 pb-2">
          <x-ui.card.title class="text-sm font-medium text-muted-foreground">{{ $metric['label'] }}</x-ui.card.title>
          <x-ui.badge :variant="$metric['trendPositive'] ? 'secondary' : 'outline'" class="shrink-0 px-1.5 py-0 text-xs">
            <x-ui.icon :name="$metric['trendIcon']" class="size-3 mr-1" />
            {{ $metric['trend'] }}
          </x-ui.badge>
        </x-ui.card.header>

        <x-ui.card.content>
          <p class="text-2xl font-bold text-foreground">{{ $metric['value'] }}</p>
          <div class="mt-1 flex flex-col gap-0.5">
            <p class="text-sm text-foreground">{{ $metric['trendText'] }}</p>
            <p class="text-xs text-muted-foreground">{{ $metric['description'] }}</p>
          </div>
        </x-ui.card.content>
      </x-ui.card>
    @endforeach
  </div>
</section>
