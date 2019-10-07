<div class="{{ $metric->width }} h-80 p-2 overflow-hidden shadow bg-white border border-gray-200">
    {{-- Legends --}}
    @includeWhen(hasMetricsLegends($metric), 'belich::components.metrics.legend')

    {{-- Header --}}
    <h4 class="text-{{ setColor($metric, 'title-color') }}-600 mt-2 px-4 ml-2">{{ $metric->name }}</h4>

    {{-- Graph --}}
    <div class="h-full py-4 pr-4">
        <div
            id="graph-{{ md5($metric->uriKey) }}"
            class="ct-chart {{ $metric->uriKey }} ct-perfect-fourth {{ ($metric->legend_h || $metric->legend_v) ? 'h-50 mt-3 z-10' : 'max-h-full' }} z-10">
        </div>
    </div>
</div>

@prepend('javascript-metrics')
    {!!
        Chart::uriKey($metric->uriKey)
            ->labels($metric->labels)
            //Pie charts has not support for multidimensional arrays
            ->series(($metric->type === 'pie') ? $metric->calculate : [$metric->calculate])
            ->type($metric->type)
            ->withArea($metric->withArea)
            ->get()
    !!}
@endprepend

@prepend('css-metrics')
    {{-- Load the custom css styles for the lib --}}
    {!! Chart::css($metric) !!}
@endprepend
