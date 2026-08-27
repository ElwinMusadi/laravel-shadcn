<x-playground.layout
    :title="__('Data Display')"
    :description="__('Table dan Pagination sebagai surface presentasi responsif untuk data lokal statis.')"
    current="data"
>
    <section class="flex flex-col gap-4" aria-labelledby="table-heading">
        <div class="flex flex-col gap-1">
            <x-ui.heading id="table-heading" variant="section">Table</x-ui.heading>
            <x-ui.heading variant="description">{{ __('x-ui.table membungkus table native dengan overflow horizontal responsif; data contoh ini tidak berasal dari database.') }}</x-ui.heading>
        </div>

        <x-ui.card>
            <x-ui.card.header>
                <x-ui.card.title>Recent invoices</x-ui.card.title>
                <x-ui.card.description>Header, body, footer, badge status, dan action area menggunakan komponen aktual.</x-ui.card.description>
            </x-ui.card.header>
            <x-ui.card.content>
                <x-ui.table>
                    <x-ui.table.caption>Static invoice records for table presentation.</x-ui.table.caption>
                    <x-ui.table.header>
                        <x-ui.table.row><x-ui.table.head>Invoice</x-ui.table.head><x-ui.table.head>Status</x-ui.table.head><x-ui.table.head>Customer</x-ui.table.head><x-ui.table.head class="text-right">Amount</x-ui.table.head><x-ui.table.head><span class="sr-only">Actions</span></x-ui.table.head></x-ui.table.row>
                    </x-ui.table.header>
                    <x-ui.table.body>
                        @foreach ([['INV-001', 'Paid', 'secondary', 'Ayu Pratama', '$250.00'], ['INV-002', 'Pending', 'outline', 'Raka Wijaya', '$150.00'], ['INV-003', 'Failed', 'destructive', 'Sinta Dewi', '$80.00']] as [$invoice, $status, $variant, $customer, $amount])
                            <x-ui.table.row>
                                <x-ui.table.cell class="font-medium text-foreground">{{ $invoice }}</x-ui.table.cell>
                                <x-ui.table.cell><x-ui.badge :variant="$variant">{{ $status }}</x-ui.badge></x-ui.table.cell>
                                <x-ui.table.cell>{{ $customer }}</x-ui.table.cell>
                                <x-ui.table.cell class="text-right font-mono text-xs">{{ $amount }}</x-ui.table.cell>
                                <x-ui.table.cell class="text-right"><x-ui.button variant="ghost" size="icon" aria-label="View {{ $invoice }}">…</x-ui.button></x-ui.table.cell>
                            </x-ui.table.row>
                        @endforeach
                    </x-ui.table.body>
                    <x-ui.table.footer>
                        <x-ui.table.row><x-ui.table.cell colspan="3">Total</x-ui.table.cell><x-ui.table.cell class="text-right font-mono text-xs">$480.00</x-ui.table.cell><x-ui.table.cell></x-ui.table.cell></x-ui.table.row>
                    </x-ui.table.footer>
                </x-ui.table>
            </x-ui.card.content>
        </x-ui.card>
        <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-4 text-sm text-foreground"><code class="font-mono">@verbatim
<x-ui.table>
    <x-ui.table.header>…</x-ui.table.header>
    <x-ui.table.body>…</x-ui.table.body>
</x-ui.table>
@endverbatim</code></pre>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="pagination-heading">
        <x-ui.heading id="pagination-heading" variant="section">Pagination</x-ui.heading>
        <x-ui.card>
            <x-ui.card.content class="flex flex-col gap-4 pt-6">
                <x-ui.pagination label="Invoice pages">
                    <x-ui.pagination.item><x-ui.pagination.previous disabled /></x-ui.pagination.item>
                    <x-ui.pagination.item><x-ui.pagination.link href="#invoice-page-1" active>1</x-ui.pagination.link></x-ui.pagination.item>
                    <x-ui.pagination.item><x-ui.pagination.link href="#invoice-page-2">2</x-ui.pagination.link></x-ui.pagination.item>
                    <x-ui.pagination.item><x-ui.pagination.link href="#invoice-page-3">3</x-ui.pagination.link></x-ui.pagination.item>
                    <x-ui.pagination.item><x-ui.pagination.ellipsis /></x-ui.pagination.item>
                    <x-ui.pagination.item><x-ui.pagination.next href="#invoice-page-2" /></x-ui.pagination.item>
                </x-ui.pagination>
                <p class="text-sm leading-6 text-muted-foreground">{{ __('Pagination hanya menyusun landmark dan control. Query, page resolver, dan state pagination tetap dimiliki pemanggil.') }}</p>
            </x-ui.card.content>
        </x-ui.card>
    </section>
</x-playground.layout>
