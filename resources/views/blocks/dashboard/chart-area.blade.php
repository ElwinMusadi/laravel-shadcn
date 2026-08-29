<section class="px-4 lg:px-6" aria-labelledby="dashboard-chart-section-heading" data-test="dashboard-chart">
    <x-ui.heading id="dashboard-chart-section-heading" variant="section" class="sr-only">
        {{ __('Total visitors chart') }}
    </x-ui.heading>

    <x-ui.card x-data="{ activeRange: '90d' }">
        <x-ui.card.header class="flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="flex flex-col gap-1">
                <x-ui.card.title>{{ __('Total Visitors') }}</x-ui.card.title>
                <x-ui.card.description>{{ __('Total for the last 3 months') }}</x-ui.card.description>
            </div>

            <div class="flex items-center" data-test="dashboard-chart-range-control">
                <div class="hidden items-center rounded-md border border-input p-0.5 md:flex" role="group" aria-label="{{ __('Select chart time range') }}">
                    @foreach ($chartSeries as $range => $series)
                        <x-ui.button
                            variant="ghost"
                            size="sm"
                            type="button"
                            aria-controls="dashboard-chart-{{ $range }}"
                            :aria-pressed="$range === '90d' ? 'true' : 'false'"
                            @click="activeRange = '{{ $range }}'"
                            x-bind:aria-pressed="activeRange === '{{ $range }}'"
                            x-bind:class="{ 'bg-accent text-accent-foreground shadow-xs': activeRange === '{{ $range }}' }"
                        >
                            {{ $series['label'] }}
                        </x-ui.button>
                    @endforeach
                </div>

                <x-ui.select x-model="activeRange" class="w-40 md:hidden" aria-label="{{ __('Select chart time range') }}" data-test="dashboard-chart-range-select">
                    @foreach ($chartSeries as $range => $series)
                        <option value="{{ $range }}">{{ $series['label'] }}</option>
                    @endforeach
                </x-ui.select>
            </div>
        </x-ui.card.header>

        <x-ui.card.content class="px-2 pt-0 sm:px-6 sm:pt-0">
            <figure aria-describedby="dashboard-chart-description">
                <figcaption id="dashboard-chart-description" class="sr-only">
                    {{ __('Selecting a time range updates the area chart and its text alternative.') }}
                </figcaption>

                @foreach ($chartSeries as $range => $series)
                    @php
                        $chartPoints = [];
                        $coordinates = [];
                        $pointCount = max(count($series['values']) - 1, 1);

                        foreach ($series['values'] as $index => $value) {
                            $x = 46 + ($index * (674 / $pointCount));
                            $y = 216 - (($value / 520) * 180);

                            $chartPoints[] = [
                                'label' => $series['labels'][$index],
                                'value' => $value,
                                'x' => $x,
                                'y' => $y,
                            ];
                            $coordinates[] = $x.','.$y;
                        }

                        $polylinePoints = implode(' ', $coordinates);
                        $linePath = implode(' L ', $coordinates);
                        $areaPath = 'M '.$coordinates[0].' L '.$linePath.' L '.$chartPoints[array_key_last($chartPoints)]['x'].',216 L '.$chartPoints[0]['x'].',216 Z';
                    @endphp

                    <div @if ($range !== '90d') style="display: none" @endif x-show="activeRange === '{{ $range }}'">
                        <svg
                            id="dashboard-chart-{{ $range }}"
                            class="h-[250px] w-full overflow-visible"
                            viewBox="0 0 760 250"
                            role="img"
                            aria-labelledby="dashboard-chart-title-{{ $range }} dashboard-chart-summary-{{ $range }}"
                        >
                            <title id="dashboard-chart-title-{{ $range }}">{{ $series['label'] }}</title>
                            <desc id="dashboard-chart-summary-{{ $range }}">{{ $series['summary'] }}</desc>

                            <g class="stroke-border" stroke-width="1">
                                <line x1="46" y1="36" x2="720" y2="36" />
                                <line x1="46" y1="96" x2="720" y2="96" />
                                <line x1="46" y1="156" x2="720" y2="156" />
                                <line x1="46" y1="216" x2="720" y2="216" />
                            </g>

                            <g class="fill-muted-foreground text-[11px] font-medium">
                                <text x="8" y="40">500</text>
                                <text x="8" y="160">250</text>
                                <text x="24" y="220">0</text>
                            </g>

                            <path d="{{ $areaPath }}" class="fill-chart-1/20" />
                            <polyline
                                points="{{ $polylinePoints }}"
                                fill="none"
                                class="stroke-chart-1"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2.5"
                            />

                            @foreach ($chartPoints as $point)
                                <circle
                                    cx="{{ $point['x'] }}"
                                    cy="{{ $point['y'] }}"
                                    r="3"
                                    class="fill-card stroke-chart-1"
                                    stroke-width="2"
                                    data-chart-point
                                />
                                <text
                                    x="{{ $point['x'] }}"
                                    y="240"
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
