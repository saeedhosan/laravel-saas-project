{{-- For submenu --}}
<ul class="menu-content">
    @if (isset($menu))
        @foreach ($menu as $submenu)
            @can($submenu->access, auth()->user())
                <li class="{{ request()->url() === $submenu->url ? 'active' : '' }}">
                    <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}"
                        class="d-flex align-items-center">
                        @if (isset($submenu->icon))
                            <i data-feather="{{ $submenu->icon ?? '' }}"></i>
                        @endif
                        <span class="menu-item text-truncate">{{ $submenu->name ?? '' }}</span>
                        @isset($menu->new)
                            <span class="bg-success text-with rounded" style="padding: 0 .5rem; margin-left: 10px;">new</span>
                        @endisset
                    </a>
                    @if (isset($submenu->submenu))
                        @include('panels/submenu', ['menu' => $submenu->submenu])
                    @endif
                </li>
            @endcan
        @endforeach
    @endif
</ul>
