<section aria-labelledby="dashboard-data-table-heading" data-test="dashboard-data-table">
    <x-ui.heading id="dashboard-data-table-heading" variant="section" class="sr-only">
        {{ __('Demo items') }}
    </x-ui.heading>

    <x-ui.card>
        <x-ui.card.header>
            <x-ui.card.title>{{ __('Recent items') }}</x-ui.card.title>
            <x-ui.card.description>{{ __('Static sample rows showing the table and action-menu composition.') }}</x-ui.card.description>
        </x-ui.card.header>

        <x-ui.card.content>
            <x-ui.table>
                <x-ui.table.caption class="sr-only">{{ __('Demo items and their current review status.') }}</x-ui.table.caption>

                <x-ui.table.header>
                    <x-ui.table.row>
                        <x-ui.table.head>{{ __('Item') }}</x-ui.table.head>
                        <x-ui.table.head>{{ __('Status') }}</x-ui.table.head>
                        <x-ui.table.head>{{ __('Category') }}</x-ui.table.head>
                        <x-ui.table.head class="text-right">{{ __('Target') }}</x-ui.table.head>
                        <x-ui.table.head class="text-right">{{ __('Limit') }}</x-ui.table.head>
                        <x-ui.table.head>{{ __('Owner') }}</x-ui.table.head>
                        <x-ui.table.head class="w-14"><span class="sr-only">{{ __('Actions') }}</span></x-ui.table.head>
                    </x-ui.table.row>
                </x-ui.table.header>

                <x-ui.table.body>
                    @foreach ($tableRows as $row)
                        <x-ui.table.row data-test="dashboard-table-row-{{ $row['id'] }}">
                            <x-ui.table.cell class="font-medium text-foreground">{{ $row['name'] }}</x-ui.table.cell>
                            <x-ui.table.cell><x-ui.badge :variant="$row['statusVariant']">{{ $row['status'] }}</x-ui.badge></x-ui.table.cell>
                            <x-ui.table.cell class="text-muted-foreground">{{ $row['category'] }}</x-ui.table.cell>
                            <x-ui.table.cell class="text-right font-mono text-xs">{{ $row['target'] }}</x-ui.table.cell>
                            <x-ui.table.cell class="text-right font-mono text-xs">{{ $row['limit'] }}</x-ui.table.cell>
                            <x-ui.table.cell>{{ $row['owner'] }}</x-ui.table.cell>
                            <x-ui.table.cell class="text-right">
                                <x-ui.dropdown id="dashboard-row-actions-{{ $row['id'] }}" data-test="dashboard-row-action-{{ $row['id'] }}">
                                    <x-ui.dropdown.trigger size="icon" aria-label="{{ __('Open actions for :item', ['item' => $row['name']]) }}">
                                        <span aria-hidden="true">•••</span>
                                    </x-ui.dropdown.trigger>

                                    <x-ui.dropdown.content align="end">
                                        <x-ui.dropdown.group>
                                            <x-ui.dropdown.label>{{ __('Demo actions') }}</x-ui.dropdown.label>
                                            <x-ui.dropdown.item href="#dashboard-data-table-heading">{{ __('Preview item') }}</x-ui.dropdown.item>
                                            <x-ui.dropdown.item>{{ __('Copy reference') }}</x-ui.dropdown.item>
                                        </x-ui.dropdown.group>
                                    </x-ui.dropdown.content>
                                </x-ui.dropdown>
                            </x-ui.table.cell>
                        </x-ui.table.row>
                    @endforeach
                </x-ui.table.body>
            </x-ui.table>
        </x-ui.card.content>
    </x-ui.card>
</section>
