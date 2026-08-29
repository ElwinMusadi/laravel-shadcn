@php
  $views = [
      ['value' => 'outline', 'label' => __('Outline'), 'count' => 24],
      ['value' => 'past-performance', 'label' => __('Past Performance'), 'count' => 8],
      ['value' => 'key-personnel', 'label' => __('Key Personnel'), 'count' => 12],
      ['value' => 'focus-documents', 'label' => __('Focus Documents'), 'count' => 5],
  ];
@endphp

<section class="flex w-full flex-col gap-4" aria-labelledby="dashboard-data-table-heading" data-test="dashboard-data-table">
  <div class="flex flex-col gap-4 px-4 lg:flex-row lg:items-center lg:justify-between lg:px-6">
    <div class="min-w-0">
      <x-ui.heading id="dashboard-data-table-heading" variant="section" class="text-lg">
        {{ __('Documents') }}
      </x-ui.heading>
      <p class="mt-1 text-sm text-muted-foreground">{{ __('Static demo data adapted from the Dashboard-01 table composition.') }}</p>
    </div>

    <x-ui.dropdown id="dashboard-columns" data-test="dashboard-column-controls">
      <x-ui.dropdown.trigger variant="outline" size="sm" aria-label="{{ __('Choose visible columns') }}">
        <x-ui.icon name="columns-3" class="size-4" />
        {{ __('Columns') }}
      </x-ui.dropdown.trigger>

      <x-ui.dropdown.content align="end">
        <x-ui.dropdown.label>{{ __('Visible columns') }}</x-ui.dropdown.label>
        <x-ui.dropdown.separator />
        @foreach ([__('Header'), __('Section Type'), __('Status'), __('Target'), __('Limit'), __('Reviewer')] as $column)
          <x-ui.dropdown.item>
            <x-ui.icon name="circle-check" class="size-4" />
            {{ $column }}
          </x-ui.dropdown.item>
        @endforeach
      </x-ui.dropdown.content>
    </x-ui.dropdown>
  </div>

  <div class="px-4 lg:px-6">
    <x-ui.tabs id="dashboard-views" default="outline" data-test="dashboard-view-controls">
      <x-ui.tabs.list class="max-w-full !justify-start overflow-x-auto">
        @foreach ($views as $view)
          <x-ui.tabs.trigger :value="$view['value']" class="gap-2">
            {{ $view['label'] }}
            <x-ui.badge variant="secondary" class="px-1.5 py-0 text-[10px]">{{ $view['count'] }}</x-ui.badge>
          </x-ui.tabs.trigger>
        @endforeach
      </x-ui.tabs.list>

      @foreach ($views as $view)
        <x-ui.tabs.content :value="$view['value']" class="sr-only">
          {{ __('The :view static view is selected.', ['view' => $view['label']]) }}
        </x-ui.tabs.content>
      @endforeach
    </x-ui.tabs>
  </div>

  <div class="px-4 lg:px-6">
    <div class="rounded-md border">
      <x-ui.table class="min-w-[920px]" data-test="dashboard-table">
        <x-ui.table.caption class="sr-only">{{ __('Demo document sections and their review status.') }}</x-ui.table.caption>

        <x-ui.table.header>
          <x-ui.table.row>
            <x-ui.table.head class="w-8 px-1"><span class="sr-only">{{ __('Reorder') }}</span></x-ui.table.head>
            <x-ui.table.head class="w-10 px-2">
              <x-ui.checkbox aria-label="{{ __('Select all document sections') }}" />
            </x-ui.table.head>
            <x-ui.table.head>{{ __('Header') }}</x-ui.table.head>
            <x-ui.table.head>{{ __('Section Type') }}</x-ui.table.head>
            <x-ui.table.head>{{ __('Status') }}</x-ui.table.head>
            <x-ui.table.head class="text-right">{{ __('Target') }}</x-ui.table.head>
            <x-ui.table.head class="text-right">{{ __('Limit') }}</x-ui.table.head>
            <x-ui.table.head>{{ __('Reviewer') }}</x-ui.table.head>
            <x-ui.table.head class="w-12"><span class="sr-only">{{ __('Actions') }}</span></x-ui.table.head>
          </x-ui.table.row>
        </x-ui.table.header>

        <x-ui.table.body>
          @foreach ($tableRows as $row)
            <x-ui.table.row data-test="dashboard-table-row-{{ $row['id'] }}">
              <x-ui.table.cell class="w-8 px-1 text-muted-foreground">
                <x-ui.icon name="grip-vertical" class="size-4" />
                <span class="sr-only">{{ __('Drag to reorder') }}</span>
              </x-ui.table.cell>
              <x-ui.table.cell class="w-10 px-2">
                <x-ui.checkbox name="selected_sections[]" value="{{ $row['id'] }}" aria-label="{{ __('Select :header', ['header' => $row['header']]) }}" />
              </x-ui.table.cell>
              <x-ui.table.cell class="font-medium text-foreground">{{ $row['header'] }}</x-ui.table.cell>
              <x-ui.table.cell class="text-muted-foreground">{{ $row['type'] }}</x-ui.table.cell>
              <x-ui.table.cell><x-ui.badge :variant="$row['statusVariant']">{{ $row['status'] }}</x-ui.badge></x-ui.table.cell>
              <x-ui.table.cell class="text-right font-mono text-xs">{{ $row['target'] }}</x-ui.table.cell>
              <x-ui.table.cell class="text-right font-mono text-xs">{{ $row['limit'] }}</x-ui.table.cell>
              <x-ui.table.cell class="text-muted-foreground">{{ $row['reviewer'] }}</x-ui.table.cell>
              <x-ui.table.cell class="text-right">
                <x-ui.dropdown id="dashboard-row-actions-{{ $row['id'] }}" data-test="dashboard-row-action-{{ $row['id'] }}">
                  <x-ui.dropdown.trigger size="icon" variant="ghost" aria-label="{{ __('Open actions for :header', ['header' => $row['header']]) }}">
                    <x-ui.icon name="ellipsis" class="size-4" />
                    <span class="sr-only">{{ __('Open actions') }}</span>
                  </x-ui.dropdown.trigger>

                  <x-ui.dropdown.content align="end">
                    <x-ui.dropdown.group>
                      <x-ui.dropdown.label>{{ __('Demo actions') }}</x-ui.dropdown.label>
                      <x-ui.dropdown.item href="#dashboard-data-table-heading">{{ __('Preview section') }}</x-ui.dropdown.item>
                      <x-ui.dropdown.item>{{ __('Copy reference') }}</x-ui.dropdown.item>
                    </x-ui.dropdown.group>
                  </x-ui.dropdown.content>
                </x-ui.dropdown>
              </x-ui.table.cell>
            </x-ui.table.row>
          @endforeach
        </x-ui.table.body>
      </x-ui.table>
    </div>
  </div>

  <div class="flex flex-col gap-3 px-4 pb-2 sm:flex-row sm:items-center sm:justify-between lg:px-6">
    <p class="text-sm text-muted-foreground">{{ __('Page 1 of 7') }}</p>

    <div class="flex items-center gap-3">
      <label for="dashboard-rows-per-page" class="text-sm text-muted-foreground">{{ __('Rows per page') }}</label>
      <x-ui.select id="dashboard-rows-per-page" class="w-18" aria-label="{{ __('Rows per page') }}">
        <option selected>10</option>
        <option>20</option>
        <option>30</option>
      </x-ui.select>

      <x-ui.pagination class="w-auto" label="{{ __('Dashboard table pagination') }}">
        <x-ui.pagination.previous disabled>
          <x-ui.icon name="chevron-left" class="size-4" />
        </x-ui.pagination.previous>
        <x-ui.pagination.next>
          <x-ui.icon name="chevron-right" class="size-4" />
        </x-ui.pagination.next>
      </x-ui.pagination>
    </div>
  </div>
</section>
