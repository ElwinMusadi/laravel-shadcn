<section aria-labelledby="dashboard-chart-section-heading" data-test="dashboard-chart">
    <x-ui.heading id="dashboard-chart-section-heading" variant="section" class="sr-only">
        {{ __('Activity chart') }}
    </x-ui.heading>

    <x-ui.card x-data="{ activeRange: '90d' }">
        <x-ui.card.header class="flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="flex flex-col gap-1.5">
                <x-ui.card.title>{{ __('Activity overview') }}</x-ui.card.title>
                <x-ui.card.description>{{ __('A static demonstration of activity over a selected time range.') }}</x-ui.card.description>
            </div>

            <div
                class="flex flex-wrap items-center gap-2"
                role="group"
                aria-label="{{ __('Select chart time range') }}"
                data-test="dashboard-chart-range-control"
            >
                @foreach ($chartSeries as $range => $series)
                    <x-ui.button
                        variant="outline"
                        size="sm"
                        type="button"
                        aria-controls="dashboard-chart-{{ $range }}"
                        :aria-pressed="$range === '90d' ? 'true' : 'false'"
                        @click="activeRange = '{{ $range }}'"
                        x-bind:aria-pressed="activeRange === '{{ $range }}'"
                        x-bind:class="{ 'bg-accent text-accent-foreground': activeRange === '{{ $range }}' }"
                    >
                        {{ $series['label'] }}
                    </x-ui.button>
                @endforeach
            </div>
        </x-ui.card.header>

        <x-ui.card.content>
            <figure aria-describedby="dashboard-chart-description">
                <figcaption id="dashboard-chart-description" class="text-sm text-muted-foreground">
                    {{ __('Each chart has a text alternative with its labels and values. Selecting another range updates the displayed SVG chart.') }}
                </figcaption>

                @foreach ($chartSeries as $range => $series)
                    @php
                        $chartPoints = [];
                        $polylineCoordinates = [];
                        $seriesPointCount = max(count($series['values']) - 1, 1);

                        foreach ($series['values'] as $index => $value) {
                            $x = 52 + ($index * (656 / $seriesPointCount));
                            $y = 232 - (($value / 100) * 176);

                            $chartPoints[] = [
                                'label' => $series['labels'][$index],
                                'value' => $value,
                                'x' => $x,
                                'y' => $y,
                            ];
                            $polylineCoordinates[] = $x.','.$y;
                        }

                        $polylinePoints = implode(' ', $polylineCoordinates);
                    @endphp

                    <div
                        @if ($range !== '90d') style="display: none" @endif
                        x-show="activeRange === '{{ $range }}'"
                    >
                        <svg
                            id="dashboard-chart-{{ $range }}"
                            class="mt-6 h-auto w-full overflow-visible"
                            viewBox="0 0 760 280"
                            role="img"
                            aria-labelledby="dashboard-chart-title-{{ $range }} dashboard-chart-summary-{{ $range }}"
                        >
                            <title id="dashboard-chart-title-{{ $range }}">{{ $series['label'] }}</title>
                            <desc id="dashboard-chart-summary-{{ $range }}">{{ $series['summary'] }}</desc>

                            <g class="stroke-border" stroke-width="1">
                                <line x1="52" y1="56" x2="708" y2="56" />
                                <line x1="52" y1="100" x2="708" y2="100" />
                                <line x1="52" y1="144" x2="708" y2="144" />
                                <line x1="52" y1="188" x2="708" y2="188" />
                                <line x1="52" y1="232" x2="708" y2="232" />
                            </g>

                            <g class="fill-muted-foreground text-[11px] font-medium">
                                <text x="12" y="60">100</text>
                                <text x="20" y="148">50</text>
                                <text x="28" y="236">0</text>
                            </g>

                            <polyline
                                points="{{ $polylinePoints }}"
                                fill="none"
                                class="stroke-chart-1"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="3"
                            />

                            @foreach ($chartPoints as $point)
                                <circle
                                    cx="{{ $point['x'] }}"
                                    cy="{{ $point['y'] }}"
                                    r="5"
                                    class="fill-card stroke-chart-1"
                                    stroke-width="3"
                                    data-chart-point
                                />
                                <text
                                    x="{{ $point['x'] }}"
                                    y="264"
                                    text-anchor="middle"
                                    class="fill-muted-foreground text-[11px]"
                                >{{ $point['label'] }}</text>
                            @endforeach
                        </svg>
                    </div>
                @endforeach

                    <div class="sr-only" aria-live="polite" data-test="dashboard-chart-data">
                        @foreach ($chartSeries as $range => $series)
                            <dl x-show="activeRange === '{{ $range }}'">
                                <div>
                                    <dt>{{ __('Selected time range') }}</dt>
                                    <dd>{{ $series['label'] }}</dd>
                                </div>
                                @foreach ($series['values'] as $index => $value)
                                    <div>
                                    <dt>{{ $series['labels'][$index] }}</dt>
                                    <dd>{{ $value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    @endforeach
                </div>
            </figure>
        </x-ui.card.content>
    </x-ui.card>
</section>
