@php
    $route = request()->route()?->getName() ?? '';
    $nav = [
        ['name' => 'student.profile',  'icon' => 'bi-person-circle',    'label' => 'Profil Saya'],
        ['name' => 'student.history',  'icon' => 'bi-clock-history',    'label' => 'Riwayat Belajar'],
        ['name' => 'student.rating',   'icon' => 'bi-star-half',        'label' => 'Rating & Review'],
        
    ];
@endphp

<nav class="flex-1 overflow-y-auto px-3 py-3 space-y-0.5">
    <p class="text-[10px] font-semibold uppercase tracking-widest px-3 mb-2" style="color:#5a7297;">Menu Mahasiswa</p>
    @foreach($nav as $item)
    @php $active = $route === $item['name']; @endphp
    <a href="{{ route($item['name']) }}"
       onclick="sCloseDrawer()"
       class="s-nav-item {{ $active ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-pointer transition-colors">
        <i class="bi {{ $item['icon'] }} text-base {{ $active ? '' : '' }}"
           style="{{ $active ? 'color:#7ba7f5;' : 'color:#5a7297;' }}"></i>
        <span class="text-sm {{ $active ? 'font-semibold text-white' : 'font-medium' }}"
              style="{{ $active ? '' : 'color:#8aaad0;' }}">{{ $item['label'] }}</span>
        @if($active)
        <span class="ml-auto w-1.5 h-1.5 rounded-full shrink-0" style="background:#4D81EE;"></span>
        @endif
    </a>
    @endforeach
</nav>
