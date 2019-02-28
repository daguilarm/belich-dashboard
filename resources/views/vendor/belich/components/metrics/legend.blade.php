{{-- Legends --}}
@hasMetricsLegends($metric)
    <div class="text-xs text-{{ setColor($metric, 'legend-color') }}-dark opacity-75 float-right border border-solid rounded-lg border-{{ setColor($metric, 'title-color') }}-lighter bg-{{ setColor($metric, 'title-color') }}-lightest mt-2 px-4 mr-5">
        <div class="p-1"><b class="mr-1">X:</b> {{ $metric->legend_h }}</div>
        <div class="p-1"><b class="mr-1">Y:</b> {{ $metric->legend_v }}</div>
    </div>
@endif
