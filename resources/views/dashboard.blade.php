<x-layouts::app
    :title="__('Documents')"
    :description="__('An overview of the current workspace using static demo data.')"
    :breadcrumbs="[
        ['label' => __('Dashboard')],
    ]"
    :show-page-header="false"
>
    @include('blocks.dashboard.dashboard-01')
</x-layouts::app>
