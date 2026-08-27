<x-layouts::app
    :title="__('Dashboard')"
    :description="__('An overview of the current workspace using static demo data.')"
    :breadcrumbs="[
        ['label' => __('Dashboard')],
    ]"
    :show-page-header="true"
>
    @include('blocks.dashboard.dashboard-01')
</x-layouts::app>
