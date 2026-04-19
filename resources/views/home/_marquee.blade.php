    {{-- ── MARQUEE DIVIDER ── --}}
    <div class="marquee-section">
        <div class="marquee-inner">
            @php
                $items = ['Aerodynamics', '·', 'Performance', '·', 'Speed', '·', 'Precision', '·', 'Power', '·', 'Technology', '·', 'Carbon Fibre', '·', 'Hybrid Unit', '·', 'Downforce', '·', 'Podium', '·', 'Aerodynamics', '·', 'Performance', '·', 'Speed', '·', 'Precision', '·', 'Power', '·', 'Technology', '·', 'Carbon Fibre', '·', 'Hybrid Unit', '·', 'Downforce', '·', 'Podium', '·'];
            @endphp
            @foreach($items as $idx => $item)
                <span class="marquee-item {{ $item !== '·' && $idx % 4 === 0 ? 'red' : '' }}">{{ $item }}</span>
            @endforeach
        </div>
    </div>