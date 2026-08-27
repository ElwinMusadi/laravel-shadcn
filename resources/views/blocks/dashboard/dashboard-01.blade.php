@php
    $metrics ??= [
        ['label' => __('Active workspaces'), 'value' => '128', 'trend' => '+12%', 'description' => __('Compared with the previous period.')],
        ['label' => __('Open items'), 'value' => '36', 'trend' => '+4', 'description' => __('Items currently awaiting attention.')],
        ['label' => __('Completed reviews'), 'value' => '1,284', 'trend' => '+18%', 'description' => __('Completed during this reporting period.')],
        ['label' => __('Automation rate'), 'value' => '74.2%', 'trend' => '+6.1%', 'description' => __('Tasks completed without manual follow-up.')],
    ];

    $chartSeries ??= [
        '90d' => [
            'label' => __('Last 3 months'),
            'summary' => __('Activity increased from 38 to 76 across the last three months.'),
            'labels' => [__('Week 1'), __('Week 3'), __('Week 5'), __('Week 7'), __('Week 9'), __('Week 11')],
            'values' => [38, 52, 47, 64, 58, 76],
        ],
        '30d' => [
            'label' => __('Last 30 days'),
            'summary' => __('Activity increased from 46 to 82 across the last 30 days.'),
            'labels' => [__('Day 1'), __('Day 6'), __('Day 12'), __('Day 18'), __('Day 24'), __('Day 30')],
            'values' => [46, 58, 51, 69, 73, 82],
        ],
        '7d' => [
            'label' => __('Last 7 days'),
            'summary' => __('Activity increased from 54 to 88 across the last seven days.'),
            'labels' => [__('Mon'), __('Tue'), __('Wed'), __('Thu'), __('Fri'), __('Sat')],
            'values' => [54, 61, 57, 72, 68, 88],
        ],
    ];

    $tableRows ??= [
        ['id' => 1, 'name' => __('Project brief'), 'status' => __('In review'), 'statusVariant' => 'secondary', 'category' => __('Document'), 'target' => '18', 'limit' => '5', 'owner' => __('Alex Morgan')],
        ['id' => 2, 'name' => __('Research summary'), 'status' => __('Ready'), 'statusVariant' => 'default', 'category' => __('Research'), 'target' => '29', 'limit' => '24', 'owner' => __('Sam Rivera')],
        ['id' => 3, 'name' => __('Planning notes'), 'status' => __('Ready'), 'statusVariant' => 'default', 'category' => __('Planning'), 'target' => '10', 'limit' => '13', 'owner' => __('Jordan Lee')],
        ['id' => 4, 'name' => __('Design review'), 'status' => __('In review'), 'statusVariant' => 'secondary', 'category' => __('Design'), 'target' => '27', 'limit' => '23', 'owner' => __('Taylor Kim')],
    ];
@endphp

<div class="flex w-full flex-col gap-6" data-test="dashboard-01">
    @include('blocks.dashboard.section-cards', ['metrics' => $metrics])
    @include('blocks.dashboard.chart-area', ['chartSeries' => $chartSeries])
    @include('blocks.dashboard.data-table', ['tableRows' => $tableRows])
</div>
