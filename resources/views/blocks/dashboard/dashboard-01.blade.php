@php
    $metrics ??= [
        [
            'label' => __('Total Revenue'),
            'value' => '$1,250.00',
            'trend' => '+12.5%',
            'trendText' => __('Trending up this month'),
            'description' => __('Visitors for the last 6 months'),
            'trendIcon' => 'trending-up',
            'trendPositive' => true,
        ],
        [
            'label' => __('New Customers'),
            'value' => '1,234',
            'trend' => '-20%',
            'trendText' => __('Down 20% this period'),
            'description' => __('Acquisition needs attention'),
            'trendIcon' => 'trending-down',
            'trendPositive' => false,
        ],
        [
            'label' => __('Active Accounts'),
            'value' => '45,678',
            'trend' => '+12.5%',
            'trendText' => __('Strong user retention'),
            'description' => __('Engagement exceeds targets'),
            'trendIcon' => 'trending-up',
            'trendPositive' => true,
        ],
        [
            'label' => __('Growth Rate'),
            'value' => '4.5%',
            'trend' => '+4.5%',
            'trendText' => __('Steady performance increase'),
            'description' => __('Meets growth projections'),
            'trendIcon' => 'trending-up',
            'trendPositive' => true,
        ],
    ];

    $chartSeries ??= [
        '90d' => [
            'label' => __('Last 3 months'),
            'summary' => __('Visitors increased from 222 to 498 across the last three months.'),
            'labels' => [__('Apr 1'), __('Apr 15'), __('May 1'), __('May 15'), __('Jun 1'), __('Jun 30')],
            'values' => [222, 342, 293, 473, 385, 498],
        ],
        '30d' => [
            'label' => __('Last 30 days'),
            'summary' => __('Visitors increased from 178 to 446 across the last 30 days.'),
            'labels' => [__('Jun 1'), __('Jun 6'), __('Jun 12'), __('Jun 18'), __('Jun 24'), __('Jun 30')],
            'values' => [178, 294, 492, 341, 132, 446],
        ],
        '7d' => [
            'label' => __('Last 7 days'),
            'summary' => __('Visitors increased from 149 to 446 across the last seven days.'),
            'labels' => [__('Jun 24'), __('Jun 25'), __('Jun 26'), __('Jun 27'), __('Jun 28'), __('Jun 30')],
            'values' => [141, 434, 448, 149, 103, 446],
        ],
    ];

    $tableRows ??= [
        ['id' => 1, 'header' => __('Cover page'), 'type' => __('Cover page'), 'status' => __('In Process'), 'statusVariant' => 'outline', 'target' => '18', 'limit' => '5', 'reviewer' => __('Eddie Lake')],
        ['id' => 2, 'header' => __('Table of contents'), 'type' => __('Table of contents'), 'status' => __('Done'), 'statusVariant' => 'secondary', 'target' => '29', 'limit' => '24', 'reviewer' => __('Eddie Lake')],
        ['id' => 3, 'header' => __('Executive summary'), 'type' => __('Narrative'), 'status' => __('Done'), 'statusVariant' => 'secondary', 'target' => '10', 'limit' => '13', 'reviewer' => __('Eddie Lake')],
        ['id' => 4, 'header' => __('Technical approach'), 'type' => __('Narrative'), 'status' => __('Done'), 'statusVariant' => 'secondary', 'target' => '27', 'limit' => '23', 'reviewer' => __('Jamik Tashpulatov')],
        ['id' => 5, 'header' => __('Design'), 'type' => __('Narrative'), 'status' => __('In Process'), 'statusVariant' => 'outline', 'target' => '2', 'limit' => '16', 'reviewer' => __('Jamik Tashpulatov')],
        ['id' => 6, 'header' => __('Capabilities'), 'type' => __('Narrative'), 'status' => __('In Process'), 'statusVariant' => 'outline', 'target' => '20', 'limit' => '8', 'reviewer' => __('Jamik Tashpulatov')],
        ['id' => 7, 'header' => __('Integration with existing systems'), 'type' => __('Narrative'), 'status' => __('In Process'), 'statusVariant' => 'outline', 'target' => '19', 'limit' => '21', 'reviewer' => __('Jamik Tashpulatov')],
        ['id' => 8, 'header' => __('Innovation and Advantages'), 'type' => __('Narrative'), 'status' => __('Done'), 'statusVariant' => 'secondary', 'target' => '25', 'limit' => '26', 'reviewer' => __('Assign reviewer')],
        ['id' => 9, 'header' => __('Overview of EMR Innovative Solutions'), 'type' => __('Technical content'), 'status' => __('Done'), 'statusVariant' => 'secondary', 'target' => '7', 'limit' => '23', 'reviewer' => __('Assign reviewer')],
        ['id' => 10, 'header' => __('Advanced Algorithms and Machine Learning'), 'type' => __('Narrative'), 'status' => __('Done'), 'statusVariant' => 'secondary', 'target' => '30', 'limit' => '28', 'reviewer' => __('Assign reviewer')],
    ];
@endphp

<div class="flex w-full flex-col gap-4 py-4 md:gap-6 md:py-6" data-test="dashboard-01">
    @include('blocks.dashboard.section-cards', ['metrics' => $metrics])
    @include('blocks.dashboard.chart-area', ['chartSeries' => $chartSeries])
    @include('blocks.dashboard.data-table', ['tableRows' => $tableRows])
</div>
